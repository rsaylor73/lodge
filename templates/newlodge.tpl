<div class="col-md-6">
<h2>New Lodge</h2>

<form action="savelodge" method="post">

<table class="table">
	<tr><td>Lodge Name:</td><td><input type="text" name="name" size=40 required></td></tr>
	<tr><td>Minimum Nights Stay:</td><td><select name="min_night_stay">
		<option value="1">1</option>
		<option selected value="2">2 (Default)</option>
		<option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
		</select></td></tr>
	<tr><td>Notification Email Address:</td><td><input type="text" name="agent_email" size=40 required></td></tr>
</table>
<input type="submit" value="Save" class="btn btn-primary">

		
	

</form>


</div>

