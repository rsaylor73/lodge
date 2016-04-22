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
            	print "<pre>";
            	print_r($a);
            	print "</pre>";
            	echo $a->get_response_reason_text();
            	break;

            	case 2:  // Declined
            	echo $a->get_response_reason_text();
            	break;

            	case 3: // Error
            	echo $a->get_response_reason_text();
            	break;
            }



			break;

			case "2":
			// Check


			break;

			case "3":
			// Wire


			break;
		}
	}
















}