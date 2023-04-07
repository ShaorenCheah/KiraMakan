<div class="col-md-2 min-vh-100  d-flex flex-column sidebar p-0 ps-2">
    <div class="d-flex justify-content-center align-items-center w-100">
        <img src="../images/KiraMakanLogo.png" class="img-fluid m-3 pt-3" style="width:60%" alt="Responsive image">
    </div>
    <ul class="navbar-nav d-flex justify-content-center align-items-start flex-fill ps-4 ms-3 pt-4">
        <h6 class="lead text-muted" style="font-size:11px;">CONTENT</h6>
        <li class="nav-item d-flex flex-row align-items-center">
            <i class="me-3 pb-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)"
                    class="bi bi-house" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                </svg></i><a class="nav-link active d-flex justify-content-center fs-6" aria-current="page"
                href="index.php">Home</a>
        </li>
        <li class="nav-item d-flex flex-row align-items-center">
            <i class="me-3 pb-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--orange)"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg></i>
            <a class="nav-link d-flex justify-content-center fs-6" href="manageMenu.php">Manage Menu</a>
        </li>
    </ul>

    <div class="d-flex justify-content-center align-items-center w-100 my-5">
        <button class="btn orange-btn me-3" type="button" data-bs-toggle="modal" data-bs-target="#logOutModalToggle">
            Log Out?
        </button>
        <?php include 'logoutModal.php'; ?>
    </div>
</div>