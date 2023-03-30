<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="accounts.js" async></script>

    <title>Kira Makan</title>
</head>

<body>
    <?php
    session_start();
    $orderID = $_GET['orderID'];
    include './includes/connection.inc.php';
    $sql = "SELECT orderDate, totalPrice FROM orders WHERE orderID = '$orderID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $orderDate = $row['orderDate'];
    $totalPrice = $row['totalPrice'];
    ?>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container col-5 h-100 my-4">
        <div class="card w-100">
            <div class="card-header">
                Order <strong>#<?= $orderID ?></strong> on <strong><?= $orderDate ?></strong>
            </div>
            <div class="card-body">
                <?php
                $sql = "SELECT * FROM order_person WHERE orderID = '$orderID'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $opID = $row['opID'];
                        $personName = $row['personName'];

                        echo "<h5 class='mt-3'>$personName</h5>";

                        $sql = "SELECT * FROM order_item_person WHERE opID = '$opID'";
                        $result2 = mysqli_query($conn, $sql);
                        $sum = 0;

                        while($row2 = mysqli_fetch_assoc($result2)){
                            $menuID = $row2['menuID'];
                            $quantity = $row2['quantity'];
                            $price = $row2['price'];
                            $sum += $price;
                            $sql = "SELECT * FROM menu WHERE menuID = '$menuID'";
                            $result3 = mysqli_query($conn, $sql);
                            $row3 = mysqli_fetch_assoc($result3);

                            $itemName = $row3['itemName'];
                            $unit = $row3['itemPrice'];
                            echo"<p>$itemName x $quantity (RM ".$unit."/unit)</p>";
                            echo"<p>RM ".$price."</p>";
                        }
                        echo"<p class='d-flex justify-content-end'>Total : RM ".$sum."</p>";
                        echo"<div class='cart-item mb-4'></div>";
                    }
                        echo"<h5 class='d-flex justify-content-end'>Grand Total : <strong>RM ".$totalPrice."</strong></h5>";
                } else {
                    echo "No results found";
                }
                ?>
            </div>
        </div>
    </div>


</body>

</html>