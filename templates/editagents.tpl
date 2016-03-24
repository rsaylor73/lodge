<div class="col-md-6">
<h2>Agents :: {$company}</h2>
<input type="button" value="New Agent" class="btn btn-success" onclick="document.location.href='newagent/{$resellerID}'"><br>
{$msg}

<table class="table">
<tr><td><b>Name</b></td><td><b>Status</b></td></tr>
{$agent_list}
</table>


<br>