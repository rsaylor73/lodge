<br>


{if $cancelled eq "No"}

	{if $tents > 1}	

	<h3>Cancel A Tent</h3>
	<table class="table">
	{$html}
	</table>

	{/if}

<hr>
<h3>Cancel Entire Reservation</h3>
<form action="cxl_reservation" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="tent" value="ALL">
Cancellation Reason:<br><textarea name="reason" cols="40" rows="5" required placeholder="Please type in the reason why the reservation is being cancelled."></textarea><br><br>
<input type="submit" value="Cancel Reservation" id="cxl" disabled class="btn btn-primary">&nbsp;&nbsp;<input type="checkbox" name="agree" onclick="document.getElementById('cxl').disabled=false;"> <b><i>You are about to cancel this reservation and will release all the tents in this reservation back to inventory. If there are any transfers assigned those will be cancelled.</i></b>
</form>
{/if}


<h3>History</h3>
<table class="table">
<tr><td><b>Date</b></td><td><b>Tent</b></td><td><b>Contact</b></td></tr>
{$history}
</table>

{if $cancelled eq "Yes"}
<table class="table">
<tr><td>Cancellation Date:</td><td>{$cxl_date}</td></tr>
<tr><td>Cancellation User:</td><td><a href="mailto:{$email}">{$first} {$last}</a></td></tr>
</table>


{/if}
