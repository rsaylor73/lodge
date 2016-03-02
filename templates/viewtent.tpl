<div class="col-md-6">
<h2>View Tent ({$c_date})</h2>

<form action="searchinventory" method="post">
<input type="hidden" name="lodge" value="{$lodge}">
<input type="hidden" name="pax" value="{$pax}">
<input type="hidden" name="start_date" value="{$start_date}">
<input type="hidden" name="end_date" value="{$end_date}">
<input type="submit" value="Back To Search Results" class="btn btn-success">
</form>
<br>

<form action="togglebeds" method="post">
<input type="hidden" name="lodge" value="{$lodge}">
<input type="hidden" name="pax" value="{$pax}">
<input type="hidden" name="start_date" value="{$start_date}">
<input type="hidden" name="end_date" value="{$end_date}">

<input type="button" value="Assign Guests and return to Calendar View" class="btn btn-primary">
<table class="table">

<tr>
	<td><i class="fa fa-calendar"></i> {$p_date}</td>
	<td><i class="fa fa-calendar"></i> {$c_date}</td>
	<td><i class="fa fa-calendar"></i> {$n_date}</td>
</tr>

<tr>
	<td>
		<table class="table">{$p_html}</table>
	</td>
	<td>
		<table class="table">{$c_html}</table>
	</td>
	<td>
		<table class="table">{$n_html}</table>
	</td>
</tr>
</table>

</form>

</div>

