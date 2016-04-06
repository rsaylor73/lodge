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

	$sql = "
	SELECT
		`r`.`beds`

	FROM
		`rooms` r

	WHERE
		`r`.`locationID` = '$_GET[lodge]'

	ORDER BY `r`.`beds` ASC LIMIT 1
	";
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$adults2 = $row['beds'];
	}

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

	$sql = "
	SELECT
		`r`.`children`

	FROM
		`rooms` r

	WHERE
		`r`.`locationID` = '$_GET[lodge]'

	ORDER BY `r`.`children` ASC LIMIT 1
	";
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		$child2 = $row['children'];
	}

	if ($adults != "") {
		//print "<br><font color=blue><b>Limit $adults2 - $adults adults and $child2 - $child children per tent</b></font>";
	}
}
?>