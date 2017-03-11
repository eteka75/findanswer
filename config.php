<?php
//site specific configuration declartion
define( 'BASE_PATH', 'http://localhost/timeline/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USERNAME','root');
define('DB_PASSWORD',''); 

$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();


define('FIRST', 4);
define('LIMIT', 4);
