<?php /* Smarty version 3.1.27, created on 2016-02-08 07:44:03
         compiled from "templates/login.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:176646962456b88d938df149_56178647%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81a0270564c79ee7a1c4f40d2a5e8bcfac7e3570' => 
    array (
      0 => 'templates/login.tpl',
      1 => 1454678804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176646962456b88d938df149_56178647',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56b88d9396a752_13279625',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56b88d9396a752_13279625')) {
function content_56b88d9396a752_13279625 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '176646962456b88d938df149_56178647';
?>
<h2>Login</h2>

<form name="myform">
<table class="table" width=500>
	<tr>
		<td><b>Username:</b><br><input type="text" name="Luuname" placeholder="User Name" size=20 required></td>
	</tr>
	<tr>
		<td><b>Password:</b><br><input type="password" name="Luupass" placeholder="Password" size=20 required></td>
	</tr>
	<tr>
		<td><center><input type="button" name="login" value="Login" class="btn btn-primary" onclick="login(this.form)"></center></td>
	</tr>
</table>
</form>

<?php echo '<script'; ?>
>
function login(myform) {
	$.get('ajax/login.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#main_element").html(php_msg);
	});
}
<?php echo '</script'; ?>
>
<?php }
}
?>