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
    $orderID = $_GET['orderID'];

    $sql = "SELECT orderDate, totalPrice FROM orders WHERE orderID = '$orderID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $orderDate = $row['orderDate'];
    $totalPrice = $row['totalPrice'];

    ?>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container col-5 h-100 my-4">
        <div class="card w-100">
            <div class="card-header">
                Order <strong>#
                    <?= $orderID ?>
                </strong> on <strong>
                    <?= $orderDate ?>
                </strong>
            </div>
            <div class="card-body">
                <?php
                $sql = "SELECT * FROM order_person WHERE orderID = '$orderID'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $opID = $row['opID'];
                        $personName = $row['personName'];

                        echo "<h5 class='mt-3'>$personName</h5>";

                        $sql = "SELECT * FROM person_menu WHERE opID = '$opID'";
                        $result2 = mysqli_query($conn, $sql);
                        $sum = 0;

                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $menuID = $row2['menuID'];
                            $quantity = $row2['quantity'];
                            $price = $row2['price'];
                            $sum += $price;
                            $sql = "SELECT * FROM menu WHERE menuID = '$menuID'";
                            $result3 = mysqli_query($conn, $sql);
                            $row3 = mysqli_fetch_assoc($result3);

                            $itemName = $row3['itemName'];
                            $unit = $row3['itemPrice'];
                            echo "<p>$itemName x $quantity (RM " . $unit . "/unit)</p>";
                            echo "<p>RM " . $price . "</p>";
                        }
                        echo
                        "<div class='d-flex justify-content-between'>
                        <button class='btn btn-primary align-self-end send-email' data-bs-target='#emailRecipientModalToggle' data-bs-toggle='modal' id='opID' value='$opID'>Send Email</button>
                        <p class='d-flex justify-content-end'>Total : RM " . $sum . "</p>
                        </div><div class='cart-item mb-4'></div>";
                    }
                    echo "<h5 class='d-flex justify-content-end'>Grand Total : <strong>RM " . $totalPrice . "</strong></h5>";
                } else {
                    echo "No results found";
                }
                ?>
                 <!-- Recipient Email Modal -->
                 <div class="modal fade" id="emailRecipientModalToggle" aria-hidden="true" aria-labelledby="emailRecipientModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="emailRecipientModalToggleLabel">Please enter recipient's email</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="login-modal">
                                        <form>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                                    </svg>
                                                </span>
                                                <div class="form-floating">
                                                    <input type="email" class="form-control" id="recEmail" name="recEmail" placeholder="name@example.com" required autocomplete="off">
                                                    <label for="recEmail">Email address</label>
                                                    <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary" id="submit-btn" name="recSubmit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
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
                    alert('Email sent successfully');
                } else {
                    alert('Error sending email');
                }
            });
    });
</script>

</html>