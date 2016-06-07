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
			$pax = $this->get_total_pax($row['reservationID']);
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
					<td>$pax</td>
				</tr>
				";

				// get contact details
				$sql2 = "
				SELECT
					b.*,
					`c`.`first`,
					`c`.`last`,
					`c`.`email`,
					`c`.`sex`,
					`c`.`address1`,
					`c`.`address2`,
					`c`.`city`,
					`c`.`province`,
					`c`.`state`,
					`cn`.`country`,
					`c`.`phone1_type`,
					`c`.`phone1`,
					`c`.`phone2_type`,
					`c`.`phone2`,
					`c`.`phone3_type`,
					`c`.`phone3`,
					`c`.`phone4_type`,
					`c`.`phone4`,
					DATE_FORMAT(`c`.`date_of_birth`, '%m/%d/%Y') AS 'dob'

				FROM
					`beds` b,
					`reserve`.`contacts` c

				LEFT JOIN `reserve`.`countries` cn ON `c`.`countryID` = `cn`.`countryID`

				WHERE
					`b`.`reservationID` = '$row[reservationID]'
					AND `b`.`contactID` != ''
					AND `b`.`contactID` = `c`.`contactID`

				GROUP BY `b`.`name`, `b`.`contactID`
				";
				$counter = "0";
				$result2 = $this->new_mysql($sql2);
				while ($row2 = $result2->fetch_assoc()) {
					$counter++;
					$html .= "
					<tr bgcolor=\"#F5F5F5\"><td colspan=3><b>Guest $counter</b></td></tr>
					<tr><td>$row2[first]</td><td colspan=2>$row2[last]</td></tr>
					<tr><td colspan=3>$row2[email]</td></tr>
					<tr><td colspan=3>Gender: $row[2sex]</td></tr>
					<tr><td colspan=3>DOB: $row2[dob]</td></tr>
					";
				}
				$html .= "<tr><td colspan=3><hr></td></tr>";

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