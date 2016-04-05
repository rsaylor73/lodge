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
<input type="hidden" name="how" value="booker">
<table class="table">
	<tr><td>
		<table class="table">
			{$msg}
			<tr><td width="200"><b>Booker Name:</b></td><td><input type="text" name="booker" required></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" value="Search" class="btn btn-primary"></td></tr>
		</table>
	</td></tr>
</table>
</form>

<form action="reservation_lookup" method="post">
<input type="hidden" name="how" value="reseller_agent">
<table class="table">
	<tr><td>
		<table class="table">
			{$msg}
			<tr><td width="200"><b>Reseller Agent Name:</b></td><td><input type="text" name="reseller_agent" required></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" value="Search" class="btn btn-primary"></td></tr>
		</table>
	</td></tr>
</table>
</form>

</div>
