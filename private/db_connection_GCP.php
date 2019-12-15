<?php

// Credentials
$dbhost = 'database-1.cptrcvahtkfl.eu-west-1.rds.amazonaws.com';
$dbuser = 'carol_2018250';
$dbpass = '13 Hatnephfcfati_';
$dbname = 'carol_2018250';

// Creating a database connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>