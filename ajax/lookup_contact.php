<?php
session_start();

$sesID = session_id();
// init
include_once "../include/settings.php";
include_once "../include/mysql.php";
include_once "../include/templates.php";

$check = $core->check_login();
if ($check == "FALSE") {
	print "<br><font color=red>Error: you must log back in.</font><br>";
} else {
	if ($_GET['contactID'] != "") {
		// contactID

		$sql = "
		SELECT
			`c`.`contactID`,
         	`c`.`first`,
         	`c`.`middle`,
         	`c`.`last`,
         	`c`.`city`,
			`c`.`province`,
			`c`.`state`,
         	`cn`.`country`,
         	DATE_FORMAT(`c`.`date_of_birth`, '%m/%d/%Y') AS 'dob',
         	`c`.`email`

		FROM
			`reserve`.`contacts` c

		LEFT JOIN `countries` cn ON `c`.`countryID` = `cn`.`countryID`

		WHERE
			`c`.`contactID` = '$_GET[contactID]'

		";
	} else {
		// name, email
                switch ($_GET['contact_type']) {
                        case "consumer":
                                $s1 = " AND `c`.`contact_type` = 'consumer' ";
                        break;

                        case "reseller":
                                $s1 = " AND `c`.`contact_type` != 'consumer' ";
                        break;
                }

		$sql = "
		SELECT
			`c`.`contactID`,
         	`c`.`first`,
         	`c`.`middle`,
         	`c`.`last`,
         	`c`.`city`,
			`c`.`province`,
			`c`.`state`,
         	`cn`.`country`,
         	DATE_FORMAT(`c`.`date_of_birth`, '%m/%d/%Y') AS 'dob',
         	`c`.`email`

		FROM
			`reserve`.`contacts` c

		LEFT JOIN `countries` cn ON `c`.`countryID` = `cn`.`countryID`

		WHERE
			`c`.`first` LIKE '%$_GET[first]%'
			AND `c`.`last` LIKE '%$_GET[last]%'
			AND `c`.`email` LIKE '%$_GET[email]%'
			$s1

		LIMIT 50
		";
	}
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$found = "1";
		$html .= "<tr><td width=\"250\">$row[first] $row[last]</td><td>$row[city]</td><td>$row[country]</td>
		<td>
		";

		if ($_GET['action'] == "reservation") {
			$html .= "<input type=\"button\" onclick=\"document.location.href='assigncontacttorsv/$_GET[reservationID]/$row[contactID]'\" 
			class=\"btn btn-primary\" value=\"Assign Contact\">";
		} else {
			$html .= "<input type=\"button\" onclick=\"document.location.href='assigncontacttobed/$_GET[reservationID]/$row[contactID]/$_GET[bed]/$_GET[roomID]'\" 
			class=\"btn btn-primary\" value=\"Assign Contact\">";
		}


		$html .= "
		</td></tr>
		<tr><td>DOB: $row[dob]</td><td colspan=4>$row[email]</td></tr>
		";
	}
	if ($found != "1") {
		$html = "<tr><td colspan=\"3\"><font color=blue>Sorry, there were no matches</font></td></tr>";
	}
	print "<table class=\"table\"><tr><td colspan=\"3\"><b>Displaying up to 50 records</b></td></tr>$html</table>";

}
