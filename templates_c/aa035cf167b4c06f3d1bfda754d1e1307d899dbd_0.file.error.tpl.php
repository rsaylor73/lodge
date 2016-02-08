<?php /* Smarty version 3.1.27, created on 2016-01-14 20:19:26
         compiled from "templates/error.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:12899043855698491edffab0_09966679%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa035cf167b4c06f3d1bfda754d1e1307d899dbd' => 
    array (
      0 => 'templates/error.tpl',
      1 => 1452820764,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12899043855698491edffab0_09966679',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5698491ee27950_98475776',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5698491ee27950_98475776')) {
function content_5698491ee27950_98475776 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '12899043855698491edffab0_09966679';
?>
<section class="main-body">
        <div class="wrapper inner-pages">
        <h1>Loan Application</h1>
        <ul class="step">
                <li><span class="step1"><strong>Step 1</strong> General Info</span></li>
            <li><span class="step2"><strong>Step 2</strong> Residence</span></li>
            <li><span class="step3"><strong>Step 3</strong> Employment</span></li>
            <li><span class="step4"><strong>Step 4</strong> Credit Info</span></li>
            <li><span class="step5"><strong>Step 5</strong> Miscellaneous</span></li>
         </ul>
         <div class="clear"></div>
		<center><br><h2>Error: You must follow the navigation. click <a href="index.php">here</a> to continue.</h2><br></center>
	</div>
</section>
<?php }
}
?>