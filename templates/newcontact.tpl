<div class="col-md-6">
<h2>New Contact</h2>

<form action="savecontact" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="bed" value="{$bed}">
<table class="table">
	<tr><td><b>Title:</b></td><td><input type="text" name="title" placeholder="(Mr., Ms., etc.)" size=40></td></tr>
	<tr><td><b>First Name:</b></td><td><input type="text" name="first" size=40 required></td></tr>
	<tr><td><b>Middle Name:</b></td><td><input type="text" name="middle" size=40></td></tr>
	<tr><td><b>Last Name:</b></td><td><input type="text" name="last" size=40 required></td></tr>

   <tr><td colspan=2><hr></td></tr>
	<tr><td><b>Email:</b></td><td><input type="text" name="email" size=40 required></td></tr>
	<tr><td><b>Address Line 1:</b></td><td><input type="text" name="addr1" size=40></td></tr>
	<tr><td><b>Address Line 2:</b></td><td><input type="text" name="addr2" size=40></td></tr>
	<tr><td><b>City:</b></td><td><input type="text" name="city" size=40></td></tr>
	<tr><td><b>State:</b></td><td><select name="state">{$state}</select>  US Only</td></tr>
	<tr><td><b>Province:</b></td><td><input type="text" name="province" size=40></td></tr>
	<tr><td><b>Country:</b></td><td><select name="country" required>{$country}</select></td></tr>
	<tr><td><b>Zip Code:</b></td><td><input type="text" name="zip" size=40></td></tr>
	<tr><td><b>Date Of Birth:</b></td><td><input type="text" name="dob" id="dob" size=40></td></tr>
	<tr><td><b>Gender:</b></td><td><select name="sex" required><option value="">--Select--</option><option value="male">Male</option><option value="female">Female</option></select></td></tr>

	<tr><td colspan=2><hr></td></tr>
	<tr><td><b>Cell Phone:</b></td><td><input type="text" name="cell_phone" placeholder="Country code and number IE 1-706-955-0044" size=40></td></tr>
	<tr><td><b>Home Phone:</b></td><td><input type="text" name="home_phone" size=40></td></tr>
	<tr><td><b>Work Phone:</b></td><td><input type="text" name="work_phone" size=40></td></tr>
	<tr><td colspan=2><input type="submit" value="Save Contact" class="btn btn-primary"></td></tr>
</table>
</form>
