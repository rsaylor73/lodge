<div class="col-md-6">
<h2>Line Items</h2>

<input type="button" value="Add Line Item" class="btn btn-success" onclick="document.location.href='newlineitem'">

{$msg}
<h2>Existing Line Items</h2><hr>
<table class="table">
<thead>
<tr><th><b>Title</b></th><th><b>Price</b></th><th><b>Manage</b></th></tr>
</thead>
<tbody>
	{$html}
</tbody>
</table>

</div>