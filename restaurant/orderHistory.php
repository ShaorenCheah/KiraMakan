<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="accounts.js" async></script>

    <title>Kira Makan</title>

</head>

<body>

    <?php
    session_start();
    include '../includes/connection.inc.php';

    ?>

    <div class="row d-flex">
        <?php include "sidebar.php"; ?>
        <div class="col-md-10 my-4 d-flex justify-content-center">
            <div class="col-md-11 d-flex justify-content-center">
                <div class="col-md-11 h-auto">
                    <div class="row m-0 d-flex flex-column justify-content-center align-items-center g-3">
                        <div class="row m-0 mt-3 me-3 d-flex flex-column justify-content-center align-items-center g-3 flex-grow-1">
                            <div class="col-md-12">
                                <h2>Order History
                                </h2>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-borderless table-hover table-striped text-center align-middle table-bordered fs-6 " style="white-space: nowrap;" id="dashboard-table">
                                    <thead class="text-wrap m-auto p-auto table-dark ">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Customer ID</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Order Time</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-wrap m-auto p-auto table-group-divider">
                                        <?php include "../includes/restaurant/displayOrderHistory.inc.php"; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="col-md-12 w-100 h-auto d-flex justify-content-center">
                            <div class="d-flex justify-content-center align-items-center my-4 position-fixed bottom-0" id="pagination">
                                <?php
                                if ($pageno > 1) {
                                    echo "<a href='orderHistory.php?pageno=" . ($pageno - 1) . "' class='fs-5 px-3 py-1 d-flex' ><i class='fa fa-angle-left big' ></i></a>";
                                }

                                for ($i = 0; $i < $total_pages; $i++) {
                                    echo "<a href='orderHistory.php?pageno=" . ($i + 1) . "' class='fs-4 px-3 py-1 d-flex'>" . ($i + 1) . "</a>";
                                }
                                if ($i > $pageno) {
                                    echo "<a href='orderHistory.php?pageno=" . ($pageno + 1) . "' class='fs-5 px-3 py-1 d-flex'><i class='fa fa-angle-right big'></i></a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>