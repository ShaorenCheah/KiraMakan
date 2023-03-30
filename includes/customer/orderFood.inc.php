<?php
include 'connection.php';

// Retrieve the order data from the POST request
$orderJSON = $_POST['orderData'];
$order = json_decode($orderJSON, true);

$restaurantID = $order['restaurantID'];
$totalPrice = $order['totalPrice'];
$today = date('d/m/Y');

// Get latest orderID
$sql = "SELECT CONCAT('O', LPAD(COUNT(*)+1, 4, '0')) AS orderID FROM orders;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$orderID = $row['orderID'];

$stmt = $conn->prepare("INSERT INTO Orders (orderID, restaurantID, customerID, orderDate, totalPrice) VALUES (?, ?, ?, ?, ?)");
$customerID="C0002";
// Bind the parameters
$stmt->bind_param('ssssd', $orderID, $restaurantID, $customerID, $today, $totalPrice);

$success = true;

if (!$stmt->execute()) {
    $success = false;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Send a JSON response indicating success or failure
$response = [
    'success' => $success
];

echo json_encode($response);
?>