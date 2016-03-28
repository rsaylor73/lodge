<div class="col-md-6">
<h2>Agent :: {$company} :: {$name}</h2>

<form name="myform" action="updateagent" method="post">
<input type="hidden" name="reseller_agentID" value="{$reseller_agentID}">
<input type="hidden" name="resellerID" value="{$resellerID}">
<table class="table">
<tr><td><b>Status:</b></td><td><select name="status"><option selected value="{$status}">{$status} (Default)</option><option>Active</option><option>Inactive</option></select></td></tr>
<tr><td><b>First Name:</b></td><td><input type="text" name="first" value="{$first}" size=40></td></tr>
<tr><td><b>Middle Initial:</b></td><td><input type="text" name="middle" value="{$middle}" size=40></td></tr>
<tr><td><b>Last Name:</b></td><td><input type="text" name="last" value="{$last}" size=40></td></tr>
<tr><td><b>Address Line 1:</b></td><td><input type="text" name="address1" value="{$address1}" size="40"></td></tr>
<tr><td><b>Address Line 2:</b></td><td><input type="text" name="address2" value="{$address2}" size="40"></td></tr>
<tr><td><b>City:</b></td><td><input type="text" name="city" value="{$city}" size="40"></td></tr>
<tr><td><b>State/Province:</b></td><td><input type="text" name="state" value="{$state}" size="40"></td></tr>
<tr><td><b>Country:</b></td><td><select name="countryID">{$country}</select></td></tr>

<tr><td><b>Phone <select name="phone1_type">
	{if $phone1_type ne ""}<option selected>{$phone1_type}</option>option>{/if}
	<option>Home</option><option>Work</option><option>Mobile</option><option>Fax</option></select></b></td>
	<td><input type="text" name="phone1" value="{$phone1}" size=40></td></tr>

<tr><td><b>Phone <select name="phone2_type">
	{if $phone2_type ne ""}<option selected>{$phone2_type}</option>option>{/if}
	<option>Home</option><option>Work</option><option>Mobile</option><option>Fax</option></select></b></td>
	<td><input type="text" name="phone2" value="{$phone2}" size=40></td></tr>

<tr><td><b>Phone <select name="phone3_type">
	{if $phone3_type ne ""}<option selected>{$phone3_type}</option>option>{/if}
	<option>Home</option><option>Work</option><option>Mobile</option><option>Fax</option></select></b></td>
	<td><input type="text" name="phone3" value="{$phone3}" size=40></td></tr>

<tr><td><b>Phone <select name="phone4_type">
	{if $phone4_type ne ""}<option selected>{$phone4_type}</option>option>{/if}
	<option>Home</option><option>Work</option><option>Mobile</option><option>Fax</option></select></b></td>
	<td><input type="text" name="phone4" value="{$phone4}" size=40></td></tr>

<tr><td><b>Email:</b></td><td><input type="text" name="email" value="{$email}" size="40"></td></tr>

<tr><td colspan=2><input type="submit" value="Update" class="btn btn-primary"></td></tr>
</table>
</form>
