<?php
session_start();
include './includes/connection.inc.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="includes/accounts.js"></script>
    <link rel="shortcut icon" href="images/KiraMakanIcon.png" type="image/x-icon">
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
                            <h3 class="fw-bold text-uppercase">Forgot Password</h3>
                        </div>
                        <div class="col-12 w-auto d-flex justify-content-center align-items-center mb-3">
                            <p class="text-muted">Please enter the OTP sent to your email</p>
                        </div>
                        <form action="resetToken.php" class="col-12 w-100 d-flex flex-column justify-content-center align-items-center" novalidate method="post" autocomplete="off" onsubmit="return validateOTPForm()">
                            <div class="form-floating w-50">
                                <input type="text" class="form-control" id="otp" name="otp" placeholder="OTP" maxlength="6" required autocomplete="off">
                                <label for="otp">One-Time Password</label>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="btn white-btn " name="checkToken">Submit</button>
                            </div>
                        </form>
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <a href="index.php" class="btn back-btn" ><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                                    </svg></i>Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2" style="background-color:var(--orange)"></div>
    </div>
</body>

</html>