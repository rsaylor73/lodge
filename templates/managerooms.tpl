<div class="col-md-6">
<h2><a href="lodge">Manage Lodge</a> : <a href="editlodge/{$id}">{$name}</a> : Rooms</h2>
<input type="button" value="Add New Room Type" class="btn btn-success" onclick="document.location.href='newroom/{$id}'">
{$msg}

<table class="table">
<tr>
	<td><b>Room</b></td>
	<td><b># Beds</b></td>
	<td><b>Min Pax</b></td>
	<td><b>Nightly Rate</b></td>
	<td>&nbsp;</td>
</tr>

{$output}

</table>

</div>
