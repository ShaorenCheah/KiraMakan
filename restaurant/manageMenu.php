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

    <title>Kira Makan</title>

</head>

<body>

    <?php
    session_start();
    include '../includes/connection.inc.php';

    if (isset($_POST['manageMenu'])) {
        $menuID = $_POST['manageMenu'];
        $availability = $_POST['availability'];
        if ($availability == "Available") {
            $availability = "Unavailable";
            $sql = "UPDATE menu SET `availability` = '$availability' WHERE menuID = '$menuID'";
            mysqli_query($conn, $sql);
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('Menu Availability Updated!'); window.location='manageMenu.php'</script>";
            }
        } else if ($availability == "Unavailable") {
            $availability = "Available";
            $sql = "UPDATE menu SET `availability` = '$availability' WHERE menuID = '$menuID'";
            mysqli_query($conn, $sql);
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('Menu Availability Updated!'); window.location='manageMenu.php'</script>";
            }
        } else {
            echo "<script>alert('Error!'); window.location='manageMenu.php'</script>";
        }
    }

    ?>


    <div class="row d-flex">
        <?php include "sidebar.php"; ?>
        <div class="col-md-10 my-4 d-flex justify-content-center">
            <div class="col-md-11 d-flex justify-content-center">
                <div class="col-md-11 h-auto">
                    <div class="row m-0 d-flex flex-column justify-content-center align-items-center g-3">
                        <div class="row m-0  me-3 d-flex flex-row justify-content-center align-items-center g-3 flex-grow-1">
                            <div class="col-md-7 d-flex flex-column">
                                <h2 class="fw-bold">Menu</h2>
                                <h6 class="text-muted">View your menu items here</h6>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end">
                                <div class="col-md-9 ">
                                    <div class="input-group">
                                        <input type="text" class="form-control w-25" name="search" placeholder="Search menu items..." value="<?php if (isset($_GET['search'])) {
                                                                                                                                                echo $_GET['search'];
                                                                                                                                            } ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex justify-content-end">
                                    <button type="submit" id="dashboard-search" class=" btn orange-btn "><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg></i> Search</button>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <table class="table table-borderless table-hover table-striped text-center align-middle  fs-6 " style="white-space: nowrap;" id="dashboard-table">

                                    <thead class=" m-auto p-auto">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Menu ID</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Item Description</th>
                                            <th scope="col">Item Price</th>
                                            <th scope="col">Item Image</th>
                                            <th scope="col">Availability</th>
                                            <th scope="col">Manage</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-wrap m-auto p-auto table-group-divider">
                                        <?php include "../includes/restaurant/displayMenuItems.inc.php"; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 w-100 h-auto d-flex justify-content-center">
                            <ul class="d-flex justify-content-center align-items-center my-4 position-fixed bottom-0 pagination" id="pagination">
                                <?php
                                if ($pageno > 1) {

                                    echo "<li class='page-item'><a href='manageMenu.php?pageno=" . ($pageno - 1) . "' class='fs-5 px-3 py-1 d-flex page-link' ><i class='fa fa-angle-left big' ></i></a></li>";
                                }

                                for ($i = 0; $i < $total_pages; $i++) {
                                    echo "<li class='page-item'><a href='manageMenu.php?pageno=" . ($i + 1) . "' class='fs-4 px-3 py-1 d-flex page-link'>" . ($i + 1) . "</a></li>";
                                }
                                if ($i > $pageno) {
                                    echo "<li class='page-item'><a href='manageMenu.php?pageno=" . ($pageno + 1) . "' class='fs-5 px-3 py-1 d-flex page-link'><i class='fa fa-angle-right big'></i></a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

</body>

</html>