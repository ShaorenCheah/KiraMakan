<?php

// Define database connection variables
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kiramakan';

// Create a connection object
$conn = new mysqli($host, $user, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>