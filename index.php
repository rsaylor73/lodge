<?php
session_start();
include "include/settings.php";
include "include/mysql.php";
include "include/templates.php";

if ($_GET['h'] != "no") {
	$smarty->display('header.tpl');
}

$check = $core->check_login();
if ($check == "FALSE") {
	if ($_GET['section'] == "forgot_password") {
		$smarty->display('forgot_password.tpl');
	} else {
		$smarty->display('login.tpl');
	}
} else {
	if ($_GET['h'] != "no") {
		$core->navigation();
	}

	// Define global constant - get the authorize.net account info
	$sql = "SELECT `authnet_login`,`authnet_key`,`authnet_testmode` FROM `settings` WHERE `id` = '1'";
	$result = $core->new_mysql($sql);
	while ($row = $result->fetch_assoc()) {
		define('authnet_login',$row['authnet_login']);
		define('authnet_key',$row['authnet_key']);
		define('authnet_testmode',$row['authnet_testmode']);
	}
	if ($_GET['section'] == "dashboard") {
		$name = "$_SESSION[first] $_SESSION[last]";
		$smarty->assign('name',$name);
		$smarty->assign('access',$_SESSION['userType']);
		$smarty->display('dashboard.tpl');
		$core->load_module('locatereservation');
	}

	if (($_GET['section'] != "dashboard") && ($_GET['section'] != "")) {
		$core->load_module($_GET['section']);
	}
}

// footer
if ($_GET['h'] != "no") {
	$year = date("Y");
	$smarty->assign('year',$year);
	$smarty->display('footer.tpl');
}
