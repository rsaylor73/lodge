<br>
<h3>Notes</h3>

<form action="savenewnote" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="type" value="reservation">
<table class="table">
<tr><td>New Note:</td></tr>
<tr><td><textarea name="note" cols="40" rows="5"></textarea></td></tr>
<tr><td><input type="submit" value="Save" class="btn btn-primary"></td></tr>
</table>
</form>

{$notes_data}
