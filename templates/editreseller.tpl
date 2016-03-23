<div class="col-md-6">
<h2>Edit Reseller</h2>

<form action="updatereseller" method="post">
<input type="hidden" name="resellerID" value="{$resellerID}">
<table class="table">
	<tr><td><b>Company:</b></td><td><input type="text" name="title" value="{$company}" placeholder="Company name" size=40></td></tr>
	<tr><td><b>Reseller Type:</b></td><td><select name="reseller_type">{$reseller_type}</select></td></tr>
	<tr><td><b>Commission:</b></td><td><input type="text" name="commission" value="{$commission}" size=40 placeholder="Commission"></td></tr>
	<tr><td><b>First Name:</b></td><td><input type="text" name="first" value="{$first}" size=40 required></td></tr>
	<tr><td><b>Middle Initial:</b></td><td><input type="text" name="middle" value="{$middle}" maxlength="2" size=40></td></tr>
	<tr><td><b>Last Name:</b></td><td><input type="text" name="last" value="{$last}" size=40 required></td></tr>

    <tr><td colspan=2><hr></td></tr>
	<tr><td><b>Email:</b></td><td><input type="text" name="email" value="{$email}" size=40 required></td></tr>
	<tr><td><b>Address:</b></td><td><input type="text" name="address" value="{$address}" size=40></td></tr>
	<tr><td><b>City:</b></td><td><input type="text" name="city" value="{$city}" size=40></td></tr>
	<tr><td><b>State:</b></td><td><select name="state">
		{if $state ne ""}
			<option selected>{$state}</option>option>
		{/if}
		{if $state eq ""}
			<option selected value="">--Select--</option>option>
		{/if}
		{$list_states}
	</select>  US Only</td></tr>
	<tr><td><b>Country:</b></td><td><select name="country" required>{$country}</select></td></tr>
	<tr><td><b>Zip Code:</b></td><td><input type="text" name="zip" value="{$zip}" size=40></td></tr>

	<tr><td colspan=2><hr></td></tr>

	<tr><td>Phone 1</td><td><input type="text" name="phone" value="{$phone}" size=40 placeholder="Phone number"></td></tr>
	<tr><td>Phone 2</td><td><input type="text" name="phone2" value="{$phone2}" size=40 placeholder="Phone number"></td></tr>

	<tr><td colspan=2><input type="submit" value="Update Reseller" class="btn btn-primary"></td></tr>
</table>
</form>
