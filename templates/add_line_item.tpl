<div class="col-md-6">
<h2><input type="button" value="&lt;&lt; Back" onclick="javascript:window.history.back()"> Add Line Item / Transfer</h2>

<form action="savelineitemtoguest" method="post">
<input type="hidden" name="reservationID" value="{$reservationID}">

<table class="table">
<tr><td><b>Select Guest:</b></td><td><select name="contactID" required>{$options}</select></td></tr>
<tr><td><b>Select Line Item:</b></td><td><select name="line_item" required>{$line_items}</select></td></tr>

<tr><td colspan="2"><input type="submit" value="Add Line Item" class="btn btn-primary"></td></tr>
</table>


</form>


</div>