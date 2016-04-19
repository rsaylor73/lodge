<br>
<h3>Cancel</h3>



<form action="cxl_reservation" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">
<input type="hidden" name="tent" value="ALL">
Cancellation Reason:<br><textarea name="reason" cols=20 rows=5></textarea><br>
<input type="submit" value="Cancel Reservation" class="btn btn-primary">
</form>