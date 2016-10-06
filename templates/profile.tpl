<div class="col-md-6">
<h2>Profile</h2>

{$msg}

<form action="saveprofile" method="post">
<table class="table">
<tr><td>First Name:</td><td><input type="text" name="first" value="{$first}" size="40"></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="last" value="{$last}" size="40"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" value="{$email}" size="40"></td></tr>
<tr><td>Username:</td><td>{$uuname}</td></tr>
<tr><td>User Type:</td><td>{$userType}</td></tr>
<tr><td>Password:</td><td><input type="password" name="uupass" placeholder="****************" size="40"></td></tr>
<tr><td colspan="2"><input type="button" value="Cancel" class="btn btn-warning" onclick="document.location.href='dashboard'">&nbsp;&nbsp;
	<input type="submit" value="Update Profile" class="btn btn-primary"></td></tr>
</table>
</form>


</div>
