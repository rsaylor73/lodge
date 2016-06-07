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
			$test_date_formatted = $this->get_reservation_dates($row['reservationID'],'ASC',$null);
			$nights	= $this->get_reservation_nights($row['reservationID']);
			if ($row['date'] == $test_date) {
				$html .= "
				<tr>
					<th><b>Conf #</b></th>
					<th><b>Nights</b></th>
					<th><b>Guests</b></th>
				</tr>
				";
				$html .= "
				<tr>
					<td><a href=\"reservation_dashboard/$row[reservationID]/details\">$row[reservationID]</a></td>
					<td>$nights</td>
					<td>$guests</td>
				</tr>
				";

			}
			//print "Test: $row[reservationID] | $row[date] | $test_date<br>";
		}

		// test to be placed in a template
		print "<div class=\"col-md-6\">";
		print "<h2>Check-In Report (Date Range TBD)</h2>";
		print "<table class=\"table\">";
		print "$html";
		print "</table>";
		print "</div>";

	}
}