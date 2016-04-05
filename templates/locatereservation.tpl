<div class="col-md-6">
<h2>Locate Reservation</h2>
<br>

<form action="reservation_dashboard" method="post">
<table class="table">
	<tr><td>
		<table class="table">
			{$msg}
			<tr><td width="200"><b>Reservation ID:</b></td><td><input type="text" name="reservationID" required></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" value="Search" class="btn btn-primary"></td></tr>
		</table>
	</td></tr>
</table>
</form>

<form action="reservation_lookup" method="post">
<input type="hidden" name="how" value="guest">
<table class="table">
	<tr><td>
		<table class="table">
			{$msg}
			<tr><td width="200"><b>Guest Name:</b></td><td><input type="text" name="guest" required></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" value="Search" class="btn btn-primary"></td></tr>
		</table>
	</td></tr>
</table>
</form>

<form action="reservation_lookup" method="post">
<input type="hidden" name="how" value="company">
<table class="table">
	<tr><td>
		<table class="table">
			{$msg}
			<tr><td width="200"><b>Reseller Company Name:</b></td><td><input type="text" name="company" required></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" value="Search" class="btn btn-primary"></td></tr>
		</table>
	</td></tr>
</table>
</form>

</div>
