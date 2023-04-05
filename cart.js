if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

function ready() {



    // Function to get restaurantID from the URL
    function getRestaurantIDFromURL() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('restaurantID');
    }

    // Function to check if the restaurantID has changed
    function hasRestaurantIDChanged() {
        var currentRestaurantID = getRestaurantIDFromURL();
        var previousRestaurantID = localStorage.getItem('previousRestaurantID');

        if (previousRestaurantID && previousRestaurantID !== currentRestaurantID) {
            return true;
        }

        localStorage.setItem('previousRestaurantID', currentRestaurantID);
        return false;
    }

    const cartButton = document.querySelector('.btn');
    var cartItemCount = 0; // replace with actual item count from shopping cart

    const cartBadge = cartButton.querySelector('.badge');

    function clearCart() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        while (cartItemContainer.hasChildNodes()) {
            cartItemContainer.removeChild(cartItemContainer.firstChild);
        }
        updateCartTotal();
        updateCartIcon();
        localStorage.removeItem('cartData');
    }

    // Check if the restaurantID has changed and clear the cart if necessary
    if (hasRestaurantIDChanged()) {
        clearCart();
    }

    // Add this function to load the cart data from localStorage
    function loadCartData() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        if (localStorage.getItem('cartData')) {
            cartItemContainer.innerHTML = localStorage.getItem('cartData');
        }
        updateCartIcon();
    }

    // Call the existing loadCartData() function
    loadCartData();

    var removeCartItemButtons = document.getElementsByClassName('btn-danger');
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i];
        button.addEventListener('click', removeCartItem);
    };

    var quantityInputs = document.getElementsByClassName('cart-quantity-input');
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];
        input.addEventListener('change', quantityChanged);
    };

    var addToCartButtons = document.getElementsByClassName('shop-item-button');
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i];
        button.addEventListener('click', addToCartClicked);
    };

    // Add this function to save the cart data to localStorage
    function saveCartData() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        localStorage.setItem('cartData', cartItemContainer.innerHTML);
    }

    function removeCartItem(event) {
        var buttonClicked = event.target;
        buttonClicked.closest('.cart-row').remove(); // Remove the entire cart-row div
        // Update cart badge
        var cartItemCount = document.querySelectorAll('.cart-row').length;
        const cartBadge = document.querySelector('.btn .badge');
        if (cartItemCount > 0) {
            cartBadge.textContent = cartItemCount;
            cartBadge.classList.add('visible');
        } else {
            cartBadge.classList.remove('visible');
        }

        // Update cartItemCount variable
        cartItemCount = cartItemCount;
        updateCartTotal();
        saveCartData(); // Save cart data after removing an item
    }

    // Update the 'quantityChanged' function
    function quantityChanged(event) {
        var input = event.target;
        if (isNaN(input.value) || input.value <= 0) {
            input.value = 1;
        }
        updateCartTotal();
        saveCartData(); // Save cart data after changing the quantity
    }

    function addToCartClicked(event) {
        var button = event.target;
        var shopItem = button.closest('.shop-item-details');
        var title = shopItem.getElementsByClassName('menu-item-name')[0].value;
        var quantity = shopItem.querySelector('input[name="quantity"]').value;
        var price = shopItem.getElementsByClassName('menu-item-price')[0].value;
        var menuID = shopItem.getElementsByClassName('menu-item-id')[0].value;
        var orderNameDropdown = document.querySelector('.order-name-dropdown');
        var selectedName = orderNameDropdown.value;
        addItemToCart(title, quantity, price, menuID, selectedName);
        updateCartTotal();
        updateCartIcon();
        saveCartData(); // Save cart data after adding a new item
    };

    function addItemToCart(title, quantity, price, menuID, selectedName) {
        var cartItems = document.getElementsByClassName('cart-items')[0];
        var cartItemsID = cartItems.getElementsByClassName('menu-item-id');

        // Check if item already exists in cart for the same customer
        for (var i = 0; i < cartItemsID.length; i++) {
            var cartItemId = cartItemsID[i].value;
            var cartItemCustomerName = cartItemsID[i].closest('.cart-row').querySelector('.cart-order-name').textContent;
            if (cartItemId == menuID && cartItemCustomerName == selectedName) {
                alert('This item is already added to the cart under your name');
                return;
            };
        };

        // Remove the currency symbol prefix and convert the price to a float
        price = parseFloat(price.replace('RM ', ''));

        var cartRow = document.createElement('div');
        cartRow.classList.add('cart-row');
        var cartRowContents = `
        <div class="row cart-item mt-2">
            <div class="col-md-8 d-flex flex-column justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="col-8">
                    <h5 class="cart-item-title m-0">${title}</h5>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                    <span class=" ms-2 badge cart-price">RM ${price.toFixed(2)}</span>
                    </div>
                    <input class="menu-item-id" type="hidden" value="${menuID}" >
                </div>
                <span class="cart-order-name">${selectedName}</span>
            </div>
            <div class="col-md-4 cart-quantity d-flex flex-row justify-content-between align-items-center">
                <input class="cart-quantity-input form-control me-2" type="number" value="${quantity}" style="width: 60%;">
                <button class="btn btn-danger d-flex justify-content-center align-items-center" type="button" style="width: 40%;"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
              </svg></button>
            </div>
        </div>
        `;
        cartRow.innerHTML = cartRowContents;
        cartItems.append(cartRow);
        cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem);
        cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged);
        saveCartData(); // Save cart data after creating a new cart row
    };

    function updateCartTotal() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        var cartRows = Array.from(cartItemContainer.getElementsByClassName('cart-row'));

        var total = 0;
        for (var i = 0; i < cartRows.length; i++) {
            var cartRow = cartRows[i];
            var priceElement = cartRow.getElementsByClassName('cart-price')[0];
            var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0];
            if (priceElement !== undefined) {
                var price = parseFloat(priceElement.textContent.replace('RM ', ''));
                var quantity = parseInt(quantityElement.value);
                total += price * quantity;
            }
        }
        net = Math.round(total * 100) / 100;
        service = net * 0.1;
        document.getElementsByClassName('cart-service')[0].innerText = 'RM ' + service.toFixed(2);
        sales = net * 0.06;
        document.getElementsByClassName('cart-sales')[0].innerText = 'RM ' + sales.toFixed(2);

        final = net * 1.16;
        secondDecimal = Math.floor(final * 100) % 10;

        if (secondDecimal <= 4) {
            final = Math.floor(final * 10) / 10;
        } else {
            final = Math.ceil(final * 10) / 10;
        }

        document.getElementsByClassName('cart-total-price')[0].innerText = 'RM ' + final.toFixed(2);




        updateCartIcon();
    }

    function updateCartIcon() {
        var cartItemCount = document.getElementsByClassName('cart-row').length;
        var cartBadge = document.querySelector('.badge');
        if (cartItemCount > 0) {
            cartBadge.textContent = cartItemCount;
            cartBadge.classList.add('visible');
        } else {
            cartBadge.textContent = 0;
            cartBadge.classList.remove('visible');
        }
    }

    document.getElementById('submitCart').addEventListener('click', submitCart);

    function submitCart(event) {
        event.preventDefault();

        var cartItems = document.getElementsByClassName('cart-items')[0];
        var cartItemCount = cartItems.children.length;
        // Check if cart is empty
        if (cartItemCount == 0) {
            alert('Your cart is empty. Please add some items before placing your order.');
            return;
        }
        console.log('Cart item count:', cartItemCount);
        var cartRows = cartItems.getElementsByClassName('cart-row');
        var orderData = [];
        var totalPrice = parseFloat(document.getElementsByClassName('cart-total-price')[0].textContent.replace('RM ', ''));
        var restaurantID = document.getElementById('restaurantID').value;
        var servicePrice = parseFloat(document.getElementsByClassName('cart-service')[0].textContent.replace('RM ', ''));
        var salesPrice = parseFloat(document.getElementsByClassName('cart-sales')[0].textContent.replace('RM ', ''));
        for (var i = 0; i < cartRows.length; i++) {
            var cartRow = cartRows[i];

            var selectedName = cartRow.getElementsByClassName('cart-order-name')[0].textContent;
            var item = cartRow.getElementsByClassName('cart-item-title')[0].textContent;
            var menuID = cartRow.getElementsByClassName('menu-item-id')[0].value;
            var price = parseFloat(cartRow.getElementsByClassName('cart-price')[0].textContent.replace('RM ', ''));
            var quantity = parseInt(cartRow.getElementsByClassName('cart-quantity-input')[0].value);
            orderData.push({
                name: selectedName,
                menuID: menuID,
                item: item,
                price: price,
                quantity: quantity
            });
        }

        var order = {
            restaurantID: restaurantID,
            orderData: orderData,
            servicePrice: servicePrice,
            salesPrice: salesPrice,
            totalPrice: totalPrice
        };

        console.log(order);

        clearCart();
        // Send the order to your server
        sendDataToServer(order);
    }

    function sendDataToServer(orderData) {
        var formData = new FormData();
        formData.append('orderData', JSON.stringify(orderData));

        fetch('/kiramakan/includes/customer/orderFood.inc.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                console.log(response);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Order submitted successfully');
                    // Create a form element
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'orderReceipt.php';

                    // Create a hidden input field for the order ID
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'orderID';
                    input.value = data.orderID;
                    form.appendChild(input);

                    // Submit the form to redirect to the order receipt page with the order ID as a POST parameter
                    document.body.appendChild(form);
                    form.submit();
                } else {
                    alert('Error submitting order');
                }
            })

    }
    updateCartTotal();
};