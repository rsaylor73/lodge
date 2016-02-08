<?php /* Smarty version 3.1.27, created on 2015-12-13 11:20:43
         compiled from "templates/contacts.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:647427190566d9adb412061_60335672%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ac42d9a43f56c09945ca022c65e4a80d8b3a49f' => 
    array (
      0 => 'templates/contacts.tpl',
      1 => 1450023641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '647427190566d9adb412061_60335672',
  'variables' => 
  array (
    'ProjectList' => 0,
    'show_form' => 0,
    'status' => 0,
    'new' => 0,
    'ProjectID' => 0,
    'form' => 0,
    'id' => 0,
    'DesignConsultant' => 0,
    'ContactName' => 0,
    'Email' => 0,
    'Phone' => 0,
    'Fax' => 0,
    'html1' => 0,
    'id2' => 0,
    'html2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566d9adb540646_57135816',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566d9adb540646_57135816')) {
function content_566d9adb540646_57135816 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '647427190566d9adb412061_60335672';
?>
<div id="contacts">
<form name="myform">

<br>

<table border=0 width=100<?php echo '%>';?>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_ct(this.form)"><option value="">Select to Load</option><?php echo $_smarty_tpl->tpl_vars['ProjectList']->value;?>
</select></td>
        </tr>
</table>
</form>

<br>

<div id="contacts">
<?php if ($_smarty_tpl->tpl_vars['show_form']->value == 'Yes') {?>


<div id="new_dc">

        <?php if ($_smarty_tpl->tpl_vars['status']->value != '') {?>
        <center><?php echo $_smarty_tpl->tpl_vars['status']->value;?>
</center>
        <?php }?>


<table border=1 width=100<?php echo '%>';?>
<tr>
	<td width=50% valign=top><b>Designer Contact</b><br>

	<div id="top">

	<?php if ($_smarty_tpl->tpl_vars['new']->value == 'Yes') {?>
	<form name="myform1" action="index.php" method="post">
	<input type="hidden" name="action" value="contacts">
	<input type="hidden" name="type" value="load">
	<input type="hidden" name="section" value="save">
	<input type="hidden" name="ProjectID" value="<?php echo $_smarty_tpl->tpl_vars['ProjectID']->value;?>
">
	<input type="hidden" name="part" value="designer">
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['form']->value == 'top') {?>
        <form name="myform1" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="update">
        <input type="hidden" name="ProjectID" value="<?php echo $_smarty_tpl->tpl_vars['ProjectID']->value;?>
">
        <input type="hidden" name="part" value="designer">
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
	<?php }?>


	<div id="list1">
	<table border=0 width=100<?php echo '%>';?>
		<tr><td align=right>Organization</td><td><input type="text" name="DesignConsultant" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'top') {?> value="<?php echo $_smarty_tpl->tpl_vars['DesignConsultant']->value;?>
"  <?php }?> size=20> 
			<button type="button" name="down" onclick="show_list1(this.form);return false;"><span class="glyphicon glyphicon-arrow-down"></button>
		</td></tr>
		<tr><td align=right>Contact Person</td><td><input type="text" name="ContactName" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'top') {?> value="<?php echo $_smarty_tpl->tpl_vars['ContactName']->value;?>
" <?php }?> size=20>
                        <button type="button" name="down" onclick="show_list3(this.form);return false;"><span class="glyphicon glyphicon-arrow-down"></button>
		</td></tr>
		<tr><td align=right>Contact Person's Email</td><td><input type="text" name="Email" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'top') {?> value="<?php echo $_smarty_tpl->tpl_vars['Email']->value;?>
" <?php }?> size=20></td></tr>
		<tr><td align=right>Phone # (10 digits)</td><td><input type="text" name="Phone" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'top') {?> value="<?php echo $_smarty_tpl->tpl_vars['Phone']->value;?>
" <?php }?> size=20></td></tr>
		<tr><td align=right>Fax # (10 digits)</td><td><input type="Text" name="Fax" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'top') {?> value="<?php echo $_smarty_tpl->tpl_vars['Fax']->value;?>
" <?php }?> size=20></td></tr>

	        <?php if ($_smarty_tpl->tpl_vars['new']->value == 'Yes') {?>
		<tr><td colspan=2><input type="submit" value="Save"></td></tr>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form']->value == 'top') {?>
		<tr><td colspan=2><input type="submit" value="Update"> <input type="checkbox" value="checked" name="delete" onclick="return confirm('You are about to delete this contact')"> Delete</td></tr>
		<?php }?>

	</table>
	</div>


	</form>
	</div>

	</td><td width=50% valign=top><br>
	<table border=0 width=100<?php echo '%>';?>
		<tr><td><b>Consultant Firm</b></td><td><b>Contact Name</b></td><td>&nbsp;</td></tr>
		<?php echo $_smarty_tpl->tpl_vars['html1']->value;?>

	</table>

	</td>
</tr>
</table>
</div>

<br><br>

<div id="new_prc">

<table border=1 width=100<?php echo '%>';?>
<tr>
        <td width=50% valign=top><b>Plan Review Contact</b><br>
	<div id="bot">

        <?php if ($_smarty_tpl->tpl_vars['new']->value == 'Yes') {?>
        <form name="myform2" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="save">
        <input type="hidden" name="ProjectID" value="<?php echo $_smarty_tpl->tpl_vars['ProjectID']->value;?>
">
        <input type="hidden" name="part" value="review">
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['form']->value == 'bot') {?>
        <form name="myform2" action="index.php" method="post">
        <input type="hidden" name="action" value="contacts">
        <input type="hidden" name="type" value="load">
        <input type="hidden" name="section" value="update">
        <input type="hidden" name="ProjectID" value="<?php echo $_smarty_tpl->tpl_vars['ProjectID']->value;?>
">
        <input type="hidden" name="part" value="review">
        <input type="hidden" name="id2" value="<?php echo $_smarty_tpl->tpl_vars['id2']->value;?>
">
        <?php }?>

        <div id="list2">
        <table border=0 width=100<?php echo '%>';?>
		<tr><td align=right>Contact Name</td><td><input type="text" name="ContactName" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'bot') {?> value="<?php echo $_smarty_tpl->tpl_vars['ContactName']->value;?>
" <?php }?> size=20> 
                        <button type="button" name="down2" onclick="show_list2(this.form);return false;"><span class="glyphicon glyphicon-arrow-down"></button>
		</td></tr>
		<tr><td align=right>Email Address</td><td><input type="text" name="Email" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'bot') {?> value="<?php echo $_smarty_tpl->tpl_vars['Email']->value;?>
" <?php }?> size=20></td></tr>
                <tr><td align=right>Phone # (10 digits)</td><td><input type="text" name="Phone" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'bot') {?> value="<?php echo $_smarty_tpl->tpl_vars['Phone']->value;?>
" <?php }?> size=20></td></tr>
                <tr><td align=right>Fax # (10 digits)</td><td><input type="text" name="Fax" <?php if ($_smarty_tpl->tpl_vars['form']->value == 'bot') {?> value="<?php echo $_smarty_tpl->tpl_vars['Fax']->value;?>
" <?php }?> size=20></td></tr>

                <?php if ($_smarty_tpl->tpl_vars['new']->value == 'Yes') {?>
                <tr><td colspan=2><input type="submit" value="Save"></td></tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['form']->value == 'bot') {?>
                <tr><td colspan=2><input type="submit" value="Update"> <input type="checkbox" value="checked" name="delete" onclick="return confirm('You are about to delete this contact')"> Delete</td></tr>
                <?php }?>


	</table>
	</div>
	</form>
	</div>
        </td><td width=50% valign=top><br>
        <table border=0 width=100<?php echo '%>';?>
		<tr><td><b>Plan Review Contact Name</b></td><td>&nbsp;</td></tr>
                <?php echo $_smarty_tpl->tpl_vars['html2']->value;?>

	</table>
	</td>
</tr>
</table>
</div>

<?php }?>

</div>


<?php echo '<script'; ?>
>
        function new_dc(myform1) {
                $.get('new_dc.php',
                $(myform1).serialize(),
                function(php_msg) {
                        $("#new_dc").html(php_msg);
                });
        }

        function show_list1(myform1) {
                $.get('show_list1.php',
                $(myform1).serialize(),
                function(php_msg) {
                        $("#list1").html(php_msg);
                });
        }


        function show_list2(myform2) {
                $.get('show_list2.php',
                $(myform2).serialize(),
                function(php_msg) {
                        $("#list2").html(php_msg);
                });
        }

        function show_list3(myform1) {
                $.get('show_list3.php',
                $(myform1).serialize(),
                function(php_msg) {
                        $("#list1").html(php_msg);
                });
        }

        function new_prc(myform2) {
                $.get('new_prc.php',
                $(myform2).serialize(),
                function(php_msg) {
                        $("#new_prc").html(php_msg);
                });
        }


        function load_ct(myform) {
                $.get('load_ct.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#contacts").html(php_msg);
                });
        }
	function load_dp(myformA) {
                $.get('load_dp.php',
                $(myformA).serialize(),
                function(php_msg) {
                        $("#top").html(php_msg);
                });
		
	}
        function load_prc(myformB) {
                $.get('load_prc.php',
                $(myformB).serialize(),
                function(php_msg) {
                        $("#bot").html(php_msg);
                });

        }

<?php echo '</script'; ?>
>

<?php }
}
?>