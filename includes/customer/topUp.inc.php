<?php
session_start();
$orderJSON = file_get_contents('php://input');
$data = json_decode($orderJSON, true);

// Get the recipient email
include '../connection.inc.php';
$cashAmount = $data["cashAmount"];
$customerID = $_SESSION['customerID'];

$sql = "UPDATE customers SET balance = balance + '$cashAmount' WHERE customerID = '$customerID'";
$result = mysqli_query($conn, $sql);

// Return response as JSON
$response = array('success' => true);

$sql2 = "SELECT * FROM customers WHERE customerID = '$customerID'";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);
$response['cashAmount'] =$cashAmount;
$response['balance'] = $row['balance'];
$_SESSION['balance'] = $row['balance'];
echo json_encode($response);
?>
