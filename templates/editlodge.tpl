<div class="col-md-6">
<h2><a href="lodge">Lodge</a> : Edit Lodge</h2>

<form action="updatelodge" method="post">
<input type="hidden" name="id" value="{$id}">

<table class="table">
	<tr><td>Lodge Name:</td><td><input type="text" name="name" value="{$name}" size=40 required></td></tr>
	<tr><td>Minimum Nights Stay:</td><td><select name="min_night_stay">
		<option value="{$min_night_stay}" selected>{$min_night_stay} (Default)</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
		</select></td></tr>
	<tr><td>Notification Email Address:</td><td><input type="text" name="agent_email" value="{$agent_email}" size=40 required></td></tr>
	<tr><td>Inventory Start Date:</td><td><input type="text" name="inventory_start_date" id="start_date" value="{$inventory_start_date}" size=40 required></td></tr>
	<tr><td>Auto Inventory:</td><td><input data-toggle="toggle" name="auto_inventory" type="checkbox" value="On" {if $auto_inventory eq "On"}checked{/if}> <i>* If off the inventory will not create.</i></td></tr>
	<tr><td>Active?</td><td><input type="checkbox" data-toggle="toggle" name="active" value="Yes" {if $active eq "Yes"}checked{/if}></td></tr>
</table>

{literal}
<input type="submit" value="Update" class="btn btn-primary"> <input type="button" value="Manage Rooms" class="btn btn-warning" onclick="
	if(
		confirm('If you have make any changes click Update then come back to manage rooms.')) {
			document.location.href='managerooms/{/literal}{$id}{literal}';
		}
	">
{/literal}
		
	

</form>


</div>

