<h2>Login</h2>

<form name="myform">
<table class="table" width=500>
	<tr>
		<td><b>Username:</b><br><input type="text" name="Luuname" placeholder="User Name" size=20 required></td>
	</tr>
	<tr>
		<td><b>Password:</b><br><input type="password" name="Luupass" placeholder="Password" size=20 required></td>
	</tr>
	<tr>
		<td><center><input type="button" name="login" value="Login" class="btn btn-primary" onclick="login(this.form)"></center></td>
	</tr>
</table>
</form>

<script>
function login(myform) {
	$.get('ajax/login.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#main_element").html(php_msg);
	});
}
</script>
