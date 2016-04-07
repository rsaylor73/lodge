<div class="col-md-6">
<h2>{$name} : Rooms</h2>

<form action="updateroom" method="post">
<input type="hidden" name="id" value="{$id}">
<input type="hidden" name="id2" value="{$id2}">

<table class="table">
<tr><td>Room Title:</td><td><input type="text" name="description" id="description" value="{$description}" size=30></td></tr>
<tr><td>Room Description:</td><td><textarea name="writeup" cols="29" rows="5" required>{$writeup}</textarea></td></tr>
<tr><td>Room Type:</td><td><select name="type" required>{$opt}</select></td></tr>
<tr><td>Number of Adults:</td><td><select name="beds"><option selected>{$beds}</option><option>1</option><option>2</option><option>3</option><option>4</option></select> (The number of adult bed(s) in this room)</td></tr>
<tr><td>Number of Children:</td><td><select name="children"><option selected>{$children}</option><option>0</option><option>1</option><option>2</option></select> (The number of child bed(s) in this room)
<tr><td>Nightly Rate:</td><td>$<input type="text" name="nightly_rate" value="{$nightly_rate}" size=20> USD</td></tr>
<tr><td>Delete Room:</td><td><input type="checkbox" name="delete" value="checked" onchange="return confirm('Deleting this room will not remove existing inventory.')"> Check to delete this room then click <b>Update</b></td></tr>
<tr><td colspan=2><input type="submit" value="Update" class="btn btn-primary"> <i>* Making changes will only affect future inventory</i></td></tr>
</table>

</form>

</div>
