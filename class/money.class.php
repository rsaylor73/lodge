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

		print "Test:<br>
		Nightly Rate: $nightly_rate<br>
		Nights: $nights<br>
		Child 1: $child1_age<br>
		Child 2: $child2_age<br>

		";

	}
}