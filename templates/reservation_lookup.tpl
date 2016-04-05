<div class="col-md-6">

{$headline}

<table class="table">
<tr><td><b>Contact</b></td><td><b>Reservation</b></td><td><b>Date Booked</b></td></tr>
{$html}

{if $html eq ""}
<tr><td colspan="3"><font color="blue">Sorry, no results found for {$string}</font></td></tr>
{/if}
</table>

</div>