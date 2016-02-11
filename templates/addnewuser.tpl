<div class="col-md-6">
<h2>New User</h2>
<form name="myform">

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">User: </span>
  <input type="text" name="uuname" required class="form-control" placeholder="Username" aria-describedby="sizing-addon1" onblur='check_user(this.form)'> <div id="check_user"></div>
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Password: </span>
  <input type="text" name="uupass" required class="form-control" placeholder="Password" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">First Name: </span>
  <input type="text" name="first" required class="form-control" placeholder="First Name" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Last Name: </span>
  <input type="text" name="last" required class="form-control" placeholder="Last Name" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Email: </span>
  <input type="text" name="email" required class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
</div>

<div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1" style="width:125px;">Access: </span>
  <select name="userType" required class="form-control" required aria-describedby="sizing-addon1">
		<option value="">Select</option>
		<option value="agent">Agent</option>
		<option value="accounting">Accounting</option>
		<option value="crew">Crew</option>
		<option value="owner">Owner</option>
		<option value="admin">Admin</option>
	</select>
		
</div>

<div class="input-group input-group-lg">
	<input type="submit" value="Add User" class="btn btn-primary">
</div>


</form>

<script>
function check_user(myform) {
	$.get('ajax/check_user.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#check_user").html(php_msg);
	});
}
</script>

</div>


