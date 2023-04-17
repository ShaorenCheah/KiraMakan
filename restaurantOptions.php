<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap JavaScript and jQuery libraries -->
    <title>Kira Makan</title>
</head>

<body>
    <?php session_start();
    
    if(isset($_SESSION['restaurantID'])){
        echo "<script>alert('You cannot access to customer interface as a restaurant. Please try again with a different account.'); window.location='http://localhost/KiraMakan/restaurant/index.php'</script>";
    }

    ?>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container pt-4 min-vh-100 d-flex flex-column  align-items-center">
        <div class="row m-0 col-10 d-flex align-items-start">
            <div class="col-12 d-flex justify-content-center mt-4 mb-3">
                <h1><strong>Select a <span style="color:var(--orange)">Restaurant</span></strong></h1>
            </div>

            <form class="col-12 d-flex flex-row justify-content-center align-items-center" action="restaurantOptions.php" method="GET">
                <div class="col-3"></div>
                <div class="col-5">
                    <div class="input-group">

                        <input type="text" class="form-control w-25" name="search" placeholder="Enter restaurant name..." value="<?php if (isset($_GET['search'])) {
                                                                                                                                        echo $_GET['search'];
                                                                                                                                    } ?>" autocomplete="off">
                    </div>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <button type="submit" id="dashboard-search" class=" btn orange-btn search-btn ms-3"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></i> Search
                    </button>
                </div>
                <div class="col-2"></div>
            </form>
        </div>


        <div class="row m-0 col-10 d-flex align-items-start">
            <div class="row col-12 g-5 m-0 mt-2 mb-5 p-0 d-flex justify-content-start">

                <?php
                if (isset($_GET['search'])) {
                    $filterValues = $_GET['search'];
                } else {
                    $filterValues = '';
                }

                include './includes/connection.inc.php';
                $sql = "SELECT * FROM Restaurants WHERE CONCAT(restaurantName, restaurantDescription) LIKE '%$filterValues%';";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="images/restaurants/<?php echo $rows['restaurantName'] ?>/<?php echo $rows['restaurantURL']; ?>" class="card-img-top" style="width:70%" alt="<?php echo $rows['restaurantName']; ?>">
                                </div>
                                <div class="mx-3" style="border-top:2px solid var(--orange)"></div>
                                <div class="card-body">
                                    <h5 class="card-title"><strong><?php echo $rows['restaurantName']; ?></strong></h5>
                                    <p class="card-text"><?php echo $rows['restaurantDescription']; ?></p>
                                    <div class="d-flex justify-content-end">
                                        <?php if ($rows['status'] == "Open") { ?>
                                            <button class="btn white-btn restaurant-button" data-bs-target="#exampleModalToggle" id="restaurantID" value="<?php echo $rows['restaurantID'] ?>" data-bs-toggle="modal"><b>Order</b></button>
                                        <?php } else { ?>
                                            <h6 style="color:red">Temporarily Closed</h6>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="col-12 d-flex justify-content-center mt-5 p-0">
                            <h5><strong>No results found for <span style="color:var(--orange)">' . $filterValues . '</span></strong></h5>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-3 p-0">
                            <img src="images/search.png" alt="empty" class="img-fluid" style="width: 25%;">
                        </div>';
                } ?>
            </div>
        </div>
    </div>


    <?php include 'includes/customer/restaurantModal.inc.php'; ?>
    </div>
    </div>

</body>

<footer>
    <?php include "footer.php"; ?>
</footer>

</html>

<script><?php include 'includes/slot.js'; ?></script>