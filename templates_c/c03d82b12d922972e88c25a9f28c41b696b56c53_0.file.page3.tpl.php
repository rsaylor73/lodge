<?php /* Smarty version 3.1.27, created on 2016-01-18 21:55:48
         compiled from "templates/page3.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1463962447569da5b4369725_75432935%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c03d82b12d922972e88c25a9f28c41b696b56c53' => 
    array (
      0 => 'templates/page3.tpl',
      1 => 1453172016,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1463962447569da5b4369725_75432935',
  'variables' => 
  array (
    'state' => 0,
    'show_co' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_569da5b43d7392_76516359',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569da5b43d7392_76516359')) {
function content_569da5b43d7392_76516359 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1463962447569da5b4369725_75432935';
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
         <h2>Step 3 of 5</h2>
         <h3>Employment information</h3>
         
    <div class="form-block">
        <form action="/page4" method="post" name="myform" id="myform">
        <input type="hidden" name="part" value="4">
        <div class="form-left fl-left">
            <h4>Applicant's Employment</h4>
            <span class="required-txt">(3 Year History Required)</span>
			<div class="form-box">
                <div class="formtagline"><strong>Current Employment Status</strong> (Primary Job)</div>
                <div class="checkbox-row">
					<input type="radio" name="employment_status" value="Employed"> Employed 
					<input type="radio" name="employment_status" value="Self-Employed"> Self-Employed 
				</div>
				<div class="checkbox-row">
					<input type="radio" name="employment_status" value="Other">  Other (Use “Other Income” Below)
				</div>
				<div class="field">
                    <label><span class="light-bold">Name of Current Employer</span></label>
                    <input type="text" name="employer_name" id="employer_name" required />
                </div>
				<div class="field">
                    <label>Employer’s Phone</label>
                    <input type="text" name="phone" id="phone" required />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="city" id="city" required />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="state" id="state" required class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="zip" id="zip" required />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>Supervisor's Name</label>
                    <input type="text" name="supervisor" id="supervisor" required />
                </div>
				<div class="field two-field">
                    <label>Hire Date (MM/YYYY)</label>
                    <input type="text" class="hire-date" name="hire_date" id="hire_date" />
                </div>
				<div class="field two-field">
                    <div class="checkbox-row">
					<input type="radio" name="hours" value="Full"> Full-time
					</div>
					<div class="checkbox-row">
					<input type="radio" name="hours" value="Part"> Part-time
					</div>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Gross Monthly Income</label>
                    <input type="text" class="gross-incm" name="gross_month_income" id="gross_month_income" required />
                </div>
				<div class="field two-field">
                    <label>Hourly Rate</label>
                    <input type="text" class="hourly-rate" name="hourly_rate" id="hourly_rate" required />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>Position/Title:</label>
                    <input type="text" name="title" id="title" required />
                </div>
            </div>
			<div class="form-box">
                <div class="checkbox-row1">
					Any gaps in employment greater than 30 days during the last 3 years?
					<input type="radio" name="employment_gaps" value="Yes"> Yes <input type="radio" name="employment_gaps" value="No" checked> No
				</div>
				<div class="field">
                    <label>Dates of gaps:</label>
                    <input type="text" name="dates_of_gaps" id="dates_of_gaps" />
                </div>
				<div class="field">
                    <label>Reason for gaps:</label>
                    <input type="text" name="reason_for_gaps" id="reason_for_gaps" />
                </div>
			</div>
			<div class="form-box">
                <div class="checkbox-row1">
					Do you have a Second Job? &nbsp;&nbsp;&nbsp;
					<input type="radio" name="second_job" value="Yes"> Yes <input type="radio" name="second_job" value="No" checked> No
				<p>If Yes, Please complete Second Employer</p>
				</div>
				<div class="field">
                    <label><span class="light-bold">Name of Second Employer</span></label>
                    <input type="text" name="s_employer" id="s_employer"/>
                </div>
				<div class="field">
                    <label>Employer’s Phone</label>
                    <input type="text" name="s_phone" id="s_phone" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="s_city" id="s_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="s_state" id="s_state" class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="s_zip" id="s_zip" />
                </div>
                                <div class="clear"></div>

				<div class="field">
                    <label>Supervisor's Name</label>
                    <input type="text" name="s_supervisor" id="s_supervisor" />
                </div>
				<div class="field two-field">
                    <label>Hire Date (MM/YYYY)</label>
                    <input type="text" class="hire-date" name="hire2_date" id="hire2_date" />
                </div>
				<div class="field two-field">
                    <div class="checkbox-row">
					<input type="radio" name="s_hours" value="Full"> Full-time
					</div>
					<div class="checkbox-row">
					<input type="radio" name="s_hours" value="Part"> Part-time
					</div>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Gross Monthly Income</label>
                    <input type="text" class="gross-incm" placeholder="$" name="s_gross_month_income" id="s_gross_month_income" />
                </div>
				<div class="field two-field">
                    <label>Hourly Rate</label>
                    <input type="text" class="hourly-rate" placeholder="$" name="s_hourly_rate" id="s_hourly_rate" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>Position/Title:</label>
                    <input type="text" name="s_title" id="s_title" />
                </div>
            </div>
			<div class="form-box">
                <div class="field">
                    <label><span class="light-bold">Name of Previous Employer</span></label>
                    <input type="text" name="p1_employer" id="p1_employer" />
                </div>
				<div class="field">
                    <label>Previous Employer’s Phone</label>
                    <input type="text" name="p1_phone" id="p1_phone" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="p1_city" id="p1_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="p1_state" class="state1"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Gross monthly income</label>
                    <input type="text" class="monthly-amount"  placeholder="$" name="p1_gross_monthly_income" id="p1_gross_monthly_income"  />
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Employment Date: MM/YYYY - MM/YYYY</label>
                    <input type="text" class="state-inline" name="p1_date1" id="emp1A_date" />
					<span class="inline-text-bottom">Thru</span> <input type="text" class="years-input" name="p1_date2" id="emp1B_date">
                </div>
				<div class="clear"></div>
				
            </div>
			<div class="form-box">
                <div class="field">
                    <label><span class="light-bold">Name of Previous Employer</span></label>
                    <input type="text" name="p2_employer" />
                </div>
				<div class="field">
                    <label>Previous Employer’s Phone</label>
                    <input type="text" name="p2_phone" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="p2_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="p2_state" class="state1"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Gross monthly income</label>
                    <input type="text" class="monthly-amount"  placeholder="$" name="p2_gross_monthly_income" id="p2_gross_monthly_income" />
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Employment Date: MM/YYYY - MM/YYYY</label>
                    <input type="text" class="state-inline" name="p2_date1" id="emp2A_date" />
					<span class="inline-text-bottom">Thru</span> <input type="text" class="years-input" name="p2_date2" id="emp2B_date">
                </div>
				<div class="clear"></div>
				
            </div>
			<div class="form-box">
			<p><strong>Other Income:</strong>  
Income from SSI, retirement, disability, alimony, child support, or
separate maintenance agreement need not be disclosed if you do 
not wish to have it considered as a basis for undertaking or repaying this debt.</p>
				<div class="field">
                    <label><span class="light-bold">Source of income 1</span></label>
                    <input type="text" name="source_income_1" />
                </div>
				
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="how_long_1" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="month_amount_1" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label><span class="light-bold">Source of income 2</span></label>
                    <input type="text" name="source_income_2" />
                </div>
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="how_long_2" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="month_amount_2" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label><span class="light-bold">Source of income 3</span></label>
                    <input type="text" name="source_income_3" />
                </div>
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="how_long_3" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="month_amount_3"  />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label><span class="light-bold">Source of income 4</span></label>
                    <input type="text" name="source_income_4" />
                </div>
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="how_long_4" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="month_amount_4"  />
                </div>
				<div class="clear"></div>
			</div>
		</div>
        <div class="form-right fl-right" <?php echo $_smarty_tpl->tpl_vars['show_co']->value;?>
>
            <h4>CO-APPLICANT Employment</h4>
            <span class="required-txt">(3 Year History Required)</span>
             <div class="form-box">
                <div class="formtagline"><strong>Current Employment Status</strong> (Primary Job)</div>
                <div class="checkbox-row">
					<input type="radio" name="cemployment_status" value="Employed"> Employed 
					<input type="radio" name="cemployment_status" value="Self-Employed" > Self-Employed
				</div>
				<div class="checkbox-row">
					<input type="radio" name="cemployment_status" value="Other">  Other (Use “Other Income” Below)
				</div>
				<div class="field">
                    <label><span class="light-bold">Current Employer</span></label>
                    <input type="text" name="cemployer_name" />
                </div>
				<div class="field">
                    <label>Employer’s Phone</label>
                    <input type="text" name="cphone" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="ccity" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cstate" class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="czip" />
                </div>
                <div class="clear"></div>

				<div class="field">
                    <label>Supervisor's Name</label>
                    <input type="text" name="csupervisor" />
                </div>
				<div class="field two-field">
                    <label>Hire Date (MM/YYYY)</label>
                    <input type="text" class="hire-date" name="chire_date" id="chire_date" />
                </div>
				<div class="field two-field">
                    <div class="checkbox-row">
					<input type="radio" name="chours" value="Full"> Full-time
					</div>
					<div class="checkbox-row">
					<input type="radio" name="chours" value="Part"> Part-time
					</div>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Gross Monthly Income</label>
                    <input type="text" class="gross-incm" name="cgross_month_income"  />
                </div>
				<div class="field two-field">
                    <label>Hourly Rate</label>
                    <input type="text" class="hourly-rate" name="chourly_rate" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>Position/Title:</label>
                    <input type="text" name="ctitle" />
                </div>
            </div>
			<div class="form-box">
                <div class="checkbox-row1">
					Any gaps in employment greater than 30 days during the last 3 years?
					<input type="radio" name="cemployment_gaps" value="Yes"> Yes <input type="radio" name="cemployment_gaps" value="No"> No
				</div>
				<div class="field">
                    <label>Dates of gaps:</label>
                    <input type="text" name="cdates_of_gaps" />
                </div>
				<div class="field">
                    <label>Reason for gaps:</label>
                    <input type="text" name="creason_for_gaps" />
                </div>
			</div>
			<div class="form-box">
                <div class="checkbox-row1">
					Do you have a Second Job? &nbsp;&nbsp;&nbsp;
					<input type="radio" name="csecond_job" value="Yes"> Yes <input type="radio" name="csecond_job" value="No"> No
				<p>If Yes, Please complete Second Employer</p>
				</div>
				<div class="field">
                    <label><span class="light-bold">Second Employer</span></label>
                    <input type="text" name="cs_employer" />
                </div>
				<div class="field">
                    <label>Employer’s Phone</label>
                    <input type="text" name="cs_phone" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="cs_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cs_state" class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="cs_zip" />
                </div>
				<div class="clear"></div>

				<div class="field">
                    <label>Supervisor's Name</label>
                    <input type="text" name="cs_supervisor" />
                </div>
				<div class="field two-field">
                    <label>Hire Date (MM/YYYY)</label>
                    <input type="text" class="hire-date" name="cs_hire_date" id="chire2_date" />
                </div>
				<div class="field two-field">
                    <div class="checkbox-row">
					<input type="radio" name="cs_hours" value="Full"> Full-time
					</div>
					<div class="checkbox-row">
					<input type="radio" name="cs_hours" value="Part"> Part-time
					</div>
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Gross Monthly Income</label>
                    <input type="text" class="gross-incm" placeholder="$" name="cs_gross_month_income" />
                </div>
				<div class="field two-field">
                    <label>Hourly Rate</label>
                    <input type="text" class="hourly-rate" placeholder="$" name="cs_hourly_rate" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label>Position/Title:</label>
                    <input type="text" name="cs_title" />
                </div>
				<div class="clear"></div>
            </div>
			<div class="form-box">
                <div class="field">
                    <label><span class="light-bold">Name of Previous Employer</span></label>
                    <input type="text" name="cp1_employer" />
                </div>
				<div class="field">
                    <label>Previous Employer’s Phone</label>
                    <input type="text" name="cp1_phone" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="cp1_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cp1_state" class="state1"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Gross monthly income</label>
                    <input type="text" class="monthly-amount"  placeholder="$" name="cp1_gross_monthly_income" />
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Employment Date: MM/YYYY - MM/YYYY</label>
                    <input type="text" class="state-inline" name="cp1_date1" id="cemp1A_date" />
					<span class="inline-text-bottom">Thru</span> <input type="text" class="years-input" name="cp1_date2" id="cemp1B_date">
                </div>
				<div class="clear"></div>
				
            </div>
			<div class="form-box">
                <div class="field">
                    <label><span class="light-bold">Previous Employer</span></label>
                    <input type="text" name="cp2_employer" />
                </div>
				<div class="field">
                    <label>Previous Employer’s Phone</label>
                    <input type="text" name="cp2_phone" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="cp2_city" />
                </div>
				<div class="field two-field">
                    <label>State</label>
                    <select name="cp2_state" class="state1"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                </div>
				<div class="field two-field">
                    <label>Gross monthly income</label>
                    <input type="text" class="monthly-amount"  placeholder="$" name="cp2_gross_monthly_income" />
                </div>
				<div class="clear"></div>
				<div class="field two-field">
                    <label>Employment Date: MM/YYYY - MM/YYYY</label>
                    <input type="text" class="state-inline" name="cp2_date1" id="cemp2A_date" />
					<span class="inline-text-bottom">Thru</span> <input type="text" class="years-input" name="cp2_date2" id="cemp2B_date">
                </div>
				<div class="clear"></div>
			</div>
			
            
			<div class="form-box">
                <p><strong>Other Income:</strong>  
Income from SSI, retirement, disability, alimony, child support, or
separate maintenance agreement need not be disclosed if you do 
not wish to have it considered as a basis for undertaking or repaying this debt.</p>
				<div class="field">
                    <label><span class="light-bold">Source of income 1</span></label>
                    <input type="text" name="csource_income_1" />
                </div>
				
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="chow_long_1" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="cmonth_amount_1"  />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label><span class="light-bold">Source of income 2</span></label>
                    <input type="text" name="csource_income_2" />
                </div>
				
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="chow_long_2" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="cmonth_amount_2" />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label><span class="light-bold">Source of income 3</span></label>
                    <input type="text" name="csource_income_3" />
                </div>
				
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="chow_long_3" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="cmonth_amount_3"  />
                </div>
                <div class="clear"></div>
				<div class="field">
                    <label><span class="light-bold">Source of income 4</span></label>
                    <input type="text" name="csource_income_4" />
                </div>
				
				<div class="field two-field">
                    <label>How Long Receiving</label>
                    <input type="text" class="state1" name="chow_long_4" />
                </div>
				<div class="field two-field">
                    <label>Monthly Amount</label>
                    <input type="text" class="monthly-amount" name="cmonth_amount_4"  />
                </div>
				<div class="clear"></div>
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