<?php
session_start();

$sesID = session_id();
// init
include_once "../include/settings.php";
include_once "../include/mysql.php";
include_once "../include/templates.php";

if ($_GET['uuname'] == "") {
	$err = "1";
}

$sql = "SELECT `uuname` FROM `users` WHERE `uuname` = '$_GET[uuname]'";
$result = $core->new_mysql($sql);
while ($row = $result->fetch_assoc()) {
	$err = "1";
}

if ($err == "1") {
	print "<font color=red>Error: username not available.</font>";
   ?>
   <script>
   document.getElementById('submit').style.display='none';
   </script>
   <?php

} else {
	print "<font color=green>Username is available.</font>";
	?>
	<script>
	document.getElementById('submit').style.display='flex';
	</script>
	<?php
}
?>
