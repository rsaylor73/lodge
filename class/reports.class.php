<?php
include $GLOBAL['path']."/class/admin.class.php";

class reports extends admin {

	public function checkinreport() {
		$sql = "
		SELECT
			`r`.`reservationID`,
			MIN(`i`.`date_code`) AS 'date'

		FROM
			`inventory` i,
			`beds` b,
			`reservations` r

		WHERE
			`i`.`locationID` = '2'
			AND `i`.`date_code` BETWEEN '20160606' AND '20160616'
			AND `i`.`inventoryID` = `b`.`inventoryID`
			AND `b`.`reservationID` = `r`.`reservationID`
			AND `r`.`active` = 'Yes'

		GROUP BY `r`.`reservationID`
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$test_date = $this->get_reservation_dates($row['reservationID'],'ASC','reports');
			print "Test: $row[reservationID] | $row[date] | $test_date<br>";
		}
	}
}