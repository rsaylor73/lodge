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
			`p`.`amount`

		FROM
			`payments` p

		WHERE
			`p`.`reservationID` = '$reservationID'
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>$row[payment_type]</td><td>$$row[amount]</td><td>$row[payment_date]</td><td>$row[transactionID]</td></tr>";
			$total = $total + $row['amount'];
		}
		if ($total > 0) {
			$html .= "<tr><td><b>Total:</b></td><td>$$total</td><td colspan=2>&nbsp;</td></tr>";
		}
		return $html;
	}

	public function get_discount_history($reservationID) {
		$sql = "
		SELECT
			`gdr`.`general_discount_reason`,
			`d`.`amount`,
			DATE_FORMAT(`d`.`date_added`, '%m/%d/%Y') AS 'date_added'

		FROM
			`lodge_res`.`discounts` d,
			`reserve`.`general_discount_reasons` gdr

		WHERE
			`d`.`reservationID` = '$reservationID'
			AND `d`.`general_discount_reasonID` = `gdr`.`general_discount_reasonID`

		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>$row[general_discount_reason]</td><td>$$row[amount]</td><td>$row[date_added]</td></tr>";
			$total = $total + $row['amount'];
		}
		if ($amount > 0) {
			$html .= "<tr><td><b>Total:</b></td><td><b>$$total</b></td><td>&nbsp;</td></tr>";
		}
		return $html;
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

	private function get_discount_reasons() {
		$sql = "
		SELECT
			`gdr`.`general_discount_reasonID`,
			`gdr`.`general_discount_reason`

		FROM
			`reserve`.`general_discount_reasons` gdr

		WHERE
			`gdr`.`status2` = 'active'
			AND `gdr`.`hide` != 'checked'

		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[general_discount_reasonID]\">$row[general_discount_reason]</option>";
		}
		return $options;
	}

	// Record info about the discount
	public function add_discounts() {
		$discount_options = $this->get_discount_reasons();

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












}