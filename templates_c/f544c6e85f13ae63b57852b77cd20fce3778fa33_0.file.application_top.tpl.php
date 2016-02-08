<?php /* Smarty version 3.1.27, created on 2015-12-05 10:48:13
         compiled from "templates/application_top.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:14355985395663073d39df74_95214097%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f544c6e85f13ae63b57852b77cd20fce3778fa33' => 
    array (
      0 => 'templates/application_top.tpl',
      1 => 1449330451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14355985395663073d39df74_95214097',
  'variables' => 
  array (
    'state_header' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5663073d3c6ad2_83005073',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5663073d3c6ad2_83005073')) {
function content_5663073d3c6ad2_83005073 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '14355985395663073d39df74_95214097';
?>
<body>
<div id="header">
        <div id="logo"><img src="img/logo.png" height="68"> <span class="dot_header"><?php echo $_smarty_tpl->tpl_vars['state_header']->value;?>
</span></div>
</div>

<div id="adminquestionbox">
        <div id="questionbox_inner">
        <a href="index.php">Dashboard Home</a><br><br>

<?php }
}
?>