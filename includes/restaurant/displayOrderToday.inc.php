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

// Query the database to get the total number of orders for the current date and restaurant
$sql = "SELECT DISTINCT COUNT(*)
                FROM orders o  
                WHERE o.orderDate LIKE '%$today%' AND o.restaurantID = '$restaurantID' AND o.status ='Pending' ;";

// Execute the query and get the total number of rows
$result = mysqli_query($conn, $sql);
$total_rows = mysqli_fetch_array($result)[0];

// Calculate the total number of pages based on the total number of rows and number of records per page
$total_pages = ceil($total_rows / $no_of_records_per_page);

// Query the database to get the orders for the current date and restaurant
$sql = "SELECT *, TIME(o.orderDate) AS orderTime
    FROM orders o
    JOIN customers c ON o.customerID = c.customerID
    WHERE o.orderDate LIKE '%$today%' AND o.restaurantID = '$restaurantID'  AND o.status ='Pending'
    LIMIT $offset, $no_of_records_per_page;";

// Execute the query and check if any rows were returned
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // Loop through the results and display each order in a table row
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <th scope='row'><?= $count ?></th>
            <td><?= $row["orderID"] ?></td>
            <td><?= $row["customerName"] ?></td>
            <td><?= $row["orderTime"] ?></td>
            <?php $totalPrice = $row["totalPrice"]; ?>
            <td>RM <?= $row["totalPrice"] ?></td>
            <td><?= $row["status"] ?></td>
            <td><button class="btn btn-primary order-button" value="<?= $row['orderID'] ?>" id="<?= $row['orderID'] ?>" data-bs-toggle="modal" data-bs-target="#orderID<?= $row['orderID'] ?>Modal">Order</button></td>
        </tr>

        <div class='modal fade' id='orderID<?= $row["orderID"] ?>Modal' aria-hidden='true' aria-labelledby='orderID<?= $row["orderID"] ?>ModalLabel' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header d-flex justify-content-start'>
                        <?php $orderID = $row["orderID"]; ?>
                        Order <strong class="px-1">#<?= $orderID ?></strong> on <strong class="px-1"><?= $orderID ?></strong>
                    </div>
                    <div class='modal-body' id='<?= $row["orderID"] ?>-modal'>
                        <?php
                        // prepare and execute the SQL query
                        $sql = "SELECT m.*, SUM(pm.quantity) as total_ordered, SUM(pm.price) as price
                        FROM Menu m
                        INNER JOIN person_menu pm ON pm.menuID = m.menuID
                        INNER JOIN order_person op ON op.opID = pm.opID
                        INNER JOIN Orders o ON o.orderID = op.orderID
                        WHERE o.orderID = '$orderID'
                        GROUP BY m.menuID";
                        $result = mysqli_query($conn, $sql);

                        // display the results
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo 'Menu Item: ' . $row['itemName'] . '<br>';
                            echo 'Price: ' . $row['price'] . '<br>';
                            echo 'Total Ordered: ' . $row['total_ordered'] . '<br><br>';
                        }
                        ?>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-start">
                            <h4 class="m-0">Total Price: RM <?= $totalPrice ?></h4>
                        </div>
                        <form action="index.php" method="POST">
                            <button type="submit" class="btn btn-primary" name="completeOrder" value="<?= $orderID ?>">Complete Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php $count++;
    }
} else {
    // If no rows were returned, display a message in a table row
    echo "<tr><td colspan='9'>No records found.</td></tr>";
}
// Close the database connection
$conn = null;

// Return the total number of pages for pagination 
return $total_pages;

?>