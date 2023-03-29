<?php 
session_start();
include 'connection.php';
$email = $_SESSION['email'];

if($email == true && isset($_SESSION['status'])){
    if(isset($_POST['checkToken'])){
        $otpCode = mysqli_real_escape_string($conn, $_POST['otp']);
        $checkToken = "SELECT * FROM accounts WHERE token = $otpCode";
        $codeRes = mysqli_query($conn, $checkToken);
        if(mysqli_num_rows($codeRes) > 0){
            $fetch_data = mysqli_fetch_assoc($codeRes);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $_SESSION['token']=$_POST['otp'];
            echo "<script>alert('Please create a new password.'); window.location='newpassword.php'</script>";
            exit();
        }else{
            echo "<script>alert('Invalid code. Please check again.'); window.location='resetToken.php'</script>";
        }
    }
  
} else{
    echo "<script>alert('Please request for an OTP first.'); window.location='forgotPassword.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center background container">
        <div class="form-container">
        <form action="resetcode.php" method="POST" autocomplete="off">
            <div class="text">Code Verification <a href="index.php"><span class="close" id="close1">&times;</span></a></div>
            <div class="data">
                <label for="otp">Enter the 6 digit One Time Password</label><br><br>
                <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
            </div>
            <br>
            <div class="btn-row">
                <button class="submit-btn" type="submit" name="check-reset-otp" value="Submit">Submit</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>