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
	$smarty->display('login.tpl');
} else {
	$smarty->display('navigation.tpl');

	if ($_GET['section'] == "dashboard") {
		$smarty->display('dashboard.tpl');
	}

	if ($_GET['section'] == "logout") {
		$core->logout();
	}
}

// footer
if ($_GET['h'] != "no") {
	$year = date("Y");
	$smarty->assign('year',$year);
	$smarty->display('footer.tpl');
}
