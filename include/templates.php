<?php
/* -----------------------------------------
// This file controls the actions of the template class
// Version 1.00
// Author: Robert Saylor
// robert@customphpdesign.com
*/


// This is PHP Smarty
require_once('libs/Smarty.class.php');
$smarty=new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setConfigDir('configs/');
$smarty->setCacheDir('cache/');

// init the core class (custom code)
include $GLOBAL['path']."/class/core.class.php";
$core = new Core($linkID);
?>
