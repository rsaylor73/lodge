<?php
include $GLOBAL['path']."/class/admin.class.php";

class reports extends admin {

	public function transferreport() {
		$sql = "
		SELECT
			`r`.`reservationID`,
			`l`.`title`,
			MIN(`i`.`date_code`) AS 'start_date',
			DATE_FORMAT(`i`.`date_code`, '%m/%d/%Y') AS 'formatted_date',
			DATEDIFF(`i`.`date_code`,now()) AS 'days'

		FROM
			`line_item_billing` lb,
			`reservations` r,
			`line_items` l,
			`beds` b,
			`inventory` i

		WHERE
			`lb`.`reservationID` = `r`.`reservationID`
			AND `r`.`cancelled` = 'No'
			AND `lb`.`line_item_id` = `l`.`id`
			AND `r`.`reservationID` = `b`.`reservationID`
			AND `b`.`inventoryID` = `i`.`inventoryID`

		GROUP BY `r`.`reservationID`

		ORDER BY `i`.`date_code` ASC
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			// get transferes for that RES
			$sql2 = "
			SELECT
				`c`.`first`,
				`c`.`last`,
				`c`.`email`,
				`l`.`title`

			FROM
				`line_item_billing` lb,
				`reserve`.`contacts` c,
				`line_items` l


			WHERE
				`lb`.`reservationID` = '$row[reservationID]'
				AND `lb`.`contactID` = `c`.`contactID`
				AND `lb`.`line_item_id` = `l`.`id`
			";
			$html .= "<tr><td colspan=2><b>Reservation: <a href=\"reservation_dashboard/$row[reservationID]/dollars\">$row[reservationID]</a> : Check-In Date $row[formatted_date]</b></td></tr>";
			$html .= "<tr><td><b>Package</b></td><td><b>Guest</b></td></tr>";
			$found = "0";
			$result2 = $this->new_mysql($sql2);
			while ($row2 = $result2->fetch_assoc()) {
				$found = "1";
				$html .= "<tr><td>$row2[title]</td><td>$row2[first] $row2[last]</td>";
			}
			if ($found == "0") {
				$html .= "<tr><td colspan=2><font color=red>There are no transfers for this reservation or the transfer has been removed.</font></td></tr>";
			}
			$html .= "<tr><td colspan=2><hr></td></tr>";
		}
		print "<div class=\"col-md-6\">";
		print "<h2>Transfer Report</h2>";
		print "<table class=\"table\">";
		print "$html";
		print "</table>";
		print "</div>";
	}

	public function paymentreport() {
		$sql = "
		SELECT
			SUM(`p`.`amount`) AS 'total',
			`p`.`reservationID`,
			`c`.`first`,
			`c`.`last`,
			`c`.`email`

		FROM
			`payments` p,
			`reservations` r

		LEFT JOIN `reserve`.`contacts` c ON `r`.`contactID` = `c`.`contactID`

		WHERE
			`p`.`reservationID` = `r`.`reservationID`

		GROUP BY `p`.`reservationID`
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			if (($row['first'] == "") && ($row['last'] == "")) {
				$row['first'] = "None";
				$row['email'] = "#";
			}
			$html .= "
			<tr>
				<td><a href=\"reservation_dashboard/$row[reservationID]/dollars\">$row[reservationID]</a></td>
				<td>$".number_format($row['total'],2,'.',',')."</td>
				<td><a href=\"mailto:$row[email]\">$row[first] $row[last]</a></td>
			</tr>
			";
		}

		print "<div class=\"col-md-6\">";
		print "<h2>Payment Report</h2>";
		print "<table class=\"table\">";
		print "<tr>
			<th>Conf #</th>
			<th>Amount Paid</th>
			<th>Contact</th>
		</tr>";
		print "$html";
		print "</table>";
		print "</div>";
	}

	public function balancereport() {
		print "<div class=\"col-sm-8\">";
                print "<h2>Balance Due Report</h2>";
                print "<i>This report is updated once every 4 hours.</i>";

                $today = date("Ymd");

                $temp = strtotime($today);
                $temp = strtotime("-3 YEAR", $temp);
                $past_due = date("Ymd", $temp);

                $temp = strtotime($today);
                $temp = strtotime("+90 DAY", $temp);
                $next_90 = date("Ymd", $temp);

                $temp = strtotime($today);
                $temp = strtotime("+6 MONTH", $temp);
                $next_6 = date("Ymd", $temp);

                $temp = strtotime($today);
                $temp = strtotime("+9 MONTH", $temp);
                $next_9 = date("Ymd", $temp);

                $temp = strtotime($today);
                $temp = strtotime("+10 YEAR",$temp);
                $greater = date("Ymd", $temp);

                $this->get_balance_report_range($past_due,$today,'allpast','All Past Due');
                $this->get_balance_report_range($today,$next_90,'90','Next 90 Days');
                $this->get_balance_report_range($next_90,$next_6,'90to6','90 Days To 6 Months');
                $this->get_balance_report_range($next_6,$next_9,'6to9','6 Months To 9 Months');
                $this->get_balance_report_range($next_9,$greater,'9plus','9 Months And Greater');

		print "</div>";
		
	}

	private function get_balance_report_range($start,$end,$type,$title) {
		print "<hr><center><h2><font color=blue>$title</font></h2></center>";

		switch ($type) {
		        case "allpast":
		        $deposit_amount = "100";
		        break;

		        case "90":
		        $deposit_amount = "100";
		        break;

		        default:
		        $deposit_amount = "40";
		        break;
		}  

                $sql = "
                SELECT
                        `r`.`reservationID`,
                        `r`.`calculated_cron_balancedue`,
                        MIN(`i`.`date_code`) AS 'start_date',
                        DATE_FORMAT(`i`.`date_code`, '%m/%d/%Y') AS 'formatted_date',
                        DATEDIFF(`i`.`date_code`,now()) AS 'days',
			`c`.`first`,
			`c`.`last`

                FROM
                        `reservations` r,
                        `beds` b,
                        `inventory` i

		LEFT JOIN `reserve`.`contacts` c ON `r`.`contactID` = `c`.`contactID`

                WHERE
                        `r`.`calculated_cron_balancedue` > '0'
			AND `i`.`date_code` BETWEEN '$start' AND '$end'
                        AND `r`.`reservationID` = `b`.`reservationID`
                        AND `b`.`inventoryID` = `i`.`inventoryID`

                GROUP BY `r`.`reservationID`

                ORDER BY `i`.`date_code` ASC
                ";

                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $html .= "<tr>";
			$reservationID = $row['reservationID'];

			// get total price
	                $rate           = $this->get_base_rate($reservationID);
                        $line           = $this->get_line_item_amounts($reservationID);
                        $payments       = $this->get_payments_amount($reservationID);
                        $discounts      = $this->get_discount_amount($reservationID);
			$debit          = $this->get_transfer_debits($reservationID);
			$deposit        = $this->get_transfer_deposits($reservationID);

	                // Commission
        	        $sql2 = "
	                SELECT
        	                `s`.`commission`

	                FROM
        	                `reservations` r, `users` u

	                LEFT JOIN `reserve`.`reseller_agents` a ON `r`.`reseller_agentID` = `a`.`reseller_agentID`
        	        LEFT JOIN `reserve`.`resellers` s ON `a`.`resellerID` = `s`.`resellerID`

                	WHERE
                        	`r`.`reservationID` = '$reservationID'
	                        AND `r`.`userID` = `u`.`id`
	                ";
        	        $result2 = $this->new_mysql($sql2);
                	while ($row2 = $result2->fetch_assoc()) {
	                        $commission = $row2['commission'] * .01;
        	        }

	                $total_commission = $rate * $commission;


			if ($row['calculated_cron_balancedue'] > 0) {
				switch ($deposit_amount) {
		 	               case "100":
				               $h1 = "<td bgcolor=\"#FA5858\"><b><font color=\"#FFFFFF\">BALANCE DUE</font></b></td>";
						$c1 = "#FA5858";
			               break;

			               case "40":
				               $deposit = (($rate + $line) - ($discounts + $total_commission)) * .40;
				               if ($payments >= $deposit) {
					               $h1 = "<td bgcolor=\"#5FB404\"><b>DEPOSIT PAID</b></td>";
							$c1 = "#5FB404"; 
				               } else {
					               $h1 = "<td bgcolor=\"#F2F5A9\"><b>DEPOSIT DUE</b></td>";
							$c1 = "#F2F5A9";
				               }
			               break;
				}

				$html .= "$h1
				<td>$ ".number_format($rate,2,'.',',')."</td>
                                <td>$ ".number_format($line,2,'.',',')."</td>
                                <td>$ ".number_format($discounts,2,'.',',')."</td>
                                <td>$ ".number_format($payments,2,'.',',')."</td>
	                        <td>$ ".number_format($row[calculated_cron_balancedue],2,'.',',')."</td></tr>";

				$html .= "<tr><td bgcolor=$c1><a href=\"invoice/$row[reservationID]\" target=_blank><font color=black>VIEW INVOICE</font></a></td><td colspan=3>$row[first] $row[last] (<a href=\"reservation_dashboard/$row[reservationID]/dollars\" target=_blank>$row[reservationID]</a>)</td>
				<td colspan=2>Start $row[formatted_date]</td>
				</tr>
				<tr><td colspan=6>&nbsp;</td></tr>
				";
			}
                }

                print "<table class=\"table\">";
                print "<tr>
			<th>&nbsp;</th>
			<th>Base Cost</th>
			<th>Line Items</th>
			<th>Discounts</th>
			<th>Payments</th>
                        <th>Amount Due</th>
                </tr>";
                print "$html";
                print "</table>";
	}

	public function checkoutreport() {
		$date1 = date("Ymd");
		$date1_f = date("m/d/Y");

		$date2 = date("Ymd",strtotime($date1 . "+7 day"));
		$date2_f = date("m/d/Y",strtotime($date1 . "+7 day"));

		$sql = "
		SELECT
			`r`.`reservationID`,
			MAX(`i`.`date_code`) AS 'date'

		FROM
			`inventory` i,
			`beds` b,
			`reservations` r

		WHERE
			`i`.`locationID` = '2'
			AND `i`.`date_code` BETWEEN '$date1' AND '$date2'
			AND `i`.`inventoryID` = `b`.`inventoryID`
			AND `b`.`reservationID` = `r`.`reservationID`
			AND `r`.`active` = 'Yes'

		GROUP BY `r`.`reservationID`

		ORDER BY `date_code` ASC
		";	
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$test_date = $this->get_reservation_dates($row['reservationID'],'DESC','reports');
			$test_date_formatted = $this->get_reservation_dates($row['reservationID'],'DESC',$null);
			$nights	= $this->get_reservation_nights($row['reservationID']);
			$pax = $this->get_total_pax($row['reservationID']);
			if ($row['date'] == $test_date) {
				$html .= "<tr><td colspan=3><font color=\"blue\">Check-Out Date: <b>$test_date_formatted</b></td></tr>";
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
					<tr><td colspan=3>Gender: $row2[sex]</td></tr>
					<tr><td colspan=3>DOB: $row2[dob]</td></tr>
					";
				}
				$html .= "<tr><td colspan=3><hr></td></tr>";

			}
		}

		print "<div class=\"col-md-6\">";
		print "<h2>Check-Out Report<br>($date1_f to $date2_f)</h2>";
		print "<table class=\"table\">";
		print "$html";
		print "</table>";
		print "</div>";
	}

	public function checkinreport() {


		$date1 = date("Ymd");
		$date1_f = date("m/d/Y");

		$date2 = date("Ymd",strtotime($date1 . "+7 day"));
		$date2_f = date("m/d/Y",strtotime($date1 . "+7 day"));

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
			AND `i`.`date_code` BETWEEN '$date1' AND '$date2'
			AND `i`.`inventoryID` = `b`.`inventoryID`
			AND `b`.`reservationID` = `r`.`reservationID`
			AND `r`.`active` = 'Yes'

		GROUP BY `r`.`reservationID`

		ORDER BY `date_code` ASC
		";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$test_date = $this->get_reservation_dates($row['reservationID'],'ASC','reports');
			$test_date_formatted = $this->get_reservation_dates($row['reservationID'],'ASC',$null);
			$nights	= $this->get_reservation_nights($row['reservationID']);
			$pax = $this->get_total_pax($row['reservationID']);
			if ($row['date'] == $test_date) {
				$html .= "<tr><td colspan=3><font color=\"blue\">Check-In Date: <b>$test_date_formatted</b></td></tr>";
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
					<tr><td colspan=3>Gender: $row2[sex]</td></tr>
					<tr><td colspan=3>DOB: $row2[dob]</td></tr>
					";
				}
				$html .= "<tr><td colspan=3><hr></td></tr>";

			}
		}

		print "<div class=\"col-md-6\">";
		print "<h2>Check-In Report<br>($date1_f to $date2_f)</h2>";
		print "<table class=\"table\">";
		print "$html";
		print "</table>";
		print "</div>";

	}
}
