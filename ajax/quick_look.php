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

		$nights = $_GET['nights'];
		$nights2 = $_GET['nights'] - 1;

		$start_date = str_replace("-","",$_GET['start_date']);
		$end_date = date("Ymd", strtotime($start_date ."+ $nights2 days"));


		$adults = $_GET['pax'] * $nights;
		if ($_GET['children'] > 0) {
			$children = $_GET['children'] * $nights;
		} else {
			$children = "0";
		}

		if ($_GET['tents'] > 1) {
			$adults = $adults / $_GET['tents'];
			$children = $children / $_GET['tents'];

		}

		
		if ($_GET['children'] == "0") {
			//
			$child_sql = "AND total_child_beds = '0'";
		} else {
			$child_sql = "AND total_child_beds >= '$children'";
		}

		if ($_GET['type'] != "") {
			$type = "AND `r`.`type` = '$_GET[type]'";
		}

		$sql = "
		SELECT
			`r`.`id`,
			`r`.`description`,
			COUNT(`a`.`status`) AS 'total_adult_beds',
			COUNT(`c`.`status`) AS 'total_child_beds',
			`r`.`nightly_rate`,
			`r`.`beds` AS 'adult',
			`r`.`children`,
			`a`.`status` AS 'adult_status',
			`c`.`status` AS 'child_status'

		FROM
			`inventory` i, `rooms` r

		LEFT JOIN `beds` a ON `i`.`inventoryID` = `a`.`inventoryID` AND `a`.`type` = 'adult' AND `a`.`status` = 'avail'
		LEFT JOIN `beds` c ON `i`.`inventoryID` = `c`.`inventoryID` AND `c`.`type` = 'child' AND `c`.`status` = 'avail'

		WHERE
			`i`.`locationID` = '$_GET[lodge]' 
			AND `i`.`date_code` BETWEEN '$start_date' AND '$end_date'
			AND `i`.`roomID` = `r`.`id`
			$type

		GROUP BY `r`.`description`

		HAVING total_adult_beds >= '$adults' $child_sql
		";

		print "<pre>";
		print "$sql";
		print "</pre>";


}
?>