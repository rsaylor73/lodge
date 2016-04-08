<div class="col-md-6">
<h2>Reserve Tent</h2>

<form action="newreservation" method="post">
<input type="hidden" name="lodge" value="{$lodge}">
<input type="hidden" name="pax" value="{$pax}">
<input type="hidden" name="start_date" value="{$start_date}">
<input type="hidden" name="children" value="{$children}">
<input type="hidden" name="tents2" value="{$tents}">
<input type="hidden" name="nights" value="{$nights}">
<input type="hidden" name="type" value="{$type}">
<input type="submit" value="Back To Search Results" class="btn btn-success">
</form>
<br>

<form action="reservenow" method="post">
{$form_html}


<table class="table">
<tr><td><b>Adults</b></td><td>{$adults}</td></tr>
<tr><td><b>Children:</b></td><td>{$children}</td></tr>
<tr><td><b>Nights:</b></td><td>{$nights}</td></tr>
<tr><td><b>Tents:</b></td><td>{$tents}</td></tr>
<tr><td><b>Check-In Date:</b></td><td>{$start_date2}</td></tr>
<tr><td><b>Check-Out Date:</b></td><td>{$end_date2}</td></tr>
</table>

<br><b>Please select {$tents} tents. Click on the toggle button in the select column to pic a tent.</b>
<table class="table">
	<tr>
		<td><b>Tent</b></td><td><b>Total</b></td><td><b>Adult(s)</b></td><td><b>Children</b></td><td><b>Select</b></td>
	</tr>
	{$html}
</table>
{$msg}
{$btn}

<div id="waiting" style="display:inline"><br><b>Please select {$tents} tents. Once you select {$tents} tents this message will be replaced with a reservation button.</b></div>

</form>

<script>
function checkboxes(){
    var inputElems = document.getElementsByTagName("input"),
    count = 0;
    for (var i=0; i<inputElems.length; i++) {
    if (inputElems[i].type === "checkbox" && inputElems[i].checked === true){
        count++;
        //alert(document.querySelectorAll('input[type="checkbox"]:checked').length);
    }
    if (count == "{$tents}") {
    	//alert(document.querySelectorAll('input[type="checkbox"]:checked').length);
    	document.getElementById('booknow').style.display='inline';
	   	document.getElementById('waiting').style.display='none';
    } else {
    	document.getElementById('booknow').style.display='none';
    	document.getElementById('waiting').style.display='inline';
    }
}}
</script>
</div>

