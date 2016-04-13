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


<tr id="credit_card1" style="display:none"><td>Name on Card:</td><td><input type="text" name="cc_name" size=40></td></tr>
<tr id="credit_card2" style="display:none"><td>Credit Card Number (Visa/MC):</td><td><input type="text" name="cc_num" size=40></td></tr>
<tr id="credit_card3" style="display:none"><td>Expiration Date (MM/YYYY):</td><td><input type="text" name="cc_month" size=10> / <input type="text" name="cc_year" size="20"></td></tr>

<tr><td>Amount:</td><td>$<input type="text" name="payment_amount" size=40></td></tr>


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
		document.getElementById('credit_card2').style.display='table-row';
	}
}

</script>

</div>