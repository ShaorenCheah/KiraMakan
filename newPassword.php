<?php
session_start();
$email = $_SESSION['email'];

if (isset($_SESSION['token']) || $email == true) {

    include './includes/connection.inc.php';

    if (isset($_POST['changePassword'])) {
        $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
        $newRepeatPassword = mysqli_real_escape_string($conn, $_POST['newRepeatPassword']);
        if ($newPassword !== $newRepeatPassword) {
            echo "<script>alert('Password does not match. Please try again.'); window.location='newPassword.php'</script>";
        } else {
            $token = NULL;
            $email = $_SESSION['email']; //getting this email using session
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE accounts SET token = '$token', `password` = '$hashedPassword' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $sql);
            if ($run_query) {
                $info = "Your password changed. Now you can login with your new password.";
                session_destroy();
                echo "<script>alert('$info'); window.location='index.php'</script>";
            } else {
                echo "<script>alert('Something went wrong. Please contact the administrator'); window.location='index.php'</script>";
                session_destroy();
            }
        }
    }
} else {
    echo "<script>alert('Timed out or invalid OTP. Please request again'); window.location='forgotPassword.php'</script>";
}

?>

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

    <title>Kira Makan</title>
</head>

<body>
    <div class="row d-flex flex-row m-0">
        <div class="col-2" style="background-color:var(--orange)"></div>
        <div class="col-8 min-vh-100 d-flex  flex-column justify-content-around align-items-center">
            <div class="card shadow py-4 px-2">
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-12 d-flex justify-content-center align-items-center mb-5">
                            <img src="images/KiraMakanLogo.png" alt="logo" class="logo img-fluid h-50 w-50">
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center mt-4 mb-2">
                            <h3 class="fw-bold text-uppercase">Reset Password</h3>
                        </div>
                        <div class="col-12 w-auto d-flex justify-content-center align-items-center mb-3">
                            <p class="text-muted">Please enter your new password</p>
                        </div>
                        <form action="newPassword.php" class="col-12 w-100 d-flex flex-column justify-content-center align-items-center" method="POST" autocomplete="off">

                            <div class="form-floating w-50 mb-3">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password" required autocomplete="off">
                                <label for="newPassword">New Password</label>
                            </div>

                            <div class="form-floating w-50">
                                <input type="password" class="form-control" id="newRepeatPassword" name="newRepeatPassword" placeholder="Repeat Password" required autocomplete="off">
                                <label for="newRepeatPassword">Repeat Password</label>
                            </div>

                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="btn white-btn" name="changePassword">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2" style="background-color:var(--orange)"></div>
    </div>
</body>

</html>