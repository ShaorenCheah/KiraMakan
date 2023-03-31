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
            <div id="hero" class="col-md-12 mt-5 g-5">
                <div class="row mx-5 d-flex  g-5 flex-row">
                    <div class="col-md-6 mt-5 d-flex flex-column">
                        <div class="col-12 ms-2 text-muted">
                            <h6>Group dining made convenient.</b>
                        </div>
                        <div class="col-md-12 mt-3">
                            <h1 class="display-1 fw-bold">Find your next meal <br>with <span style="color:var(--orange)">Kira Makan</span>.
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
                            <a href="restaurantOptions.php"  class="btn orange-btn fs-4">Order now</a>
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
                                <img src="images/pastries.jpg" class="img-fluid rounded h-100" alt="hero">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>