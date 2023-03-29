<?php 
session_start();
$email = $_SESSION['email'];

if(isset($_SESSION['token']) || $email == true){

    include 'connection.php';

    if(isset($_POST['changePassword'])){
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $repeatPassword = mysqli_real_escape_string($conn, $_POST['repeatPassword']);
        if($password !== $repeatPassword){
            echo "<script>alert('Password does not match. Please try again.'); window.location='newPassword.php'</script>";
        }else{
            $token = NULL;
            $email = $_SESSION['email']; //getting this email using session
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE accounts SET token = $token, password = '$hashedPassword' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $sql);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                echo "<script>alert('$info'); window.location='index.php'</script>";
            }else{
                echo "<script>alert('Something went wrong. Please contact the administrator'); window.location='index.php'</script>";
            }
        }
    }
}else{
    echo "<script>alert('Timed out or invalid OTP. Please request again'); window.location='forgotPassword.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="center background container">
        <div class="form-container">
        <form action="newPassword.php" method="POST" autocomplete="off">
            <div class="text">New Password <a href="index.php"><span class="close" id="close1">&times;</span></a></div>
            <div class="data">
                <label for="password">Enter your new password:</label><br><br>
                <input type="password" name="password" minlength="8" maxlength="15" placeholder="Enter password" required>
            </div><br>
            <div class="data">
                <label for="repeatPassword">Confirm your password:</label><br><br>
                <input type="password" name="repeatPassword" minlength="8" maxlength="15" placeholder="Enter password again" required>
            </div>
            <br>
            <div class="btn-row">
                <button class="submit-btn" type="submit" name="changePassword" value="Change">Change</button>
            </div>
        </form> 
        </div>
    </div>
</body>
</html>