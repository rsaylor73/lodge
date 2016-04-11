<?php
include $GLOBAL['path']."/class/core.class.php";

class money extends Core {

	public function dollars($reservationID) {
		$sql = "
		SELECT
			`i`.`nightly_rate`

		FROM
			`beds` b, `inventory` i

		WHERE
			`b`.`reservationID` = '$reservationID'
			AND `b`.`inventoryID` = `i`.`inventoryID`

		LIMIT 1
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$nightly_rate = $row['nightly_rate'];
		}
		$nights = $this->get_reservation_nights($reservationID);

		print "Test:<br>
		Nightly Rate: $nightly_rate<br>
		Nights: $nights<br>

		";

	}
}