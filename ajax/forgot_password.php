<?php
session_start();

$sesID = session_id();
// init
include_once "../include/settings.php";
include_once "../include/mysql.php";
include_once "../include/templates.php";

//include $GLOBAL['path']."/class/core.class.php";
//$core = new Core($linkID);

$settings = $core->get_settings();

$sql = "SELECT * FROM `users` WHERE `email` = '$_GET[email]'";
$result = $core->new_mysql($sql);
while ($row = $result->fetch_assoc()) {
	$msg = "$row[first] $row[last]<br>You have requested your password to be sent to your registered email address.<br><br>
	Username: $row[uuname]<br>
	Password: $row[uupass]<br>
	Web Site: <a href=\"https://reservations.aggressorsafarilodge.com\">https://reservations.aggressorsafarilodge.com</a><br>";
	$subj = "Forgot password for Safari Lodge";
	mail($row['email'],$subj,$msg,$settings[3]);
}
$smarty->assign('msg','<center><font color=green>Password was sent.</font></center>');
$smarty->display('login.tpl');
?>
