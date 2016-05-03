<div class="col-md-6">
<h2>Edit Refunds / Cash Transfer Conf #{$reservationID}</h2>

<form action="updaterefundcashtransfer" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="id" value="{$id}">
<table class="table">
<tr><td width="200">Transaction Type:</td><td>{$type}</td></tr>
<tr><td>Transaction Detail:</td><td><select name="detail" id="detail" required>
	<option selected value="{$detail}">{$detail} (Default)</option>
	<option value="Debit">Debit</option>
	{if $type eq "Cash Transfer"}
	<option value="Deposit">Deposit</option>
	{/if}
</select>
&nbsp;<a href="javascript:void(0)" onclick="document.getElementById('detail_extra').style.display='table-row';"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
</td></tr>

<tr id="detail_extra" style="display:none"><td colspan=2>
	<table class="table"><tr><td>
	<b>Debit</b> will apply as a cash widthdraw from the reservation. In the condition of a refund the reservation price will be reduced by the refund price.<hr>
	<b>Deposit</b> will apply as a cash payment to the reservation.<br>
	</td></tr></table>
	<br>
	<a href="javascript:void(0)" onclick="document.getElementById('detail_extra').style.display='none';"><i class="fa fa-times-circle" aria-hidden="true"></i> close</a>


</td></tr>

<tr><td>Referral Reservation ID:</td><td><input type="text" name="referral_reservationID" id="referral_reservationID" value="{$referral_reservationID}" size="20" placeholder="...cash is going or coming..." required></td></tr>
<tr><td>Amount:</td><td>$ <input type="text" name="amount" id="amount" value="{$amount}" required onkeypress="return isNumber(event)" size="18"></td></tr>
<tr><td><input type="submit" class="btn btn-primary" value="Update"></td></tr>
</table>
</form>


</div>

<script>
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