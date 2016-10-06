<div style="text-align:center;">
<h2>Login</h2>
{$msg}
<form name="myform">
<table class="table" width=500 align="center">
	<tr>
		<td><b>Username:</b><br><input type="text" name="uuname" placeholder="User Name" size=20 required></td>
	</tr>
	<tr>
		<td><b>Password:</b><br><input type="password" name="uupass" placeholder="Password" size=20 required onkeypress="if(event.keyCode==13) { loginfrm(this.form); return false;}"></td>
	</tr>
	<tr>
		<td><center><input type="button" name="login" value="Login" class="btn btn-primary" onclick="loginfrm(this.form)">&nbsp;&nbsp;
		<input type="button" name="forgot" value="Forgot Password" class="btn btn-warning" onclick="document.location.href='forgot_password'">
		</center></td>
	</tr>
</table>
</form>
</div>

<script>
function loginfrm(myform) {
	$.get('ajax/login.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#main_element").html(php_msg);
	});
}
</script>
