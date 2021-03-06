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
		<a href="javascript:void(0)" onclick="window.frames['hidden_save'].location.href='printinvoice/{$reservationID}';" ><i class="fa fa-print"></i></a>&nbsp;
		<a href="javascript:void(0)" onclick="window.frames['hidden_save'].location.href='emailinvoice/{$reservationID}';" ><i class="fa fa-envelope-o"></i></a>&nbsp;
		<a href="invoice/{$reservationID}" target="_blank"><i class="fa fa-eye"></i></a>
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

{if $resellerID ne ""}
	{if $contactID eq ""}
<tr>
	<td colspan=3>
		<form action="assigncontacttoreservation/{$reservationID}" method="get">
		<input type="submit" value="Assign Contact" class="btn btn-warning">
		</form>
	</td></tr>

{else}
<tr><td colspan="2"><b>Contact</b></td><td><b>Email</b></td></tr>
<tr><td colspan="2"><a href="editcontact/{$contactID}" target=_blank>{$first} {$last}</a></td><td><a href="mailto:{$email}">{$email}</a></td></tr>
<tr><td colspan="3">
		<form action="assigncontacttoreservation/{$reservationID}" method="get">
		<input type="submit" value="Change Contact" class="btn btn-warning">
		</form>
	</td></tr>
	{/if}
{/if}


{if $resellerID eq ""}
<tr>
	<td colspan=3>
		<form action="assignreseller/{$reservationID}" method="get">
		<input type="submit" value="Assign Reseller" class="btn btn-warning">
		</form>
	</td></tr>
{else}
<tr><td><b>Reseller</b></td><td><b>Agent</b></td><td><b>Commission</b></td></tr>
<tr><td>{$company}</td><td><a href="mailto:{$email}?subject=Aggressor Lodge reservation {$reservationID}">{$r_first} {$r_last}</a></td><td>{$commission} %</td></tr>
<tr><td colspan="3">
		<form action="assignreseller/{$reservationID}" method="get">
		<input type="submit" value="Change Agent" class="btn btn-warning">
		</form>
	</td></tr>
{/if}

</table>

<iframe name="hidden_save" width="0" height="0" frameborder="0"></iframe>

