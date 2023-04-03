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
    <?php session_start() ?>
    <div class="min-vh-100">
        <div class="row d-flex flex-col ">
            <header class="col-md-12 mb-5">
                <!-- Header -->
                <?php include 'header.php'; ?>
            </header>

            <!-- Hero -->
            <div id="hero" class="col-md-12 mt-4 g-5">
                <div class="row mx-5 d-flex  g-5 flex-row">
                    <div class="col-md-6 mt-5 d-flex flex-column">
                        <div class="col-12 ms-2 text-muted">
                            <h6>Group dining made convenient.</b>
                        </div>
                        <div class="col-md-12 mt-3">
                            <h1 class="display-3 fw-bold">Find your next meal <br>with <span style="color:var(--orange)">Kira Makan</span>.
                            </h1>
                        </div>
                        <div class="col-md-12 mt-5">
                            <p class="fs-5 pb-5 lead">
                                <span style="color:var(--orange); font-weight:bolder;">Kira Makan</span> is a food ordering web application designed to improve group dining experience.
                                Enjoy various features such as <span style="color:#ef4207;">group payment calculation</span>,
                                and <span style="color:#ef4207;">send payment receipt</span>
                                to ease your problems when eating out in a group. Just register an account and you can enjoy the perks above.
                            </p>
                        </div>
                        <div class="col-md-12 mt-2 d-flex">
                            <a href="restaurantOptions.php" class="btn orange-btn fs-4">Order now</a>
                        </div>
                    </div>

                    <div class="col-md-6 ps-5 d-flex h-100 gap-3 align-items-stretch flex-row">
                        <div class="col-md-5 d-flex gap-3 flex-column">
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <img src="images/coffee.png" class="object-fit-cover img-fluid rounded h-100" alt="hero">
                            </div>
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <img src="images/noodles.png" class="img-fluid rounded h-100 w-100 object-fit-cover" alt="hero">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-12 h-100">
                                <img src="images/pastries.jpg" class="img-fluid rounded h-100 " alt="hero">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" restaurant-carousel mt-2" id="restaurant-carousel">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-5 mb-4">
                <h1 class="display-4 font-weight-bold" style="color:var(--primary)"><strong>Our <span style="color:var(--orange)">Restaurant</span> Partners</strong></h1>
            </div>

            <div class="col-1"></div>
            <div id="myCarousel" class="col-10 carousel slide my-3" data-bs-ride="carousel">
                <?php
                include './includes/connection.inc.php';
                $sql = "SELECT * FROM Restaurants";
                $run = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_all($run, MYSQLI_ASSOC);
                ?>

                <!-- Wrapper for slides -->
                <div class="carousel-inner pb-5">
                    <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="row g-2 ">
                                <?php for ($j = $i; $j < $i + 3 && $j < count($rows); $j++) { ?>
                                    <div class="col-md-4">
                                        <div class="card px-2">
                                            <img src="images/restaurants/<?php echo $rows[$j]['restaurantURL']; ?>" class="card-img-top rounded" alt="<?php echo $rows[$j]['restaurantName']; ?>">
                                            <div class="card-body">
                                                <h4 class="card-title" style="font-weight:500"><?php echo $rows[$j]['restaurantName']; ?></h4>
                                                <p class="card-text"><?php echo $rows[$j]['restaurantDescription']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="pt-5">
                    <!-- Indicators -->
                    <div class="carousel-indicators mt-5">
                        <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                            <button type="button" style="background-color:var(--orange);" data-bs-target="#myCarousel" data-bs-slide-to="<?php echo $i / 3; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>" aria-current="<?php echo $i == 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $i / 3 + 1; ?>"></button>
                        <?php } ?>
                    </div>
                </div>

                <!-- Left and right controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span aria-hidden="true"><i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="var(--primary)" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                            </svg></i></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span aria-hidden="true"><i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="var(--primary)" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </i></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="col-"></div>
            <div class="col-12 d-flex justify-content-center mb-5">
                <a href="restaurantOptions.php" class="btn orange-btn fs-4">Order now</a>
            </div>

            <?php include 'restaurantPopUp.php'; ?>
        </div>
    </div>


</body>

</html>