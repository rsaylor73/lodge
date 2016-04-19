<div class="col-md-6">
<h2>Reservation {$reservationID} {$cancelled}</h2>
<br>

<ul class="nav nav-tabs">
  <li {if $part eq "details"}	class="active"	{/if}><a href="reservation_dashboard/{$reservationID}/details">Details</a></li>
  <li {if $part eq "guests"}	class="active"	{/if}><a href="reservation_dashboard/{$reservationID}/guests">Guests</a></li>
  <li {if $part eq "dollars"}	class="active"	{/if}><a href="reservation_dashboard/{$reservationID}/dollars">Dollars</a></li>
  <li	{if $part eq "notes"}	class="active"	{/if}><a href="reservation_dashboard/{$reservationID}/notes">Notes</a></li>
  <li	{if $part eq "cancel"}	class="active"	{/if}><a href="reservation_dashboard/{$reservationID}/cancel">Cancel</a></li>
</ul>


{if $part eq "details"}
	{include "reservation_details.tpl"}
{/if}

{if $part eq "guests"}
   {include "reservation_guests.tpl"}
{/if}

{if $part eq "dollars"}
   {include "reservation_dollars.tpl"}
{/if}

{if $part eq "notes"}
   {include "reservation_notes.tpl"}
{/if}

{if $part eq "cancel"}
   {include "reservation_cancel.tpl"}
{/if}




</div>
