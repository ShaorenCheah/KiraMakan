<?php
$restaurantID = $_SESSION['restaurantID'];
$sql = "SELECT *
    FROM orders o
    JOIN customers c ON o.customerID = c.customerID
    WHERE o.restaurantID = '$restaurantID'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $orderID = $row['orderID'];
        $orderDate = $row['orderDate'];
        $totalPrice = $row["totalPrice"];

        echo "
        <div class='modal fade' id='orderID" . $orderID . "HistoryModal' aria-hidden='true'
            aria-labelledby='orderID" . $orderID . "HistoryModalLabel' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header d-flex justify-content-start'>
                        <h5 class='font-weight-bold mb-0'>
                            <strong>
                                Order <span style='color:var(--orange)'>#
                                    " . $orderID . "
                                </span> on <span style='color:var(--orange)'>
                                    " . $orderDate . "
                                </span>
                            </strong>
                        </h5>
                    </div>
                    <div class='modal-body' id='" . $orderID . "-modal'>
                    ";

        // query to get the menuID, quantity and price of the order
        $sql = "SELECT m.itemName, pm.quantity, m.itemPrice, SUM(pm.price) AS total_price
                FROM order_person op
                JOIN person_menu pm ON op.opID = pm.opID
                JOIN menu m ON pm.menuID = m.menuID
                WHERE op.orderID = '$orderID'
                GROUP BY m.itemName, pm.quantity, m.itemPrice";
        $result2 = mysqli_query($conn, $sql);

        while ($row2 = mysqli_fetch_assoc($result2)) {

            $itemName = $row2['itemName'];
            $quantity = $row2['quantity'];
            $unit = $row2['itemPrice'];
            $price = $row2['total_price'];

            echo
                "<div class='d-flex flex-row justify-content-between my-3'>
                    <h6>$itemName x  $quantity (RM $unit/unit)</h6>
                    <h6>RM $price</h6>
                </div>
                <div class='border-bottom'></div>";
        }

        echo "
                </div>
                    <div class='modal-footer d-flex justify-content-between align-items-center'>
                        <div class='d-flex justify-content-start'>
                            <h4 class='m-0'>Total Price: RM  $totalPrice </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
}
?>
