<div class="col-md-6">
<h2>GIS Link</h2>
{$msg}

<form action="processgis" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="contactID" value="{$contactID}">
<input type="hidden" name="bedID" value="{$bedID}">
<table class="table">
	<tr><td colspan="2">Send GIS Link for Confirmation Number <b>{$reservationID}</b></td></tr>
	<tr><td><input type="radio" name="sendto" value="guest" checked></td><td>{$first} {$last} ({$email})</td></tr>
	<!--<tr><td><input type="radio" name="sendto" value="all"></td><td>All guests</td></tr>-->
	<tr><td colspan="2"><input type="submit" class="btn btn-success" value="Send GIS Link">&nbsp;&nbsp;
		<input type="button" value="Cancel" class="btn btn-warning" onclick="document.location.href='reservation_dashboard/{$reservationID}/guests'">
	</td></tr>
</table>
</form>
</div>
