<br>
<h3>Details</h3>

<table class="table">
<tr>
	<td><b>Invoice</b></td>
	<td><b>Booker</b></td>
	<td><b>Date Booked</b></td>
</tr>

<tr>
	<td>
		<i class="fa fa-print"></i>&nbsp;
		<i class="fa fa-envelope-o"></i>&nbsp;
		<i class="fa fa-eye"></i>
	</td>
	<td><a href="mailto:{$t1_email}">{$t1_first} {$t1_last}</a></td>
	<td>{$t1_booked_date}</td>
</tr>

<tr>
	<td><b>Check-In</b></td>
	<td><b>Check-Out</b></td>
	<td><b>Number of Nights</b></td>
</tr>

<tr>
	<td>{$begin_date}</td>
	<td>{$end_date}</td>
	<td>{$nights}</td>
</tr>

{if $resellerID eq ""}
<tr>
	<td colspan=3>
		<form action="assignreseller/{$reservationID}" method="get">
		<input type="submit" value="Assign Reseller" class="btn btn-warning">
		</form>
	</td></tr>
{else}
<tr><td><b>Reseller</b></td><td><b>Agent</b></td><td><b>Commission</b></td></tr>
<tr><td>{$company}</td><td><a href="mailto:{$email}?subject=Aggressor Lodge reservation {$reservationID}">{$first} {$last}</a></td><td>{$commission} %</td></tr>
<tr><td colspan="3">
		<form action="assignreseller/{$reservationID}" method="get">
		<input type="submit" value="Change Agent" class="btn btn-warning">
		</form>
	</td></tr>
{/if}

</table>
