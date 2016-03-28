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

	if ($_GET['resellerID'] != "") {
		$sql = "
		SELECT
			`r`.`company`,
			`r`.`resellerID`,
			`a`.`reseller_agentID`,
			`a`.`first`,
			`a`.`last`

		FROM
			`reserve`.`resellers` r, `reserve`.`reseller_agents` a

		WHERE
			`r`.`resellerID` = '$_GET[resellerID]'
			AND `r`.`resellerID` = `a`.`resellerID`
			AND `a`.`status` = 'Active'

		ORDER BY `a`.`first` ASC, `a`.`last` ASC
		";
	} elseif ($_GET['company'] != "") {
		# code...
	} else {

	}

	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		if ($html == "") {
			$html .= "<tr><td colspan=2><b>$row[company]</b></td></tr>";
		}
		$html .= "<tr><td width=\"150\">$row[first] $row[last]</td><td><input type=\"button\" onclick=\"document.location.href='assignagenttoreservation/$_GET[reservationID]/$row[reseller_agentID]'\" class=\"btn btn-primary\" value=\"Assign Agent\"></td></tr>";
	}
	print "<table class=\"table\">$html</table>";

	
}
?>