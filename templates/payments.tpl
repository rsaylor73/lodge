<div class="col-md-6">
<h2><input type="button" value="&lt;&lt; Back" onclick="javascript:window.history.back()"> Payments : Conf #{$reservationID}</h2>

<form action="processpayment" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">

<table class="table">
<tr>
	<td width="200">Payment Type:</td><td><select name="payment_type" id="payment_type" onchange="get_payment_type()">
		<option selected value="">--Select--</option>
		<option value="1">Credit Card</option>
		<option value="2">Check</option>
		<option value="3">Wire</option>
		</select>
	</td>
</tr>


<tr id="credit_card1" style="display:none"><td>Name on Card:</td><td><input type="text" name="cc_name" id="cc_name" size=20 placeholder="Name on Card"></td></tr>
<tr id="credit_card2" style="display:none"><td>
	<i class="fa fa-cc-visa fa-3x" aria-hidden="true"></i>
	<i class="fa fa-cc-mastercard fa-3x" aria-hidden="true"></i>
	 </td><td><input type="text" name="cc_num" id="cc_num" size=20 placeholder="Credit card number" maxlength="16" {literal}pattern="[0-9]{16}"{/literal}></td></tr>
<tr id="credit_card3" style="display:none"><td>Expiration Date (MM/YYYY):</td><td>
	<input type="text" name="cc_month" id="cc_month" size=5 placeholder="Month" maxlength="2" {literal}pattern="[0-9]{2}"{/literal}> / 
	<input type="text" name="cc_year" id="cc_year" size="5" placeholder="Year"  maxlength="4" {literal}pattern="[0-9]{4}"{/literal}></td></tr>
<tr id="credit_card4" style="display:none"><td>CVV Number:</td><td><input type="text" name="cvv" id="cvv" {literal}patern="[0-9]{3}"{/literal}</td></td>

<tr id="check1" style="display:none"><td>Check Number:</td><td><input type="text" name="check_number" id="check_number" size="20"></td></tr>
<tr id="check2" style="display:none"><td>Description:</td><td><textarea name="check_description" id="check_description" cols="30" rows="5"></textarea></td></tr>

<tr id="wire1" style="display:none"><td>Wire Description:</td><td><textarea name="wire_description" id="wire_description" cols="30" rows="5"></textarea></td></tr>


<tr><td>Amount:</td><td>$<input type="text" name="payment_amount" size=20 onkeypress="return isNumber(event)" required></td></tr>
<tr><td>Payment Date:</td><td><input type="text" name="payment_date" id="payment_date" required></td></tr>


<tr><td colspan="2"><input type="submit" value="Process Payment" class="btn btn-primary"></td></tr>
</table>
</form>

<script>
function get_payment_type() {
	var e = document.getElementById("payment_type");
	var strPayment = e.options[e.selectedIndex].value;
	if (strPayment == "1") {
		document.getElementById('credit_card1').style.display='table-row';
		document.getElementById('credit_card2').style.display='table-row';
		document.getElementById('credit_card3').style.display='table-row';
		document.getElementById('credit_card4').style.display='table-row';
		document.getElementById('cc_name').required=true;
		document.getElementById('cc_num').required=true;
		document.getElementById('cc_month').required=true;
		document.getElementById('cc_year').required=true;
		document.getElementById('cvv').required=true;
		document.getElementById('check1').style.display='none';
		document.getElementById('check2').style.display='none';
		document.getElementById('check_number').required=false;
		document.getElementById('wire1').style.display='none';
		document.getElementById('wire_description').required=false;
		document.getElementById('check_description').required=false;
	}

	if (strPayment == "2") {
		document.getElementById('check1').style.display='table-row';
		document.getElementById('check2').style.display='table-row';
		document.getElementById('credit_card1').style.display='none';
		document.getElementById('credit_card2').style.display='none';
		document.getElementById('credit_card3').style.display='none';
		document.getElementById('credit_card4').style.display='none';
		document.getElementById('check_number').required=true;
		document.getElementById('check_description').required=true;
		document.getElementById('cc_name').required=false;
		document.getElementById('cc_num').required=false;
		document.getElementById('cc_month').required=false;
		document.getElementById('cc_year').required=false;
		document.getElementById('cvv').required=false;
		document.getElementById('wire1').style.display='none';
		document.getElementById('wire_description').required=false;
	}

	if (strPayment == "3") {
		document.getElementById('wire1').style.display='table-row';
		document.getElementById('check1').style.display='none';
		document.getElementById('check2').style.display='none';
		document.getElementById('credit_card1').style.display='none';
		document.getElementById('credit_card2').style.display='none';
		document.getElementById('credit_card3').style.display='none';
		document.getElementById('credit_card4').style.display='none';
		document.getElementById('wire_description').required=true;
		document.getElementById('check_number').required=false;
		document.getElementById('cc_name').required=false;
		document.getElementById('cc_num').required=false;
		document.getElementById('cc_month').required=false;
		document.getElementById('cc_year').required=false;
		document.getElementById('cvv').required=false;
		document.getElementById('check_description').required=false;
	}

}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 46 || charCode > 57)) {
        return false;
    }
    if (charCode == 47) {
    	return false;
    }
    return true;
}

</script>

</div>
