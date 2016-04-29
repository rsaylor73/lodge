<div class="col-md-6">
<h2>Edit Discount : Conf #{$reservationID}</h2>

<form action="update_new_discount" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="id" value="{$id}">
<table class="table">
<tr><td>Select Discount Reason:</td><td><select name="general_discount_reasonID" style="width:200px">{$discount_options}</select></td></tr>
<tr><td>Amount:</td><td>$<input type="text" name="amount" value="{$amount}" size="20" required></td></tr>
<tr><td colspan=2><input type="submit" value="Update" class="btn btn-primary"></td></tr>
</table>
</form>

</div>