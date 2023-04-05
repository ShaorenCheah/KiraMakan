<?php
// Check if the page number parameter is set, if not default to 1
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

// Set the number of records to display per page and calculate the offset
$no_of_records_per_page = 7;
$offset = ($pageno - 1) * $no_of_records_per_page;

// Get the restaurant ID from the session
$restaurantID = $_SESSION['restaurantID'];

// Query the database to get the total number of orders that are completed for any date, any time and current restaurant
$sql = "SELECT DISTINCT COUNT(*)
                FROM orders o  
                WHERE o.restaurantID = '$restaurantID';";

// Execute the query and get the total number of rows
$result = mysqli_query($conn, $sql);
$total_rows = mysqli_fetch_array($result)[0];

// Calculate the total number of pages based on the total number of rows and number of records per page
$total_pages = ceil($total_rows / $no_of_records_per_page);

// Query the database to get the orders that are completed for any date, any time and current restaurant
$sql = "SELECT *, DATE(o.orderDate) AS orderDate, TIME(o.orderDate) AS orderTime
    FROM orders o
    JOIN customers c ON o.customerID = c.customerID
    WHERE o.restaurantID = '$restaurantID'
    LIMIT $offset, $no_of_records_per_page;";

// Execute the query and check if any rows were returned
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Loop through the results and display each order in a table row
    if(isset($_GET['pageno'])) {
        $count = $offset + 1;
    } else {
        $count = 1;
    }
    
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <th scope='row'><?= $count ?></th>
            <td><?= $row["orderID"] ?></td>
            <td><?= $row["customerID"] ?></td>
            <td><?= $row["orderDate"] ?></td>
            <td><?= $row["orderTime"] ?></td>
            <?php $totalPrice = $row["totalPrice"]; ?>
            <td>RM <?= $row["totalPrice"] ?></td>
            <td><?= $row["status"] ?></td>
            <td><button class="btn white-btn view-button" style="font-size:14px" value="<?= $row['orderID'] ?>" id="<?= $row['orderID'] ?>" data-bs-toggle="modal" data-bs-target="#orderID<?= $row['orderID'] ?>HistoryModal">View</button></td>
        </tr>

        <?php $count++;
    }
} else {
    // If no rows were returned, display a message in a table row
    echo "<tr><td colspan='7'>No records found.</td></tr>";
}

// Return the total number of pages for pagination 
return $total_pages;

?>