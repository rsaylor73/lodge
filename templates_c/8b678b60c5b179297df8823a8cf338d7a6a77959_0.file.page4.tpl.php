<?php /* Smarty version 3.1.27, created on 2016-01-22 19:59:37
         compiled from "templates/page4.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:213563540056a2d079ea9010_45586098%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b678b60c5b179297df8823a8cf338d7a6a77959' => 
    array (
      0 => 'templates/page4.tpl',
      1 => 1453510770,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213563540056a2d079ea9010_45586098',
  'variables' => 
  array (
    'state' => 0,
    'show_co' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56a2d079f0c414_47701852',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56a2d079f0c414_47701852')) {
function content_56a2d079f0c414_47701852 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '213563540056a2d079ea9010_45586098';
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
         <h2>Step 4 of 5</h2>
         <h3>Credit information</h3>
    <div class="form-block">
        <form action="/page5" method="post" name="myform" id="myform">
        <input type="hidden" name="part" value="5">
        <div class="form-left fl-left">
            <h4>Applicant's Credit info</h4>
            <div class="form-box">
                <div class="formtagline center"><strong>Complete if Currently Renting</strong></div>
                <div class="field">
                    <label>Landlord’s Name</label>
                    <input type="text" name="landlord_name" id="landlord_name" />
                </div>
				<div class="field">
                    <label>Relationship to Landlord (if any)</label>
                    <input type="text" name="relationship" id="relationship" />
                </div>
				<div class="field">
                    <label>Landlord’s Phone</label>
                    <input type="text" name="phone" id="phone" />
                </div>
				<div class="field">
                    <label>Current Monthly Rent to Landlord</label>
                    <input type="text" name="rent" id="rent" />
                </div>
			</div>
			<div class="form-box">
                <div class="formtagline center"><strong>Complete if You Currently Own</strong></div>
                <div class="field">
                    <label>Home Currently Financed By</label>
                    <input type="text" name="relationship" id="relationship" />
                </div>
				<div class="field two-field">
                    <label>Monthly Payment</label>
                    <input type="text" class="monthly-pynt" name="payment" id="payment" />
                </div>
				<div class="field two-field">
                    <label>Balance</label>
                    <input type="text" class="balance" name="balance" id="balance"  />
                </div>
				<div class="clear"></div>
				<div class="field">
                    <label>Name of Other Lender (if applicable)</label>
                    <input type="text" name="other_lender" id="other_lender" />
                </div>
				<div class="field two-field">
                    <label>Monthly Payment</label>
                    <input type="text" class="monthly-pynt" name="other_payment" id="other_payment" />
                </div>
				<div class="field two-field">
                    <label>Balance</label>
                    <input type="text" class="balance" name="other_blance" id="other_blance"  />
                </div>
				<div class="clear"></div>
				<div class="field">
                    <label>Name of Other Lender (if applicable)</label>
                    <input type="text" name="other2_lender" id="other2_lender" />
                </div>
				<div class="field two-field">
                    <label>Monthly Payment</label>
                    <input type="text" class="monthly-pynt" name="other2_payment" id="other2_payment" />
                </div>
				<div class="field two-field">
                    <label>Balance</label>
                    <input type="text" class="balance" name="other2_balance" id="other2_balance"  />
                </div>
				<div class="clear"></div>
			</div>
			<div class="form-box">
                <div class="formtagline center"><strong>Applicant’s Assets</strong></div>
                <div class="field">
                    <label>Cash (including deposit)</label>
                    <input type="text" name="cash" id="cash" required />
                </div>
				<div class="field">
                    <label>Bonds, Securities, 401(k), etc</label>
                    <input type="text" name="bonds" id="bonds" />
                </div>
				<div class="field">
                    <label>Other Assets</label>
                    <input type="text" name="other_assets" id="other_assets" />
                </div>
				<div class="field">
                    <label>Total Assets</label>
                    <input type="text" name="total_assets" id="total_assets"  />
                </div>
				<div class="formtagline center"><strong>Savings Accounts</strong></div>
				<div class="field">
                    <label>Bank Name</label>
                    <input type="text" name="bank_name" id="bank_name" />
                </div>
				<div class="field two-field">
                    <label>City</label>
                    <input type="text" class="monthly-pynt" name="bank_city" id="bank_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="bank_state" class="balance" /><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Approximate Balance</label>
                    <input type="text" class="monthly-pynt" name="bank_balance" id="bank_balance" />
                </div>
				<div class="clear"></div>
				<div class="formtagline center"><strong>Checking Accounts</strong></div>
				<div class="field">
                    <label>Bank Name</label>
                    <input type="text" name="bank2_name" id="bank2_name" />
                </div>
				<div class="field two-field">
                    <label>City</label>
                    <input type="text" class="monthly-pynt" name="bank2_city" id="bank2_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="bank2_state" class="balance"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Approximate Balance</label>
                    <input type="text" class="monthly-pynt" name="bank2_balance" id="bank2_balance" />
                </div>
				<div class="clear"></div>
			</div>
			<div class="form-box">
                <div class="additional-info">Additional Information for applicant</div>
				<div class="field">
                    <label>Are there any outstanding judgments against you?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="judgments" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="judgments" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Have you been declared bankrupt within the past 7 years?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="bankrupt" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="bankrupt" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Have you had property foreclosed upon or given title or deed in lieu thereof in 
the last 7 years?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="foreclosed" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="foreclosed" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a party to a lawsuit?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="lawsuit" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="lawsuit" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Have you directly or indirectly been obligated on any loan which resulted in 
foreclosure, transfer of title in lieu of foreclosure, or judgment? </label>
                    <div class="checkbox-ysno">
					<input type="radio" name="foreclosure2" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="foreclosure2" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Are you presently delinquent or in default on any Federal debt or any other loan, 
mortgage, financial obligation, bond, or loan guarantee?  </label>
                    <div class="checkbox-ysno">
					<input type="radio" name="delinquent" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="delinquent" value="No" required> No
					</div>
				</div>
				<div class="inline-field">
                    <spna class="inline-text">If yes, explain</spna> <input type="text" class="explain-input" name="delinquent_text" id="delinquent_text">
				</div>
				<div class="field">
                    <label>Are you obligated to pay alimony, child support, or separate maintenance?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="child_support" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="child_support" value="No" required> No
					<p>If yes, please indicate the amount for each:</p>
					<spna class="inline-text">Alimony: $</spna> <input type="text" class="explain-input1" name="alimony_amount" id="alimony_amount">
					<div class="clear"></div>
					<spna class="inline-text">Child Support: $</spna> <input type="text" class="explain-input2" name="child_support_amount" id="child_support_amount">
					<div class="clear"></div>
					<spna class="inline-text">Separate Maintenance: $</spna> <input type="text" class="explain-input3" name="seperate_maint_amount" id="seperate_maint_amount">
					</div>
				</div>
				<div class="field">
                    <label>Is any part of the down payment borrowed?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="borrowed" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="borrowed" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a co-maker or endorser on a note? </label>
                    <div class="checkbox-ysno">
					<input type="radio" name="comaker_on_a_note" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="comaker_on_a_note" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a U.S. citizen?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="citizen" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="citizen" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a permanent resident alien?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="resident_alien" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="resident_alien" value="No" required> No
					</div>
				</div>
				<div class="field">
                    <div class="inlinecheckbox">Do you intend to occupy the property as your primary residence?  &nbsp;<input type="radio" name="occupy_property" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="occupy_property" value="No" required> No</div>
                </div>
				<div class="field">
                    <label>If “Yes” above, please complete the questions below</label>
                </div>
				<div class="field">
                    <div class="inlinecheckbox">Have you had ownership interest in a property in the last three years?  &nbsp;<input type="radio" name="owned_interest_property" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="owned_interest_property" value="No" required> No</div>
                </div>
				<div class="field">
				<span class="inline-text">1) What type of property did you own-principal residence (PR), second home (SH), or investment property (IP)?</span> <input type="text" class="no1" name="type_property_own" id="type_property_own"> 
				</div>
				<div class="field">
				<span class="inline-text">2) How did you hold title to the home-solely by yourself (S), jointly with your spouse (SP), or jointly with another person (O)?</span>  <input type="text" class="no1" name="hold_title" id="hold_title"> 
				</div>
				
			</div>



		</div>
        <div class="form-right fl-right" <?php echo $_smarty_tpl->tpl_vars['show_co']->value;?>
>
            <h4>CO-APPLICANT Credit info</h4>
			<div class="form-box">
                <div class="formtagline center"><strong>Complete if Currently Renting</strong></div>
                <div class="field">
                    <label>Landlord’s Name</label>
                    <input type="text" name="clandlord_name" id="clandlord_name" />
                </div>
				<div class="field">
                    <label>Relationship to Landlord (if any)</label>
                    <input type="text" name="clandlord_name" id="clandlord_name" />
                </div>
				<div class="field">
                    <label>Landlord’s Phone</label>
                    <input type="text" name="cphone" id="cphone" />
                </div>
				<div class="field">
                    <label>Current Monthly Rent to Landlord</label>
                    <input type="text" name="crent" id="crent" />
                </div>
			</div>
			<div class="form-box">
                <div class="formtagline center"><strong>Complete if You Currently Own</strong></div>
                <div class="field">
                    <label>Home Currently Financed By</label>
                    <input type="text" name="clender" id="clender" />
                </div>
				<div class="field two-field">
                    <label>Monthly Payment</label>
                    <input type="text" class="monthly-pynt" name="cpayment" id="cpayment" />
                </div>
				<div class="field two-field">
                    <label>Balance</label>
                    <input type="text" class="balance" name="cbalance" id="cbalance" />
                </div>
				<div class="clear"></div>
				<div class="field">
                    <label>Name of Other Lender (if applicable)</label>
                    <input type="text" name="cother_lender" id="cother_lender" />
                </div>
				<div class="field two-field">
                    <label>Monthly Payment</label>
                    <input type="text" class="monthly-pynt" name="cother_payment" id="cother_payment" />
                </div>
				<div class="field two-field">
                    <label>Balance</label>
                    <input type="text" class="balance" name="cother_blance" id="cother_blance"  />
                </div>
				<div class="clear"></div>
				<div class="field">
                    <label>Name of Other Lender (if applicable)</label>
                    <input type="text" name="cother2_lender" id="cother2_lender" />
                </div>
				<div class="field two-field">
                    <label>Monthly Payment</label>
                    <input type="text" class="monthly-pynt" name="cother2_payment" id="cother2_payment" />
                </div>
				<div class="field two-field">
                    <label>Balance</label>
                    <input type="text" class="balance" name="cother2_balance" id="cother2_balance"  />
                </div>
				<div class="clear"></div>
			</div>
			<div class="form-box">
                <div class="formtagline center"><strong>Applicant’s Assets</strong></div>
                <div class="field">
                    <label>Cash (including deposit)</label>
                    <input type="text" name="ccash" id="ccash" />
                </div>
				<div class="field">
                    <label>Bonds, Securities, 401(k), etc</label>
                    <input type="text" name="cbonds" id="cbonds" />
                </div>
				<div class="field">
                    <label>Other Assets:</label>
                    <input type="text" name="cother_assets" id="cother_assets" />
                </div>
				<div class="field">
                    <label>Total Assets</label>
                    <input type="text" name="ctotal_assets" id="ctotal_assets" />
                </div>
				<div class="formtagline center"><strong>Savings Accounts</strong></div>
				<div class="field">
                    <label>Bank Name</label>
                    <input type="text" name="cbank_name" id="cbank_name" />
                </div>
				<div class="field two-field">
                    <label>City</label>
                    <input type="text" class="monthly-pynt" name="cbank_city" id="cbank_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cbank_state" class="balance"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Approximate Balance</label>
                    <input type="text" class="monthly-pynt" name="cbank_balance" id="cbank_balance" />
                </div>
				<div class="clear"></div>
				<div class="formtagline center"><strong>Checking Accounts</strong></div>
				<div class="field">
                    <label>Bank Name</label>
                    <input type="text" name="cbank2_name" id="cbank2_name" />
                </div>
				<div class="field two-field">
                    <label>City</label>
                    <input type="text" class="monthly-pynt" name="cbank2_city" id="cbank2_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cbank2_state" class="balance"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Approximate Balance</label>
                    <input type="text" class="monthly-pynt" name="cbank2_balance" id="cbank2_balance" />
                </div>
				<div class="clear"></div>
			</div>
			<div class="form-box">
                <div class="additional-info">Additional Information for applicant</div>
				<div class="field">
                    <label>Are there any outstanding judgments against you?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cjudgments" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cjudgments" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Have you been declared bankrupt within the past 7 years?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cbankrupt" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cbankrupt" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Have you had property foreclosed upon or given title or deed in lieu thereof in 
the last 7 years?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cforeclosed" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cforeclosed" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a party to a lawsuit?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="clawsuit" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="clawsuit" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Have you directly or indirectly been obligated on any loan which resulted in 
foreclosure, transfer of title in lieu of foreclosure, or judgment? </label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cforeclosure2" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cforeclosure2" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Are you presently delinquent or in default on any Federal debt or any other loan, 
mortgage, financial obligation, bond, or loan guarantee?  </label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cdelinquent" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cdelinquent" value="No"> No
					</div>
				</div>
				<div class="inline-field">
                    <spna class="inline-text">If yes, explain</spna> <input type="text" class="explain-input" name="cdelinquent_text" id="cdelinguent_text">
				</div>
				<div class="field">
                    <label>Are you obligated to pay alimony, child support, or separate maintenance?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cchild_support" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cchild_support" value="No"> No
					<p>If yes, please indicate the amount for each:</p>
					<spna class="inline-text">Alimony: $</spna> <input type="text" class="explain-input1" name="calimony_amount" id="calimony_amount">
					<div class="clear"></div>
					<spna class="inline-text">Child Support: $</spna> <input type="text" class="explain-input2" name="cchild_support_amount" id="cchild_support_amount">
					<div class="clear"></div>
					<spna class="inline-text">Separate Maintenance: $</spna> <input type="text" class="explain-input3" name="cseperate_maint_amount" id="cseperate_maint_amount">
					</div>
				</div>
				<div class="field">
                    <label>Is any part of the down payment borrowed?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cborrowed" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cborrowed" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a co-maker or endorser on a note? </label>
                    <div class="checkbox-ysno">
					<input type="radio" name="ccomaker_on_a_note" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ccomaker_on_a_note" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a U.S. citizen?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="ccitizen" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ccitizen" value="No"> No
					</div>
				</div>
				<div class="field">
                    <label>Are you a permanent resident alien?</label>
                    <div class="checkbox-ysno">
					<input type="radio" name="cresident_alien" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cresident_alien" value="No"> No
					</div>
				</div>
				<div class="field">
                    <div class="inlinecheckbox">Do you intend to occupy the property as your primary residence?  &nbsp;<input type="radio" name="coccupy_property" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="coccupy_property" value="No"> No</div>
                </div>
				<div class="field">
                    <label>If “Yes” above, please complete the questions below</label>
                </div>
				<div class="field">
                    <div class="inlinecheckbox">Have you had ownership interest in a property in the last three years?  &nbsp;<input type="radio" name="cowned_interest_property" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cowned_interest_property" value="No"> No</div>
                </div>
				<div class="field">
				<span class="inline-text">
				1) What type of property did you own-principal residence (PR), second home (SH), or investment property (IP)?</span> <input type="text" class="no1" name="ctype_property_own" id="ctype_property_own"> 
				</div>
				<div class="field">
				<span class="inline-text">2) How did you hold title to the home-solely by yourself (S), jointly with your spouse (SP), or jointly with another person (O)?</span>  <input type="text" class="no1" name="chold_title" id="chold_title"> 
				</div>
				
			</div>

		</div>
		
	
		
		<div class="clear"></div>
		<input type="submit" value="Continue">
        </form>
		<div class="prescription">
			<p><input type="image" src="img/skip.jpg" name="skip"></p>
		</div>
	</div>
</section>

<?php }
}
?>