<?php

if (isset($_POST['loginSubmit'])) {

    session_start();
    include 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);
        $fetch_pass = $fetch['password'];
        if (password_verify($password, $fetch_pass)) {
            $accountType = $fetch['accountType'];

            if ($accountType == "Resturant") {
                $_SESSION['accountID'] = $fetch['accountID'];
                $_SESSION['accountType'] = $accountType;
                echo "<script>alert('Successful Login! Welcome Restaurant!'); window.location='./Restaurant/dashboard.php' </script>";
            } else if ($accountType == "Customer") {
                $_SESSION['accountID'] = $fetch['accountID'];
                $_SESSION['accountType'] = $accountType;
                echo "<script>alert('Successful Login! Welcome Guest!'); window.location='index.php'</script>";
            } else {
                echo "error";
            }
        } else {
            echo "<script>alert('Woops! Email or Password is Wrong.'); window.location='index.php'</script>";
        }

    } else {
        echo "<script>alert('Woops! Invalid or Wrong Email.'); window.location='index.php'</script>";
    }


    //echo "$sql"; 

    mysqli_close($conn);

} else if (isset($_POST['userRegisterSubmit'])) {

    include 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $accountType = $_POST['accountType'];

    $sql = "INSERT INTO accounts (accountID, email, password, accountType) VALUES ('$accountID', '$email', '$password', '$accountType')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successful Registration!'); window.location='index.php'</script>";
    } else {
        echo "<script>alert('Woops! Something went wrong.'); window.location='index.php'</script>";
    }

    mysqli_close($conn);

} else {
    echo "<script>alert('You do not have access to this page.'); window.location='index.php'</script>";
}

?>