<?php
session_start();
include 'connection.php';
$email = $_SESSION['email'];

if ($email == true && isset($_SESSION['status'])) {
    if (isset($_POST['checkToken'])) {
        $otpCode = mysqli_real_escape_string($conn, $_POST['otp']);
        $checkToken = "SELECT * FROM accounts WHERE token = $otpCode";
        $codeRes = mysqli_query($conn, $checkToken);
        if (mysqli_num_rows($codeRes) > 0) {
            $fetch_data = mysqli_fetch_assoc($codeRes);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $_POST['otp'];
            echo "<script>alert('Please create a new password.'); window.location='newPassword.php'</script>";
            exit();
        } else {
            echo "<script>alert('Invalid code. Please check again.'); window.location='resetToken.php'</script>";
        }
    }

} else {
    echo "<script>alert('Please request for an OTP first.'); window.location='forgotPassword.php'</script>";
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
        <div class="card">
            <div class="card-header">
                <h5>Enter OTP</h5>
            </div>
            <div class="card-body">
                <form action="resetToken.php" method="post" autocomplete="off">
                    <div class="form-group mb-3">
                        <label for="otp">OTP:</label>
                        <input type="text" class="form-control" id="otp" name="otp" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="checkToken">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>