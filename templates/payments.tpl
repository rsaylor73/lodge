<div class="col-md-6">
<h2>Payments</h2>

<form action="processpayment" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">

<table class="table">
<tr>
	<td>Payment Type:</td><td><select name="payment_type" id="payment_type" onchange="get_payment_type()">
		<option selected value="">--Select--</option>
		<option value="1">Credit Card</option>
		<option value="2">Check</option>
		<option value="3">Wire</option>
		</select>
	</td>
</tr>


<tr id="credit_card1" style="display:none"><td>Name on Card:</td><td><input type="text" name="cc_name" id="cc_name" size=20 placeholder="Customer Name"></td></tr>
<tr id="credit_card2" style="display:none"><td>
	<i class="fa fa-cc-visa fa-3x" aria-hidden="true"></i>
	<i class="fa fa-cc-mastercard fa-3x" aria-hidden="true"></i>
	 </td><td><input type="text" name="cc_num" id="cc_num" size=20 placeholder="Credit card number" maxlength="16" {literal}pattern="[0-9]{16}"{/literal}></td></tr>
<tr id="credit_card3" style="display:none"><td>Expiration Date (MM/YYYY):</td><td>
	<input type="text" name="cc_month" id="cc_month" size=5 placeholder="Month" maxlength="2" {literal}pattern="[0-9]{2}"{/literal}> / 
	<input type="text" name="cc_year" id="cc_year" size="5" placeholder="Year"  maxlength="4" {literal}pattern="[0-9]{4}"{/literal}></td></tr>
<tr id="cred_card4" style="display:none"><td>CVV Number:</td><td><input type="text" name="cvv" id="cvv" {literal}patern="[0-9]{3}"{/literal}</td></td>

<tr><td>Amount:</td><td>$<input type="text" name="payment_amount" size=20 onkeypress="return isNumber(event)" required></td></tr>


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
	}
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 46 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>

</div>