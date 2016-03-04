<div class="col-md-6">
<h2><a href="lodge">New Reservation</a><br>{$name}</h2>
<b>Minimum night stay per person: {$min_night_stay} nights.</b><br>
{if $reservationID ne ''}
<form action="completereservation" method="post"><input type="submit" value="Complete Reservation" class="btn btn-success"></form>
{/if}
<br>
