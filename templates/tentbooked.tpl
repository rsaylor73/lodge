<div class="col-md-6">
<h2>Tent Booked</h2>

<form action="searchinventory" method="post">
<input type="hidden" name="lodge" value="{$lodge}">
<input type="hidden" name="pax" value="{$pax}">
<input type="hidden" name="start_date" value="{$start_date}">
<input type="hidden" name="end_date" value="{$end_date}">
<input type="submit" value="Back To Search Results" class="btn btn-success">
</form>
<br>

<br>You have booked {$ok} beds under reservationID <b>{$reservationID}</b>. To add more rooms to this reservation click on the <b>Back To Search Results</b>. If this reservation is complete click <b>Complete Reservation</b> and assign guests.<br><br>

<form action="completereservation" method="post"><input type="submit" value="Complete Reservation" class="btn btn-success"></form>





</div>
