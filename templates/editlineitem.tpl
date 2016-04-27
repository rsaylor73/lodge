<div class="col-md-6">
<h2>Edit Line Items</h2>

<form action="updatelineitem" method="post">
<input type="hidden" name="id" value="{$id}">
<table class="table">
<tr><td>Title:</td><td><input type="text" name="title" value="{$title}" size="20" required></td></tr>
<tr><td>Description:</td><td><textarea name="description" value="{$description}" cols="20" rows="5" required></textarea></td></tr>
<tr><td>Price:</td><td>$<input type="text" name="price" value="{$price}" size="20" required></td></tr>
<tr><td colspan="2"><input type="submit" value="Update" class="btn btn-primary"></td></tr>
</table>
</form>

</div>