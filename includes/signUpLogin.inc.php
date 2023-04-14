<?php
include './connection.inc.php';
if (isset($_POST['loginSubmit'])) {

    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT * FROM accounts WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $fetch = mysqli_fetch_assoc($result);
        $hashedPassword = $fetch['password'];

        if (password_verify($password, $hashedPassword) && $fetch['email'] == $email) {

            $_SESSION['email'] = $email;
            $_SESSION['accountID'] = $fetch['accountID'];
            $_SESSION['accountType'] = $fetch['accountType'];

            if ($_SESSION['accountType'] == "Customer") {
                $stmt = mysqli_prepare($conn, "SELECT * FROM customers WHERE accountID = ?");
                mysqli_stmt_bind_param($stmt, "s", $fetch['accountID']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_assoc($result);

                $_SESSION['customerName'] = $data['customerName'];
                $_SESSION['customerID'] = $data['customerID'];
                $_SESSION['balance'] = $data['balance'];
                echo "<script>alert('Successful Login! Welcome " . $_SESSION['customerName'] . "!'); window.location='../index.php'</script>";
            } else {
                $stmt = mysqli_prepare($conn, "SELECT * FROM restaurants WHERE accountID = ?");
                mysqli_stmt_bind_param($stmt, "s", $fetch['accountID']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_assoc($result);
                $_SESSION['restaurantName'] = $data['restaurantName'];
                $_SESSION['restaurantID'] = $data['restaurantID'];
                echo "<script>alert('Successful Login! Welcome " . $_SESSION['restaurantName'] . "!'); window.location='../restaurant/index.php'</script>";
            }
        } else {
            echo "<script>alert('Woops! Password is Wrong.'); window.location='index.php'</script>";
        }
    } else {

        echo "<script>alert('Woops! Invalid or Wrong Email.'); window.location='index.php'</script>";
    }

    mysqli_close($conn);
} else if (isset($_POST['userRegisterSubmit'])) {



    // Define form inputs
    $customerName = $_POST['customerName'];
    $regEmail = $_POST['regEmail'];
    $phoneNo = $_POST['phoneNo'];
    $regPassword = $_POST['regPassword'];
    $regRepeatPassword = $_POST['regRepeatPassword'];
    $accountType = 'Customer';

    // Hash the password
    $hashedPassword = password_hash($regPassword, PASSWORD_DEFAULT);

    // Generate new accountID by getting the last accountID from the database and incrementing it by 1
    $sql = "SELECT accountID FROM accounts ORDER BY accountID DESC LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_accountID = $row["accountID"];
        $new_accountID_num = intval(substr($last_accountID, 1)) + 1;
    } else {
        $new_accountID_num = 1;
    }
    $new_accountID = "A" . str_pad($new_accountID_num, 4, "0", STR_PAD_LEFT);
    $stmt->close();

    // Prepare and bind parameters for account data insertion
    $stmt = mysqli_prepare($conn, "INSERT INTO accounts (accountID, email, password, accountType) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $new_accountID, $regEmail, $hashedPassword, $accountType);
    if (mysqli_stmt_execute($stmt) === FALSE) {
        echo "Error: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
    mysqli_stmt_close($stmt);

    // Get the latest customerID from customers table
    $sql = "SELECT customerID FROM customers ORDER BY customerID DESC LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_customerID = $row["customerID"];
        $new_customerID_num = intval(substr($last_customerID, 1)) + 1;
    } else {
        $new_customerID_num = 1;
    }
    $new_customerID = "C" . str_pad($new_customerID_num, 4, "0", STR_PAD_LEFT);
    $stmt->close();

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

    echo "<script>alert('Successful Registration! Welcome $customerName!'); window.location='../index.php'</script>";

    mysqli_close($conn);
}
