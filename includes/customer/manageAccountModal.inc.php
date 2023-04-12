<!-- Logout Modal -->
<div class='modal fade' id='manageAccountModalToggle' aria-hidden='true' aria-labelledby='manageAccountModalToggleLabel' tabindex='-1'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-body' id='manageAccount-modal'>
                <div class='row d-flex flex-row'>
                    <div class="col-md-12 d-flex flex-column justify-content-center align-items-center my-2">
                        <h4><strong>Manage <span style="color:var(--orange)">Account</span></strong></h4>
                        <div class="col-md-7 d-flex flex-row justify-content-between mt-2">
                            <div>
                                <h5>Remaining Balance</h5>
                            </div>
                            <div>
                                <h5>RM <span style="color:var(--orange)"><?php echo number_format($_SESSION['balance'], 2); ?></h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="images/wallet.png" alt="Wallet" class="img-fluid" style="width:45%">
                        </div>
                        <div class="d-flex flex-row gap-4 mt-3">
                            <div class="mt-3">
                                <button class="btn orange-btn" data-bs-target="#reloadModalToggle" data-bs-toggle="modal"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-wallet" viewBox="0 0 16 16">
                                            <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z" />
                                        </svg></i>Reload E-Wallet</button>
                            </div>
                            <div class="mt-3">
                                <button class="btn orange-btn" data-bs-target="#reloadModalToggle" data-bs-toggle="modal"><i class="me-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" />
                                        </svg>
                                        </svg></i>Billing Information</button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href='includes/customer/logOut.inc.php' class='btn back-btn'><i class='me-2'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill="var(--orange)" class='bi bi-box-arrow-right' viewBox='0 0 16 16'>
                                        <path fill-rule='evenodd' d='M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z' />
                                        <path fill-rule='evenodd' d='M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z' />
                                    </svg>
                                </i>Log Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/customer/reloadModal.inc.php'; ?>