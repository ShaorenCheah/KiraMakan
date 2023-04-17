<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Kira Makan</title>
</head>

<body>
    <?php session_start();

    if (isset($_SESSION['restaurantID'])) {
        echo "<script>alert('You cannot access to customer interface as a restaurant. Please try again with a different account.'); window.location='http://localhost/KiraMakan/restaurant/index.php'</script>";
    }

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
                                        <img src="images/restaurants/<?php echo $rows['restaurantName'] ?>/<?php echo $rows['restaurantURL']; ?>"
                                            class="image-fluid rounded" style="height:90px" alt="...">
                                    </div>
                                    <div class="col-md-6 mt-2 d-flex flex-column justify-content-between">
                                        <h4>
                                            <?php echo $rows['restaurantName']; ?>
                                        </h4>
                                        <h6 class="text-muted">Ordered on
                                            <?php echo date('j M, H:i', strtotime($rows['orderDate'] . ' ' . $rows['orderTime'])); ?>
                                        </h6>
                                    </div>
                                    <div class="col-md-3 mt-2 d-flex justify-content-end">
                                        <h5>RM <span style="color:var(--orange)">
                                                <?php echo $rows['totalPrice']; ?>
                                            </span></h5>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button class="btn white-btn order-button order-button" style="font-size:14px"
                                        value="<?= $rows['orderID'] ?>" id="<?= $rows['orderID'] ?>" data-bs-toggle="modal"
                                        data-bs-target="#orderID<?= $rows['orderID'] ?>Modal"><i class="me-2"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-receipt"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                <path
                                                    d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
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

            <div class="col-md-12 d-flex flex-column justify-content-start align-items-center my-5">
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
                                        <img src="images/restaurants/<?php echo $rows['restaurantName'] ?>/<?php echo $rows['restaurantURL']; ?>"
                                            class="image-fluid rounded" style="height:90px" alt="...">
                                    </div>
                                    <div class="col-md-6 mt-2 d-flex flex-column justify-content-between">
                                        <h4>
                                            <?php echo $rows['restaurantName']; ?>
                                        </h4>
                                        <h6 class="text-muted">Ordered on
                                            <?php echo date('j M, H:i', strtotime($rows['orderDate'] . ' ' . $rows['orderTime'])); ?>
                                        </h6>
                                    </div>
                                    <div class="col-md-3 mt-2 d-flex justify-content-end">
                                        <h5>RM <span style="color:var(--orange)">
                                                <?php echo $rows['totalPrice']; ?>
                                            </span></h5>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button class="btn white-btn order-button order-button" style="font-size:14px"
                                        value="<?= $rows['orderID'] ?>" id="<?= $rows['orderID'] ?>" data-bs-toggle="modal"
                                        data-bs-target="#orderID<?= $rows['orderID'] ?>Modal"><i class="me-2"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-receipt"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                                <path
                                                    d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                            </svg></i>View Receipt</button>
                                </div>
                            </div>

                            <?php include "includes/customer/displayMyOrderModal.inc.php"; ?>
                            <?php
                        }
                    } else {
                        echo "<h5 class='text-muted mb-3'>You have no completed orders</h5>";
                    }
                    ?>
                </div>
            </div>
        </div>


        <!-- Recipient Email Modal -->
        <div class="modal fade" id="emailRecipientModalToggle" aria-hidden="true"
            aria-labelledby="emailRecipientModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="col-12 d-flex justify-content-center align-items-center mt-4">
                        <h3 class="fw-bold mb-2">Enter recipient's email</h3>
                    </div>
                    <div class="modal-body" id="login-modal">

                        <div class="input-group mb-3">
                            <span class="input-group-text" style="color:var(--orange); ">
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
    </div>
</body>

<footer>
    <?php include "footer.php"; ?>
</footer>

</html>

<script><?php include 'includes/customer/historySendReceipt.js'; ?></script>