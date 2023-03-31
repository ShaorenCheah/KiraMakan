<nav id="header" class="navbar navbar-expand-lg row p-2 py-4 m-0">

    <!-- Navbar brand -->
    <div class="col-2 w-auto">
        <a class="navbar-brand h-auto" href="index.php">
            <img src="../images/KiraMakanLogoPrimary.jpg" alt="Bootstrap" height="55">
        </a>
    </div>
    <!-- Navbar brand -->

    <!-- Navbar collapse menu button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar collapse menu button -->

    <!-- Navbar and Navitems -->
    <div class="collapse navbar-collapse col-10 " id="navbarSupportedContent">
        <div class="d-flex justify-content-around align-items-center flex-fill">
            <ul class="navbar-nav me-25">
                <div class="w-auto">
                    <li class="nav-item p-2 px-4">
                        <a class="nav-link active fs-4" aria-current="page" href="index.php">Home</a>
                    </li>
                </div>
                <div class="w-auto p-2 px-4">
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="orderHistory.php">Order History</a>
                    </li>
                </div>
                <div class="w-auto p-2 px-4">
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="#">Menu Items</a>
                    </li>
                </div>
            </ul>
        </div>
        <!-- Navbar logo right -->
        <div class="w-auto d-flex align-items-center justify-content-center">
            <?php



            echo '
                <!-- Button trigger modal -->
                <button class="btn me-3" type="button" data-bs-toggle = "modal" data-bs-target = "#logOutModalToggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                </svg>
                </button>
                ';
            include 'logOutModal.php';


            ?>
        </div>
        <!-- Navbar logo right -->
    </div>

    <!-- Navbar and Navitems -->

</nav>