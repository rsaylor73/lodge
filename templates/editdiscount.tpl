<div class="col-md-6">
<h2>Edit Discount</h2>

<form action="updatediscount" method="post">
<input type="hidden" name="id" value="{$id}">
<table class="table">
<tr><td>Discount Name:</td><td><input type="text" name="reason" id="reason" value="{$reason}" size="20" maxlength="200" required></td></tr>
<tr><td>Active:</td><td><select name"show"><option selected>{$show}</option><option>No</option><option>Yes</option></select></td></tr>
<tr><td colspan="2"><input type="submit" value="Update" class="btn btn-primary"></td></tr>
</table>
</form>

</div>