<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Bootstrap/bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="Bootstrap/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js"></script>
    <title>Kira Makan</title>
</head>

<body>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>

        <!-- Hero -->
        <section id="hero">
            <div class="container d-block mt-2">
                <div class="row row-cols-2 row-container m-auto">
                    <!-- Left column -->
                    <div class="col d-flex justify-content-center align-items-center">
                        <img src="images/HeroImg.jpg" class="img-fluid">
                    </div>

                    <!-- Right column -->
                    <div class="col p-5">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="container d-block h-auto">

                                <h1 class="text-center">Group dining made <span class="text-primary">convenient</span>.</h1>

                                <div class="container d-block h-auto py-5">
                                    <p class="fs-5 text-center">
                                        <span style="color:#005fbb; font-weight:bolder;">Kira Makan</span> is a food ordering web application designed to improve group dining experience.
                                        Enjoy various features such as <span style="color:#0584ff;">group payment calculation</span>,
                                        and <span style="color:#0584ff;">send payment receipt</span>
                                        to ease your problems when eating out in a group. Just register an account and you can enjoy the perks above.
                                    </p>
                                </div>

                                <div class="container d-flex h-auto justify-content-center align-items-center">
                                    <button type="button" class="btn btn-primary fs-4">Order now</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero -->
    </header>


    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>