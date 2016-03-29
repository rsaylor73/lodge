<div class="col-md-6">
<h2>Assign Contact</h2>

<font color="green">The contact was added to reservation {$reservationID}. Loading please wait...<br><br></font>
If the page does not load please click <a href="reservation_dashboard/{$reservationID}/guests">here</a>

<script>
   setTimeout(function() {
		window.location.replace('reservation_dashboard/{$reservationID}/guests')
	}
   ,2000);

</script>

</div>