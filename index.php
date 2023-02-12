<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Bootstrap/bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
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
            <div class="container row-container col-12 d-flex justify-content-center align-items-center mt-2 py-3 px-2">
                
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

                        <button type="button" class="btn btn-primary fs-4">Order now</button>

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