<div style="text-align:center;">
<h2>Forgot Password</h2>
{$msg}
<form name="myform">
<table class="table" width=500 align="center">
	<tr><td>Type in your email address below and the system will send you your password.</td></tr>
	<tr>
		<td><b>Email:</b><br><input type="text" name="email" placeholder="User Email" size=20 required></td>
	</tr>
	<tr>
		<td><center><input type="button" name="login" value="Send Password" class="btn btn-primary" onclick="loginfrm(this.form)"></center></td>
	</tr>
</table>
</form>
</div>

<script>
function loginfrm(myform) {
	$.get('ajax/forgot_password.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#main_element").html(php_msg);
	});
}
</script>
