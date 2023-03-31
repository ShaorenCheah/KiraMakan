<?php

// Define database connection variables
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kiramakan';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>