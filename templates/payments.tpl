<div class="col-md-6">
<h2>Payments</h2>

<form action="processpayment" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">

<table class="table">
<tr>
	<td>Payment Type:</td><td><select name="payment_type">
		<option selected value="">--Select--</option>
		<option value="Credit Card">Credit Card</option>
		<option value="Check">Check</option>
		<option value="Wire">Wire</option>
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

</div>