<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="accounts.js" async></script>

    <title>Kira Makan</title>

</head>

<body>

    <?php
    session_start();
    include '../includes/connection.inc.php';
    ?>

    <div class="row d-flex">

        <?php include 'sidebar.php'; ?>

        <div class="col-md-10 d-flex flex-row mt-4">
            <div class="col-md-4 m-4">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="row m-0 d-flex justify-content-center align-items-center">
                            <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                                <h3 class="fw-bold">Restaurant Registration</h3>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center mb-1">
                                <p class=" mb-3">Please enter restaurant details</p>
                            </div>
                            <form action="../signUpLogin.php" method="post" novalidate class="col-12 row g-4 m-0">
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="resEmail" name="resEmail"
                                            placeholder="name@example.com" required autocomplete="off">
                                        <label for="resEmail">Email address</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="resPassword" name="resPassword"
                                            placeholder="Password" required autocomplete="off">
                                        <label for="resPassword">Password</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="resRepeatPassword"
                                            name="resRepeatPassword" placeholder="Repeat Password" required
                                            autocomplete="off">
                                        <label for="resRepeatPassword">Repeat Password</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="resName" name="resName"
                                            placeholder="Name" required autocomplete="off">
                                        <label for="resName">Name</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="type" class="form-control" id="resDesc" name="resDesc"
                                            placeholder="Description" required autocomplete="off">
                                        <label for="resDesc">Description</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-12 d-flex justify-content-between my-2">
                            <label class="btn secondary-btn btn-b mx-auto px-3 d-block fs-5" for="resImage">
                                Upload Image
                                <input type="file" id="resImage" name="resImage" accept="image/*" required
                                    style="display: none;">
                            </label>
                            <button type="submit" class="btn orange-btn btn-b mx-auto px-3 d-block fs-5"
                                name="resRegisterSubmit">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>