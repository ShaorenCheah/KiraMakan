<?php
$restaurantID = $_SESSION['restaurantID'];
$sql = "SELECT *, TIME(o.orderDate) AS orderTime
    FROM orders o
    JOIN customers c ON o.customerID = c.customerID
    WHERE o.orderDate LIKE '%$today%' AND o.restaurantID = '$restaurantID'  AND o.status ='Pending'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $orderID = $row['orderID'];    
        $totalPrice = $row["totalPrice"];
        echo "
        <div class='modal fade' id='orderID" . $orderID . "Modal' aria-hidden='true' aria-labelledby='orderID" . $orderID . "ModalLabel' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header d-flex justify-content-start'>
                        Order <strong class='px-1'>#$orderID</strong> on <strong class='px-1'>$orderID</strong>
                    </div>
                    <div class='modal-body' id='$orderID-modal'>";

        // prepare and execute the SQL query

        $sql = 'SELECT m.*, SUM(pm.quantity) as total_ordered, SUM(pm.price) as price
                        FROM Menu m
                        INNER JOIN person_menu pm ON pm.menuID = m.menuID
                        INNER JOIN order_person op ON op.opID = pm.opID
                        INNER JOIN Orders o ON o.orderID = op.orderID
                        WHERE o.orderID = "'.$orderID.'"
                        GROUP BY m.menuID';

        $result2 = mysqli_query($conn, $sql);

        // display the results
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo 'Menu Item:' . $row2["itemName"] . '<br>';
            echo 'Price: ' . $row2["price"] . '<br>';
            echo 'Total Ordered: ' . $row2["total_ordered"] . '<br><br>';
        }

        echo "
                    </div>
                    <div class='modal-footer d-flex justify-content-between align-items-center'>
                        <div class='d-flex justify-content-start'>
                            <h4 class='m-0'>Total Price: RM  $totalPrice </h4>
                        </div>
                        <form action='index.php' method='POST'>
                            <button type='submit' class='btn btn-primary' name='completeOrder' value='$orderID'>Complete Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }
}; ?>
