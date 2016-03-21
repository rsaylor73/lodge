<div class="col-md-6">
<h2>Edit Contact</h2>

<form action="updatecontact" method="post">
<input type="hidden" name="contactID" value="{$contactID}">
<table class="table">
	<tr><td><b>Title:</b></td><td><input type="text" name="title" value="{$title}" placeholder="(Mr., Ms., etc.)" size=40></td></tr>
	<tr><td><b>First Name:</b></td><td><input type="text" name="first" value="{$first}" size=40 required></td></tr>
	<tr><td><b>Middle Name:</b></td><td><input type="text" name="middle" value="{$middle}" size=40></td></tr>
	<tr><td><b>Last Name:</b></td><td><input type="text" name="last" value="{$last}" size=40 required></td></tr>

    <tr><td colspan=2><hr></td></tr>
	<tr><td><b>Email:</b></td><td><input type="text" name="email" value="{$email}" size=40 required></td></tr>
	<tr><td><b>Address Line 1:</b></td><td><input type="text" name="address1" value="{$address1}" size=40></td></tr>
	<tr><td><b>Address Line 2:</b></td><td><input type="text" name="address2" value="{$address2}" size=40></td></tr>
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
	<tr><td><b>Province:</b></td><td><input type="text" name="province" value="{$province}" size=40></td></tr>
	<tr><td><b>Country:</b></td><td><select name="country" required>{$list_country}</select></td></tr>
	<tr><td><b>Zip Code:</b></td><td><input type="text" name="zip" value="{$zip}" size=40></td></tr>
	<tr><td><b>Date Of Birth:</b></td><td><input type="text" name="dob" value="{$date_of_birth}" size=40></td></tr>

	<tr><td colspan=2><hr></td></tr>

	<tr><td>
		<select name="phone1_type">
		<option>Home</option>option>
		<option>Work</option>option>
		<option>Mobile</option>option>
		<option>Fax</option>option>
		{if $phone1_type ne ""}
		<option selected>{$phone1_type}</option>
		{/if}
	</td><td><input type="text" name="{$phone1}" value="{$phone1}" placeholder="Country code and number IE 1-706-955-0044" size=40></td></tr>
    <tr><td>
    	<select name="phone2_type">
		<option>Home</option>option>
		<option>Work</option>option>
		<option>Mobile</option>option>
		<option>Fax</option>option>
		{if $phone2_type ne ""}
		<option selected>{$phone2_type}</option>
		{/if}
    </td><td><input type="text" name="{$phone2}" value="{$phone2}" placeholder="Country code and number IE 1-706-955-0044" size=40></td></tr>
    <tr><td>
		<select name="phone3_type">
		<option>Home</option>option>
		<option>Work</option>option>
		<option>Mobile</option>option>
		<option>Fax</option>option>
		{if $phone3_type ne ""}
		<option selected>{$phone3_type}</option>
		{/if}
    </td><td><input type="text" name="{$phone3}" value="{$phone3}" placeholder="Country code and number IE 1-706-955-0044" size=40></td></tr>
    <tr><td>
		<select name="phone4_type">
		<option>Home</option>option>
		<option>Work</option>option>
		<option>Mobile</option>option>
		<option>Fax</option>option>
		{if $phone4_type ne ""}
		<option selected>{$phone4_type}</option>
		{/if}
    </td><td><input type="text" name="{$phone4}" value="{$phone4}" placeholder="Country code and number IE 1-706-955-0044" size=40></td></tr>

	<tr><td colspan=2><input type="submit" value="Update Contact" class="btn btn-primary"></td></tr>
</table>
</form>
