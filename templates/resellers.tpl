<div class="col-md-6">
<h2>Resellers</h2>
<input type="button" value="New Reseller" class="btn btn-success" onclick="document.location.href='newreseller'"><br>
{$msg}


<br>

<form action="resellers" method="post">
<table class="table">
<tr>
	<td><input type="text" name="first" placeholder="First Name" size=20></td>
	<td><input type="text" name="last" placeholder="Last Name" size=20></td>
</tr>
<tr id="s1">
	<td><input type="text" name="phone" placeholder="Phone" size=20></td>
	<td><input type="text" name="zip" placeholder="Zip" size=20></td>
</tr>
<tr id="s2">
	<td><input type="text" name="email" placeholder="Email" size=20></td>
	<td><select name="country" style="width:200px">{$country}</select></td>
</tr>
<tr id="s3">
	<td><input type="text" name="resellerID" placeholder="Reseller ID"></td>
	<td><input type="text" name="city" placeholder="City"></td>
</tr>
<tr id="s4">
	<td><input type="text" name="address" placeholder="Address"></td>
	<td><input type="text" name="company" placeholder="Company"></td>
</tr>
<tr>
	<td colspan=2>
		&nbsp;&nbsp;<input type="submit" value="Search" class="btn btn-primary">&nbsp;&nbsp;<input type="button" value="Clear" class="btn btn-warning" onclick="document.location.href='resellers'">
	</td>
</tr>
</table>
</form>


<table class="table">
<tr>
	<td><b>Company</b></td>
	<td><b>Name</b></td>
	<td><b>City</b></td>
	<td><b>Country</b></td>
</tr>

{$list}

</table>

