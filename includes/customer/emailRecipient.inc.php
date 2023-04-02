<?php
// Get the recipient email
if (isset($_POST['recSubmit'])) {
    $email = $_POST['recEmail'];
    $orderID = $_POST['orderID'];

    // Query to get opID, personName, itemName, quantity and price based on the orderID
    $sql = "SELECT op.*, pm.*, m.itemName
        FROM order_person op
        INNER JOIN person_menu pm ON op.opID = pm.pmID
        INNER JOIN menu m ON pm.menuID = m.menuID
        WHERE op.orderID = $orderID";

    // Execute the query and check if any rows were returned
    $result = mysqli_query($conn, $sql);

    // If rows were returned, then proceed to send the email
    if (mysqli_num_rows($result) > 0) {
        // Get the order details
        $row = mysqli_fetch_assoc($result);
        $opID = $row['opID'];
        $personName = $row['personName'];
        $itemName = $row['itemName'];
        $quantity = $row['quantity'];
        $price = $row['price'];

        // Get the total price
        $totalPrice = $quantity * $price;

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
    <th>Total Price</th>
    </tr>
    <tr>
    <td>$itemName</td>
    <td>$quantity</td>
    <td>$price</td>
    <td>$totalPrice</td>
    </tr>
    </table>
    <p>Order Date: $date</p>
    <p>Order Time: $time</p>
    <p>Thank you for your order.</p>
    <p>Regards,</p>
    <p>Restaurant Name</p>
    </body>
    </html>
    ";

        // Email headers
        $sender = "From: kiramakan@outlook.com";

        // Send the email
        if (mail($email, $subject, $message, $sender)) {
            // If email was sent successfully, then redirect to the order page
            echo "<script>alert('Email was sent successfully!'); window.location='orderReceipt.php?orderID=$orderID'</script>";
        } else {
            // If email was not sent successfully, then redirect to the order page
            echo "<script>alert('Process Failed!'); window.location='orderReceipt.php?orderID=$orderID'</script>";

        }

    }

} else {

    ?>

    <!-- Recipient Email Modal -->
    <div class="modal fade" id="emailRecipientModalToggle" aria-hidden="true"
        aria-labelledby="emailRecipientModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="emailRecipientModalToggleLabel">Please enter recipient's email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="login-modal">
                    <form action="includes/customer/emailRecipient.inc.php" novalidate method="post"
                        onsubmit="return validateRecipientForm()">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path
                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                            </span>
                            <div class="form-floating">
                                <input type="email" class="form-control" id="recEmail" name="recEmail"
                                    placeholder="name@example.com" required autocomplete="off">
                                <label for="recEmail">Email address</label>
                                <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" name="recSubmit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

}

?>