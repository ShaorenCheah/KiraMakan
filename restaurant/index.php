<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="accounts.js" async></script>

    <title>Kira Makan</title>

</head>

<body>

    <?php
    session_start();
    include '../includes/connection.inc.php';
    $restaurantID = $_SESSION['restaurantID'];

    if (isset($_POST['completeOrder'])) {
        $orderID = $_POST['completeOrder'];
        $sql = "UPDATE orders SET status = 'Completed' WHERE orderID = '$orderID'";
        mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Order Completed!'); window.location='index.php'</script>";
        }
    }
    ?>
    <div class="row d-flex">
        <?php include "sidebar.php"; ?>
        <div class="col-md-10 my-4 d-flex justify-content-center">
            <div class="col-md-11">
                <div class="col-md-12 d-flex flex-row">
                    <div class="col-md-3">
                        <div class="card col-md-11">
                            <div class="card-body">
                                <?php
                                $sql = "SELECT COUNT(*) as dailyOrders
                                        FROM orders
                                        WHERE restaurantID = '$restaurantID' AND DATE(orderDate) = CURDATE();";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $dailyOrders = $row['dailyOrders'];
                                }
                                ?>
                                <h6 class="card-title"><strong>Daily Orders</strong></h6>
                                <h3 class="card-text d-flex justify-content-end">
                                    <?= $dailyOrders ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card col-md-11">
                            <div class="card-body">
                                <?php
                                $sql = "SELECT SUM(totalPrice) AS dailySales
                                        FROM orders
                                        WHERE restaurantID = '$restaurantID' AND DATE(orderDate) = CURDATE();";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $dailySales = $row['dailySales'];
                                }
                                ?>
                                <h6 class="card-title"><strong>Daily Sale</strong></h6>
                                <h3 class="card-text d-flex justify-content-end">
                                <?php if($dailySales != 0){ echo "RM". $dailySales.""; } else { echo"RM 0.00"; }?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card col-md-11">
                            <div class="card-body">
                                <?php
                                $sql = "SELECT COUNT(*) as monthlyOrders
                                        FROM orders
                                        WHERE restaurantID = '$restaurantID' AND MONTH(orderDate) = MONTH(CURDATE()) AND YEAR(orderDate) = YEAR(CURDATE());";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $monthlyOrders = $row['monthlyOrders'];
                                }
                                ?>
                                <h6 class="card-title"><strong>Monthly Orders</strong></h6>
                                <h3 class="card-text d-flex justify-content-end">
                                    <?= $monthlyOrders ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card col-md-11">
                            <div class="card-body">
                                <?php
                                $sql = "SELECT SUM(totalPrice) AS monthlySales
                                        FROM orders
                                        WHERE restaurantID = '$restaurantID' AND MONTH(orderDate) = MONTH(CURDATE()) AND YEAR(orderDate) = YEAR(CURDATE());";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $monthlySales = $row['monthlySales'];
                                }
                                ?>
                                <h6 class="card-title"><strong>Monthly Sales</strong></h6>
                                <h3 class="card-text d-flex justify-content-end">
                                    <?php if($monthlySales != 0){ echo "RM". $monthlySales.""; } else { echo"RM 0.00"; }?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="row m-0 mt-3 me-3 d-flex flex-column justify-content-center align-items-center g-3 flex-grow-1">
                    <div class="col-md-12">
                        <?php $today = date("Y-m-d"); ?>
                        <h4>Todays Order (
                            <?= $today ?>)
                        </h4>
                    </div>
                    <div class="col-md-12">
                        <table
                            class="table table-borderless table-hover table-striped text-center align-middle table-bordered"
                            style="white-space: nowrap; font-size:14px;" id="dashboard-table">

                            <thead class="text-wrap m-auto p-auto table-dark ">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Order Time</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>

                            <tbody class="text-wrap m-auto p-auto table-group-divider">
                                <?php include "../includes/restaurant/displayOrderToday.inc.php"; ?>
                            </tbody>
                        </table>
                        <?php include "../includes/restaurant/displayOrderTodayModal.inc.php"; ?>
                    </div>
                </div>
                <div class="col-md-12 w-100 h-auto d-flex justify-content-center">
                    <div class="d-flex justify-content-center align-items-center my-4 position-fixed bottom-0"
                        id="pagination">
                        <?php
                        if ($pageno > 1) {
                            echo "<a href='index.php?pageno=" . ($pageno - 1) . "' class='fs-5 px-3 py-1 d-flex' ><i class='fa fa-angle-left big' ></i></a>";
                        }

                        for ($i = 0; $i < $total_pages; $i++) {
                            echo "<a href='index.php?pageno=" . ($i + 1) . "' class='fs-4 px-3 py-1 d-flex'>" . ($i + 1) . "</a>";
                        }
                        if ($i > $pageno) {
                            echo "<a href='index.php?pageno=" . ($pageno + 1) . "' class='fs-5 px-3 py-1 d-flex'><i class='fa fa-angle-right big'></i></a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    let selectedOrderID = '';
    const orderButtons = document.querySelectorAll('.order-button');

    orderButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedOrderID = button.value;
            console.log(selectedOrderID)
        });
    });
</script>

</html>