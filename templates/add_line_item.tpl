<div class="col-md-6">
<h2><input type="button" value="&lt;&lt; Back" onclick="document.location.href='reservation_dashboard/{$reservationID}/dollars'"> Add Line Item / Transfer</h2>

<form action="savelineitemtoguest" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">

<table class="table">
<tr><td><b>Select Guest:</b></td><td><select name="contactID" required>{$options}</select></td></tr>
<tr><td><b>Select Line Item:</b></td><td><select name="line_item" required>{$line_items}</select></td></tr>

<tr><td colspan="2"><input type="submit" value="Add Line Item" class="btn btn-primary"></td></tr>
</table>


<table class="table">
<thead>
<tr><th width="33%"><b>Guest</b></th><th width="33%"><b>Title</b></th><th width="33%"><b>Price</b></th></tr>
</thead>
<tbody>
{$html}
</tbody>
</table>


</form>


</div>
