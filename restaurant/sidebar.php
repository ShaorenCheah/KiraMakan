<?php
$sql = "SELECT * FROM restaurants WHERE restaurantID = '$_SESSION[restaurantID]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="col-md-2 min-vh-100  d-flex flex-column sidebar p-0 ps-2">
    <div class="d-flex justify-content-center align-items-center w-100">
        <img src="../images/KiraMakanLogo.png" class="img-fluid m-3 pt-3" style="width:60%" alt="Responsive image">
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3 flex-column">
        <div class="card w-75">
            <div class="card-body d-flex justify-content-center flex-column">
                <img src="../images/restaurants/<?= $row['restaurantName'] ?>/<?= $row['restaurantURL'] ?>" class="rounded img-fluid mb-3 h-75" alt="Restaurant Logo">
                <h6 class="card-title"> <strong><?= $row['restaurantName'] ?></strong></h6>
                <p class="card-text" style="font-size:10px"><?= $row['restaurantDescription'] ?></p>
            </div>
        </div>
    </div>

    <ul class="navbar-nav d-flex justify-content-start align-items-start flex-fill ps-4 ms-3 pt-4">
        <h6 class="lead text-muted" style="font-size:11px;">CONTENT</h6>
        <li class="nav-item d-flex flex-row align-items-center">
            <i class="me-3 pb-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                </svg></i><a class="nav-link active d-flex justify-content-center fs-6" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item d-flex flex-row align-items-center">
            <i class="me-3 pb-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)" class="bi bi-clock-history" viewBox="0 0 16 16">
                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                </svg></i>
            <a class="nav-link d-flex justify-content-center fs-6" href="orderHistory.php">Order History</a>
        </li>
        <li class="nav-item d-flex flex-row align-items-center">
            <i class="me-3 pb-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--orange)" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg></i>
            <a class="nav-link d-flex justify-content-center fs-6" href="manageMenu.php">Menu</a>
        </li>
    </ul>

    <div class="d-flex justify-content-center align-items-center w-100 my-5">
        <button class="btn orange-btn me-3" type="button" data-bs-toggle="modal" data-bs-target="#logOutModalToggle">
            Log Out?
        </button>
        <?php include 'logoutModal.php'; ?>
    </div>
</div>