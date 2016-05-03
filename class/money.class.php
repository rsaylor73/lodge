<?php
include $GLOBAL['path']."/class/core.class.php";

class money extends Core {

	public function dollars($reservationID) {
		$sql = "
		SELECT
			`i`.`nightly_rate`,
			`r`.`child1_age`,
			`r`.`child2_age`

		FROM
			`beds` b, `inventory` i, `reservations` r

		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`inventoryID` = `i`.`inventoryID`
			AND `r`.`reservationID` = '$reservationID'

		LIMIT 1
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$nightly_rate = $row['nightly_rate'];
			$child1_age = $row['child1_age'];
			$child2_age = $row['child2_age'];
		}
		$nights = $this->get_reservation_nights($reservationID);

		$adults = $nightly_rate * $nights;

		if ($child1_age > 0) {
			$age1 = $this->child_age_map($child1_age);
			$fee = $this->child_age_fee($child1_age);
			$child_amount1 = ($nightly_rate/2)/$fee;
		}

		if ($child2_age > 0) {
			$age2 = $this->child_age_map($child2_age);
			$fee = $this->child_age_fee($child2_age);
			$child_amount2 = ($nightly_rate/2)/$fee;
		}

		$total = $adults + $child_amount1 + $child_amount2;

		$data['adults_rate'] = $adults;
		$data['nightly_rate'] = $nightly_rate;
		$data['child1_rate'] = $child_amount1;
		$data['child1_age'] = $age1;
		$data['child2_rate'] = $child_amount2;
		$data['child2_age'] = $age2;
		$data['nights'] = $nights;

		return($data);
	}

	public function payments() {
		$template = "payments.tpl";
		$data['reservationID'] = $_GET['reservationID'];

		$this->load_smarty($data,$template);
	}

	public function processpayment() {
		switch ($_POST['payment_type']) {
			case "1":
			// Credit
         	require_once('class/authorizenet.class.php');
         	$a = new authorizenet_class;
         	$a->add_field('x_login', authnet_login);
         	$a->add_field('x_tran_key', authnet_key);
         	$a->add_field('x_version', '3.1');
         	$a->add_field('x_type', 'AUTH_CAPTURE');
         	if (authnet_testmode == "Yes") {
         		$a->add_field('x_test_request', 'TRUE');    // Just a test transaction
         	}
         	$a->add_field('x_relay_response', 'FALSE');
         	$a->add_field('x_delim_data', 'TRUE');
         	$a->add_field('x_delim_char', '|');
         	$a->add_field('x_encap_char', '');
         	$a->add_field('x_email_customer', 'FALSE');
         	$a->add_field('x_description', "ATSL $_POST[reservationID]");

         	$a->add_field('x_method', 'CC');
         	$a->add_field('x_card_num', $_POST['cc_num']);   // test successful visa
         	$a->add_field('x_amount', $_POST['payment_amount']);
         	$exp_date = $_POST['cc_month'] . $_POST['cc_year'];
         	$a->add_field('x_exp_date', $exp_date);    // march of 2008
         	$a->add_field('x_card_code', $_POST['cvv']);    // Card CAVV Security code

			switch ($a->process()) {
            	case 1: // Accepted
            	// $a->get_response_reason_text();
            	$transactionID = $a->get_transaction_id();
            	$payment = $this->record_payment($transactionID);
            	if ($payment == "TRUE") {
            		$msg = "<font color=green>The payment of $$_POST[payment_amount] was processed.</font>";
            	}
            	break;

            	case 2:  // Declined
            	$msg = "<font color=red>".$a->get_response_reason_text()."</font>";
            	break;

            	case 3: // Error
            	$msg = "<font color=red>".$a->get_response_reason_text()."</font>";
            	break;
            }



			break;

			case "2":
			// Check
			$payment = $this->record_payment($null);
            if ($payment == "TRUE") {
            	$msg = "<font color=green>The payment of $$_POST[payment_amount] was processed.</font>";
            }

			break;

			case "3":
			// Wire
			$payment = $this->record_payment($null);
            if ($payment == "TRUE") {
            	$msg = "<font color=green>The payment of $$_POST[payment_amount] was processed.</font>";
            }

			break;
		}

		$template = "completepayment.tpl";
		$data['reservationID'] = $_POST['reservationID'];
		if ($msg == "") {
			$msg = "<font color=red>There was an un-known error and the payment was not processed.</font>";
		}
		$data['msg'] = $msg;
		$this->load_smarty($data,$template);
	}

	private function record_payment($transactionID) {
		$today = date("Ymd");
		$sql = "

		INSERT INTO `payments` (`customer_name`,`reservationID`,`payment_type`,`transactionID`,`check_number`,`check_description`,`wire_description`,
		`amount`,`payment_date`,`insert_date`,`update_date`,`userID`)
		VALUES ('$_POST[cc_name]','$_POST[reservationID]','$_POST[payment_type]','$transactionID','$_POST[check_number]','$_POST[check_description]',
		'$_POST[wire_description]','$_POST[payment_amount]','$_POST[payment_date]',
		'$today','$today','$_SESSION[id]')
		";
		$result = $this->new_mysql($sql);
		return $result;
	}

	public function get_payment_history($reservationID) {
		$sql = "
		SELECT
			DATE_FORMAT(`p`.`payment_date`, '%m/%d/%Y') AS 'payment_date',
			IF(`p`.`transactionID` != '',`p`.`transactionID`,'N/A') AS 'transactionID',
			IF(`p`.`check_number` != '', `p`.`check_number`,'N/A') AS 'check_number',
			`p`.`payment_type`,
			`p`.`amount`,
			`p`.`id`

		FROM
			`payments` p

		WHERE
			`p`.`reservationID` = '$reservationID'
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>
			<a href=\"editpayment/$row[id]/$reservationID\"><i class=\"fa fa-wrench\" aria-hidden=\"true\"></i></a>&nbsp;
			<a href=\"deletepayment/$row[id]/$reservationID\" onclick=\"return confirm('You are about to delete a payment. Only an administration can continue. Click OK to confirm.')\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>&nbsp;
			$row[payment_type]</td><td>$$row[amount]</td><td>$row[payment_date]</td><td>$row[transactionID]</td></tr>";
			$total = $total + $row['amount'];
		}
		if ($total > 0) {
			$html .= "<tr><td><b>Total:</b></td><td>$$total</td><td colspan=2>&nbsp;</td></tr>";
		}
		return $html;
	}

	public function editpayment() {
		$template = "editpayment.tpl";
		$sql = "
		SELECT
			`p`.*

		FROM
			`payments` p

		WHERE
			`p`.`id` = '$_GET[id]'
			AND `p`.`reservationID` = '$_GET[reservationID]'

		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
		$this->load_smarty($data,$template);
	}

	public function updatepayment() {
		$today = date("Ymd");

		if ($_POST['check_number'] != "") {
			$c1_sql = " ,`check_number` = '$_POST[check_number]' ";
		}
		if ($_POST['check_description'] != "") {
			$c2_sql = " ,`check_description` = '$_POST[check_description]' ";
		}
		if ($_POST['wire_description'] != "") {
			$w1_sql = " ,`wire_description` = '$_POST[wire_description]' ";
		}

		$sql = "
		UPDATE `payments` SET `amount` = '$_POST[payment_amount]', `payment_date` = '$_POST[payment_date]', `update_date` = '$today', `userID` = '$_SESSION[userID]' $c1_sql $c2_sql $w1_sql WHERE `id` = '$_POST[id]' AND `reservationID` = '$_POST[reservationID]'
		";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The payment was updated.</font>";
		} else {
			$data['msg'] = "<font color=red>The payment failed to update.</font>";
		}
		$template = "updatepayment.tpl";
		$data['reservationID'] = $_POST['reservationID'];
		$this->load_smarty($data,$template);
	}

	public function deletepayment() {
		$sql = "DELETE FROM `payments` WHERE `id` = '$_GET[id]' AND `reservationID` = '$_GET[reservationID]'";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The payment was deleted.</font>";
		} else {
			$data['msg'] = "<font color=red>The payment failed to delete.</font>";
		}
		$template = "deletepayment.tpl";
		$data['reservationID'] = $_GET['reservationID'];
		$this->load_smarty($data,$template);
	}

	public function get_discount_history($reservationID) {
		$sql = "
		SELECT
			`gdr`.`reason`,
			`d`.`id`,
			`d`.`amount`,
			DATE_FORMAT(`d`.`date_added`, '%m/%d/%Y') AS 'date_added'

		FROM
			`discounts` d,
			`general_discount_reason` gdr

		WHERE
			`d`.`reservationID` = '$reservationID'
			AND `d`.`general_discount_reasonID` = `gdr`.`id`

		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>
			<a href=\"editdiscountassigned/$row[id]/$reservationID\"><i class=\"fa fa-wrench\" aria-hidden=\"true\"></i></a>&nbsp;
			<a href=\"deletediscountassigned/$row[id]/$reservationID\" onclick=\"return confirm('You are about to delete $row[reason]. Click OK to confirm.')\">
				<i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>&nbsp;

			$row[reason]</td><td>$$row[amount]</td><td>$row[date_added]</td></tr>";
			$total = $total + $row['amount'];
		}
		if ($amount > 0) {
			$html .= "<tr><td><b>Total:</b></td><td><b>$$total</b></td><td>&nbsp;</td></tr>";
		}
		return $html;
	}

	public function editdiscountassigned() {
		$template = "editdiscountassigned.tpl";
		$data['discount_options'] = $this->get_discount_reasons($id);
		$data['id'] = $_GET['id'];
		$data['reservationID'] = $_GET['reservationID'];
		$sql = "SELECT `amount` FROM `discounts` WHERE `id` = '$_GET[id]' AND `reservationID` = '$_GET[reservationID]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$data['amount'] = $row['amount'];
		}

		$this->load_smarty($data,$template);

	}

	public function update_new_discount() {
		$today = date("Ymd");
		$sql = "UPDATE `discounts` SET `general_discount_reasonID` = '$_POST[general_discount_reasonID]', `amount` = '$_POST[amount]', `date_modified` = '$today', `userID` = '$_SESSION[id]' 
		WHERE `id` = '$_POST[id]' AND `reservationID` = '$_POST[reservationID]' ";
		$result = $this->new_mysql($sql);
		$data['reservationID'] = $_POST['reservationID'];
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The discount was updated.</font>";
		} else {
			$data['msg'] = "<font color=red>The discount failed to update.</font>";
		}
		$template = "update_new_discount.tpl";
		$this->load_smarty($data,$template);
	}

	public function deletediscountassigned() {
		$sql = "DELETE FROM `discounts` WHERE `id` = '$_GET[id]' AND `reservationID` = '$_GET[reservationID]' ";
		$result = $this->new_mysql($sql);
		$data['reservationID'] = $_GET['reservationID'];
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The discount was deleted.</font>";
		} else {
			$data['msg'] = "<font color=red>The discount failed to delete.</font>";
		}
		$template = "deletediscountassigned.tpl";
		$this->load_smarty($data,$template);

	}

	// Record info about the line item billing
	public function add_line_item() {
		$template = "add_line_item.tpl";
		$data['options'] = $this->get_contacts_in_rsv($_GET['reservationID']);
		$data['line_items'] = $this->get_line_items();
		$data['reservationID'] = $_GET['reservationID'];

		$this->load_smarty($data,$template);

	}

	private function get_contacts_in_rsv($reservationID) {
		$sql = "
		SELECT
			`c`.`contactID`,
			`c`.`first`,
			`c`.`last`

		FROM
			`lodge_res`.`beds` b,
			`reserve`.`contacts` c
			

		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`contactID` = `c`.`contactID`

		GROUP BY `c`.`contactID`
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[contactID]\">$row[first] $row[last]</option>";
		}
		if ($options == "") {
			$options = "<option value=\"\">You need to assign contacts first.</option>";
		}
		return $options;
	}

	private function get_line_items() {
		$sql = "SELECT `id`,`title`,`price` FROM `line_items` ORDER BY `title` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[id]\">$row[title] ($$row[price])</option>";
		}
		if ($options == "") {
			$options = "<option value=\"\">There are no line items please add one.</option>";
		}
		return $options;
	}

	public function savelineitemtoguest() {
		$today = date("Ymd");
		$sql = "
		INSERT INTO `line_item_billing` (`reservationID`,`contactID`,`line_item_id`,`date_added`,`date_updated`,`userID`)
		VALUES ('$_POST[reservationID]','$_POST[contactID]','$_POST[line_item]','$today','$today','$_SESSION[id]')
		";
		$result = $this->new_mysql($sql);

		if ($result == "TRUE") {
			$msg = "<font color=green>The line item was added.</font>";
		} else {
			$msg = "<font color=red>The line item failed to add.</font>";
		}
		$template = "savelineitemtoguest.tpl";
		$data['reservationID'] = $_POST['reservationID'];
		$data['msg'] = $msg;
		$this->load_smarty($data,$template);

	}

	public function display_line_items_in_rsv($reservationID) {
		$sql = "
		SELECT
			`c`.`first`,
			`c`.`last`,
			`l`.`title`,
			`l`.`price`,
			`lib`.`id`

		FROM
			`lodge_res`.`line_item_billing` lib,
			`reserve`.`contacts` c,
			`lodge_res`.`line_items` l

		WHERE
			`lib`.`reservationID` = '$reservationID'
			AND `lib`.`line_item_id` = `l`.`id`
			AND `lib`.`contactID` = `c`.`contactID`

		";
		$result = $this->new_mysql($sql);
		while ($row=$result->fetch_assoc()) {
			$html .= "<tr><td>
				<a href=\"deletelineitemassigned/$row[id]/$reservationID\" onclick=\"return confirm('You are about to delete $row[title] from guest $row[first] $row[last]. Click OK to confirm')\">
				<i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>&nbsp;

			$row[first] $row[last]</td><td>$row[title]</td><td>$$row[price]</td></tr>";
			$total = $total + $row['price'];
			$found = "1";
		}
		if ($total > 0) {
			$html .= "<tr><td><b>Total:</b></td><td>&nbsp;</td><td><b>$$total</b></td></tr>";
		}
		if ($found != "1") {
			$html .= "<tr><td colspan=3><font color=blue>There are no line items selected.</font></td></tr>";
		}
		return $html;
	}



	public function deletelineitemassigned() {
		$sql = "DELETE FROM `line_item_billing` WHERE `id` = '$_GET[id]' AND `reservationID` = '$_GET[reservationID]' ";
		$result = $this->new_mysql($sql);
		$data['reservationID'] = $_GET['reservationID'];
		if ($result == "TRUE") {
			$data['msg'] = "<font color=green>The line item was deleted.</font>";
		} else {
			$data['msg'] = "<font color=red>The line item failed to delete.</font>";
		}
		$template = "deletelineitemassigned.tpl";
		$this->load_smarty($data,$template);
	}

	private function get_discount_reasons($id) {
		$sql = "
		SELECT
			`gdr`.`id`,
			`gdr`.`reason`

		FROM
			`general_discount_reason` gdr

		WHERE
			`gdr`.`show` = 'Yes'

		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if ($row['id'] == $id) {
				$options .= "<option selected value=\"$row[id]\">$row[reason]</option>";
			} else {
				$options .= "<option value=\"$row[id]\">$row[reason]</option>";
			}
		}
		return $options;
	}

	// Record info about the discount
	public function add_discounts() {
		$discount_options = $this->get_discount_reasons($null);

		$template = "add_discounts.tpl";
		$data['reservationID'] = $_GET['reservationID'];
		$data['discount_options'] = $discount_options;
		$this->load_smarty($data,$template);

	}

	// Record and save the discount to the RSV
	public function save_new_discount() {
		$today = date("Ymd");
		$sql = "INSERT INTO `discounts` (`general_discount_reasonID`,`amount`,`date_added`,`date_modified`,`userID`,`reservationID`) 
		VALUE ('$_POST[general_discount_reasonID]','$_POST[amount]','$today','$today','$_SESSION[id]','$_POST[reservationID]')";

		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$msg = "<font color=green>The discount was applied.</font>";
		} else {
			$msg = "<font color=red>The discount failed to apply.</font>";
		}
		$template = "save_new_discount.tpl";
		$data['reservationID'] = $_POST['reservationID'];
		$data['msg'] = $msg;
		$this->load_smarty($data,$template);

	}

	public function refundcashtransfer() {
		$template = "refundcashtransfer.tpl";
		$data['reservationID'] = $_GET['reservationID'];
		$this->load_smarty($data,$template);
	}

	public function saverefundcashtransfer() {
		$today = date("Ymd");
		$sql = "
		INSERT INTO `transfers` (`type`,`detail`,`referral_reservationID`,`reservationID`,`amount`,`userID`,`date_created`,`date_updated`) VALUES
		('$_POST[type]','$_POST[detail]','$_POST[referral_reservationID]','$_POST[reservationID]','$_POST[amount]','$_SESSION[id]','$today','$today')
		";
		$result = $this->new_mysql($sql);
		if ($result == "TRUE") {
			$msg = "<font color=green>The transfer was applied.</font>";
		} else {
			$msg = "<font color=red>The transfer failed to apply.</font>";
		}
		$template = "saverefundcashtransfer.tpl";
		$data['reservationID'] = $_POST['reservationID'];
		$data['msg'] = $msg;
		$this->load_smarty($data,$template);
	}

	public function listrefundtransfers($reservationID) {
		$sql = "SELECT `id`,`type`,`detail`,`referral_reservationID`,`amount` FROM `transfers` WHERE `reservationID` = '$reservationID'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>
			<a href=\"editrefundtransfer/$row[id]/$reservationID\"><i class=\"fa fa-wrench\" aria-hidden=\"true\"></i></a>
			&nbsp;
			<a href=\"deleterefundtransfer/$row[id]/$reservationID\" onclick=\"return confirm('You are about to delete $row[type] in the amount of $$row[amount]. Only an administrator can delete this transaction. Click Ok to confirm.')\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
			&nbsp;
			$row[type]</td><td>$row[detail]</td><td>$row[referral_reservationID]</td><td>$$row[amount]</td></tr>";
		}
		if ($html == "") {
			$html .= "<tr><td colspan=4><font color=blue>There are no refund/transfers.</font></td></tr>";
		}
		return $html;
	}

	public function editrefundtransfer() {
		$sql = "SELECT * FROM `transfers` WHERE `id` = '$_GET[id]' AND `reservationID` = '$_GET[reservationID]'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			foreach ($row as $key=>$value) {
				$data[$key] = $value;
			}
		}
		$template = "editrefundtransfer.tpl";
		$this->load_smarty($data,$template);
	}

	public function deleterefundtransfer() {

	}










}