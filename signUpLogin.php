<?php

if (isset($_POST['loginSubmit'])) {

    session_start();
    include 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT * FROM accounts WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $fetch = mysqli_fetch_assoc($result);
        $accountType = $fetch['accountType'];

        if ($accountType == "Restaurant") {
            // Use prepared statement to prevent SQL injection
            $stmt = mysqli_prepare($conn, "SELECT * FROM restaurants WHERE accountID = ?");
            mysqli_stmt_bind_param($stmt, "s", $fetch['accountID']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $fetch_name = mysqli_fetch_assoc($result);
            $name = $fetch_name['restaurantName'];
        } else if ($accountType == "Customer") {
            // Use prepared statement to prevent SQL injection
            $stmt = mysqli_prepare($conn, "SELECT * FROM customers WHERE accountID = ?");
            mysqli_stmt_bind_param($stmt, "s", $fetch['accountID']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $fetch_name = mysqli_fetch_assoc($result);
            $name = $fetch_name['customerName'];
        } else {
            echo "error";
        }

        $hashedPassword = $fetch['password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['email'] = $email;
            $_SESSION['accountID'] = $fetch['accountID'];
            $_SESSION['accountType'] = $accountType;
            $_SESSION['name'] = $name;
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
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $accountType = 'Customer';

    // Check if password and repeat password match
    if ($password !== $repeatPassword) {
        echo "<script>alert('Passwords do not match!'); window.location='index.php'</script>";
        mysqli_close($conn);
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Generate new accountID by getting the last accountID from the database and incrementing it by 1
    $sql = "SELECT accountID FROM accounts ORDER BY accountID DESC LIMIT 1";
    $result = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $last_accountID);
    mysqli_stmt_fetch($result);
    if ($last_accountID !== null) {
        $new_accountID_num = intval(substr($last_accountID, 1)) + 1;
    } else {
        $new_accountID_num = 1;
    }
    $new_accountID = "A" . str_pad($new_accountID_num, 4, "0", STR_PAD_LEFT);

    // Prepare and bind parameters for account data insertion
    $stmt = mysqli_prepare($conn, "INSERT INTO accounts (accountID, email, password, accountType) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $new_accountID, $email, $hashedPassword, $accountType);
    if (mysqli_stmt_execute($stmt) === FALSE) {
        echo "Error: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
    mysqli_stmt_close($stmt);

    // Get the latest customerID from customers table
    $sql = "SELECT customerID FROM customers ORDER BY customerID DESC LIMIT 1";
    $result = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($result);
    mysqli_stmt_bind_result($result, $last_customerID);
    mysqli_stmt_fetch($result);
    if ($last_customerID !== null) {
        $new_customerID_num = intval(substr($last_customerID, 1)) + 1;
    } else {
        $new_customerID_num = 1;
    }
    $new_customerID = "C" . str_pad($new_customerID_num, 4, "0", STR_PAD_LEFT);

    // Prepare and bind parameters for customer data insertion
    $stmt = mysqli_prepare($conn, "INSERT INTO customers (customerID, customerName, phoneNo, accountID) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $new_customerID, $customerName, $phoneNo, $new_accountID);
    if (mysqli_stmt_execute($stmt) === FALSE) {
        echo "Error: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
    mysqli_stmt_close($stmt);

    echo "<script>alert('Successful Registration! Welcome $customerName!'); window.location='index.php'</script>";

    mysqli_close($conn);

}


?>