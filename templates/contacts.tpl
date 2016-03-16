<div class="col-md-6">
<h2>Contacts</h2>
<input type="button" value="New Contact" class="btn btn-success" onclick="document.location.href='newcontact'"><br>
{$msg}


<br>

<form action="searchcontacts" method="post">
<table class="table">
<tr>
	<td><input type="text" name="first" placeholder="First Name" size=20></td>
	<td><input type="text" name="last" placeholder="Last Name" size=20></td>
</tr>

<tr id="s0">
	<td colspan=2><i class="fa fa-arrow-down" onclick="
	document.getElementById('s0').style.display='none';
   document.getElementById('s1').style.display='table-row';
   document.getElementById('s2').style.display='table-row';
   document.getElementById('s3').style.display='table-row';
   document.getElementById('s4').style.display='table-row';

">

 Show more search options</i></td>
</tr>

<tr id="s1" style="display:none">
	<td><input type="text" name="phone" placeholder="Phone" size=20></td>
	<td><input type="text" name="zip" placeholder="Zip" size=20></td>
</tr>
<tr id="s2" style="display:none">
	<td><input type="text" name="email" placeholder="Email" size=20></td>
	<td><select name="country" style="width:200px">{$country}</select></td>
</tr>
<tr id="s3" style="display:none">
	<td><input type="text" name="contactID" placeholder="Contact ID"></td>
	<td><input type="text" name="city" placeholder="City"></td>
</tr>
<tr id="s4" style="display:none">
	<td><input type="text" name="address" placeholder="Address"></td>
	<td><input type="text" name="province" placeholder="Province"></td>
</tr>
<tr>
	<td colspan=2>
		&nbsp;&nbsp;<input type="submit" value="Search" class="btn btn-primary">&nbsp;&nbsp;<input type="button" value="Clear" class="btn btn-warning" onclick="document.location.href='searchcontacts'">
	</td>
</tr>
</table>
</form>


<table class="table">
<tr>
	<td><b>Name</b></td>
	<td><b>City</b></td>
	<td><b>State/Province</b></td>
	<td><b>Country</b></td>
</tr>

{$list}

</table>

