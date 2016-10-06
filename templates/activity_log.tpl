<div class="col-md-6">
<h2>Activity Log</h2>
<form name="myform" action="showactivitylog" method="post">

<table class="table">
	<tr><td>Select User</td><td><select name="users"><option selected value="">Any</option>{$users}</select></td></tr>
	<tr><td>Select Module</td><td><select name="modules"><option selected value="">Any</option>{$modules}</select></td></tr>
	<tr><td colspan=2><input type="submit" value="View" class="btn btn-primary"></td></tr>
</table>

</form>
</div>
