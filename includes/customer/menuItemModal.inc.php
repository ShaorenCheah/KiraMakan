<?php
echo '
<div class="modal fade" id="' . $row['menuID'] . '" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="exampleModalToggleLabel">' . $row['itemName'] . '</h1><br>
            </div>
            <div class="modal-body d-flex h-auto flex-row w-100 container-fluid justify-content-between" id="type-modal">
                <div class=" col-12 d-flex flex-column">
                    <div class="d-flex justify-content-center">
                        <div class="shop-item-details w-100">
                            <input type="hidden" class="menu-item-id" value="' . $row['menuID'] . '">
                            <input type="hidden" class="menu-item-name" value="' . $row['itemName'] . '">
                            <input type="hidden" class="menu-item-price" value="' . $row['itemPrice'] . '">
                            <h6 class="text-muted pb-3">' . $row['itemDescription'] . '</h6>
                            <div class="row m-0">
                                <div class="col-9 d-flex align-items-center p-0">
                                    <h6 class="primary-color m-0 p-0">Quantity</h6>
                                </div>
                                <div class="col-3 p-0">
                                    <div class="input-group d-flex justify-content-end w-100">
                                        <input type="number" name="quantity" min="1" class="form-control" aria-label="Quantity" value="1" style="max-width: 80px;">  
                                    </div>                              
                                </div>                            
                                <div class="col-12 d-flex justify-content-center mt-5">
                                    <button class="btn orange-btn shop-item-button" data-bs-dismiss="modal" >Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
?>
