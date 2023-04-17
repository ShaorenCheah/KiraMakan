<?php
session_start();
$orderJSON = file_get_contents('php://input');
$order = json_decode($orderJSON, true);

// Get the recipient email
include '../connection.inc.php';
$email = $order['recEmail'];
$orderID = $order['orderID'];
$opID = $order['opID'];

$sql = "SELECT r.restaurantName FROM restaurants r, orders o WHERE o.orderID = '$orderID' AND o.restaurantID = r.restaurantID";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$restaurantName = $row['restaurantName'];

$sql = "SELECT * FROM order_person WHERE opID = '$opID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$personName = $row['personName'];

$sql = "SELECT DATE(orderDate) AS orderDate, TIME(orderDate) AS orderTime FROM orders WHERE orderID = '$orderID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$date = $row['orderDate'];
$time = $row['orderTime'];


// Email subject
$subject = "Receipt for Order #" . $orderID . "";

// Email message
$message = "
    <html>
    <head>
        <title>Receipt for Order #" . $orderID . "</title>
        <style>
        .table {
            margin-top: 20px;
            margin-bottom: 20px;
            border-collapse: separate;
            border-spacing: 0px;
            text-align: center;
          }
          
          .table th,
          .table td {
            padding: 10px;
          }
          
          .table tr {
            margin-bottom: 10px;
          }
          
          .table tbody tr:last-child td {
            border-bottom: none;
          }
          
          .table td:last-child {
            font-weight: bold;
          }
          
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                    <p>Dear $personName,</p>
                    <p>Thank you for using KiraMakan. Here's your order receipt of dining in with <strong>" . $_SESSION['customerName'] . "</strong> at <strong>" . $restaurantName . "</strong>. Here are your order details: </p>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>";

$sql = "SELECT * FROM person_item WHERE opID = '$opID'";
$result = mysqli_query($conn, $sql);
$sum = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $quantity = $row['quantity'];
    $price = $row['price'];
    $itemID = $row['itemID'];

    $sql2 = "SELECT * FROM items WHERE itemID = '$itemID'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $itemName = $row2['itemName'];
    $message .= "        
            <tr class='d-flex justify-content-center align-items-center'>
                <td>$itemName</td>
                <td>$quantity</td>
                <td>RM $price</td>
            </tr>";

    $sum += $price;
}
$net = round($sum * 100) / 100;
$service = $net * 0.1;
$sales = $net * 0.06;

$final = $net * 1.16;
$secondDecimal = floor($final * 100) % 10;

if ($secondDecimal <= 4) {
    $finalRounded = floor($final * 10) / 10;
} else {
    $finalRounded = ceil($final * 10) / 10;
}

$service = number_format($service, 2);
$sales = number_format($sales, 2);
$round = number_format($finalRounded - $final, 2);
$finalRounded = number_format($finalRounded, 2);
$net = number_format($net,2);

$message .= "
                    </tbody>
                    </table>
                    <p>
                    Subtotal: RM$net<br>
                    Service Tax (10%): RM$service<br>
                    Sales Tax (6%): RM$sales<br>
                    Cash Rounded: RM$round<br>
                    Grand Total: <strong>RM$finalRounded</strong>
                    </p>
                    <p>
                    Order Date: $date<br>
                    Order Time: $time
                    </p>
                    <br>
                    <p>Thank you for your order.</p>
                    <p>Regards,</p>
                    <p>KiraMakan</p>
                </div>
            </div>
        </div>
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
