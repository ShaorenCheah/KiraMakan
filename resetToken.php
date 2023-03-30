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
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-shield-lock" viewBox="0 0 16 16">
                                <path
                                    d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                <path
                                    d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                            </svg>
                        </span>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="otp" name="otp" placeholder="OTP" required autocomplete="off">
                            <label for="otp">OTP</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="checkToken">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>