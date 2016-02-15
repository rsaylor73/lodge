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
	$core->navigation();
	//$smarty->display('navigation.tpl');

	if ($_GET['section'] == "dashboard") {
		$name = "$_SESSION[first] $_SESSION[last]";
		$smarty->assign('name',$name);
		$smarty->assign('access',$_SESSION['userType']);
		$smarty->display('dashboard.tpl');
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
