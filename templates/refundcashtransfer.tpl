<div class="col-md-6">
<h2>Refunds / Cash Transfer</h2>

<form action="saverefundcashtransfer">
<input type="hidden" name="reservationID" value="{$reservationID}">
<table class="table">
<tr><td>Transaction Type:</td><td><select name="type" id="type" required onchange="check_type()">
	<option value="">--Select--</option>
	<option value="Refund">Refund</option>
	<option value="Cash Transfer">Cash Transfer</option>
	</select></td></tr>
<tr><td>Transaction Detail:</td><td><select name="detail" id="detail" required><option selected value="">--Select--</option><option>Debit</option><option>Deposit</option></select></td></tr>
<tr><td>Referral Reservation ID:</td><td><input type="text" name="referral_reservationID" id="referral_reservationID" size="20" placeholder="...cash is going or coming..." required></td></tr>
<tr><td>Amount:</td><td><input type="text" name="amount" id="amount" required></td></tr>
<tr><td><input type="submit" class="btn btn-primary" value="Save"></td></tr>
</table>
</form>


</div>

<script>
function check_type() {
	var e = document.getElementById("type");
	var strType = e.options[e.selectedIndex].value;
	if (strType == "Refund") {
		document.getElementById('referral_reservationID').value="N/A";
		document.getElementById('detail').value="Debit";

		e.remove(e.options[2]);
	} else {
		document.getElementById('referral_reservationID').value="";
	}
}
</script>