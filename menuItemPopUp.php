<?php
echo'
<div class="modal fade" id="'. $row['menuID'] .'" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Select number of customers</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex h-auto flex-row w-100 container-fluid justify-content-between" id="type-modal">
                <div class=" col-12 d-flex flex-column">
                    <div class="d-flex justify-content-center">
                        <div class="shop-item-details">
                            <span class="shop-item-title">'.$row['itemName'].'</span><br>
                            <span class="shop-item-price cart-price">RM '.$row['itemPrice'].'</span><br>
                            <input type="hidden" class="menu-item-id" value="'.$row['menuID'].'">
                            <button class="btn btn-primary shop-item-button" data-bs-dismiss="modal" >Order '. $row['menuID'] .' : '. $row['itemName'] .'</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
