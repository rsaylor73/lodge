<div class="col-md-6">
<h2><a href="lodge">New Reservation</a></h2>
{$msg}

<form method="post" action="searchinventory">
<table class="table">
<tr><td>Select Lodge:</td><td><select name="lodge" required>{$lodge}</select></td></tr>
<tr><td>Passengers:</td><td><select name="pax" required><option selected value=\"\">Select</option>{$pax}</select></td></tr>
<tr><td>Start Date:</td><td><input type="text" name="start_date" id="start_date" value="{$start_date}" required></td></tr>
<tr><td>End Date:</td><td><input type="text" name="end_date" id="end_date" value="{$end_date}" required></td></tr>
<tr><td colspan=2><input type="submit" value="Search Rooms" class="btn btn-primary"></td></tr>
</table>

</form>


</div>

