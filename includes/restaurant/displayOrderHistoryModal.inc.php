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
        $sql = "SELECT * FROM order_person WHERE orderID = '$orderID'";
        $result2 = mysqli_query($conn, $sql);

        while ($row2 = mysqli_fetch_assoc($result2)) {

            $opID = $row2['opID'];
            $sql = "SELECT * FROM person_menu WHERE opID = '$opID'";
            $result3 = mysqli_query($conn, $sql);
            $sum = 0;

            while ($row3 = mysqli_fetch_assoc($result3)) {
                $menuID = $row3['menuID'];
                $quantity = $row3['quantity'];
                $price = $row3['price'];

                $sql = "SELECT * FROM menu WHERE menuID = '$menuID'";
                $result4 = mysqli_query($conn, $sql);

                $row4 = mysqli_fetch_assoc($result4);
                $itemName = $row4['itemName'];
                $unit = $row4['itemPrice'];
                echo "Menu Item" . $itemName . "<br>";
                echo "Menu Item" . $unit . "<br><br>";
            }
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
}
