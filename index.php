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

	if ($_GET['section'] == "users") {
		$core->users();
	}

	if ($_GET['section'] == "addnewuser") {
		$core->addnewuser();
	}

	if ($_GET['section'] == "saveuser") {
		$core->saveuser();
	}

	if ($_GET['section'] == "edituser") {
		$core->edituser();
	}

	if ($_GET['section'] == "updateuser") {
		$core->updateuser();
	}

	if ($_GET['section'] == "deleteuser") {
		$core->deleteuser();
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
