<?php
header('Content-Type: application/json');

// Database configuration
$db_host = 'localhost';
$db_user = 'username';
$db_pass = 'password';
$db_name = 'foodOrdering';

// Create a connection to the database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read JSON data from the request body
$inputJSON = file_get_contents('php://input');
$orderData = json_decode($inputJSON, true);

// Prepare the SQL statement for inserting the order data
$stmt = $conn->prepare("INSERT INTO `Order` (customer_name, menu_id, item_title, quantity, price) VALUES (?, ?, ?, ?, ?)");

// Bind the parameters
$stmt->bind_param('ssidi', $customer_name, $menu_id, $item_title, $quantity, $price);

// Insert the order data into the database
$success = true;
foreach ($orderData as $orderItem) {
    $customer_name = $orderItem['name'];
    $menu_id = $orderItem['menuID'];
    $item_title = $orderItem['title'];
    $quantity = $orderItem['quantity'];
    $price = $orderItem['price'];

    if (!$stmt->execute()) {
        $success = false;
        break;
    }
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