<?php /* Smarty version 3.1.27, created on 2016-01-16 09:13:08
         compiled from "templates/page1.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:333697980569a4ff49b7351_89937202%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97301286758c2104a3966bca14d4f85e118d5ead' => 
    array (
      0 => 'templates/page1.tpl',
      1 => 1452953586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '333697980569a4ff49b7351_89937202',
  'variables' => 
  array (
    'state' => 0,
    'cstate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_569a4ff49fb6f5_81682790',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569a4ff49fb6f5_81682790')) {
function content_569a4ff49fb6f5_81682790 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '333697980569a4ff49b7351_89937202';
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
         <h2>Step 1 of 5</h2>
         <h3>General information</h3>

<?php echo '<script'; ?>
 language="javascript"> 

function toggle() {

	var ele = document.getElementById("co");


	if(ele.style.display == "inline") {
    		ele.style.display = "none";
		cfname.required = false;
                clname.required = false;
                chome_phone.required = false;
                cemail.required = false;
                cdob.required = false;
                cssn.required = false;
                caddress.required = false;
                ccity.required = false;
                cstate.required = false;
                czip.required = false;

  	} else {
		ele.style.display = "inline";
		cfname.required = true;
		clname.required = true;
		chome_phone.required = true;
		cemail.required = true;
		cdob.required = true;
		cssn.required = true;
		caddress.required = true;
		ccity.required = true;
		cstate.required = true;
		czip.required = true;
	}

} 

<?php echo '</script'; ?>
>

         <div class="form-description">
             <p>You may apply for credit in your name alone.  If you intend to apply for joint credit, initial here:  <input type="checkbox" name="coapp" value="checked" onclick="toggle()" /><br/>
    Co - Applicant information: Complete if (a) joint credit application; (b) income/assets of another person (may be Applicant’s spouse) to be used for loan qualification; or (c) Applicant resides in community property state or relying on community property for loan 
    qualification – AK, AZ, CA, ID, LA, NM, NV, TX, WA, WI.</p>
    	 </div>
    <div class="form-block">
        <form action="/page2" method="post" name="myform" id="myform">
	<input type="hidden" name="part" value="2">
        <div class="form-left fl-left">
            <h4>Applicant</h4>
                   <div class="form-box">
                <div class="field">
                    <label>First Name</label>
                    <input type="text" name="fname" id="fname" required />
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input type="text" name="lname" id="lname" required />
                </div>
                <div class="field">
                    <label>Middle Name</label>
                    <input type="text" name="mname" id="mname" />
                </div>
                <div class="field">
                    <label>Home Phone:</label>
                    <input type="text" name="home_phone" id="home_phone" required />
                </div>
                <div class="field">
                    <label>Cell Phone:</label>
                    <input type="text" name="cell_phone" id="cell_phone" />
                </div>
                <div class="field">
                    <label>Email:</label>
                    <input type="text" name="email" id="email" required />
                </div>
                <div class="field">
                    <label>Date of Birth(MM/DD/YYYY):</label>
                    <input type="text" name="dob" id="dob" required />
                </div>
                <div class="field">
                    <label>Social Security Number:</label>
                    <input type="text" name="ssn" required placeholder="###-##-####" />
                </div>
                <div class="field-extra">
                    <label>Marital Status:</label>
	        	<input type="checkbox" name="married" id="married" value="checked" /> Married &nbsp;&nbsp;&nbsp; 
			<input type="checkbox" name="seperated" id="seperated" value="checked" /> Separated &nbsp;&nbsp;&nbsp; 
			<input type="checkbox" name="unmarried" id="unmarried" value="checked" /> Unmarried
                </div>
                <div class="field-extra">
                    <label>Number of Dependents (excluding applicants):</label>
                    <input type="text"  class="no-of-applicnt" name="number_of_dependents">
                </div>
                <div class="field">
                    <label>Ages of Dependents:</label>
                    <input type="text" name="dependents_age" id="dependents_age" />
                </div>
				<div class="field">
                    <label>Current Street Address</label>
                    <input type="text" name="address" id="address" required />
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
				
            </div>
        </div>
        <div class="form-right fl-right" style="display: none" id="co">
            <h4>CO-APPLICANT <span class="heading-h4-small">(if any)</span></h4>
                   <div class="form-box">
                <div class="field">
                    <label>First Name</label>
                    <input type="text" name="cfname" id="cfname" />
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input type="text" name="clname" id="clname" />
                </div>
                <div class="field">
                    <label>Middle Initial (Optional)</label>
                    <input type="text" name="cmname" id="cmanme" />
                </div>
                <div class="field">
                    <label>Home Phone:</label>
                    <input type="text" name="chome_phone" id="chome_phone" />
                </div>
                <div class="field">
                    <label>Cell Phone:</label>
                    <input type="text" name="ccell_phone" id="ccell_phone" />
                </div>
                <div class="field">
                    <label>Email:</label>
                    <input type="text" name="cemail" id="cemail" />
                </div>
                <div class="field">
                    <label>Date of Birth(MM/DD/YYYY):</label>
                    <input type="text" name="cdob" id="cdob" />
                </div>
                <div class="field">
                    <label>Social Security Number:</label>
                    <input type="text" name="cssn" id="cssn" placeholder="###-##-####" />
                </div>
                <div class="field-extra">
                    <label>Marital Status:</label>
                <input type="checkbox" name="cmarried" id="cmarried" value="checked"/> Married &nbsp;&nbsp;&nbsp; 
		<input type="checkbox" name="cseperated" id="cseperated" value="checked" /> Separated &nbsp;&nbsp;&nbsp; 
		<input type="checkbox" name="cunmarried" id="cunmarried" value="checked" /> Unmarried
                </div>
                <div class="field-extra">
                    <label>Number of Dependents (excluding applicants):</label>
                    <input type="text"  class="no-of-applicnt" name="cnumber_of_dependents">
                </div>
                <div class="field">
                    <label>Ages of Dependents:</label>
                    <input type="text" name="cdependents_age" id="cdependents_age" />
                </div>
                <div class="field">
                    <label>Current Street Address</label>
                    <input type="text" name="caddress" id="caddress" />
                </div>
				<div class="field">
                    <label>City</label>
                    <input type="text" name="ccity" id="ccity" />
                </div>
				<div class="field two-field">
					<label>State</label>
                                        <select name="cstate" id="cstate" class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['cstate']->value;?>
</select>
				</div>
				<div class="field two-field">
					<label>Zip</label>
					<input type="text" class="zip" name="czip" id="czip" />
				</div>
				<div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <!--<a href="javascript:void(0);" class="btn" onclick="document.getElementById('myform').submit();" >Continue</a>-->
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