<nav id="header" class="navbar navbar-expand-lg">

    <!-- Navbar collapse menu button -->
    <button class="navbar-toggler my-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar and Navitems -->
    <div class="collapse navbar-collapse mx-5 w-auto" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <div class="d-flex justify-content-center">
            <a class="navbar-brand m-0 p-0" href="index.php">
                <img src="images/KiraMakanLogo.png" alt="Bootstrap" height="50">
            </a>
        </div>
        <!-- Navbar collapse menu button -->
        
        <ul class="navbar-nav d-flex gap-4 w-auto flex-grow-1 justify-content-center align-items-center my-3">

            <li class="nav-item">
                <a class="nav-link fs-5" id="nav-home" aria-current="page" href="index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link fs-5" id="nav-restaurant" href="restaurantOptions.php">Restaurants</a>
            </li>

            <?php if (isset($_SESSION['accountID'])) {
                echo '
                 
                    <li class="nav-item">
                        <a class="nav-link fs-5" id="nav-history" href="myOrders.php">My Orders</a>
                    </li>
                    ';
            }
            ?>
        </ul>

        <!-- Navbar logo right -->
        <div class="d-flex justify-content-center gap-4">
            <?php

            if (isset($_GET["restaurantID"])) {
                echo '
                <!-- Button trigger modal -->

                <button class="btn orange-btn position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-cart" viewBox="0 0 16 16">
                       <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                </button>
                ';
            };

            if (!isset($_SESSION["accountID"])) {
                echo '
                <!-- Button trigger modal -->
                <button class="btn fs-6 px-4 white-btn"  type="button" data-bs-toggle="modal" data-bs-target="#loginModalToggle">
                
                <i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--main)" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg></i>
                Log In
                </button>

                <button class="btn fs-6 orange-btn"  data-bs-target="#userSignUpModalToggle" data-bs-toggle="modal"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                </svg></i>Sign Up</button>
                ';
                include 'includes/signUpLoginModal.inc.php';
            } else {
                echo '
                <!-- Button trigger modal -->
                <button class="btn white-btn" type="button" data-bs-toggle = "modal" data-bs-target = "#manageAccountModalToggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                </svg>
                </button>
                ';
                include 'includes/customer/manageAccountModal.inc.php';
            }
            ?>
        </div>
        <!-- Navbar logo right -->
    </div>
</nav>