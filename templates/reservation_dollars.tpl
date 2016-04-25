<br>
<h3>Nightly Rate</h3>
<hr>

<table class="table">
<tr><td>Tent Nightly Rate (Adults):</td><td>${$nightly_rate}</td></tr>

{if $child1_rate ne ""}
<tr><td>Child 1 Nightly Rate ({$child1_age})</td><td>${$child1_rate}</td></tr>
{/if}

{if $child2_rate ne ""}
<tr><td>Child 2 Nightly Rate ({$child2_age})</td><td>${$child2_rate}</td></tr>
{/if}

<tr><td>Number of Nights:</td><td>{$nights}</td></tr>
<tr><td>Number of Tents:</td><td>{$tents}</td></tr>
<tr><td>Total Reservation:</td><td>${$total}</td></tr>
</table>

<h3>Transfer/Line Item Dollars</h3>
<hr>

<h3>Discounts</h3><hr>
<input type="button" value="Add Discount" class="btn btn-success" onclick="document.location.href='discounts/{$reservationID}'"></h3>


<h3>Payments</h3><hr>
<input type="button" value="Make A Payment" class="btn btn-success" onclick="document.location.href='payments/{$reservationID}'"></h3>

<table class="table">
<thead>
<tr>
	<th><b>Payment Type</b></th>
	<th><b>Amount</b></th>
	<th><b>Date</b></th>
	<th><b>Transaction ID</b></th>
</tr>
</thead>
<tbody>
	{if $payment_history == ""}
	<tr><td colspan="4"><font color=blue>Payment history does not exist for this reservation.</font></td></tr>
	{else}
	{$payment_history}
	{/if}
</tbody>
</table>

