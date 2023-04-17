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
        $salesTotal = $row["salesTotal"];
        $serviceTotal = $row["serviceTotal"];

        echo "
        <div class='modal fade' id='orderID" . $orderID . "HistoryModal' aria-hidden='true'
            aria-labelledby='orderID" . $orderID . "HistoryModalLabel' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header d-flex justify-content-start'>
                        <h5 class='fw-bold mb-0'>
                                Order <span style='color:var(--orange)'>#" . $orderID . "
                                </span> on <span style='color:var(--orange)'>
                                    " . $orderDate . "
                                </span>
                        </h5>
                    </div>
                    <div class='modal-body' id='" . $orderID . "-modal'>
                    ";

        // query to get the menuID, quantity and price of the order
        $sql = "SELECT i.itemName, pi.quantity, i.itemPrice, SUM(pi.price) AS total_price
                FROM order_person op
                JOIN person_item pi ON op.opID = pi.opID
                JOIN items i ON pi.itemID = i.itemID
                WHERE op.orderID = '$orderID'
                GROUP BY i.itemName, pi.quantity, i.itemPrice";
        $result2 = mysqli_query($conn, $sql);
        $subtotal = 0;
        while ($row2 = mysqli_fetch_assoc($result2)) {

            $itemName = $row2['itemName'];
            $quantity = $row2['quantity'];
            $unit = $row2['itemPrice'];
            $price = $row2['total_price'];
            $subtotal += $price;
            echo
            "<div class='d-flex flex-row justify-content-between my-3'>
                    <h6>$itemName x  <span style='color:var(--orange)'>$quantity</span> (RM $unit/unit)</h6>
                    <h6>RM $price</h6>
                </div>
                ";
        }

?>
        </div>
        <div class='modal-footer mx-2'>
            <div class="d-flex flex-column col-12 justify-content-end">
                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                    <p class="mb-0" style="font-size:12px">Subtotal</p>
                    <p class="mb-0" style="font-size:12px">RM <?= number_format($subtotal, 2) ?></p>
                </div>
                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                    <p class="mb-0" style="font-size:12px">Service Tax (10%)</p>
                    <p class="mb-0" style="font-size:12px">RM <?= $serviceTotal ?></p>
                </div>
                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                    <p class="mb-0" style="font-size:12px">Sales Tax (6%)</p>
                    <p class="mb-0" style="font-size:12px">RM <?= $salesTotal ?></p>
                </div>
                <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                    <p class="mb-0" style="font-size:12px">Cash Rounding</p>
                    <p class="mb-0" style="font-size:12px">RM <?= number_format($totalPrice - $subtotal - $salesTotal - $serviceTotal, 2) ?></p>
                </div>
                <div class="d-flex flex-row justify-content-between gap-1 mb-1 mt-2">
                    <h4 class="mb-0"><strong>Grand Total</strong><span class="text-muted" style="font-size:13px"> (rounded price)</span></h4>
                    <h4 class="mb-0"><strong>RM <span style="color:var(--orange)"><?= $totalPrice ?></span></strong></h4>

                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
<?php
    }
}
?>