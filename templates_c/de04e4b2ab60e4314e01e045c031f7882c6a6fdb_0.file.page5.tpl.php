<?php /* Smarty version 3.1.27, created on 2016-01-23 20:53:49
         compiled from "templates/page5.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:172477009856a42ead2e3236_17217317%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de04e4b2ab60e4314e01e045c031f7882c6a6fdb' => 
    array (
      0 => 'templates/page5.tpl',
      1 => 1453600419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172477009856a42ead2e3236_17217317',
  'variables' => 
  array (
    'state' => 0,
    'show_co' => 0,
    'co_app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56a42ead356509_67774182',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56a42ead356509_67774182')) {
function content_56a42ead356509_67774182 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '172477009856a42ead2e3236_17217317';
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
         <h2>Step 5 of 5</h2>
         <h3>Miscellaneous</h3>
         <div class="form-block">
        <form action="/page6" method="post" name="myform" id="myform">
        <input type="hidden" name="part" value="6">
            <h4>MONTHLY HOUSEHOLD LIVING EXPENSES</h4>
            <div class="form-fullwidth-box">
                <p>INSTRUCTIONS:Please fill out the MONTHLY HOUSEHOLD living expenses below such as food, clothing, gasoline, and
health care, including the payment of recurring medical expenses.</p>
                <div class="field two-field">
				<span class="inline-text-bottom">Food: $</span> <input type="text" class="years-input" name="food" id="food" required>
				</div>
                <div class="field two-field">
                <span class="inline-text-bottom">Clothing: $</span> <input type="text" class="years-input" name="clothing" id="clothing" required>
                </div>
                <div class="field two-field">
                <span class="inline-text-bottom">Gasoline: $</span> <input type="text" class="years-input" name="gas" id="gas" required>
                </div>
                <div class="field two-field1">
                <span class="inline-text-bottom">Healthcaree: $</span> <input type="text" class="years-input" name="healthcare" id="healthcare" required>
                <p class="small-font">(Including payment of recurring medical expenses)</p>
                </div>
           </div>
             <!--fulwidth end-->
            <h4>Land information</h4>
            <div class="form-fullwidth-box">
                <div class="field">
                    <p><strong>This information is only need if you are applying for Land/Home package or you are using land to secure the loan.</strong></p>
                    </div>
                    <div class="field">
                    <p>Is there a residence currently on the land where you are planning to place this home? <span class="ouline-checkbox input"><input type="radio" name="land_residence" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="land_residence" value="No" required> No</span>  </p>
                    <p>Is the land that will be used to secure the loan currently in the applicant or co-applicant’s name?    <span class="ouline-checkbox input"><input type="radio" name="land_secure_loan" value="Yes"> Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="land_secure_loan" value="No" required> No</span>  </p>
                    <p>How was this land acquired by applicant/co-applicant?<span class="ouline-checkbox lessspacecheckbox input"><br><input type="radio" name="land_acquired" value="Gifted"> Gifted <input type="radio" name="land_acquired" value="Inherited"> Inherited <input type="radio" name="land_acquired" value="Purchased" required>Purchased <input type="radio" name="land_acquired" value="Other">Other</span ></p>
                    <div class="checkbox-row inline-field">
                        <input type="text" class="other-input paddingless" name="acquired_other" id="acquired_other" placeholder="Other reason">
                    </div>
                    
					<div class="field two-field no-bottm-space">
						<span class="inline-text-bottom">Size of land (acres):</span>
						<input class="input-width-ninty" type="text" name="land_size" id="land_size">
					</div>
					<div class="field two-field no-bottm-space">
						<span class="inline-text-bottom">Date land was gifted/inherited/purchased:</span>
						<input class="input-width-ninty" type="text" name="year_land_received" id="year_land_received">
					</div>
					<div class="field two-field no-bottm-space">
						<span class="inline-text-bottom">Purchase Price of land:</span>
						<input class="input-width-ninty" type="text" name="land_purchase_price" id="land_purchase_price">
					</div>
					<div class="clear"></div>
					</div>
            </div>
            <!--fulwidth end-->
            <h4>Property Location</h4>
            <div class="form-fullwidth-box">
                <div class="field">
                    <p><strong>Where will the home be located?</strong></p>
                </div>
                <div class="form-left fl-left">
                    <div class="field float-block-fields">
                    <label>Street Address</label>
                    <input type="text" name="address" id="address" required />
                    </div>
                    <div class="field two-field">
                    <label>State</label>
                    <select name="state" class="state" required><option value="" selected>Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
					</div>
					<div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="zip" name="zip" id="zip" required />
                </div>
                </div>
                <div class="form-left fl-right">
                    <div class="field float-block-fields">
                    <label>City</label>
                    <input type="text" name="city" id="city" required />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="checkbox-row inline-field">
                        <span class="inline-text">If home will be located on a rented property/park/community, amount of future monthly lot rent/site rent: $</span> <input type="text" class="zip" name="future" id="future">
                </div>
                
            </div>
            <!--fulwidth end-->
            <h4>Contacts <span class="heading-small">(Nearest 2 Relatives Not Living in the Home)</span></h4>
            <div class="form-fullwidth-box">
                <div class="form-left fl-left">
                    <div class="field float-block-fields">
                    <label><span class="light-bold">Name (First, MI, Last):</span></label>
                    <input type="text" name="c1_name" id="c1_name" required />
                    </div>
                    <div class="field float-block-fields">
                    <label>Home Phone</label>
                    <input type="text" name="c1_home_phone" id="c1_home_phone" required />
                    </div>
                    <div class="field float-block-fields">
                    <label>Street Address</label>
                    <input type="text" name="c1_address" id="c1_address" required />
                    </div>
                    <div class="field two-field">
                    <label>State</label>
                    <select name="c1_state" required class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                    </div>
                    <div class="field two-field">
                    <label>Zip</label>
                    <input type="text" name="c1_zip" id="c1_zip" required class="state1"/>
                    </div>

			<div class="clear"></div>

                    <div class="field float-block-fields">
                    <label><span class="light-bold">Name (First, MI, Last):</span></label>
                    <input type="text" name="c2_name" id="c2_name" required />
                    </div>
                    <div class="field float-block-fields">
                    <label>Home Phone</label>
                    <input type="text" name="c2_home_phone" id="c2_home_phone" required />
                    </div>
                    <div class="field float-block-fields">
                    <label>Street Address</label>
                    <input type="text" name="c2_address" id="c2_address" required />
                    </div>
                    <div class="field two-field">
                    <label>State</label>
                    <select name="c2_state" required class="state"><option selected value="">Select</option><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</select>
                    </div>
                    <div class="field two-field">
                    <label>Zip</label>
                    <input type="text" class="state1" name="c2_zip" id="c2_zip" required />
                    </div>
                    <div class="field two-field">
                    </div>
                </div>
                <div class="form-left fl-right">
                    <div class="field two-field">
                    <label>Suffix</label>
                    <input type="text" class="suffix" name="c1_suffix" id="c1_suffix" />
                    </div>
                    <div class="field two-field">
                    <label>Relationship</label>
                    <input type="text" class="relationship" name="c1_relationship" id="c1_relationship" required />
                    </div>
                    <div class="clear"></div>
                    <div class="field float-block-fields">
                    <label>Cell Phone</label>
                    <input type="text" name="c1_cell_phone" id="c1_cell_phone" />
                    </div>
                    <div class="field float-block-fields">
                    <label>City</label>
                    <input type="text" name="c1_city" id="c1_city" required />
                    </div>
                    <div class="field blank-field float-block-fields">
                    
                    </div>
                    <div class="field two-field">
                    <label>Suffix</label>
                    <input type="text" class="suffix" name="c2_suffix" id="c2_suffix" />
                    </div>
                    <div class="field two-field">
                    <label>Relationship</label>
                    <input type="text" class="relationship" name="c2_relationship" id="c2_relationship" required />
                    </div>
                    <div class="clear"></div>
                    <div class="field float-block-fields">
                    <label>Cell Phone</label>
                    <input type="text" name="c2_cell_phone" id="c2_cell_phone" />
                    </div>
                    <div class="field float-block-fields">
                    <label>City</label>
                    <input type="text" name="c2_city" id="c2_city" required />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <!--fulwidth end-->
            <h4>THIRD PARTY AUTHORIZATION</h4>
            <div class="form-fullwidth-box">
                <div class="field">
                <p>By providing the information below, you authorize the lender to discuss the terms and conditions of your application and/or a
pproval with the following individual(s)</p>
                </div>
                <div class="form-left fl-left">
                    <div class="field float-block-fields">
                    <label>Name</label>
                    <input type="text" name="tp1_name" id="tp1_name" required />
                    </div>
                    <div class="field float-block-fields">
                    <label>Name</label>
                    <input type="text" name="tp2_name" id="tp2_name" required />
                    </div>
                </div>
                <div class="form-left fl-right">
                    <div class="field two-field">
                    <label>Relationship</label>
                    <input type="text" class="state" name="tp1_relationship" id="tp1_relationship" required />
                    </div>
                    <div class="field two-field">
                    <label>Phone Number</label>
                    <input type="text" class="state1" name="tp1_phone" id="tp1_phone" required />
                    </div>
                    <div class="clear"></div>
                    <div class="field two-field">
                    <label>Relationship</label>
                    <input type="text" class="state" name="tp2_relationship" id="tp2_relationship" required />
                    </div>
                    <div class="field two-field">
                    <label>Phone Number</label>
                    <input type="text" class="state1" name="tp2_phone" id="tp2_phone" required />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <!--fulwidth end-->
            <div class="no-bg">
            <p>The following information is requested by the federal government for certain types of loans related to a dwelling in order to
monitor the lender’s compliance with 
equal credit opportunity, fair housing, and home mortgage disclosure laws. 
You are not required to furnish this information, but are encouraged to do so.
You 
may select one or more designations for “Race.”
The law provides that a lender may not discriminate on the basis of this information, or on whether you choose 
to furnish it. 
However, if you choose not to furnish the information and you have made this application in person, under federal regulations
the lender is required 
to note ethnicity, race, and sex on the basis of visual observation or surname. If you do not wish to furnish this information, please check below</p>
            <p>CALIFORNIA:
If this loan is for the purchase, construction, rehabilitation or refinancing of a housing accommodation, the following information is requested by 
the State of California and the federal government to monitor this financial institution’s compliance with the Housing Financial Discrimination
Act, Equal Credit 
Opportunity Law, and Fair Housing Law.
The law provides that a financial institution may neither discriminate on the basis of this information nor on whether 
or not it is furnished.
Furnishing this information is optional.
If you do not wish to furnish this information, please initial below</p>
             <p>This application was taken by: <span class="ouline-checkbox input">
<input type="radio" name="application_location" value="Face">Face-to-Face interview&nbsp;&nbsp;
<input type="radio" name="application_location" value="Mail"> Mail&nbsp;&nbsp;
<input type="radio" name="application_location" value="Phone"> Telephone&nbsp;&nbsp;
<input type="radio" name="application_location" value="Internet" checked> Internet&nbsp;&nbsp;
<input type="radio" name="application_location" value="Fax"> Fax&nbsp;&nbsp;
</span></p>
            
            
                <div class="form-left fl-left">
                    <div class="form-box">
                    <h5 class="center heading-larg"><span class="light-bold">Applicant</h5>
                    <div class="field">
                        <label><strong>Ethnicity</strong></label>
                        <span class="ouline-checkbox1 input"> <input type="radio" name="ethnicity" value="Hispanic or Latino" required>Hispanic or Latino &nbsp;&nbsp;
				<input type="radio" name="ethnicity" value="Not Hispanic or Latino">Not Hispanic or Latino</span> 
                    </div>
                    <div class="field">
                        <label><strong>RACE</strong></label>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="race" required value="American Indian or Alaskan Native">American Indian or Alaskan Native</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="race" value="Asian">Asian</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="race" value="Black or African American">Black or African American</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="race" value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="race" value="White">White</div>
                    </div>
                    <div class="field">
                        <label><strong>SEX</strong></label>
                        <span class="ouline-checkbox1 input"> <input type="radio" name="sex" value="Male" required>Male &nbsp;&nbsp;<input type="radio" name="sex" value="Female">Female</span> 
                    </div>
                    <div class="field">
                        <label><strong>MARITAL STATUS</strong></label>
                        <span class="ouline-checkbox1 input"> 
				<input type="radio" name="marital_status" value="Married">Married &nbsp;&nbsp;
				<input type="radio" name="marital_status" value="Unmarried">Unmarried </span> &nbsp;&nbsp;
				<input type="radio" name="marital_status" value="Seperated"> Separated</span>
                    <p><input type="checkbox"> do not wish to furnish this information <input type="text" class="inline-text-field" name="decline" id="decline">(initials).  Assessment of 
ethnicity, race, and sex are required on the basis of visual observation or surname if the 
information is not furnished.  </p>
                    </div>
                    </div>
                </div>
                <div class="form-left fl-right" <?php echo $_smarty_tpl->tpl_vars['show_co']->value;?>
>
                    <div class="form-box">
                    <div class="center heading-larg"><span class="light-bold ">Co-Applicant</div>
                    <div class="field">
                        <label><strong>Ethnicity</strong></label>
                        <span class="ouline-checkbox1 input"> <input type="radio" name="cethnicity" value="Hispanic or Latino">Hispanic or Latino &nbsp;&nbsp;
				<input type="radio" name="cethnicity" value="Not Hispanic or Latino">Not Hispanic or Latino</span> 
                    </div>
                    <div class="field">
                        <label><strong>RACE</strong></label>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="crace" value="American Indian or Alaskan Native">American Indian or Alaskan Native</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="crace" value="Asian">Asian</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="crace" value="Black or African American">Black or African American</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="crace" value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</div>
                        <div class="ouline-checkbox1 input"> <input type="radio" name="crace" value="White">White</div>
                    </div>
                    <div class="field">
                        <label><strong>SEX</strong></label>
                        <span class="ouline-checkbox1 input"> <input type="radio" name="csex" value="Male">Male &nbsp;&nbsp;<input type="radio" name="csex" value="Female">Female</span> 
                    </div>
                    <div class="field">
                        <label><strong>MARITAL STATUS</strong></label>
                        <span class="ouline-checkbox1 input"> 
				<input type="radio" name="cmarital_status" value="Married">Married &nbsp;&nbsp;
				<input type="radio" name="cmarital_status" value="Unmarried">Unmarried </span> &nbsp;&nbsp;
				<input type="radio" name="cmarital_status" value="Seperated"> Separated</span>
                    <p><input type="checkbox"> do not wish to furnish this information <input type="text" class="inline-text-field" name="cdecline" id="cdecline">(initials).  Assessment of 
ethnicity, race, and sex are required on the basis of visual observation or surname if the 
information is not furnished.  </p>
                    </div>
                    </div>
                </div>
                <div class="clear"></div>
                </div>
         <!----form-block-->
          </div>
        
        
        <div class="prescription">
			<p><strong>CALIFORNIA</strong>: An applicant, if married, may apply for a separate account. If your credit is declined, you refuse or counter offer, your account is terminated or there is an unfavorable change in the terms made to your account and our decision is based, in whole or in part, on information contained in a consumer credit report, you have the right to obtain within 60 days a free copy of your consumer credit report from the consumer credit reporting agency and from any other consumer credit reporting agency which compiles and maintains files on consumers on a nationwide basis. Additionally, you have the right under California Civil Code § 1785.16 to dispute the accuracy or completeness of any information in a consumer credit report 
furnished by the consumer credit reporting agency. <p>
<p><strong>MASSACHUSETTS</strong>: The responsibility of the attorney for the mortgagee is to protect the interest of the mortgagee. 
Mortgagors may, at their own expense, engage an attorney of their selection to represent their interests in the transaction. </p>
<p><strong>NEW HAMPSHIRE: If this is an application for balloon financing, you are entitled to receive, upon request, a written 
estimate of the monthly payment amount for a balloon payment refinancing in accordance with the creditor's then 
existing refinance programs prior to entering into a balloon contract.</strong></p> 
<p><strong>NEW YORK:</strong> In connection with your application for credit, a consumer report may be requested in connection with such application. Upon 
request, you will be informed whether or not a consumer report was requested, and if such report was requested, informed of the name and address of the 
consumer reporting agency that furnished the report. If your application is granted, subsequent consumer reports may be requested or utilized in 
connection with any updates, renewal, or extension of the credit for which application was made.</p> 
<p><strong>OHIO</strong>: The Ohio laws against discrimination require that all creditors make credit equally available to all credit worthy customers, and that credit reporting agencies maintain separate credit histories on each individual upon request. The Ohio civil rights commission administers compliance with this law.</p> 
<p><strong>RHODE ISLAND</strong> : Credit reports may be requested in connection with this application. </p>
<p><strong>VERMONT</strong> : By completing this credit application and giving us permission to obtain your credit reports, you authorize us and our employees or affiliates to obtain and verify information about you (including one or more credit reports, information about your employment and banking and credit 
relationships) that we may deem necessary or appropriate in evaluating your application. If your application is approved and credit is extended, 
you also authorize us, and our employees and agents, to obtain additional credit reports and other information about you in connection with reviewing the 
account, increasing the credit line on the account (if applicable), taking collection on the account, or for any other legitimate purpose associated with 
the account. </p>
<p><strong>WASHINGTON</strong> : Washington State law against discrimination prohibits discrimination in credit transactions because of race, creed, color, national origin, sex or marital status. The Washington State Human Rights Commission administers compliance with this law. Additionally, please let us know 
if we should investigate your credit references and/or credit history under another name. </p>
<p><strong>WISCONSIN</strong> : No provision of a marital property agreement, a unilateral statement under Wisc. Stat. § 766.59 or a court decree under Wis
c. Stat. § 766.70 adversely affects the interest of the creditor unless the creditor, prior to the time the credit is granted, is furnished a copy of the agreement, statement or decree or has actual knowledge of the adverse provision when the obligation to the creditor is incurred. NON-APPLICANT SPOUSE 
WAIVER OF NOTICE: I agree to waive notice of any extension of credit in connection with this application:</p> 
<div class="field two-field">
                    <span class="inline-text-bottom">Non-applicant Spouse:</span>
                    <input type="text" class="state1" name="non_applicant_spouse" id="non_applicant_spouse" />
                </div>
				<div class="field two-field">
                    <span class="inline-text-bottom">Date:</span>
                    <input type="text" class="zip" name="non_applicant_spouse_date" id="non_applicant_spouse_date" />
                </div>
                <div class="clear"></div>
                

<p>I (We) (1) state that the above information is true, accurate and complete as of the date of this Application, and I(we) understand that any false statements or intentional/negligent misrepresentation of information provided may result in civil liability, monetary damages and/or criminal penalties including fine or imprisonment, or both, under the provisions of 18 U.S.C. 1001, et seq.; 31 U.S.C. 3729, 3802; (2) I (we) agree to amend this Application if any of the information therein should change prior to closing of the loan; (3) acknowledge that this Application is the property of the creditor or credit institution to which it is submitted, whether or not the loan I (we) am/are applying for is approved and closed; (4) authorize the creditor or credit institution to which this Application is submitted to request a consumer credit report on me (us) and to request of any present or past creditor or employer information as to my credit or employment for the purpose of considering this Application; (5) authorize the creditor, credit institution or servicer of my (our) loan to request a consumer credit report on me (us) in connection with the servicing of my (our) loan, as permitted by law; (6) authorize the creditor, credit institution or servicer of my (our) loan to report the existence of and information about this loan, including my (our) delinquency and/or compliance with the loan terms and conditions; (7) agree that the residential property which will secure this loan will not be used for any illegal purpose; (8) agree that the ownership or servicing of this loan may be transferred to another, with notice given of such transfer as may be required by law; and (9) that my (our) transmission of this Application as an "electronic record" with my (our) "electronic signature," as those terms are defined by applicable federal and state law (but not including audio or video recordings), or my (our) facsimile transmission of this application containing my (our) facsimile signature(s), shall be as effective, enforceable and valid as if a paper version of this Application were delivered containing my (our) original signature(s). </p>
<p><strong>INFORMATION SHARING CONSENT</strong>: I (We) consent and authorize the creditor, credit institution, servicer or their assignees to share my(our) confidential personal and financial information with others as is necessary to facilitate the processing of this application, completing this transaction, servicing my(our) account, or other legitimate purpose, including sharing necessary personal and financial information with the seller of my(our) home and/or land to facilitate my(our) sales transaction.</p>
<p><strong>ACKNOWLEDGEMENT</strong>: I (We) acknowledge that any creditor or credit institution to which this Application is submitted, owner of the loan, its servicers, successors and assigns, may verify or re-verify any information or data relating to the loan, for any legitimate business purpose through any source, including a source named in this application or a consumer reporting agency. <div class="ouline-checkbox1 input"> 

<input type="checkbox" name="app_ack" value="checked" required>Applicant</div><div class="ouline-checkbox1 input"> 

<?php if ($_smarty_tpl->tpl_vars['co_app']->value == "1") {?>
	<input type="checkbox" name="co_ack" value="checked" required>Co-Applicant
<?php }?>
</div></p>
            </div>

	<input type="submit" value="Continue">
</form>

	</div>
</section>

<?php }
}
?>