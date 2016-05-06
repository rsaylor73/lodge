<div class="col-md-6">
<h2>Assign Contact : {$reservationID}</h2>

<form name="myform">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="bed" value="{$bed}">
<input type="hidden" name="roomID" value="{$roomID}">
<input type="hidden" name="action" value="{$action}">
<table class="table">

<tr>
	<td width="150"><b>First Name:</b></td><td><input type="text" name="first" size="40" onkeypress="if(event.keyCode==13) { lookup_contact(this.form); return false;}"></td>
</tr>
<tr>
	<td width="150"><b>Last Name:</b></td><td><input type="text" name="last" size="40" onkeypress="if(event.keyCode==13) { lookup_contact(this.form); return false;}"></td>
</tr>
<tr>
	<td width="150"><b>Email:</b></td><td><input type="text" name="email" size="40" onkeypress="if(event.keyCode==13) { lookup_contact(this.form); return false;}"></td>
</tr>
<tr>
	<td width="150"><b>Contact ID</b></td><td><input type="text" name="resellerID" size="40" onkeypress="if(event.keyCode==13) { lookup_contact(this.form); return false;}"></td>
</tr>

<tr><td colspan="2"><input type="button" value="Search" class="btn btn-primary" onclick="lookup_contact(this.form)">&nbsp;&nbsp;

{if $action eq "reservation"}

<input type="button" value="New Contact" class="btn btn-success" 
onclick="window.open('newcontact/{$reservationID}/reservation');document.getElementById('message').style.display='inline';"> 

{else}

<input type="button" value="New Contact" class="btn btn-success" 
onclick="window.open('newcontact/{$reservationID}/{$bed}/{$roomID}');document.getElementById('message').style.display='inline';"> 

{/if}

<div id="message" style="display:none"><br><i>You can search for your new contact after you add them.</i></div></td></tr>
</table>

	<div id="displayresults">

	</div>

</form>

<script>

function lookup_contact(myform) {
	$.get('ajax/lookup_contact.php',
	$(myform).serialize(),
	function(php_msg) {
		$("#displayresults").html(php_msg);
	});
}

</script>

</div>