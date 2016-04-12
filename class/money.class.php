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

		if ($child1_age != "") {
			$age1 = $this->child_age_map($child1_age);
			$fee = $this->child_age_fee($child1_age);
			$child_amount1 = $nightly_rate/2)/$fee;
			//print "Child 1 amount: $child_amount<br>";
		}

		if ($child2_age != "") {
			$age2 = $this->child_age_map($child2_age);
			$fee = $this->child_age_fee($child2_age);
			$child_amount2 = ($nightly_rate/2)/$fee;
			//print "Child 2 amount: $child_amount<br>";
		}

		$total = $adults + $child_amount1 + $child_amount2;

		$data['adults_rate'] = $adults;
		$data['nightly_rate'] = $nightly_rate;
		$data['child1_rate'] = $child_amount1;
		$data['child1_age'] = $age1;
		$data['child2_rate'] = $child_amount2;
		$data['child2_age'] = $age2;
		$data['nights'] = $nights;


		/*
		print "Test:<br>
		Nightly Rate: $nightly_rate<br>
		Nights: $nights<br>
		Child 1: $child1_age<br>
		Child 2: $child2_age<br>

		";
		*/

		return($data);
	}
}