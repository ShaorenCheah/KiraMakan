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

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Kira Makan</title>
</head>

<body>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container col-10">
        <div class="row w-100">
            <div class="col-12 d-flex justify-content-center my-4">
                <h1>Select a restaurant</h1>
            </div>


            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <?php
                include 'connection.php';
                $sql = "SELECT * FROM Restaurants";
                $run = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_all($run, MYSQLI_ASSOC);
                ?>

                <!-- Indicators -->
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?php echo $i / 3; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>" aria-current="<?php echo $i == 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $i / 3 + 1; ?>"></button>
                    <?php } ?>
                </div>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="row">
                                <?php for ($j = $i; $j < $i + 3 && $j < count($rows); $j++) { ?>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img src="<?php echo $rows[$j]['restaurantURL']; ?>" class="card-img-top" alt="<?php echo $rows[$j]['restaurantName']; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $rows[$j]['restaurantName']; ?></h5>
                                                <p class="card-text"><?php echo $rows[$j]['restaurantDescription']; ?></p>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary restaurantButton" data-bs-target="#exampleModalToggle" value="<?php echo $rows[$j]['restaurantID'] ?>" data-bs-toggle="modal">Order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
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

</body>
<script>
    const restaurantButtons = document.querySelectorAll('.restaurantButton');
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