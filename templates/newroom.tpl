<div class="col-md-6">
<h2>{$name} : Rooms</h2>

<form action="saveroom" method="post">
<input type="hidden" name="id" value="{$id}">

<table class="table">
<tr><td>Room Title:</td><td><input type="text" name="description" id="description" size=30></td></tr>
<tr><td>Room Description:</td><td><textarea name="writeup" cols="29" rows="5" required>{$writeup}</textarea></td></tr>
<tr><td>Room Type:</td><td><select name="type" required>{$opt}</select></td></tr>
<tr><td>Number of Adult Beds:</td><td><select name="beds"><option>1</option><option selected>2</option><option>3</option><option>4</option></select> (The number of adult beds in this room)</td></tr>
<tr><td>Number of Child Beds:</td><td><select name="children"><option selected>0</option><option>1</option><option>2</option></select> (The number of child beds in this room)</td></tr>
<tr><td>Nightly Rate:</td><td>$<input type="text" name="nightly_rate" size=20> USD</td></tr>
<tr><td colspan=2><input type="submit" value="Save" class="btn btn-primary"></td></tr>
</table>

</form>

</div>
