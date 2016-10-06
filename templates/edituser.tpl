<div class="col-md-6">
<h2><a href="users">Users</a> : Edit User</h2>
<form name="myform" action="updateuser" method="post">
<input type="hidden" name="id" value="{$id}">

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">User: </span>
  <input type="text" value="{$uuname}" disabled class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">First Name: </span>
  <input type="text" name="first" value="{$first}" required class="form-control" placeholder="First Name" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Last Name: </span>
  <input type="text" name="last" value="{$last}" required class="form-control" placeholder="Last Name" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Email: </span>
  <input type="text" name="email" value="{$email}" required class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Access: </span>
  <select name="userType" required class="form-control" required aria-describedby="sizing-addon1">
		<option selected>{$userType}</option>
		<option value="agent">Agent</option>
		<option value="accounting">Accounting</option>
		<option value="crew">Crew</option>
		<option value="owner">Owner</option>
		<option value="admin">Admin</option>
	</select>
		
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Active: </span>
  <select name="active" required class="form-control" required aria-describedby="sizing-addon1">
      <option selected>{$active}</option>
		<option>Yes</option>
		<option>No</option>
   </select>

</div>


<div class="input-group input-group-lg" id="submit">
	<input type="submit" value="Update User" class="btn btn-primary">
</div>


</form>


</div>


