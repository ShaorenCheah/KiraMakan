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
    <script src="includes/accounts.js" async></script>
    <link rel="shortcut icon" href="images/KiraMakanIcon.png" type="image/x-icon">
    <title>KiraMakan</title>
</head>

<body>
    <?php
    session_start();

    if (isset($_SESSION['restaurantID'])) {
        echo "<script>alert('You cannot access to customer interface as a restaurant. Please try again with a different account.'); window.location='http://localhost/KiraMakan/restaurant/index.php'</script>";
    }

    ?>

    <div class="d-flex flex-column me-0 min-vh-100">
        <header>
            <!-- Header -->
            <?php include 'header.php'; ?>
        </header>

        <!-- Hero -->
        <div id="hero" class="d-flex h-100 flex-grow-1 align-items-center justify-content-center mx-5">
            <div class="d-flex">
                <div class="col-md-6 d-flex flex-column flex-grow-1 justify-content-center">
                    <div class="col-12  text-muted">
                        <h6>Group dining made convenient.</b>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h1 class="display-5 fw-bold">Find your next meal <br>with <span style="color:var(--orange)">KiraMakan</span>.
                        </h1>
                    </div>
                    <div class="col-md-12 mt-4">
                        <p class="fs-6 pb-3 lead">
                            <span style="color:var(--orange); font-weight:bolder;">KiraMakan</span> is a food ordering web application designed to improve group dining experience.
                            Enjoy various features such as <span style="color:#ef4207;">group payment calculation</span>,
                            and <span style="color:#ef4207;">send payment receipt</span>
                            to ease your problems when eating out in a group. Just register an account and you can enjoy the perks above.
                        </p>
                    </div>
                    <div class="col-md-12 mt-4 d-flex">
                        <a href="restaurantOptions.php" class="btn orange-btn fs-5">Order now</a>
                    </div>
                </div>

                <div class="col-md-6 ps-5 d-flex h-100 align-items-stretch flex-row">
                    <div class="col-md-5 d-flex gap-3 flex-column pe-3">
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <img src="images/coffee.png" class="object-fit-cover img-fluid rounded h-100" alt="Coffee">
                        </div>
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <img src="images/noodles.png" class="img-fluid rounded h-100 w-100 object-fit-cover" alt="Noodles">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="col-md-12 h-100">
                            <img src="images/pastries.jpg" class="img-fluid rounded h-100 " alt="Pastries">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class=" restaurant-carousel mt-2 d-flex justify-content-center align-items-center" id="restaurant-carousel">
        <div class="row me-0">
            <div class="col-12 d-flex justify-content-center mt-5 ">
                <h1 class="display-5 fw-bold" style="color:var(--primary)">Our <span style="color:var(--orange)">Restaurant</span> Partners</h1>
            </div>

            <div id="myCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                <?php
                include './includes/connection.inc.php';
                $sql = "SELECT * FROM Restaurants";
                $run = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_all($run, MYSQLI_ASSOC);
                ?>

                <!-- Wrapper for slides -->
                <div class="carousel-inner py-5">
                    <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="row gap-4 d-flex justify-content-evenly">
                                <?php for ($j = $i; $j < $i + 3 && $j < count($rows); $j++) { ?>
                                    <div class="col d-flex justify-content-center align-items-center">
                                        <div class="card" style="height:350px; width:250px">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <img src="images/restaurants/<?php echo $rows[$j]['restaurantName']; ?>/<?php echo $rows[$j]['restaurantURL']; ?>" class="card-img-top" style="width:70%" alt="<?php echo $rows[$j]['restaurantName']; ?>">
                                            </div>
                                            <div class="mx-3" style="border-top:2px solid var(--orange)"></div>
                                            <div class="card-body ">
                                                <p class="card-title fw-bold" style="font-size:20px;"><?php echo $rows[$j]['restaurantName']; ?></p>
                                                <p class="card-text" style="font-size:13px;"><?php echo $rows[$j]['restaurantDescription']; ?></p>
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
            <div class="col-12 d-flex justify-content-center mb-5">
                <a href="restaurantOptions.php" class="btn orange-btn fs-4">Explore All</a>
            </div>

            <?php include 'includes/customer/restaurantModal.inc.php'; ?>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center objective px-5 py-5 m-0 w-100">
        <div class="d-flex flex-column col-md-6">
            <h2 class="display-5 fw-bold ms-5">Our best<span style="color:var(--orange)"> features</span>!</h2>
            <div class="col d-flex flex-row ms-5 mt-3">
                <div class="col-md-1 d-flex justify-content-start align-items-start">
                    <img src="images/tick.png" class="img-fluid rounded" style="width:90%" alt="Food">
                </div>
                <div class="col-md-11 d-flex flex-column mt-4 ms-3">
                    <h3 class="fw-bold">Improve group dining experience</h3>
                    <p class="text-muted">KiraMakan address the inconvenience of calculating payback during group dining.</p>
                </div>
            </div>
            <div class="col d-flex flex-row ms-5 mt-3">
                <div class="col-md-1 d-flex justify-content-start align-items-start">
                    <img src="images/tick.png" class="img-fluid rounded" style="width:90%" alt="Food">
                </div>
                <div class="col-md-11 d-flex flex-column mt-4 ms-3">
                    <h3 class="fw-bold">Convenient payback request</h3>
                    <p class="text-muted">Implement an automatic email notification system to inform payees of their payback amount.</p>
                </div>
            </div>
            <div class="col d-flex flex-row ms-5 mt-3">
                <div class="col-md-1 d-flex justify-content-start align-items-start">
                    <img src="images/tick.png" class="img-fluid rounded" style="width:90%" alt="Food">
                </div>
                <div class="col-md-11 d-flex flex-column mt-4 ms-3">
                    <h3 class="fw-bold">Affordable food ordering platform</h3>
                    <p class="text-muted">Streamline restaurant management operations for improved efficiency.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="images/mobilePayment.png" class="img-fluid rounded h-50" style="width:50%" alt="Food">
        </div>
    </div>
    <footer>
        <?php include "footer.php"; ?>
    </footer>

</body>

</html>