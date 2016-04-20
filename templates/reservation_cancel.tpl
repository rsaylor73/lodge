<br>
<h3>Cancel</h3>


{if $cancelled eq "No"}
<form action="cxl_reservation" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="tent" value="ALL">
Cancellation Reason:<br><textarea name="reason" cols=40 rows=5 required placeholder="Please type in the reason why the reservation is being cancelled."></textarea><br><br>
<input type="submit" value="Cancel Reservation" onclick="return confirm('You are about to cancel this reservation and will release all the tents in this reservation back to inventory. Click OK to continue.')" class="btn btn-primary">
</form>
{/if}


{if $cancelled eq "Yes"}
<table class="table">
<tr><td>Cancellation Date:</td><td>{$cxl_date}</td></tr>
<tr><td>Cancellation User:</td><td><a href="mailto:{$email}">{$first} {$last}</a></td></tr>
</table>


{/if}