<?php /* Smarty version 3.1.27, created on 2015-12-08 20:49:07
         compiled from "templates/project_entry.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:95784876356678893d35e03_36880632%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38bf80996001c17ede9607ab13c9ef11d8faf47f' => 
    array (
      0 => 'templates/project_entry.tpl',
      1 => 1449625478,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95784876356678893d35e03_36880632',
  'variables' => 
  array (
    'type' => 0,
    'ProjectID' => 0,
    'ProjectList' => 0,
    'show_form' => 0,
    'ProjectType' => 0,
    'c1' => 0,
    'c2' => 0,
    'BLN_Project_Name' => 0,
    'ProjectName' => 0,
    'PayItem' => 0,
    'RouteNum' => 0,
    'Location' => 0,
    'ContractNum' => 0,
    'LocFrom' => 0,
    'LocTo' => 0,
    'Length' => 0,
    'Urban_or_Rural' => 0,
    'ImprovementTypeOptions' => 0,
    'ImprovementType' => 0,
    'ClassificationOptions' => 0,
    'Classification' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56678893db3201_56750012',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56678893db3201_56750012')) {
function content_56678893db3201_56750012 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '95784876356678893d35e03_36880632';
?>
<div id="pe">
<br>

<form name="myform" action="index.php" method="post">
<input type="hidden" name="action" value="pe">

<table border=0 width=100<?php echo '%>';?>

	<tr bgcolor="#FFFFFF">

			<?php if ($_smarty_tpl->tpl_vars['type']->value == '') {?>
                        <td align="center" width="16.66%">
                        <button type="button" class="btn btn-default btn-lg" onclick="document.location.href='index.php?action=pe&type=new'">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <br>Add New
                        </button>
                        </td>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['type']->value == 'update') {?>
			<td align="center" width="16.66%">
                                <input type="hidden" name="type" value="update">
				<input type="hidden" name="ProjectID" value="<?php echo $_smarty_tpl->tpl_vars['ProjectID']->value;?>
">
	                        <button type="submit" class="btn btn-default btn-lg" onclick="update_record(this.form)">
        	                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> <br>Update
                	        </button>
                        </td>
			<?php }?>


			<?php if ($_smarty_tpl->tpl_vars['type']->value == 'new') {?>
			<td align="center" width="16.66%">
				<input type="hidden" name="type" value="save">
                        	<button type="submit" class="btn btn-default btn-lg" onclick="save_record(this.form)">
	                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> <br>Save
        	                </button>
                        </td>
			<?php }?>


                        <td align="center" width="16.66%">
                        <button type="button" class="btn btn-default btn-lg" onclick="document.getElementById('search_project').style.display='inline'">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span> <br>Search
                        </button>
			</td>



		<td align="center" width="16.66%">
			<button type="button" class="btn btn-default btn-lg" onclick="document.location.href='index.php?action=pe&load_project=0'">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <br>Clear
			</button>

		</td>


		<td align="center" width="16.66%">
                        <button type="button" class="btn btn-default btn-lg" onclick="document.location.href='index.php'">
                          <span class="glyphicon glyphicon-off" aria-hidden="true"></span> <br>Exit
                        </button>
		</td>
	</tr>
</table>

<div id="search_project" style="display:<?php echo '<?=';?>$display;<?php echo '?>';?>">
<table border=0 widtd=100<?php echo '%>';?>
<tr><td>
Enter Project Number:</td><td><input type="text" name="project_number" id="project_number" value="" size=40>

<input type="button" value="Search" onclick="redirect_page()">

</td></tr>
</table>
<div id="container">
</div>

</div>
<br>


<table border=0 width=100<?php echo '%>';?>
	<tr bgcolor="#000000">
		<td width=200><font color="339900">Project Number</font></td><td><select name="load_project" onchange="load_pe(this.form)"><option value="">Select to Load</option><?php echo $_smarty_tpl->tpl_vars['ProjectList']->value;?>
</select></td>
	</tr>
</table>
<div id="someElem"></div>


<br>

<?php if ($_smarty_tpl->tpl_vars['show_form']->value == 'Yes') {?>
<table border=0 width=100<?php echo '%>';?>

	<?php if ($_smarty_tpl->tpl_vars['ProjectType']->value == "DOT") {?>
	<?php $_smarty_tpl->tpl_vars['c1'] = new Smarty_Variable("checked", null, 0);?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['ProjectType']->value == "LPA") {?>
        <?php $_smarty_tpl->tpl_vars['c2'] = new Smarty_Variable("checked", null, 0);?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['c1']->value == '' && $_smarty_tpl->tpl_vars['c2']->value == '') {?>
		<?php $_smarty_tpl->tpl_vars['c1'] = new Smarty_Variable("checked", null, 0);?>
	<?php }?>
	<tr>
		<td width=200><b>Project Owner:</b></td><td><input type="radio" name="ProjectType" id="ProjectType" value="DOT" <?php echo $_smarty_tpl->tpl_vars['c1']->value;?>
> DOT &nbsp;&nbsp;<input type="radio" name="ProjectType" value="LPA" <?php echo $_smarty_tpl->tpl_vars['c2']->value;?>
>  Local Agency</td>
	</tr>
	<tr>
		<td><b>BLN Identifier:</b></td><td><input type="text" name="DescriptionCode" value="<?php echo $_smarty_tpl->tpl_vars['BLN_Project_Name']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>DOT Project Number:</b></td><td><input type="text" name="customerNumber" value="<?php echo $_smarty_tpl->tpl_vars['ProjectName']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Cost Code:</b></td><td><input type="text" name="PayItem" value="<?php echo $_smarty_tpl->tpl_vars['PayItem']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Route No.</b></td><td><input type="text" name="RouteNum" value="<?php echo $_smarty_tpl->tpl_vars['RouteNum']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Project Location:</b></td><td><input type="text" name="Location" value="<?php echo $_smarty_tpl->tpl_vars['Location']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Contract Number:</b></td><td><input type="text" name="ContractNum" value="<?php echo $_smarty_tpl->tpl_vars['ContractNum']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Loc. From:</b></td><td><input type="text" name="LocFrom" value="<?php echo $_smarty_tpl->tpl_vars['LocFrom']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Loc. To:</b></td><td><input type="text" name="LocTo" value="<?php echo $_smarty_tpl->tpl_vars['LocTo']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Length:</b></td><td><input type="text" name="Length" value="<?php echo $_smarty_tpl->tpl_vars['Length']->value;?>
" size="40"></td>
	</tr>
	<tr>
		<td><b>Urban/Rural:</b></td><td><select name="Urban_or_Rural">
		<option>Urban</option><option>Rural</option>
		<?php if ($_smarty_tpl->tpl_vars['Urban_or_Rural']->value != '') {?>
		<option selected><?php echo $_smarty_tpl->tpl_vars['Urban_or_Rural']->value;?>
</option>
		<?php }?>
		</select></td>
	</tr>
	<tr>
		<td><b>Type of Improvement:</b></td><td><div id="imp" style="display:inline"><select name="ImprovementType"><?php echo $_smarty_tpl->tpl_vars['ImprovementTypeOptions']->value;?>


		<?php if ($_smarty_tpl->tpl_vars['ImprovementType']->value != '') {?>
		<option selected><?php echo $_smarty_tpl->tpl_vars['ImprovementType']->value;?>
</option>
		<?php }?>

		</select> <input type="button" value="Add Improvement Type" onclick="new_improvement(this.form)"></div></td>
	</tr>
	<tr>
		<td><b>Functional Classification:</b></td><td><div id="cls" style="display:inline"><select name="Classification"><?php echo $_smarty_tpl->tpl_vars['ClassificationOptions']->value;?>


		<?php if ($_smarty_tpl->tpl_vars['Classification']->value != '') {?>
		<option selected><?php echo $_smarty_tpl->tpl_vars['Classification']->value;?>
</option>
		<?php }?>

		</select> <input type="button" value="Add Classification" onclick="new_classification(this.form)"></div></td>
	</tr>
</table>
<?php }?>


<?php echo '<script'; ?>
>
        function new_classification(myform) {
                $.get('new_classification.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#cls").html(php_msg);
                });
        }


        function new_improvement(myform) {
                $.get('new_improvement.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#imp").html(php_msg);
                });
        }


        function load_pe(myform) {
                $.get('load_pe.php',
                $(myform).serialize(),
                function(php_msg) {
                        $("#pe").html(php_msg);
                });
        }


<?php echo '</script'; ?>
>



</form>

</div>

<?php }
}
?>