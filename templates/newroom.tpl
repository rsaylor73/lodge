<div class="col-md-6">
<h2>{$name} : Rooms</h2>

<form action="saveroom">
<input type="hidden" name="id" value="{$id}">

<table class="table">
<tr><td>Room Description:</td><td><input type="text" name="description" id="description" size=30></td></tr>
<tr><td>Minimum PAX:</td><td><select name="min_pax"><option selected>1</option><option>2</option><option>3</option><option>4</option></select></td></tr>
<tr><td>Nightly Rate:</td><td><input type="text" name="nightly_rate" size=30></td></tr>
<tr><td colspan=2><input type="submit" value="Save" class="btn btn-primary"></td></tr>
</table>

</form>

</div>
