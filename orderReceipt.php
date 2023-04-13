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
    <?php
    session_start();

    include './includes/connection.inc.php';
    if (isset($_POST['orderID'])) {
        $orderID = $_POST['orderID'];
    } else {
        echo '<script>alert("Please order first"); window.location= "restaurantOptions.php";</script>';
    }

    $sql = "SELECT o.orderDate, o.serviceTotal, o.salesTotal, o.totalPrice, r.restaurantName FROM orders o, restaurants r WHERE o.restaurantID = r.restaurantID AND orderID = '$orderID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $orderDate = $row['orderDate'];
    $serviceTotal = $row['serviceTotal'];
    $salesTotal = $row['salesTotal'];
    $totalPrice = $row['totalPrice'];
    $restaurantName = $row['restaurantName'];

    ?>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container col-6 h-100 my-4">
        <div class="card w-100">
            <div class="card-header">
                <h5 class="font-weight-bold mb-0">
                    <strong>
                        Order <span style="color:var(--orange)">#<?= $orderID ?>
                        </span> on <span style="color:var(--orange)">
                            <?= $orderDate ?>
                        </span>@ <span style="color:var(--orange)" id="restaurantName"><?= $restaurantName ?></span>
                    </strong>
                </h5>
            </div>
            <div class="card-body">
                <?php
                $subtotal = 0;
                $sql = "SELECT * FROM order_person WHERE orderID = '$orderID'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $opID = $row['opID'];
                        $personName = $row['personName'];
                ?>
                        <div class="d-flex flex-row">
                            <h5 class='mt-2 mb-3'><strong><?= $personName ?></strong></h5>
                        </div>
                        <?php
                        $sql = "SELECT * FROM person_menu WHERE opID = '$opID'";
                        $result2 = mysqli_query($conn, $sql);
                        $sum = 0;

                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $menuID = $row2['menuID'];
                            $quantity = $row2['quantity'];
                            $price = $row2['price'];
                            $sum += $price;
                            $subtotal += $price;
                            $sql = "SELECT * FROM menu WHERE menuID = '$menuID'";
                            $result3 = mysqli_query($conn, $sql);
                            $row3 = mysqli_fetch_assoc($result3);

                            $itemName = $row3['itemName'];
                            $unit = $row3['itemPrice'];
                        ?>
                            <div class="d-flex flex-row justify-content-between mb-2">
                                <h6><?= $itemName ?> x <?= $quantity ?> (RM <?= $unit ?>/unit)</h6>
                                <h6>RM <?= $price ?></h6>
                            </div>
                        <?php
                        }
                        ?>
                        <div class='d-flex justify-content-between flex-row mt-3'>
                            <?php if ($personName == $_SESSION['customerName']) {
                                echo '<div class="col-7"></div>';
                            } else {
                                echo '
                            <div class="d-flex align-items-center col-7">
                                <button class="btn white-btn d-flex align-items-center justify-content-center send-email" data-bs-target="#emailRecipientModalToggle" data-bs-toggle="modal" id="opID" value="' . $opID . '"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-envelope mb-1" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                        </svg></i>Send Receipt
                                </button>
                            </div>';
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

                            ?>
                            <div class="d-flex flex-column col-5">
                                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                                    <p class="mb-0" style="font-size:13px">Subtotal</p>
                                    <p class="mb-0" style="font-size:13px">RM <?= number_format($net, 2) ?></p>
                                </div>
                                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                                    <p class="mb-0" style="font-size:13px">Service Tax (10%)</p>
                                    <p class="mb-0" style="font-size:13px">RM <?= $service ?></p>
                                </div>
                                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                                    <p class="mb-0" style="font-size:13px">Sales Tax (6%)</p>
                                    <p class="mb-0" style="font-size:13px">RM <?= $sales ?></p>
                                </div>
                                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                                    <p class="mb-0" style="font-size:13px">Cash Rounding</p>
                                    <p class="mb-0" style="font-size:13px">RM <?= $round ?></p>
                                </div>
                                <div class="d-flex flex-row justify-content-between gap-1 mb-1">

                                    <h5 class="mb-0"><strong>Total</strong><span class="text-muted" style="font-size:13px"> (rounded price)</span></h5>
                                    <h5 class="mb-0"><strong>RM <span style="color:var(--orange)"><?= $finalRounded ?></span></strong></h5>

                                </div>
                            </div>
                        </div>
                    <?php
                        echo "<div class='cart-item mb-4'></div>";
                    }


                    ?>
                    <div class="d-flex flex-column col-12 justify-content-end">
                        <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                            <p class="mb-0" style="font-size:14px">Subtotal</p>
                            <p class="mb-0" style="font-size:14px">RM <?= number_format($subtotal, 2) ?></p>
                        </div>
                        <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                            <p class="mb-0" style="font-size:14px">Service Tax (10%)</p>
                            <p class="mb-0" style="font-size:14px">RM <?= $serviceTotal ?></p>
                        </div>
                        <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                            <p class="mb-0" style="font-size:14px">Sales Tax (6%)</p>
                            <p class="mb-0" style="font-size:14px">RM <?= $salesTotal ?></p>
                        </div>
                        <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                            <p class="mb-0" style="font-size:14px">Cash Rounding</p>
                            <p class="mb-0" style="font-size:14px">RM <?= number_format($totalPrice - $subtotal - $salesTotal - $serviceTotal, 2) ?></p>
                        </div>
                        <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                            <h4 class="mb-0"><strong>Grand Total</strong><span class="text-muted" style="font-size:13px"> (rounded price)</span></h4>
                            <h4 class="mb-0"><strong>RM <span style="color:var(--orange)"><?= $totalPrice ?></span></strong></h4>

                        </div>
                    </div>
                <?php
                } else {
                    echo "No results found";
                }
                ?>
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
        </div>
    </div>


</body>

<footer>
    <?php include "footer.php"; ?>
</footer>

</html>
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
        const orderID = document.getElementsByName('orderID')[0].value;


        // create a JavaScript object with the values
        const data = {
            recEmail: recEmail,
            orderID: orderID,
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