<?php /* Smarty version 3.1.27, created on 2016-01-16 10:46:20
         compiled from "templates/page2.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2143848481569a65ccbd0d29_94738348%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56857427015e93662594e5896c9ba0568e1f37da' => 
    array (
      0 => 'templates/page2.tpl',
      1 => 1452959173,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2143848481569a65ccbd0d29_94738348',
  'variables' => 
  array (
    'addr1' => 0,
    'city' => 0,
    'state1' => 0,
    'state' => 0,
    'zip' => 0,
    'show_co' => 0,
    'caddr1' => 0,
    'ccity' => 0,
    'cstate1' => 0,
    'czip' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_569a65ccc2fca0_24898125',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569a65ccc2fca0_24898125')) {
function content_569a65ccc2fca0_24898125 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2143848481569a65ccbd0d29_94738348';
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
         <h2>Step 2 of 5</h2>
         <h3>Residence information</h3>
         
    <div class="form-block">
        <form action="/page3" method="post" name="myform" id="myform">
        <input type="hidden" name="part" value="3">
        <div class="form-left fl-left">
            <h4>Applicant's residence</h4>
            <span class="required-txt">(5 Year History Required)</span>
			<div class="form-box">
                <div class="formtagline"><strong>Current Residential Status:</strong></div>
                <div class="checkbox-row">
					<input type="radio" name="res_status" value="Own" checked> Own <input type="radio" name="res_status" value="Rent"> Rent 
					<input type="radio" name="res_status" value="Family"> Living With Family <input type="radio" name="res_status" value="Other"> Other
				</div>
				<div class="checkbox-row inline-field">
					<input type="text" class="other-input" name="other" id="other" placeholder="Other reason">
				</div>
				<div class="field">
                    <label>If you currently own, what will you do with your home? </label>
                    <div class="checkbox-row">
					<input type="radio" name="own_question" value="Sell"> Sell 
					<input type="radio" name="own_question" value="Trade"> Trade 
					<input type="radio" name="own_question" value="Rent"> Rent 
					<input type="radio" name="own_question" value="Keep"> Keep
 				</div>
                </div>
            </div>
			<div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Current Street Address:</span></label>
                    <input type="text" name="addr1" id="addr1" value="<?php echo $_smarty_tpl->tpl_vars['addr1']->value;?>
" required />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="city" id="city" value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
" required />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="state" id="state" required class="state"><?php echo $_smarty_tpl->tpl_vars['state1']->value;
echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="zip" id="zip" value="<?php echo $_smarty_tpl->tpl_vars['zip']->value;?>
" required />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>How Long at this address?</label>
                    <div class="field two-field">
					<span class="inline-text-bottom"># of Years:</span> <input type="text" class="years-input" name="years" id="years" required>
					
					</div>
					<div class="field two-field1">
					<span class="inline-text-bottom"># of Months:</span> <input type="text" class="years-input" name="months" id="months" required>
					</div>
                </div>
			</div>
			<div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Current Mailing Address</span> (if  different from street address)</label>
                    <input type="text" name="current_mail_addr" value="<?php echo $_smarty_tpl->tpl_vars['addr1']->value;?>
" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="current_city" value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select class="state" name="current_state"><?php echo $_smarty_tpl->tpl_vars['state1']->value;
echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="current_zip" value="<?php echo $_smarty_tpl->tpl_vars['zip']->value;?>
" />
                </div>
				<div class="clear"></div>
			</div>
			<div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Previous Street Address:</span> (most recent first)</label>
                    <input type="text" name="p1_addr" id="p1_addr" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="p1_city" id="p1_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="p1_state" id="p1_state" class="state"><option value="" selected>Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="p1_zip" id="p1_zip" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>How Long at this address?</label>
                    <div class="field two-field">
					<span class="inline-text-bottom"># of Years:</span> <input type="text" class="years-input" name="p1_years" id="p1_years">
					
					</div>
					<div class="field two-field1">
					<span class="inline-text-bottom"># of Months:</span> <input type="text" class="years-input" name="p1_months" id="p1_months">
					</div>
                </div>
			</div>
			<div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Previous Street Address:</span></label>
                    <input type="text" name="p2_addr" id="p2_addr" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="p2_city" id="p2_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="p2_state" id="p2_state" class="state"><option value="" selected>Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="p2_zip" id="p2_zip" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>How Long at this address?</label>
                    <div class="field two-field">
					<span class="inline-text-bottom"># of Years:</span> <input type="text" class="years-input" name="p2_years" id="p2_years">
					
					</div>
					<div class="field two-field1">
					<span class="inline-text-bottom"># of Months:</span> <input type="text" class="years-input" name="p2_months" id="p2_months">
					</div>
                </div>
			</div>
        </div>
        <div class="form-right fl-right" <?php echo $_smarty_tpl->tpl_vars['show_co']->value;?>
>
            <h4>CO-APPLICANT residence</h4>
            <span class="required-txt">(5 Year History Required)</span>
             <div class="form-box">
                <div class="formtagline"><strong>Current Residential Status:</strong></div>
                <div class="checkbox-row">
					<input type="radio" name="cres_status" value="Own" selected> Own 
					<input type="radio" name="cres_status" value="Rent"> Rent 
					<input type="radio" name="cres_status" value="Family"> Living With Family
					<input type="radio" name="cres_status" value="Other"> Other
				</div>
				<div class="checkbox-row inline-field">
					<input type="text" class="other-input" name="cother" id="cother" placeholder="Other reason">
				</div>
				<div class="field">
                    <label>If you currently own, what will you do with your
home? </label>
                    <div class="checkbox-row">
					<input type="radio" name="cown_question" value="Sell"> Sell 
					<input type="radio" name="cown_question" value="Trade"> Trade 
					<input type="radio" name="cown_question" value="Rent"> Rent 
					<input type="radio" name="cown_question" value="Keep"> Keep
 				</div>
                </div> 
            </div>
			 <div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Current Street Address:</span></label>
                    <input type="text" name="caddr1" value="<?php echo $_smarty_tpl->tpl_vars['caddr1']->value;?>
" id="caddr1" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="ccity" id="ccity" value="<?php echo $_smarty_tpl->tpl_vars['ccity']->value;?>
" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cstate" id="cstate" class="state"><?php echo $_smarty_tpl->tpl_vars['cstate1']->value;
echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="czip" id="czip" value="<?php echo $_smarty_tpl->tpl_vars['czip']->value;?>
" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>How Long at this address?</label>
                    <div class="field two-field">
					<span class="inline-text-bottom"># of Years:</span> <input type="text" class="years-input" name="cyears" id="cyears">
					
					</div>
					<div class="field two-field1">
					<span class="inline-text-bottom"># of Months:</span> <input type="text" class="years-input" name="cmonths" id="cmonths">
					</div>
                </div>
			</div>
			 <div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Current Mailing Address</span> (if  different from street address)</label>
                    <input type="text" name="ccurrent_mail_addr" id="ccurrent_mail_addr" value="<?php echo $_smarty_tpl->tpl_vars['caddr1']->value;?>
" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="ccurrent_city" id="ccurrent_city" value="<?php echo $_smarty_tpl->tpl_vars['ccity']->value;?>
" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="ccurrent_state" id="ccurrent_state" class="state"><?php echo $_smarty_tpl->tpl_vars['cstate1']->value;
echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="ccurrent_zip" id="ccurrent_zip" value="<?php echo $_smarty_tpl->tpl_vars['czip']->value;?>
" />
                </div>
				<div class="clear"></div>
			</div>
			 <div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Previous Street Address:</span> (most recent first)</label>
                    <input type="text" name="cp1_addr" id="cp1_addr" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="cp1_city" id="cp1_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cp1_state" id="cp1_state" class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="cp1_zip" id="cp1_zip" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>How Long at this address?</label>
                    <div class="field two-field">
					<span class="inline-text-bottom"># of Years:</span> <input type="text" class="years-input" name="cp1_years" id="cp1_years">
					
					</div>
					<div class="field two-field1">
					<span class="inline-text-bottom"># of Months:</span> <input type="text" class="years-input" name="cp1_months" id="cp1_months">
					</div>
                </div>
			</div>
			 <div class="form-box">
				<div class="field">
                    <label><span class="light-bold">Previous Street Address:</span></label>
                    <input type="text" name="cp2_addr" id="cp2_addr" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="cp2_city" id="cp2_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cp2_state" id="cp2_state" class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="cp2_zip" id="cp2_zip" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>How Long at this address?</label>
                    <div class="field two-field">
					<span class="inline-text-bottom"># of Years:</span> <input type="text" class="years-input" name="cp2_years" id="cp2_years">
					
					</div>
					<div class="field two-field1">
					<span class="inline-text-bottom"># of Months:</span> <input type="text" class="years-input" name="cp2_months" id="cp2_months">
					</div>
                </div>
			</div>
        </div>
        <div class="clear"></div>
	<input type="submit" value="Continue">
		<div class="prescription">
			<p><input type="image" src="img/skip.jpg" name="skip"></p>
		</div>
	</form>
	    </div>
	
    </div>
</section>
<?php }
}
?>