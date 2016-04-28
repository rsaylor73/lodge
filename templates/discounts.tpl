<div class="col-md-6">
<h2>Discounts</h2>

<input type="button" value="Add Discount" class="btn btn-success" onclick="document.location.href='newdiscount'">

{$msg}
<h2>Existing Discounts</h2><hr>
<table class="table">
<thead>
<tr><th><b>Title</b></th><th><b>Active</b></th><th><b>Manage</b></th></tr>
</thead>
<tbody>
	{$html}
</tbody>
</table>

</div>