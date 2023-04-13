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
        $totalPrice = $row["totalPrice"];
        $salesTotal = $row["salesTotal"];
        $serviceTotal = $row["serviceTotal"];

        echo "
        <div class='modal fade' id='orderID" . $orderID . "Modal' aria-hidden='true' aria-labelledby='orderID" . $orderID . "ModalLabel' tabindex='-1'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header d-flex justify-content-start'>
                        Order <strong class='px-1'>#$orderID</strong> on <strong class='px-1'>$orderID</strong>
                    </div>
                    <div class='modal-body' id='" . $orderID . "-modal'>";

        // prepare and execute the SQL query

        $sql = 'SELECT m.*, SUM(pm.quantity) as total_ordered, SUM(pm.price) as price
                        FROM Menu m
                        INNER JOIN person_menu pm ON pm.menuID = m.menuID
                        INNER JOIN order_person op ON op.opID = pm.opID
                        INNER JOIN Orders o ON o.orderID = op.orderID
                        WHERE o.orderID = "' . $orderID . '"
                        GROUP BY m.menuID';

        $result2 = mysqli_query($conn, $sql);
        $subtotal = 0;
        // display the results
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo 'Menu Item:' . $row2["itemName"] . '<br>';
            echo 'Price: ' . $row2["price"] . '<br>';
            echo 'Total Ordered: ' . $row2["total_ordered"] . '<br><br>';
            $subtotal += $row2["price"];
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
                <form action='index.php' method='POST' class="d-flex justify-content-center mt-4">
                    <button type='submit' class='btn orange-btn' name='completeOrder' value='$orderID' id="orderBtn">Complete Order</button>
                </form>
            </div>
        </div>
        </div>
        </div>
        </div>
<?php
    }
}; ?>

<script>
    var viewOrderButtons = document.querySelectorAll('.view-order');
    let selectedOrderID = '';

    viewOrderButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedOrderID = button.value;
            console.log(selectedOrderID);
        });
    });

    var orderBtn = document.getElementById('orderBtn');

    orderBtn.addEventListener('click', function() {
        // Get the current URL of the page
        var url = window.location.href;

        var data = {
            type: 'Order',
            orderID: selectedOrderID,
            url: url
        };
        // send switch state to server
        sendDataToServer(data);
    });

    function sendDataToServer(data) {
        var sentData = JSON.stringify(data);

        fetch('/kiramakan/includes/restaurant/restaurantData.inc.php', {
                method: 'POST',
                body: sentData,
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.href = data.url;
                } else {
                    alert('Error updating order');
                }
            })

    }
</script>