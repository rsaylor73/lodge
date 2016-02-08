<?php /* Smarty version 3.1.27, created on 2016-01-26 20:03:48
         compiled from "templates/page6.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:213374341856a81774596831_66186387%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '552fb18121c2659eb68125c78bf53c4f8233efa5' => 
    array (
      0 => 'templates/page6.tpl',
      1 => 1453856547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213374341856a81774596831_66186387',
  'variables' => 
  array (
    'state' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56a817745d9da5_36086918',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56a817745d9da5_36086918')) {
function content_56a817745d9da5_36086918 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '213374341856a81774596831_66186387';
?>
<section class="main-body">
	<div class="wrapper inner-pages">
    	<h1>Loan application</h1>
        <ul class="step">
        	<li><span class="step1"><strong>Step 1</strong> General Info</span></li>
            <li><span class="step2"><strong>Step 2</strong> Residence</span></li>
            <li><span class="step3"><strong>Step 3</strong> Employment</span></li>
            <li><span class="step4"><strong>Step 4</strong> Credit Info</span></li>
            <li><span class="step5"><strong>Step 5</strong> Miscellaneous</span></li>
         </ul>
         <div class="clear"></div>
         <h2>Final Details</h2>
		<div class="center-div">
			<div class="form-block">
        <form action="/page7" method="post" name="myform" id="myform">
        <input type="hidden" name="part" value="7">
			<div class="center">
				<div class="form-box">
					<h3><span class="light-bold">Types of Financing</span></h3>
					<div class="field">
                        <label><strong></strong></label>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="financing_type" value="Home" required>I am seeking home only financing</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="financing_type" value="HomeLand">I am seeking home/land financing</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="financing_type" value="Either">I am considering either type of financing</div>
                    </div>
					<div class="field">
					<p><strong>Are you  currently working with a manufacturing home dealer?</strong></p>
					<p>If so, please complete the following. if not, please simply click "Submit" below</p>
					</div>
					<div class="field">
                    <label>Sales Rep's Name</label>
                    <input type="text" name="sales_rep_name" id="sales_rep_name" />
					</div>
					<div class="field">
                    <label>Sales Rep's Phone Number</label>
                    <input type="text" name="sales_rep_phone" id="sales_rep_phone" />
					</div>
					<div class="field">
                    <label>Sales Rep's Email Address</label>
                    <input type="text" name="sales_rep_email" id="sales_rep_email" />
					</div>
					<div class="field">
                    <label>Name of Sales Center</label>
                    <input type="text" name="sales_center_name" id="sales_center_name" />
					</div>
					<div class="field">
                    <label>Address of Sales Center</label>
                    <input type="text" name="address" id="address" />
					</div>
					<div class="field">
                    <label>City</label>
                    <input type="text" name="city" id="city" />
					</div>

                                        <div class="field">
                    <label>State</label>
                    <select name="state" id="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                                        </div>


                                        <div class="field">
                    <label>Zip</label>
                    <input type="text" name="zip" id="zip" />
                                        </div>

					<div class="field">
                        <span class="ouline-checkbox1 input" name="copy_score" value="checked"> <input type="checkbox">Please send a copy of my credit score to the sales rep listed above</span> 
                    </div>
				</div>
			</div>
			<button class="submit" value="Submit">Submit</button>
			</form>
			</div>
		</div>
    </div>
</section>

<?php }
}
?>