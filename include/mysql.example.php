<?php

$DB_NAME = 'database_name';
$DB_HOST = 'database_host'; // normally localhost
$DB_USER = 'database_user';
$DB_PASS = 'database_password';


$linkID = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}
?>
