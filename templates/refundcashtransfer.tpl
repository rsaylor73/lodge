<div class="col-md-6">
<h2>Refunds / Cash Transfer</h2>

<form action="saverefundcashtransfer">
<input type="hidden" name="reservationID" value="{$reservationID}">
<table class="table">
<tr><td>Transaction Type:</td><td><select name="type" required>
	<option value="">--Select--</option>
	<option value="Refund">Refund</option>
	<option value="Cash Transfer">Cash Transfer</option>
	</select></td></tr>
<tr><td>Transaction Detail:</td><td><select name="detail" required><option selected value="">--Select--</option><option>Debit</option><option>Deposit</option></select></td></tr>
<tr><td>Referral Reservation ID:</td><td><input type="text" name="referral_reservationID" size="30" placeholder="The reservation number where the cash is going or coming from" required></td></tr>
<tr><td><input type="submit" class="btn btn-primary" value="Save"></td></tr>
</table>
</form>


</div>