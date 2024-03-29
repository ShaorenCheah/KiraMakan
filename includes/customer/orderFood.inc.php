<?php
session_start();
include '../connection.inc.php';

// Retrieve the order data from the POST request
$orderJSON = $_POST['orderData'];
$order = json_decode($orderJSON, true);

$restaurantID = $order['restaurantID'];
$totalService = $order['servicePrice'];
$totalSales = $order['salesPrice'];
$totalPrice = $order['totalPrice'];
$subtotal = $order['subTotal'];
date_default_timezone_set('Asia/Kuala_Lumpur');
$current_time = date("Y-m-d H:i:s");

// Get latest orderID
$sql = "SELECT CONCAT('ORD', LPAD(COUNT(*)+1, 4, '0')) AS orderID FROM orders;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$orderID = $row['orderID'];

$stmt = $conn->prepare("INSERT INTO Orders (orderID, restaurantID, customerID, orderDate,subTotal, serviceTotal, salesTotal, totalPrice,status) VALUES (?, ?, ?,?,?,?, ?, ?,?)");
$customerID = $_SESSION['customerID'];
$status = "Pending";
// Bind the parameters
$stmt->bind_param('ssssdddds', $orderID, $restaurantID, $customerID, $current_time,$subtotal,$totalService, $totalSales, $totalPrice,$status);
$stmt->execute();

$success = true;

//Get the order persons 

foreach ($order['orderData'] as $personName) {
    $customerName = $personName['name'];

    // Check if the name already exists in the database
    $sql = "SELECT opID FROM order_person WHERE personName = ? AND orderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $customerName, $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the name exists, skip to the next orderItem
    if ($result->num_rows > 0) {
        continue;
    }

    // If the name doesn't exist, insert it into the database
    $sql = "SELECT CONCAT('OP', LPAD(COUNT(*)+1, 4, '0')) AS opID FROM order_person;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $opID = $row['opID'];

    $stmt = $conn->prepare("INSERT INTO order_person (opID, orderID, personName) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $opID, $orderID, $customerName);

    if (!$stmt->execute()) {
        $success = false;
        break;
    }
}

// Get the order items
foreach ($order['orderData'] as $orderItem){
    $itemID = $orderItem['itemID'];
    $quantity = $orderItem['quantity'];
    $price = $orderItem['price'] * $quantity;
    $personName = $orderItem['name'];

    // Get the opID of the customer
    $sql = "SELECT opID FROM order_person WHERE personName = ? AND orderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $personName , $orderID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    $opID = $row['opID'];

    $stmt = $conn->prepare("INSERT INTO person_item (opID, itemID, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssid', $opID, $itemID, $quantity, $price);

    if (!$stmt->execute()) {
        $success = false;
        break;
    }
}

$sql = "UPDATE customers SET balance = balance - ? WHERE customerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ds', $totalPrice, $_SESSION['customerID']);
$stmt->execute();

$sql = "SELECT * FROM customers WHERE customerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $_SESSION['customerID']);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$_SESSION['balance'] = $row['balance'];

// Close the statement and connection
$stmt->close();
$conn->close();

// Send a JSON response indicating success or failure
$response = [
    'success' => $success,
    'orderID' => $orderID,
    'totalPrice' => $totalPrice,
    'balance' => $_SESSION['balance']
];

echo json_encode($response);
