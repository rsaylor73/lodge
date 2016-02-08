<?php
session_start();

$sesID = session_id();

// init
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";


$sql = "SELECT * FROM `users` WHERE `uuname` = '$_GET[uuname]' AND `uupass` = '$_GET[uupass]' AND `active` = 'Yes'";
$result = $core->new_mysql($sql);
while ($row = $result->fetch_assoc()) {
	foreach ($row as $key=>$value) {
		$_SESSION[$key] = $value;
	}
	$found = "1";
}


if ($found == "1") {
	$settings = $core->get_settings();
	echo '<script>
		window.location = "/admin";
	</script>';
	//print "You have been logged in. Click <a href=\"index.php\">here</a> to continue.<br>";
} else {
	$core->login('<font color=red>The username and or password was incorrect.</font>');
}
?>
