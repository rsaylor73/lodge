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
			`c`.`first`,
			`c`.`last`,
			`c`.`email`,
			`c`.`city`,
			DATE_FORMAT(`c`.`date_of_birth`, '%m/%d/%Y') AS 'dob'

		FROM
			`reserve`.`contacts` c

		WHERE
			`c`.`contactID` = '$_GET[contactID]'

		";

	} else {
		// name, email
		$sql = "
		SELECT
			`c`.`first`,
			`c`.`last`,
			`c`.`email`,
			`c`.`city`,
			`c`.`contactID`,
			DATE_FORMAT(`c`.`date_of_birth`, '%m/%d/%Y') AS 'dob'

		FROM
			`reserve`.`contacts` c

		WHERE
			`c`.`first` LIKE '%$_GET[first]%'
			AND `c`.`last` LIKE '%$_GET[last]%'
			AND `c`.`email` LIKE '%$_GET[email]%'
		";
	}
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$html .= "<tr><td width=\"250\">$row[first] $row[last]</td><td>$row[city]</td><td>$row[dob]</td>
		<td><input type=\"button\" onclick=\"document.location.href='assigncontacttobed/$_GET[reservationID]/$row[contactID]/$_GET[bed]'\" class=\"btn btn-primary\" value=\"Assign Contact\"></td></tr>";
	}
	print "<table class=\"table\">$html</table>";

}