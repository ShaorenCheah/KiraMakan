<?php

if (isset($_POST['loginSubmit'])) {

    session_start();
    include 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $fetch = mysqli_fetch_assoc($result);
        $accountType = $fetch['accountType'];

        if ($accountType == "Restaurant") {
            $sql = "SELECT * FROM restaurants WHERE accountID = '" . $fetch['accountID'] . "'";
            $result = mysqli_query($conn, $sql);
            $fetch_name = mysqli_fetch_assoc($result);
            $name = $fetch_name['restaurantName'];
        } else if ($accountType == "Customer") {
            $sql = "SELECT * FROM customers WHERE accountID = '" . $fetch['accountID'] . "'";
            $result = mysqli_query($conn, $sql);
            $fetch_name = mysqli_fetch_assoc($result);
            $name = $fetch_name['customerName'];
        } else {
            echo "error";
        }
        
        $fetch_pass = $fetch['password'];
        if ($password == $fetch_pass) {
            $_SESSION['email'] = $email;
            $_SESSION['accountID'] = $fetch['accountID'];
            $_SESSION['accountType'] = $accountType;
            $_SESSION[$accountType . 'Name'] = $name;
            echo "<script>alert('Successful Login! Welcome $name!'); window.location='index.php'</script>"; //To be changed into redirecting to customer / restaurant index page
        } else {
            echo "<script>alert('Woops! Password is Wrong.'); window.location='index.php'</script>";
        }
        
    } else {

        echo "<script>alert('Woops! Invalid or Wrong Email.'); window.location='index.php'</script>";

    }

    mysqli_close($conn);

} else if (isset($_POST['userRegisterSubmit'])) {

    include 'connection.php';

    // Define form inputs
    $customerName = $_POST['customerName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $accountType = 'Customer';

    // Check if password and repeat password match
    if ($password !== $repeatPassword) {
        echo "<script>alert('Passwords do not match!'); window.location='index.php'</script>";
        mysqli_close($conn);
    }
    
    // Generate new accountID by getting the last accountID from the database and incrementing it by 1
    $sql = "SELECT accountID FROM accounts ORDER BY accountID DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_accountID = $row["accountID"];
        $new_accountID_num = intval(substr($last_accountID, 1)) + 1;
    } else {
        $new_accountID_num = 1;
    }
    $new_accountID = "A" . str_pad($new_accountID_num, 4, "0", STR_PAD_LEFT);

    // Insert account data into accounts table
    $sql = "INSERT INTO accounts (accountID, email, password, accountType) VALUES ('$new_accountID', '$email', '$password', '$accountType')";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        mysqli_close($conn);
        exit();
    } else {
        // Get the latest customerID from customers table
        $sql = "SELECT customerID FROM customers ORDER BY customerID DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_customerID = $row["customerID"];
            $new_customerID_num = intval(substr($last_customerID, 1)) + 1;
        } else {
            $new_customerID_num = 1;
        }
        $new_customerID = "C" . str_pad($new_customerID_num, 4, "0", STR_PAD_LEFT);

        // Insert customer data into customers table
        $sql = "INSERT INTO customers (customerID, customerName, accountID) VALUES ('$new_customerID', '$customerName', '$new_accountID')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            mysqli_close($conn);
            exit();
        } else {
            echo "<script>alert('Successful Registration! Welcome $customerName!'); window.location='index.php'</script>";
        }
    }

    mysqli_close($conn);

}

?>