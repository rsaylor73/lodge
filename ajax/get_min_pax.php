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

	// get max number of adults per tent
	$sql = "
	SELECT
		`r`.`beds`

	FROM
		`rooms` r

	WHERE
		`r`.`locationID` = '$_GET[lodge]'

	ORDER BY `r`.`beds` DESC LIMIT 1
	";
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$adults = $row['beds'];
	}


	// get min number of children
	$child = "0";
	print "Test $child<br>";
	$sql = "
	SELECT
		`r`.`children`

	FROM
		`rooms` r

	WHERE
		`r`.`locationID` = '$_GET[lodge]'

	ORDER BY `r`.`children` DESC LIMIT 1
	";
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$child = $row['children'];
	}
	print "Test: $child<br>";

	// get total adult pax of a lodge
	$sql = "
	SELECT
		SUM(`r`.`beds`) AS 'total_pax'

	FROM
		`rooms` r
	
	WHERE
		`r`.`locationID` = '$_GET[lodge]'

	";
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$adult = $row['total_pax'];
	}

	if ($adults != "") {
		$adult1 = $adult - $adults;
		if ($child == "0") {
			$adult1 = $adult1 + $adults;
			print "<br><font color=blue>Max $adult1 Adults</font>";
		} else {
			print "<br><font color=blue>Max $adult1 Adults <b>OR</b> $adults Adults and $child Children</font>";
		}
	} else {
		print "<br><font color=red>ERROR: No rooms are defined.</font>";
	}
}
?>