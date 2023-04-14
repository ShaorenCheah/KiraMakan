<?php
$filtervalues = $_GET['search'] ?? "";
// Check if the page number parameter is set, if not default to 1
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

// Set the number of records to display per page and calculate the offset
$no_of_records_per_page = 5;
$offset = ($pageno - 1) * $no_of_records_per_page;

// Get the restaurant ID from the session
$restaurantID = $_SESSION['restaurantID'];
$restaurantName = $_SESSION['restaurantName'];

// Query the database to get the total number of menu items from menu table
$sql = "SELECT COUNT(*) FROM menu WHERE restaurantID = '$restaurantID' AND CONCAT(itemName,category,itemDescription,itemPrice,availability) LIKE '%$filtervalues%';";

// Execute the query and get the total number of rows
$result = mysqli_query($conn, $sql);
$total_rows = mysqli_fetch_array($result)[0];

// Calculate the total number of pages based on the total number of rows and number of records per page
$total_pages = ceil($total_rows / $no_of_records_per_page);

// Query the database to get the menu items from menu table
$sql = "SELECT * FROM menu WHERE restaurantID = '$restaurantID' AND CONCAT(itemName,category,itemDescription,itemPrice,availability) LIKE '%$filtervalues%' LIMIT $offset, $no_of_records_per_page;";

// Execute the query and check if any rows were returned
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Loop through the results and display each order in a table row
    if (isset($_GET['pageno'])) {
        $count = $offset + 1;
    } else {
        $count = 1;
    }
    
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <th scope='row'>
                <?= $count ?>
            </th>
            <td>
                <?= $row["menuID"] ?>
            </td>
            <td>
                <?= $row["itemName"] ?>
            </td>
            <td>
                <?= $row["itemDescription"] ?>
            </td>
            <td>
                <?= $row["category"] ?>
            </td>
            <td>
                <?= $row["itemPrice"] ?>
            </td>
            <td>
                <img src="../images/restaurants/<?= $restaurantName ?>/menu/<?= $row['menuURL'] ?>" class="rounded img-fluid my-1 w-25" alt="Item Image">
            </td>
            <td>
                <?= $row["availability"] ?>
            </td>
            <td>
                <form>
                    <?php
                    if ($row['availability'] == 'Available') {
                        $text = "Disable";
                        $type = "btn-danger";
                    } else {
                        $text = "Enable";
                        $type = "btn-success";
                    }

                    echo '<button class="btn ' . $type . ' menu-availability" value="' . $row['availability'] . '" id="' . $row['menuID'] . '" name="manageMenu">' . $text . '</button>';
                    ?>
                </form>
            </td>
        </tr>

<?php $count++;
    }
} else {
    // If no rows were returned, display a message in a table row
    echo "<tr><td colspan='9'>No records found.</td></tr>";
}

// Return the total number of pages for pagination 
return $total_pages;

?>