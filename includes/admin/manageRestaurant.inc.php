<?php
include '../includes/connection.inc.php';

// Query the database to get restaurant details
$sql = "SELECT * FROM restaurants";

// Execute the query and check if any rows were returned
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)) {
    // Loop through the results and display each order in a table row
    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <th scope='row'>
                <?= $count ?>
            </th>
            <td>
                <?= $row["restaurantID"] ?>
            </td>
            <td>
                <?= $row["restaurantName"] ?>
            </td>
            <td>
                <?= $row["status"] ?>
            </td>
            <td>
                <form action="index.php" method="POST">
                    <?php
                    if ($row['status'] == 'Open') {
                        echo '<button class="btn btn-danger" value="' . $row['restaurantID'] . '" id="' . $row['restaurantID'] . '" name="manageRestaurant">Close</button>';
                        echo '<input type="hidden" name="status" value="Open">';
                    } else if ($row['status'] == 'Close') {
                        echo '<button class="btn btn-success" value="' . $row['restaurantID'] . '" id="' . $row['restaurantID'] . '" name="manageRestaurant">Open</button>';
                        echo '<input type="hidden" name="status" value="Close">';
                    } else {
                        echo 'error';
                    }
                    ?>
                </form>
            </td>
        </tr>

        <?php $count++;
    }
} else {
    // If no rows were returned, display a message in a table row
    echo "<tr><td colspan='6'>No records found.</td></tr>";
}
?>