<?php
echo '
<div class="modal fade" id="' . $row['menuID'] . '" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">' . $row['itemName'] . '</h1><br>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex h-auto flex-row w-100 container-fluid justify-content-between" id="type-modal">
                <div class=" col-12 d-flex flex-column">
                    <div class="d-flex justify-content-center">
                        <div class="shop-item-details">
                            <input type="hidden" class="menu-item-id" value="' . $row['menuID'] . '">
                            <input type="hidden" class="menu-item-name" value="' . $row['itemName'] . '">
                            <input type="hidden" class="menu-item-price" value="' . $row['itemPrice'] . '">
                            <h6 class="primary-color pb-3">' . $row['itemDescription'] . '</h6>
                            <div class="row">
                                <div class="col-9 d-flex align-items-center">
                                    <h6 class="primary-color m-0 p-0">Quantity:</h6>
                                </div>
                                <div class="col-3 d-flex justify-content-end">
                                    <div class="input-group w-100">
                                        <input type="number" name="quantity" min="1" aria-label="Quantity" value="1" style="max-width: 80px;">  
                                    </div>                              
                                </div>                            
                                <div class="col-12 d-flex justify-content-center mt-4">
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
