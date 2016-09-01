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
			AND `a`.`first` != ''
			AND `a`.`last` != ''

		ORDER BY `r`.`company` ASC, `a`.`first` ASC, `a`.`last` ASC
		";
	} else {

		if ($_GET['company'] != "") {
			$s1 = " AND `r`.`company` LIKE '%$_GET[company]%' ";
		}
		if ($_GET['city'] != "") {
			$s2 = " AND `a`.`city` LIKE '%$_GET[city]%' ";
		}
		if ($_GET['email'] != "") {
			$s3 = " AND `a`.`email` LIKE '%$_GET[email]%' ";
		}
		if ($_GET['country'] != "") {
			$s4a = " ,`countries` c ";
			$s4b = " AND `a`.`countryID` = `c`.`countryID` AND `c`.`country` LIKE '%$_GET[country]%' ";
		}

		$sql = "
		SELECT
			`r`.`company`,
			`r`.`resellerID`,
			`a`.`reseller_agentID`,
			`a`.`first`,
			`a`.`last`

		FROM
			`reserve`.`resellers` r, `reserve`.`reseller_agents` a $s4a

		WHERE
			`r`.`resellerID` = `a`.`resellerID`
			AND `a`.`status` = 'Active'
			AND `a`.`first` != ''
			AND `a`.`last` != ''

			$s1
			$s2
			$s3
			$s4b

		ORDER BY `r`.`company` ASC, `a`.`first` ASC, `a`.`last` ASC

		LIMIT 100
		";
	}

	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		if ($this_company != $row['company']) {
			$html .= "<tr><td colspan=2><b>$row[company]</b></td></tr>";
			$this_company = $row['company'];
		}
		$html .= "<tr><td width=\"250\">$row[first] $row[last]</td><td><input type=\"button\" onclick=\"document.location.href='assignagenttoreservation/$_GET[reservationID]/$row[reseller_agentID]/$row[resellerID]'\" class=\"btn btn-primary\" value=\"Assign Agent\"></td></tr>";
	}
	print "<table class=\"table\">$html</table>";

	
}
?>
