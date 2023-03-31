<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="accounts.js" async></script>

    <title>Kira Makan</title>

</head>

<body>

    <?php session_start() ?>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>
    <div class="row m-3">
        <div class="col-md-2 h-auto">
            <div class="row m-0 d-flex flex-column justify-content-center align-items-center g-4">
                <div class="col-md-12">
                    Info
                </div>
                <div class="col-md-12">
                    Dashboard 1
                </div>
                <div class="col-md-12">
                    Dashboard 2
                </div>
            </div>
        </div>
        <div class="col-md-10 h-auto">
            <div class="row m-0 d-flex flex-column justify-content-center align-items-center g-4">
                <div class="col-md-12">
                    Todays Order:
                </div>
                <div class="col-md-12">
                    Table
                </div>
            </div>
        </div>
    </div>

</body>

</html>