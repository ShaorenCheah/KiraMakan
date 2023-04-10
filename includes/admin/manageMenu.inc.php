<?php
include '../../includes/connection.inc.php';

if (isset($_POST['addItemSubmit'])) {

    // Define form inputs
    $resID = $_POST['resID'];
    $itemName = $_POST['itemName'];
    $category = $_POST['category'];
    $itemDesc = $_POST['itemDesc'];
    $itemPrice = $_POST['itemPrice'];
    $availability = 'Available';

    // Get restaurant name based on restaurant ID
    $sql = "SELECT restaurantName FROM restaurants WHERE restaurantID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $resID);
    mysqli_stmt_execute($stmt);
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $resName = $row["restaurantName"];
    } else {
        echo "<script>alert('Woops! Something went wrong. Please try again.');</script>";
        exit();
    }

    if (isset($_FILES['itemImage']) && !empty($_FILES['itemImage']['name'])) {
        //Get the uploaded image
        $file = $_FILES['itemImage'];
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        $menuURL = $fileName . "." . $fileExt;

        // Define the directory where menu images will be stored according to restaurant name
        $targetDir = "C:/xampp/htdocs/KiraMakan/images/restaurants/$resName";

        // Create directory for image upload
        if (!file_exists($targetDir . "/menu")) {
            mkdir($targetDir . "/menu");
        }

        // Define the target path of the image
        $targetPath = $targetDir . "/menu" . "/" . $menuURL;

        // Upload the image to the directory
        if (!move_uploaded_file($_FILES['itemImage']['tmp_name'], $targetPath)) {
            echo "<script>alert('Woops! Something went wrong. Please try again.');</script>";
            exit();
        } else {
            // Generate new menuID by getting the last menuID from the database and incrementing it by 1
            $sql = "SELECT menuID FROM menu ORDER BY menuID DESC LIMIT 1";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $last_menuID = $row["menuID"];
                $new_menuID_num = intval(substr($last_menuID, 1)) + 1;
            } else {
                $new_menuID_num = 1;
            }
            $new_menuID = "M" . str_pad($new_menuID_num, 4, "0", STR_PAD_LEFT);
            $stmt->close();

            // Prepare and bind parameters for menu data insertion
            $sql = "INSERT INTO menu (`menuID`, `restaurantID`, `itemName`, `category`, `itemDescription`, `itemPrice`, `menuURL`, `availability`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssssss", $new_menuID, $resID, $itemName, $category, $itemDesc, $itemPrice, $menuURL, $availability);
            if (mysqli_stmt_execute($stmt) === FALSE) {
                echo "Error: " . mysqli_stmt_error($stmt);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                exit();
            }
            mysqli_stmt_close($stmt);

            echo "<script>alert('Menu Item has been successfully added!'); window.location='http://localhost/KiraMakan/admin/manageMenu.php'</script>";

            mysqli_close($conn);

        }

    } else {
        echo "<script>alert('Woops! Something went wrong. Please try again.'); window.location='http://localhost/KiraMakan/admin/manageMenu.php'</script>";
        exit();
    }

}
?>