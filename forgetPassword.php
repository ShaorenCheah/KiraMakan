<?php

session_start();
include 'connection.php';

if(isset($_POST['forgetSubmit'])){
    $email = mysqli_real_escape_string($conn, $_POST['altEmail']);
    $checkEmail = "SELECT * FROM accounts WHERE email='$email'";
    $run = mysqli_query($conn, $checkEmail);

    if(mysqli_num_rows($run) > 0){
        $token = rand(999999, 111111);
        $insertCode = "UPDATE accounts SET token = $token WHERE email = '$email'";
        $run =  mysqli_query($conn, $insertCode);
        if($run){
            $subject = "Password Reset Code";
            $message = "Your password reset code is $token .";
            $sender = "From: kiramakan@outlook.com";
            if(mail($email, $subject, $message, $sender)){

                $info = "OTP sent to $email. Please check all your folders including spam.";
                $_SESSION['status'] = "Code Sent";
                $_SESSION['email'] = $email;
                echo "<script>alert('$info'); window.location='resetToken.php'</script>";
                exit();
            }else{
                echo "<script>alert('Error occured. OTP unable to sent. Please contact the administrator.'); window.location='index.php'</script>";
            }
        }else{
            echo "<script>alert('Error occured. Please contact the administrator.'); window.location='index.php'</script>";
        }
    }else{
        echo "<script>alert('This email address does not exist.'); window.location='index.php'</script>";
    }
}
?>