<div class="col-md-6">
<h2>Reserve Tent</h2>

<form action="searchinventory" method="post">
<input type="hidden" name="lodge" value="{$lodge}">
<input type="hidden" name="pax" value="{$pax}">
<input type="hidden" name="start_date" value="{$start_date}">
<input type="hidden" name="end_date" value="{$end_date}">
<input type="submit" value="Back To Search Results" class="btn btn-success">
</form>
<br>

<form action="reservenow" method="post">
{$form_html}


<table class="table">
<tr><td><b>Adults</b></td><td>{$adults}</td></tr>
<tr><td><b>Children:</b></td><td>{$children}</td></tr>
<tr><td><b>Nights:</b></td><td>{$nights}</td></tr>
<tr><td><b>Start Date:</b></td><td>{$start_date2}</td></tr>
<tr><td><b>End Date:</b></td><td>{$end_date2}</td></tr>
</table>


<table class="table">
	<tr>
		<td><b>Tent</b></td><td><b>Total</b></td><td>Adult(s)</td><td>Children</td><td><b>Select</b></td>
	</tr>
	{$html}
</table>
{$msg}
{$btn}
</form>

</div>

