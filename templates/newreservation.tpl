<div class="col-md-6">
<h2><a href="lodge">New Reservation</a></h2>
{$msg}

<form method="post" action="searchinventory">
<table class="table">
<tr><td>Select Lodge:</td><td><select name="lodge" required>{$lodge}</select></td></tr>
<tr><td>Adults:</td><td><select name="pax" required><option selected value="">Select</option>{$pax}</select></td></tr>
<tr><td>Children:</td><td><select name="children"><option selected value="">Select</option><option>0</option><option>1</option><option>2</option><option>3</option></td></tr>
<tr><td>Number of Nights:</td><td><select name="nights"><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option></select></td></tr>
<tr><td>Start Date:</td><td><input type="text" name="start_date" id="start_date" value="{$start_date}" required></td></tr>
<tr><td>End Date:</td><td><input type="text" name="end_date" id="end_date" value="{$end_date}" required></td></tr>
<tr><td colspan=2><input type="submit" value="Search Rooms" class="btn btn-primary"></td></tr>
</table>

</form>


</div>

