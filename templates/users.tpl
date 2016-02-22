<div class="col-md-6">
<h2><a href="users">Users</a></h2>
{$msg}
<input type="button" value="Add New User" class="btn btn-success" onclick="document.location.href='addnewuser/'">

<table class="table">
<tr>
	<td><b>Name</b></td>
	<td><b>Access Type</b></td>
	<td><b>Active</b></td>
	<td></td>
</tr>

{if $output ne ""}{$output}{/if}
{if $output eq ""}<tr><td colspan=3>No users found.</td></tr>{/if}

</table>

</div>

