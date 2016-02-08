<?php

$DB_NAME = 'lodge_res';
$DB_HOST = 'mysql';
$DB_USER = 'root';
$DB_PASS = 'F7m9dSz0';


$linkID = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}
?>
