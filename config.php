<?php
define('DB_HOST', 'localhost');
define('DB_USERNAME','dceconnect');
define('DB_PASSWORD','dcedatabase');
define('DB_NAME', 'krp_fees');
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>
