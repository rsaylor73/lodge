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

	$tents = int($_GET['pax'] / $adults);
	if ($tents < 1) {
		$tents = "1";
	}

	print "Test $tents";

	?>
	<script>
	document.getElementById('tents').value=$tents;
	</script>
	<?php

}
?>