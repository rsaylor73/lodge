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


$rand = rand(200,2000);
print "Test $rand<br>";

}
?>