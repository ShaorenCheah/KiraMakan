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
    <?php session_start()?>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <!-- Hero -->
    <div id="hero">
        <div class="container row-container col-9 d-flex justify-content-center align-items-center mt-5 py-3 px-2">

            <!-- Left column -->
            <div class="col-4 d-flex justify-content-center align-items-center px-5">
                <img src="images/HeroImg.jpg" class="img-fluid">
            </div>

            <!-- Right column -->
            <div class="col-8 p-3 d-flex flex-column justify-content-center align-items-center h-auto ps-2">

                <h1 class="text-center pb-5"><b>Group dining made <span class="text-primary">convenient</span>.</b></h1>

                <p class="fs-5 text-center pb-5">
                    <span style="color:#005fbb; font-weight:bolder;">Kira Makan</span> is a food ordering web application designed to improve group dining experience.
                    Enjoy various features such as <span style="color:#0584ff;">group payment calculation</span>,
                    and <span style="color:#0584ff;">send payment receipt</span>
                    to ease your problems when eating out in a group. Just register an account and you can enjoy the perks above.
                </p>

                <a href="restaurantOptions.php" class="btn btn-primary fs-4">Order now</a>

            </div>

        </div>
    </div>


    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>