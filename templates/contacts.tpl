<div class="col-md-6">
<h2>Contacts</h2>
<input type="button" value="New Contact" class="btn btn-success" onclick="document.location.href='newcontact'"><br>
{$msg}


<br>

<form action="searchcontacts" method="post">
<div class="form-group">
  <label class="control-label sr-only" for="inputGroupSuccess4">Input group with success</label>
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-search"></i></span>
    <input type="text" name="search_string" class="form-control" id="inputGroupSuccess4" placeholder="Search contacts IE: Robert Saylor, Augusta, GA" aria-describedby="inputGroupSuccess4Status" style="width:350px;">
		&nbsp;&nbsp;<input type="submit" value="Search" class="btn btn-primary">&nbsp;&nbsp;<input type="button" value="Clear" class="btn btn-warning" onclick="document.location.href='searchcontacts'">
  </div>
</div>
</form>


<table class="table">
<tr>
	<td><b>Name</b></td>
	<td><b>City</b></td>
	<td><b>State/Province</b></td>
	<td><b>Country</b></td>
</tr>

{$list}

</table>
