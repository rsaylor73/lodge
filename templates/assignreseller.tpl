<div class="col-md-6">
<h2>Assign Reseller : {$reservationID}</h2>

<form name="myform">
<input type="hidden" name="reservationID" value="{$reservationID}">
<table class="table">
<tr>
	<td width="150"><b>Reseller ID</b></td><td><input type="text" name="resellerID" size="40" onkeypress="if(event.keyCode==13) { lookup_reseller(this.form); return false;}"></td>
</tr>
<tr>
	<td width="150"><b>Company:</b></td><td><input type="text" name="company" size="40" onkeypress="if(event.keyCode==13) { lookup_reseller(this.form); return false;}"></td>
</tr>

<tr>
	<td width="150"><b>City:</b></td><td><input type="text" name="city" size="40" onkeypress="if(event.keyCode==13) { lookup_reseller(this.form); return false;}"></td>
</tr>

<tr>
        <td width="150"><b>Email:</b></td><td><input type="text" name="email" size="40" onkeypress="if(event.keyCode==13) { lookup_reseller(this.form); return false;}"></td>
</tr>

<tr>
        <td width="150"><b>Country:</b></td><td><input type="text" name="country" size="40" onkeypress="if(event.keyCode==13) { lookup_reseller(this.form); return false;}"></td>
</tr>




<tr><td colspan="2"><input type="button" value="Search" class="btn btn-primary" onclick="lookup_reseller(this.form)"></td></tr>
</table>

	<div id="displayresults">

	</div>

</form>

<script>

function lookup_reseller(myform) {
	$.get('ajax/lookup_reseller.php',
	$(myform).serialize(),
	function(php_msg) {
		$("#displayresults").html(php_msg);
	});
}

</script>

</div>
