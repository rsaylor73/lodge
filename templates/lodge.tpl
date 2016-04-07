<div class="col-md-6">
<h2><a href="lodge">Manage Lodge</a></h2>
<input type="button" class="btn btn-success" value="Add Lodge" onclick="document.location.href='addlodge'">&nbsp;
<input type="button" class="btn btn-warning" value="Room Types" onclick="document.location.href='roomtypes'">
{$msg}

<hr><b>Existing Locations</b><br>
<table class="table">
<tr>
	<td><b>Name</b></td><td><b>Active</b></td><td>&nbsp;</td>
</tr>
{$output}
</table>

</div>

