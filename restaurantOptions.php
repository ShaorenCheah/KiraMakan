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
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container py-4 h-80">
        <div class="row col-11">
            <div class="col-12 d-flex justify-content-center my-4">
                <h1><strong>Select a restaurant</strong></h1>
            </div>


            <div id="myCarousel" class="carousel slide my-3" data-bs-ride="carousel">
                <?php
                include 'connection.php';
                $sql = "SELECT * FROM Restaurants";
                $run = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_all($run, MYSQLI_ASSOC);
                ?>

                <!-- Wrapper for slides -->
                <div class="carousel-inner pb-5">
                    <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="row">
                                <?php for ($j = $i; $j < $i + 3 && $j < count($rows); $j++) { ?>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img src="images/restaurants/<?php echo $rows[$j]['restaurantURL']; ?>" class="card-img-top" alt="<?php echo $rows[$j]['restaurantName']; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $rows[$j]['restaurantName']; ?></h5>
                                                <p class="card-text"><?php echo $rows[$j]['restaurantDescription']; ?></p>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary restaurant-button" data-bs-target="#exampleModalToggle" value="<?php echo $rows[$j]['restaurantID'] ?>" data-bs-toggle="modal"><b>Order</b></button>
                                                </div>
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
                            <button type="button" style="background-color:#005fbb;"data-bs-target="#myCarousel" data-bs-slide-to="<?php echo $i / 3; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>" aria-current="<?php echo $i == 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $i / 3 + 1; ?>"></button>
                        <?php } ?>
                    </div>
                </div>

                <!-- Left and right controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


            <?php include 'restaurantPopUp.php'; ?>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>
<script>
    const restaurantButtons = document.querySelectorAll('.restaurant-button');
    const restaurantIDInput = document.getElementById('restaurantID');
    const submitBtn = document.getElementById('submitBtn');

    let selectedRestaurantID = '';

    restaurantButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedRestaurantID = button.value;
            restaurantIDInput.value = selectedRestaurantID;
        });
    });

    submitBtn.addEventListener('click', () => {
        // Redirect to the other page
        window.location.href = 'foodOrdering.php?restaurantID=' + selectedRestaurantID + '';
    });
</script>

</html>