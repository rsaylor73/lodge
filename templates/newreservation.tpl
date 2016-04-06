<div class="col-md-6">
<h2><a href="lodge">New Reservation</a></h2>
{$msg}

<!--<form method="post" action="searchinventory" name="myform">-->
<form method="post" action="viewtent" name="myform">
<table class="table">
<tr><td>Select Lodge:</td><td><select name="lodge" id="lodge" required onchange="get_min_pax(this.form);turnon();">{$lodge}</select></td></tr>
<tr><td>Adults:</td><td><select name="pax" id="pax" required onchange="get_min_tent(this.form)" disabled>{$pax}</select></td></tr>
<tr><td>Children:</td><td><select name="children"><option>0</option><option>1</option><option>2</option><option>3</option>{if $post_children ne ""}<option selected>{$post_children}</option>{/if}</td></tr>
<tr><td>Number of Tents:</td><td>

<input type="hidden" name="tents" id="tents" 
	{if $post_tents ne ""} value="{$post_tents}" {else} value="1" {/if}>
<select name="tents2" id="tents2" disabled>
	<option selected>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>
	<option>5</option>
	<option>6</option>
	<option>7</option>
	<option>8</option>
	<option>9</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	{if $post_tents ne ""}
		<option selected>{$post_tents}</option>
	{/if}
	</select> <div id="min_pax" style="display:inline"></div></td></tr>
<tr><td>Number of Nights:</td><td><select name="nights"><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option>
	{if $post_nights ne ""}<option selected>{$post_nights}</option>{/if}</select></td></tr>
<tr><td>Start Date:</td><td><input type="text" name="start_date" id="start_date" value="{$post_start_date}" required></td></tr>
<tr><td colspan=2><input type="submit" value="Search Rooms" class="btn btn-primary"></td></tr>
</table>

<div id="null"></div>

</form>

<script>

function turnon() {
	var e = document.getElementById("lodge");
	var strUser = e.options[e.selectedIndex].value;
	alert(strUser);
	document.getElementById('pax').disabled=false;
}

function get_min_pax(myform) {
	$.get('ajax/get_min_pax.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#min_pax").html(php_msg);
	});
}

function get_min_tent(myform) {
	$.get('ajax/set_min_tents.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#null").html(php_msg);
	});
}
</script>

</div>

