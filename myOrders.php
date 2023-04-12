<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="orderHistory.js" async></script>
    <title>Kira Makan</title>
</head>

<body>
    <?php session_start();
    include 'includes/connection.inc.php' ?>
    <div class="min-vh-100">
        <header class="col-md-12 mb-5">
            <!-- Header -->
            <?php include 'header.php'; ?>
        </header>

        <div class="row d-flex flex-column">
            <div class="col-md-12 d-flex flex-column justify-content-start align-items-center">
                <div class="col-md-12 d-flex justify-content-center mb-3">
                    <h1><strong><span style="color:var(--orange)">Active</span> Orders</strong></h1>
                </div>
                <div class="col-md-12 d-flex flex-column justify-content-center align-items-center mb-2 gap-3">
                    <?php
                    $customerID = $_SESSION['customerID'];
                    $sql = "SELECT *, DATE(o.orderDate) AS orderDate, TIME(o.orderDate) AS orderTime FROM orders o , restaurants r WHERE customerID = '$customerID' AND o.restaurantID = r.restaurantID AND o.status='Pending' ORDER BY orderDate DESC, orderTime DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="card col-md-4">
                                <div class="card-body d-flex flex-row">
                                    <div class="col-md-3">
                                        <img src="images/restaurants/<?php echo $rows['restaurantName'] ?>/<?php echo $rows['restaurantURL']; ?>" class="image-fluid rounded m-3" style="width 70px; height:70px;" alt="...">
                                    </div>
                                    <div class="col-md-6 mt-2 d-flex flex-column justify-content-between">
                                        <h4><?php echo $rows['restaurantName']; ?></h4>
                                        <h6 class="text-muted">Ordered on <?php echo date('j M, H:i', strtotime($rows['orderDate'] . ' ' . $rows['orderTime'])); ?></h6>
                                    </div>
                                    <div class="col-md-3 mt-2 d-flex justify-content-end">
                                        <h5>RM <span style="color:var(--orange)"><?php echo $rows['totalPrice']; ?></span></h5>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button class="btn white-btn order-button order-button" style="font-size:14px" value="<?= $rows['orderID'] ?>" id="<?= $rows['orderID'] ?>" data-bs-toggle="modal" data-bs-target="#orderID<?= $rows['orderID'] ?>Modal"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-receipt" viewBox="0 0 16 16">
                                                <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                            </svg></i>View Receipt</button>
                                </div>
                            </div>

                            <?php include "includes/customer/displayMyOrderModal.inc.php"; ?>
                        <?php
                        }
                    } else { ?>
                        <h5 class='text-muted p-0'>You have no active orders</h5>
                        <a href="restaurantOptions.php" class="btn orange-btn fs-5">Order now</a>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-md-12 d-flex flex-column justify-content-start align-items-center mt-5 mb-2">
                <div class="col-md-12 d-flex justify-content-center mb-3">
                    <h1><strong><span style="color:var(--orange)">Completed</span> Orders</strong></h1>
                </div>
                <div class="col-md-12 d-flex flex-column justify-content-center align-items-center mb-2 gap-3">
                    <?php
                    $customerID = $_SESSION['customerID'];
                    $sql = "SELECT *, DATE(o.orderDate) AS orderDate, TIME(o.orderDate) AS orderTime FROM orders o , restaurants r WHERE customerID = '$customerID' AND o.restaurantID = r.restaurantID AND o.status='Completed' ORDER BY orderDate DESC, orderTime DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="card col-md-4">
                                <div class="card-body d-flex flex-row">
                                    <div class="col-md-3">
                                        <img src="images/restaurants/<?php echo $rows['restaurantName'] ?>/<?php echo $rows['restaurantURL']; ?>" class="image-fluid rounded m-3" style="width 70px; height:70px;" alt="...">
                                    </div>
                                    <div class="col-md-6 mt-2 d-flex flex-column justify-content-between">
                                        <h4><?php echo $rows['restaurantName']; ?></h4>
                                        <h6 class="text-muted">Ordered on <?php echo date('j M, H:i', strtotime($rows['orderDate'] . ' ' . $rows['orderTime'])); ?></h6>
                                    </div>
                                    <div class="col-md-3 mt-2 d-flex justify-content-end">
                                        <h5>RM <span style="color:var(--orange)"><?php echo $rows['totalPrice']; ?></span></h5>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button class="btn white-btn order-button order-button" style="font-size:14px" value="<?= $rows['orderID'] ?>" id="<?= $rows['orderID'] ?>" data-bs-toggle="modal" data-bs-target="#orderID<?= $rows['orderID'] ?>Modal"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-receipt" viewBox="0 0 16 16">
                                                <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                            </svg></i>View Receipt</button>
                                </div>
                            </div>

                            <?php include "includes/customer/displayMyOrderModal.inc.php"; ?>
                    <?php
                        }
                    } else {
                        echo "<h5 class='text-muted'>You have no completed orders</h5>";
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="col-md-12 d-flex flex-column">
        </div>
    </div>
</body>


</html>

<script>
    let orderbtn = document.querySelector('.order-button');
    let selectedorderID = '';

    const checkOrderButtons = document.querySelectorAll('.order-button');
    checkOrderButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedorderID = button.value;
            console.log(selectedorderID);
        });
    });

    let opID = document.querySelector('.opID');
    let selectedopID = '';
    const sendEmailButtons = document.querySelectorAll('.send-email');
    sendEmailButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedopID = button.value;
            console.log(selectedopID);
        });
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    // select the submit button element
    const submitBtn = document.querySelector('#submit-btn');

    // add a click event listener to the submit button
    submitBtn.addEventListener('click', () => {

        // get the values of the inputs
        // get the selectedopID value
        const recEmail = document.getElementById('recEmail').value;

        // validate the email input
        if (!isValidEmail(recEmail)) {
            alert('Please enter a valid email address');
            return;
        }

        // create a JavaScript object with the values
        const data = {
            recEmail: recEmail,
            orderID: selectedorderID,
            opID: selectedopID
        };
        console.log(data); // log the data object

        fetch('/kiramakan/includes/customer/emailRecipient.inc.php', {
                method: 'POST',
                body: JSON.stringify(data)
            })
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.success) {
                    alert('Receipt sent successfully');
                } else {
                    alert('Error sending receipt');
                }
            });
    });
</script>