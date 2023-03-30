<?php
session_start();
$email = $_SESSION['email'];

if (isset($_SESSION['token']) || $email == true) {

    include 'connection.php';

    if (isset($_POST['changePassword'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $repeatPassword = mysqli_real_escape_string($conn, $_POST['repeatPassword']);
        if ($password !== $repeatPassword) {
            echo "<script>alert('Password does not match. Please try again.'); window.location='newPassword.php'</script>";
        } else {
            $token = NULL;
            $email = $_SESSION['email']; //getting this email using session
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Kira Makan</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center mt-5 py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="newPassword.php" method="POST" autocomplete="off">
                            <div class="form-group mb-3">
                                <label for="password">New Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="repeatPassword">Repeat Password:</label>
                                <input type="password" class="form-control" id="repeatPassword" name="repeatPassword"required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="changePassword">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>