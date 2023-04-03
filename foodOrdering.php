<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Bootstrap JavaScript and jQuery libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="cart.js" async></script>

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Kira Makan</title>
</head>

<body>
    <?php
    session_start();

    $restaurantID = $_GET['restaurantID'];
    if (isset($_GET['namesArray'])) {
        $namesArray = explode(",", $_GET['namesArray']);
    }
    include './includes/connection.inc.php';
    ?>

    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="row col-md-12 m-0">
        <div class="col-md-12 d-flex justify-content-center mt-4">
            <?php
            $sql = "SELECT * FROM restaurants WHERE restaurantID = '$restaurantID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $restaurantName = $row['restaurantName'];
            ?>

            <h1><strong><?= $restaurantName ?></strong></h1>
            <input type="hidden" name="restaurantID" id="restaurantID" value="<?= $restaurantID ?>">
        </div>
        <div class="col-md-3"></div>
        <div class="nav col-md-6 d-flex flex-row justify-content-between nav-pills w-40 px-4 mb-3 my-2" id="pills-tab" role="tablist">
            <button class="nav-link active w-20" id="pills-meals" data-bs-toggle="pill" data-bs-target="#pills-meal-tab" type="button" role="tab" aria-controls="pills-meal" aria-selected="true">Meals</button>
            <button class="nav-link" id="pills-drinks" data-bs-toggle="pill" data-bs-target="#pills-drinks-tab" type="button" role="tab" aria-controls="pills-drinks" aria-selected="false">Drinks</button>
            <button class="nav-link" id="pills-desserts" data-bs-toggle="pill" data-bs-target="#pills-desserts-tab" type="button" role="tab" aria-controls="pills-desserts" aria-selected="false">Desserts</button>
            <button class="nav-link" id="pills-addons" data-bs-toggle="pill" data-bs-target="#pills-addons-tab" type="button" role="tab" aria-controls="pills-addons" aria-selected="false">Add-Ons</button>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-6 d-flex flex-row align-items-center justify-content-start px-4">
            <h4>Currently ordering for</h4>
            <select class="form-select w-25 ms-3 order-name-dropdown" aria-label="Default select example">
                <?php
                if (!isset($_SESSION["email"])) {
                    echo "<option value=\"Guest\">Guest</option>";
                } else {
                    echo "<option value='{$_SESSION["name"]}'>{$_SESSION["name"]}</option>";
                }
                foreach ($namesArray as $name) {
                    echo "<option value=\"$name\">$name</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3"></div>

        <div class="col-md-2"></div>
        <div class="tab-content col-md-8 mt-4" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-meal-tab" role="tabpanel" aria-labelledby="pills-meal-tab" tabindex="0">
                <?php

                $sql = "SELECT * FROM Menu WHERE restaurantID = '$restaurantID' AND category = 'Meals'";

                $result = mysqli_query($conn, $sql);

                echo '<div class="row gap-5 d-flex flex-row justify-content-start">';
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        // Create a card for the menu item
                ?>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="images/restaurants/<?=$restaurantName?>/menu/<?= $row['menuURL'] ?>" class="card-img-top" alt=" <?= $row['itemName'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><b><?= $row['itemName'] ?></b></h5>
                                    <p class="card-text d-flex"><?= $row['itemDescription'] ?></p>
                                    <div class="row d-flex align-items-center">
                                        <h6 class="card-price col-md-8 align-items-center ">RM <?= $row['itemPrice'] ?></h6>
                                        <?php
                                        if (isset($_SESSION['accountID'])) {
                                        ?>
                                            <button class="btn white-btn restaurantButton col-md-4" data-bs-target="#<?= $row['menuID'] ?>" value="<?= $row['menuID'] ?>" data-bs-toggle="modal">Order</button>
                                        <?php } else { ?>
                                            <div class="col-md-4"></div>
                                        <?php
                                        };
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php include 'menuItemPopUp.php';
                    }
                } else {
                    echo '<div class="col-12 d-flex justify-content-center mt-5 p-0">
                        <h5><strong>There are currently no <span style="color:var(--orange)">meals</span> available</strong></h5>
                    </div>
                    <div class="col-12 d-flex justify-content-center mb-3 p-0">
                        <img src="images/cook.png" alt="empty" class="img-fluid" style="width: 25%;">
                    </div>';
                } ?>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-drinks-tab" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

            <?php

            $sql = "SELECT * FROM Menu WHERE restaurantID = '$restaurantID' AND category = 'Drinks'";

            $result = mysqli_query($conn, $sql);

            echo '<div class="row gap-5 d-flex flex-row justify-content-start">';
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    // Create a card for the menu item
            ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/restaurants/<?=$restaurantName?>/menu/<?= $row['menuURL'] ?>" class="card-img-top" alt=" <?= $row['itemName'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><b><?= $row['itemName'] ?></b></h5>
                                <p class="card-text d-flex"><?= $row['itemDescription'] ?></p>
                                <div class="row d-flex align-items-center">
                                    <h6 class="card-price col-md-8 align-items-center ">RM <?= $row['itemPrice'] ?></h6>
                                    <?php
                                    if (isset($_SESSION['accountID'])) {
                                    ?>
                                        <button class="btn white-btn restaurantButton col-md-4" data-bs-target="#<?= $row['menuID'] ?>" value="<?= $row['menuID'] ?>" data-bs-toggle="modal">Order</button>
                                    <?php } else { ?>
                                        <div class="col-md-4"></div>
                                    <?php
                                    };
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php include 'menuItemPopUp.php';
                }
            } else {
                echo '<div class="col-12 d-flex justify-content-center mt-5 p-0">
                        <h5><strong>There are currently no <span style="color:var(--orange)">drinks</span> available</strong></h5>
                    </div>
                    <div class="col-12 d-flex justify-content-center mb-3 p-0">
                        <img src="images/cook.png" alt="empty" class="img-fluid" style="width: 25%;">
                    </div>';
            } ?>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-desserts-tab" role="tabpanel" aria-labelledby="pills-desserts-tab" tabindex="0">

        <?php

        $sql = "SELECT * FROM Menu WHERE restaurantID = '$restaurantID' AND category = 'Desserts'";

        $result = mysqli_query($conn, $sql);

        echo '<div class="row gap-5 d-flex flex-row justify-content-start">';
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                // Create a card for the menu item
        ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/restaurants/<?=$restaurantName?>/menu/<?= $row['menuURL'] ?>" class="card-img-top" alt=" <?= $row['itemName'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><b><?= $row['itemName'] ?></b></h5>
                            <p class="card-text d-flex"><?= $row['itemDescription'] ?></p>
                            <div class="row d-flex align-items-center">
                                <h6 class="card-price col-md-8 align-items-center ">RM <?= $row['itemPrice'] ?></h6>
                                <?php
                                if (isset($_SESSION['accountID'])) {
                                ?>
                                    <button class="btn white-btn restaurantButton col-md-4" data-bs-target="#<?= $row['menuID'] ?>" value="<?= $row['menuID'] ?>" data-bs-toggle="modal">Order</button>
                                <?php } else { ?>
                                    <div class="col-md-4"></div>
                                <?php
                                };
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

        <?php include 'menuItemPopUp.php';
            }
        } else {
            echo '<div class="col-12 d-flex justify-content-center mt-5 p-0">
                        <h5><strong>There are currently no <span style="color:var(--orange)">desserts</span> available</strong></h5>
                    </div>
                    <div class="col-12 d-flex justify-content-center mb-3 p-0">
                        <img src="images/cook.png" alt="empty" class="img-fluid" style="width: 25%;">
                    </div>';
        } ?>
    </div>

    </div>


    <div class="tab-pane fade" id="pills-addons-tab" role="tabpanel" aria-labelledby="pills-addons-tab" tabindex="0">

        <?php

        $sql = "SELECT * FROM Menu WHERE restaurantID = '$restaurantID' AND category = 'Add-Ons'";

        $result = mysqli_query($conn, $sql);

        echo '<div class="row gap-5 d-flex flex-row justify-content-start">';
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                // Create a card for the menu item
        ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/restaurants/<?=$restaurantName?>/menu/<?= $row['menuURL'] ?>" class="card-img-top" alt=" <?= $row['itemName'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><b><?= $row['itemName'] ?></b></h5>
                            <p class="card-text d-flex"><?= $row['itemDescription'] ?></p>
                            <div class="row d-flex align-items-center">
                                <h6 class="card-price col-md-8 align-items-center ">RM <?= $row['itemPrice'] ?></h6>
                                <?php
                                if (isset($_SESSION['accountID'])) {
                                ?>
                                    <button class="btn white-btn restaurantButton col-md-4" data-bs-target="#<?= $row['menuID'] ?>" value="<?= $row['menuID'] ?>" data-bs-toggle="modal">Order</button>
                                <?php } else { ?>
                                    <div class="col-md-4"></div>
                                <?php
                                };
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

        <?php include 'menuItemPopUp.php';
            }
        } else {
            echo '<div class="col-12 d-flex justify-content-center mt-5 p-0">
                        <h5><strong>There are currently no <span style="color:var(--orange)">add-ons</span> available</strong></h5>
                    </div>
                    <div class="col-12 d-flex justify-content-center mb-3 p-0">
                        <img src="images/cook.png" alt="empty" class="img-fluid" style="width: 25%;">
                    </div>';
        } ?>
    </div>
    </div>


    <div class="col-md-2"></div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <?php if (isset($_SESSION['accountID'])) {
        ?>
            <div class="offcanvas-header d-flex justify-content-center flex-column">
                <h5 class="offcanvas-title"><strong>Your Cart</strong></h5>
                <h6 class="text-muted mt-2" id="add-text">Start adding items into your cart</h6>
            </div>

            <div class="offcanvas-body px-4 pb-4  w-100 h-100 p-0 d-flex flex-column">
                <form id="cart-form" class="p-0 h-100 d-flex flex-column">
                    <div class="cart-items flex-grow-1"></div>
                    <div class="cart-total container-fluid w-100 p-0">
                        <div class="d-flex flex-column">
                            <div class="col-12 d-flex flex-row justify-content-between">
                                <h6>Service Tax (10%)</h6>
                                <h6  class="cart-service">RM 0</h6>
                            </div>
                            <div class="col-12 d-flex flex-row justify-content-between">
                                <h6>Sales Tax (6%)</h6>
                                <h6 class="cart-sales">RM 0</h6>
                            </div>
                            <div class="col-12 d-flex flex-row justify-content-between mt-2">
                                <h5><strong class="cart-total-title">Grand Total</strong></h5>
                                <h5><strong><span class="cart-total-price">RM 0</span></strong></h5>
                            </div>
                            <div class="col-12 d-flex mt-4 justify-content-center align-items-end">
                                <button class="btn orange-btn" id="submitCart">Submit Cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        <?php } else {
        ?> <div class="offcanvas-body row w-auto h-100 mx-2 d-flex flex-column justify-content-center align-items-center">
                <div class="col-12 mb-5">
                    <img src="images/login.jpg" class="img-fluid" alt="Login First">
                </div>
                <button class="btn orange-btn me-3 w-50" type="button" data-bs-toggle="modal" data-bs-target="#loginModalToggle">
                    Please Login First
                </button>
            </div>
        <?php
        }; ?>
    </div>




</body>

</html>