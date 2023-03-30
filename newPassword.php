<?php
session_start();
$email = $_SESSION['email'];

if (isset($_SESSION['token']) || $email == true) {

    include './includes/connection.inc.php';

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
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-lock" viewBox="0 0 16 16">
                                        <path
                                            d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                    </svg>
                                </span>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" required autocomplete="off">
                                    <label for="password">New Password</label>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-check2-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                        <path
                                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                    </svg>
                                </span>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="repeatPassword"
                                        name="repeatPassword" placeholder="Repeat Password" required autocomplete="off">
                                    <label for="repeatPassword">Repeat Password</label>
                                </div>
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