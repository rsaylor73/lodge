<?php
session_start();

$sesID = session_id();
// init
include_once "../include/settings.php";
include_once "../include/mysql.php";
include_once "../include/templates.php";

//include $GLOBAL['path']."/class/core.class.php";
//$core = new Core($linkID);

$sql = "SELECT * FROM `users` WHERE `uuname` = '$_GET[uuname]' AND BINARY `uupass` = '$_GET[uupass]'";
$result = $core->new_mysql($sql);
while ($row = $result->fetch_assoc()) {
	foreach ($row as $key=>$value) {
   	$_SESSION[$key] = $value;
	}
   $_SESSION['logged'] = "TRUE";
   $ok = "1";
   print "<div class=\"modal-body\"><br><br><font color=green>Login sucessfull. Loading please wait...</font><br><bR></div>";

   ?>
   <script>
   setTimeout(function() {
		window.location.replace('index.php?section=dashboard')
	}
   ,2000);

	</script>
   <?php
}

if ($ok != "1") {
	$smarty->assign('msg','<center><font color=red>Login failed.</font></center>');
	$smarty->display('login.tpl');
}
?>
