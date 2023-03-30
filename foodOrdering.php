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
    include 'connection.php';
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

            <h1><?= $restaurantName ?></h1>
        </div>
        <div class="col-md-3"></div>
        <div class="nav col-md-6 d-flex flex-row justify-content-between nav-pills w-40 px-4 mb-3 my-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active w-20" id="v-pills" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Meals</button>
            <button class="nav-link" id="v-pills" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Drinks</button>
            <button class="nav-link" id="v-pills" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Desserts</button>
            <button class="nav-link" id="v-pills" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Add-Ons</button>
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
        <div class="col-md-1"></div>
        <div class="tab-content col-md-10 mt-5" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <?php

                // Get the current page number from the query string
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Number of menu items to display per page
                $itemsPerPage = 6;

                // Calculate the offset of the first menu item to display on the current page
                $offset = ($page - 1) * $itemsPerPage;

                $sql = "SELECT * FROM Menu WHERE restaurantID = '$restaurantID' LIMIT $offset, $itemsPerPage";

                $result = mysqli_query($conn, $sql);

                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    // Start a new row every four cards
                    if (($offset + $counter) % 3 == 0) {
                        echo '<div class="row g-5 d-flex justify-content-center">';
                    }

                    // Create a card for the menu item
                    echo '
                        <div class="col-md-3">
                                <div class="card">
                                    <img src="images/restaurants/menu/' . $row['menuURL'] . '" class="card-img-top" alt="' . $row['itemName'] . '">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>' . $row['itemName'] . '</b></h5>
                                        <p class="card-text d-flex">' . $row['itemDescription'] . '</p>
                                        <div class="row d-flex align-items-center">
                                            <h6 class="card-price col-md-8 align-items-center ">RM' . $row['itemPrice'] . '</h6>
                                            <button class="btn btn-primary restaurantButton col-md-4" data-bs-target="#' . $row['menuID'] . '" value="' . $row['menuID'] . '" data-bs-toggle="modal">Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';

                    include 'menuItemPopUp.php';

                    $counter++;
                }

                // End the row if there are less than four cards
                if (($offset + $counter) % 4 != 0) {
                    echo '</div>';
                }

                echo '</div>';

                // Pagination
                $sql = "SELECT COUNT(*) AS total FROM Menu WHERE restaurantID = '$restaurantID'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalItems = $row['total'];
                $totalPages = ceil($totalItems / $itemsPerPage);

                echo '<div class="d-flex justify-content-center mt-3">
                      <nav aria-label="Menu item navigation">
                          <ul class="pagination">';

                // Disable the previous button on the first page
                if ($page == 1) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?restaurantID=' . $restaurantID . '&page=' . ($page - 1) . '">Previous</a></li>';
                }

                // Display up to five page links
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);

                for ($i = $startPage; $i <= $endPage; $i++) {
                    if ($i == $page) {
                        echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?restaurantID=' . $restaurantID . '&page=' . $i . '">' . $i . '</a></li>';
                    }
                }

                // Disable the next button on the last page
                if ($page == $totalPages) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?restaurantID=' . $restaurantID . '&page=' . ($page + 1) . '">Next</a></li>';
                }

                echo '</ul></nav></div>';

                ?>
            </div>


            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">HI</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div>
        </div>
    </div>
    <div class="col-md-1"></div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Shopping Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body row w-auto h-auto mx-2">
            <form id="cart-form" class="p-0">
                <div class="cart-items">
                </div>
                <div class="cart-total">
                    <strong class="cart-total-title">Total</strong>
                    <span class="cart-total-price">RM 0</span>
                </div>
                <button class="btn btn-primary" id="submitCart">Submit Cart</button>
            </form>
        </div>
    </div>

    </div>

</body>

</html>