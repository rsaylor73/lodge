<div class="col-md-6">
<h2>Edit Payments : Conf #{$reservationID}</h2>

<form action="updatepayment" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="id" value="{$id}">

<table class="table">
<tr>
	<td width="200">Payment Type:</td><td>{$payment_type}</td>
</tr>



{if $payment_type eq "Check"}
<tr><td>Check Number:</td><td><input type="text" name="check_number" id="check_number" size="20" value="{$check_number}" required></td></tr>
<tr><td>Description:</td><td><textarea name="check_description" id="check_description" cols="30" rows="5" required>{$check_description}</textarea></td></tr>
{/if}

{if $payment_type eq "Wire"}
<tr><td>Wire Description:</td><td><textarea name="wire_description" id="wire_description" cols="30" rows="5" required>{$wire_description}</textarea></td></tr>
{/if}


<tr><td>Amount:</td><td>$<input type="text" name="payment_amount" size=20 onkeypress="return isNumber(event)" required value="{$payment_amount}"></td></tr>
<tr><td>Payment Date:</td><td><input type="text" name="payment_date" id="payment_date" required value="{$payment_date}"></td></tr>


<tr><td colspan="2"><input type="submit" value="Update Payment" class="btn btn-primary"></td></tr>
</table>
</form>

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

</div>