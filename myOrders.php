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
    <script src="accounts.js" async></script>

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

        <div class="row d-flex flex-col">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="col-md-12">
                    <h2>My Orders
                    </h2>
                </div>
                <div class="col-md-12">
                    <table class="table table-borderless table-hover table-striped text-center align-middle table-bordered fs-6 " style="white-space: nowrap;" id="dashboard-table">
                        <thead class="text-wrap m-auto p-auto table-dark ">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Restaurant Name</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Order Time</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <?php
                        $customerID = $_SESSION['customerID'];
                        $sql = "SELECT *, o.status, DATE(o.orderDate) AS orderDate, TIME(o.orderDate) AS orderTime FROM orders o , restaurants r WHERE customerID = '$customerID' AND o.restaurantID = r.restaurantID ";
                        $count = 1;
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <th scope='row'><?= $count ?></th>
                                    <td><?= $row["orderID"] ?></td>
                                    <td><?= $row["restaurantName"] ?></td>
                                    <td><?= $row["orderDate"] ?></td>
                                    <td><?= $row["orderTime"] ?></td>
                                    <td>RM <?= $row["totalPrice"] ?></td>
                                    <td><?= $row["status"] ?></td>
                                    <td><button class="btn white-btn order-button" style="font-size:14px" value="<?= $row['orderID'] ?>" id="<?= $row['orderID'] ?>" data-bs-toggle="modal" data-bs-target="#orderID<?= $row['orderID'] ?>Modal">Order</button></td>
                                </tr>
                        <?php $count++;
                                include "includes/customer/displayMyOrderModal.inc.php";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No records found.</td></tr>";
                        }

                        ?>
                    </table>
                    <!-- Recipient Email Modal -->
                    <div class="modal fade" id="emailRecipientModalToggle" aria-hidden="true" aria-labelledby="emailRecipientModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="col-12 d-flex justify-content-center align-items-center mt-4">
                                    <h3 class="fw-bold mb-2">Enter recipient's email</h3>
                                </div>
                                <div class="modal-body" id="login-modal">

                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="color:var(--orange); ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                            </svg>
                                        </span>
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="recEmail" name="recEmail" placeholder="name@example.com" required autocomplete="off">
                                            <label for="recEmail">Email address</label>
                                            <input type="hidden" name="orderID" id="opID" value="<?php echo $orderID; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="btn orange-btn" id="submit-btn" name="recSubmit">Send</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
</body>
<script>
    const sendEmailButtons = document.querySelectorAll('.send-email');
    let opIDInput = document.getElementById('opID');

    let selectedopID = '';

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
        const restaurantName = document.getElementById("restaurantName").textContent;
        const orderID = document.getElementsByName('orderID')[0].value;


        // create a JavaScript object with the values
        const data = {
            recEmail: recEmail,
            orderID: orderID,
            restaurantName: restaurantName,
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

</html>