<?php
echo "
    <div class='modal fade modal-lg' id='orderID" . $rows['orderID'] . "Modal' aria-hidden='true' aria-labelledby='orderID" . $rows['orderID'] . "ModalLabel' tabindex='-1'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header d-flex justify-content-start'>
                    <strong> Order <span class='px-1' style='color:var(--orange)'>#" . $rows['orderID'] . "</span> on <span class='px-1' style='color:var(--orange)'>" . $rows['orderDate'] . " " . $rows['orderTime'] . "</span> @ <span class='px-1' style='color:var(--orange)'>" . $rows['restaurantName'] . "</span>
                    <input type='hidden' id='restaurantName' value='" . $rows['restaurantName'] . "'>
                    <input type='hidden' id='orderIDReceipt' value='" . $rows['orderID'] . "'></strong>
                </div>
                <div class='modal-body' id='" . $rows['orderID'] . "-modal'>";

// prepare and execute the SQL query

$subtotal = 0;
$sql = "SELECT * FROM order_person WHERE orderID = '" . $rows['orderID'] . "'";
$result2 = mysqli_query($conn, $sql);

// display the results
while ($row2 = mysqli_fetch_assoc($result2)) {
    $opID = $row2['opID'];
    $personName = $row2['personName'];
?>
    <div class="d-flex flex-row">
        <h5 class='mt-2 mb-3'><strong><?= $personName ?></strong></h5>
    </div>
    <?php
    $sql = "SELECT * FROM person_menu WHERE opID = '$opID'";
    $result3 = mysqli_query($conn, $sql);
    $sum = 0;

    while ($row3 = mysqli_fetch_assoc($result3)) {
        $menuID = $row3['menuID'];
        $quantity = $row3['quantity'];
        $price = $row3['price'];
        $sum += $price;
        $subtotal += $price;
        $sql = "SELECT * FROM menu WHERE menuID = '$menuID'";
        $result4 = mysqli_query($conn, $sql);
        $row4 = mysqli_fetch_assoc($result4);

        $itemName = $row4['itemName'];
        $unit = $row4['itemPrice'];
    ?>
        <div class="d-flex flex-row justify-content-between mb-2">
            <h6><?= $itemName ?> x <?= $quantity ?> (RM <?= $unit ?>/unit)</h6>
            <h6>RM <?= $price ?></h6>
        </div>
    <?php
    }
    ?>
    <div class='d-flex justify-content-between flex-row mt-3'>
        <?php if ($personName == $_SESSION['customerName']) {
            echo '<div class="col-7"></div>';
        } else {
            echo '
                <div class="d-flex align-items-center col-7">
                    <button class="btn white-btn d-flex align-items-center justify-content-center send-email" data-bs-target="#emailRecipientModalToggle" data-bs-toggle="modal" id="opID" value="' . $opID . '"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-envelope mb-1" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                            </svg></i>Send Receipt
                    </button>
                </div>';
        }

        $net = round($sum * 100) / 100;
        $service = $net * 0.1;
        $sales = $net * 0.06;

        $final = $net * 1.16;
        $secondDecimal = floor($final * 100) % 10;

        if ($secondDecimal <= 4) {
            $finalRounded = floor($final * 10) / 10;
        } else {
            $finalRounded = ceil($final * 10) / 10;
        }

        $service = number_format($service, 2);
        $sales = number_format($sales, 2);
        $round = number_format($finalRounded - $final, 2);
        $finalRounded = number_format($finalRounded, 2);

        ?>
        <div class="d-flex flex-column col-5">
            <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                <p class="mb-0" style="font-size:13px">Subtotal</p>
                <p class="mb-0" style="font-size:13px">RM <?= number_format($net, 2) ?></p>
            </div>
            <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                <p class="mb-0" style="font-size:13px">Service Tax (10%)</p>
                <p class="mb-0" style="font-size:13px">RM <?= $service ?></p>
            </div>
            <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                <p class="mb-0" style="font-size:13px">Sales Tax (6%)</p>
                <p class="mb-0" style="font-size:13px">RM <?= $sales ?></p>
            </div>
            <div class="d-flex flex-row justify-content-between gap-1 mb-1">
                <p class="mb-0" style="font-size:13px">Cash Rounding</p>
                <p class="mb-0" style="font-size:13px">RM <?= $round ?></p>
            </div>
            <div class="d-flex flex-row justify-content-between gap-1 mb-1">

                <h5 class="mb-0"><strong>Total</strong><span class="text-muted" style="font-size:13px"> (rounded price)</span></h5>
                <h5 class="mb-0"><strong>RM <span style="color:var(--orange)"><?= $finalRounded ?></span></strong></h5>

            </div>
        </div>
    </div>

<?php
    echo "<div class='cart-item mb-4'></div>";
}


$sql = "SELECT o.orderDate, o.serviceTotal, o.salesTotal, o.totalPrice, r.restaurantName FROM orders o, restaurants r WHERE o.restaurantID = r.restaurantID AND orderID = '" . $rows['orderID'] . "'";
$results = mysqli_query($conn, $sql);
$fetch = mysqli_fetch_assoc($results);

$orderDate = $fetch['orderDate'];
$serviceTotal = $fetch['serviceTotal'];
$salesTotal = $fetch['salesTotal'];
$totalPrice = $fetch['totalPrice'];
$restaurantName = $fetch['restaurantName'];

?>
<div class="d-flex flex-column col-12 justify-content-end">
    <div class="d-flex flex-row justify-content-between gap-1 mb-1">
        <p class="mb-0" style="font-size:14px">Subtotal</p>
        <p class="mb-0" style="font-size:14px">RM <?= number_format($subtotal, 2) ?></p>
    </div>
    <div class="d-flex flex-row justify-content-between gap-1 mb-1">
        <p class="mb-0" style="font-size:14px">Service Tax (10%)</p>
        <p class="mb-0" style="font-size:14px">RM <?= $serviceTotal ?></p>
    </div>
    <div class="d-flex flex-row justify-content-between gap-1 mb-1">
        <p class="mb-0" style="font-size:14px">Sales Tax (6%)</p>
        <p class="mb-0" style="font-size:14px">RM <?= $salesTotal ?></p>
    </div>
    <div class="d-flex flex-row justify-content-between gap-1 mb-1">
        <p class="mb-0" style="font-size:14px">Cash Rounding</p>
        <p class="mb-0" style="font-size:14px">RM <?= number_format($totalPrice - $subtotal - $salesTotal - $serviceTotal, 2) ?></p>
    </div>
    <div class="d-flex flex-row justify-content-between gap-1 mb-1">
        <h4 class="mb-0"><strong>Grand Total</strong><span class="text-muted" style="font-size:13px"> (rounded price)</span></h4>
        <h4 class="mb-0"><strong>RM <span style="color:var(--orange)"><?= $totalPrice ?></span></strong></h4>
    </div>
</div>

</div>
</div>
</div>
</div>