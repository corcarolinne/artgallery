<?php
/*****************************************
* This query uses the procedural interface
******************************************/

// Credentials
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '13 Hatnephfcfati_';
$dbname = 'carol_2018250';

// 1. Create a database connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// 5. Close database connection
//mysqli_close($connection);
?>