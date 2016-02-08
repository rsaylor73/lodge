<?php /* Smarty version 3.1.27, created on 2015-12-21 19:23:36
         compiled from "templates/milestones.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:80596412456789808488ec2_67708970%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfb5507ce3907dc86f181288267ba23899ba2725' => 
    array (
      0 => 'templates/milestones.tpl',
      1 => 1450742784,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80596412456789808488ec2_67708970',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_567898087b0c59_31346426',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_567898087b0c59_31346426')) {
function content_567898087b0c59_31346426 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '80596412456789808488ec2_67708970';
?>
<form name="myform">

<br>

<table border=0 width=100<?php echo '%>';?>
        <tr bgcolor="#000000">
                <td width=200><font color="339900">Project Number</font></td><td><select name="load_project" id="load_project" onchange="load_ms(this.form)"><option value="">Select to Load</option><?php echo '<?=';?>$result[1];<?php echo '?>';?></select></td>
        </tr>
</table>



<br>
<table border=0 width=100<?php echo '%>';?>
<tr>
	<td width=200><b>Submittal Type:</b></td><td><select name="submittal_type">

	</select></td>
</tr>
<tr>
	<td><b>Scheduled Date In:</b></td>
	<td><input type="text" name="TargetDate" id="TargetDate" value="<?php echo '<?=';?>$result[3]['TargetDate'];<?php echo '?>';?>" size=40></td>
</tr>
<tr>
	<td><b>Actual Date In:</b></td>
        <td><input type="text" name="DateIn" id="DateIn" value="<?php echo '<?=';?>$result[3]['DateIn'];<?php echo '?>';?>" size=40></td>
</tr>

<tr>
        <td><b>Target Date Out:</b></td>
        <td><input type="text" name="TargetDateOut" id="TargetDateOut" value="<?php echo '<?=';?>$result[3]['TargetDateOut'];<?php echo '?>';?>" size=40></td>
</tr>


<tr>
        <td><b>Actual Date Out:</b></td>
        <td><input type="text" name="DateOut" id="DateOut" value="<?php echo '<?=';?>$result[3]['DateOut'];<?php echo '?>';?>" size=40></td>
</tr>

<tr>
	<td><b>Organization:</b></td>
	<td><select name="organization">

	</select></td>
</tr>
<tr>
	<td><b>Contact Person:</b></td>
	<td><select name="contact_person">

	</select></td>
</tr>
<tr>

	<td><b>Comments:</b></td>
	<td><textarea name="Comments" cols=40 rows=5></textarea>&nbsp;&nbsp;

	</td>
</tr>
</table>

<br>

<table border=1 width=100<?php echo '%>';?>
<tr bgcolor="#F0F0F0">
	<td>&nbsp;</td>
	<td>Milestone Description</td>
	<td>Scheduled Date In</td>
	<td>Actual Date In</td>
	<td>Target Date Out</td>
	<td>Actual Date Out</td>
	<td>By</td>
</tr>


</table>
<br><br>
</form>
</div>


<?php echo '<script'; ?>
>
        function load_ms(myform) {
                $.get('load_ms.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#milestones").html(php_msg);
                });
        }
        function save(myform) {
                $.get('save_ms.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#milestones").html(php_msg);
                });
        }
        function update(myform) {
                $.get('update_ms.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#milestones").html(php_msg);
                });
        }

<?php echo '</script'; ?>
>

<?php }
}
?>