<?php
$orderJSON = file_get_contents('php://input');
$order = json_decode($orderJSON, true);

// Get the recipient email
include '../connection.inc.php';
$email = $order['recEmail'];
$orderID = $order['orderID'];
$opID = $order['opID'];

$sql = "SELECT * FROM order_person WHERE opID = '$opID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$personName = $row['personName'];

// Get the current date and time
$date = date("d/m/Y");
$time = date("h:i:sa");

// Email subject
$subject = "Order Confirmation";

// Email message
$message = "
    <html>
    <head>
        <title>Order Confirmation</title>
    </head>
    <body>
        <p>Dear $personName,</p>
        <p>Thank you for ordering from us. Your order has been confirmed.</p>
        <p>Order Details:</p>
        <table>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>";

$sql = "SELECT * FROM person_menu WHERE opID = '$opID'";
$result = mysqli_query($conn, $sql);
$sum = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $quantity = $row['quantity'];
    $price = $row['price'];
    $menuID = $row['menuID'];

    $sql2 = "SELECT * FROM menu WHERE menuID = '$menuID'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $itemName = $row2['itemName'];
    $message .= "        
            <tr>
                <td>$itemName</td>
                <td>$quantity</td>
                <td>$price</td>
            </tr>";

    $sum += $price;
}
$message .= "
            </table>
            <p>Total Price: $sum</p>
            <p>Order Date: $date</p>
            <p>Order Time: $time</p>
            <p>Thank you for your order.</p>
            <p>Regards,</p>
            <p>Restaurant Name</p>
        </body>
    </html>
";

// Email headers
$headers = "From: kiramakan@outlook.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

// Send the email
if (mail($email, $subject, $message, $headers)) {
    $success = true;
} else {
    $success = false;
}

// Send a JSON response indicating success or failure
$response = [
    'success' => $success
];

echo json_encode($response);
?>