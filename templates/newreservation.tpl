<div class="col-md-6">
<h2><a href="lodge">New Reservation</a></h2>
{$msg}

<!--<form method="post" action="searchinventory" name="myform">-->
<form method="post" action="viewtent" name="myform">
<table class="table">
<tr><td width="200">Select Lodge:</td><td colspan="3"><select name="lodge" id="lodge" required onchange="get_min_pax(this.form);turnon();">{$lodge}</select></td></tr>
<tr><td>Adults:</td><td colspan="3"><select name="pax" id="pax" required onchange="get_min_tent(this.form);show_children();">{$pax}</select> <div id="min_pax" style="display:inline"></div></td></tr>
<tr id="child0"><td>Children:</td><td><select name="children" id="children" onchange="do_child()"><option>0</option><option>1</option><option>2</option>{if $post_children ne ""}<option selected>{$post_children}</option></select>{/if}</td></tr>
<tr><td></td>
	<td id="child1" style="display:none">
		<select name="childage1" id="childage1">
		<option value="">Child 1 Age?</option>
		<option value="1">0 - 6</option>
		<option value="2">7 - 15</option>
		<option value="3">16+</option>
		</select>
	</td>

	<td id="child2" style="display:none">
		<select name="childage2" id="childage2">
		<option value="">Child 2 Age?</option>
		<option value="1">0 - 6</option>
		<option value="2">7 - 15</option>
		<option value="3">16+</option>
		</select>
	</td>
</tr>

<tr><td>Number of Tents:</td><td colspan="3">

	<input type="hidden" name="tents" id="tents" 
	{if $post_tents ne ""} value="{$post_tents}" {else} value="1" {/if}>



	<select name="tents2" id="tents2" disabled onchange="swap()">
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
	</select> <input type="checkbox" name="or" onclick="document.getElementById('tents2').disabled=false"> Override </td></tr>
<tr><td>Number of Nights:</td><td colspan="3"><select name="nights"><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option>
	{if $post_nights ne ""}<option selected>{$post_nights}</option>{/if}</select></td></tr>

<tr><td>Type:</td><td><select name="type"><option value="">Any</option>{$type}</select> <font color=blue><br>Children are welcome in the Family class tents</font></td></tr>
<tr><td>Check-In Date:</td><td colspan="3"><input type="text" name="start_date" id="start_date" value="{$post_start_date}" required onchange="quick_look(this.form)"> <input type="button" value="test" onclick="quick_look(this.form)"></td></tr>
<tr><td colspan=5><input type="submit" value="Search Rooms" class="btn btn-primary">&nbsp;&nbsp;<input type="button" value="Reset" class="btn btn-warning" onclick="document.location.href='newreservation'"></td></tr>
</table>

<div id="quick_look"></div>

<div id="null"></div>

</form>

<script>

function do_child() {
	var e = document.getElementById("children");
	var strChild = e.options[e.selectedIndex].value;
	if (strChild == "1") {
		document.getElementById('child1').style.display='inline';
		document.getElementById('childage1').required=true;
		document.getElementById('child2').style.display='none';
		document.getElementById('childage2').required=false;
	}
	if (strChild == "2") {
		document.getElementById('child1').style.display='inline';
		document.getElementById('childage1').required=true;
		document.getElementById('child2').style.display='inline';
		document.getElementById('childage2').required=true;
	}
	if (strChild == "0") {
		document.getElementById('childage1').required=false;
		document.getElementById('childage2').required=false;
		document.getElementById('child1').style.display='none';
		document.getElementById('child2').style.display='none';
	}
}

function turnon() {
	var e = document.getElementById("lodge");
	var strUser = e.options[e.selectedIndex].value;
	if (strUser != "") {
		document.getElementById('pax').disabled=false;
		document.getElementById('children').disabled=false;


	} else {
		document.getElementById('pax').disabled=true;
		document.getElementById('children').disabled=true;
		document.getElementById('pax').value='1';
		document.getElementById('children').value='0';
	}
}

function swap() {
	var t = document.getElementById("tents2");
	var strTent = t.options[t.selectedIndex].value;
	document.getElementById('tents').value = strTent;
	//strTent.value = document.getElementById('tents').value;
}

function show_children() {
	var p = 2;
	var k = document.getElementById('pax');
	var strKids = k.options[k.selectedIndex].value;
	if (strKids > p) {
		document.getElementById('child0').style.display='none';
		document.getElementById('children').value = 0;
	} else {
		document.getElementById('child0').style.display='table-row';
	}
}

function quick_look(myform) {
	$.get('ajax/quick_look.php',
	$(myform).serialize(),
	function(php_msg) {
	$("#quick_look").html(php_msg);
	});
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

