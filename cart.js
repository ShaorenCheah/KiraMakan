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

    // Check if the restaurantID has changed and clear the cart if necessary
    if (hasRestaurantIDChanged()) {
        clearCart();
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

    // Update the 'removeCartItem' function
    function removeCartItem(event) {
        var buttonClicked = event.target;
        buttonClicked.parentElement.parentElement.remove();
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
        console.log(quantity);
        var orderNameDropdown = document.querySelector('.order-name-dropdown');
        var selectedName = orderNameDropdown.value;
        addItemToCart(title, quantity, price, menuID, selectedName);
        updateCartTotal();
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


        var cartRow = document.createElement('div');
        cartRow.classList.add('cart-row');
        var cartRowContents = `
        <div class="row">
            <div class="cart-item cart-column">
                <span class="cart-order-name">${selectedName}</span>
                <span class="cart-item-title">${title}</span>
                <input class="menu-item-id" type="hidden" value="${menuID}">
            </div>
            <div class="cart-price cart-column">RM ${price}</div>
            <div class="cart-quantity cart-column">
                <input class="cart-quantity-input" type="number" value="${quantity}">
                <button class="btn btn-danger" type="button">REMOVE</button>
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

        // Sort the cart rows based on the cart-order-name
        cartRows.sort(function (a, b) {
            var aName = a.querySelector('.cart-order-name').textContent;
            var bName = b.querySelector('.cart-order-name').textContent;
            return aName.localeCompare(bName);
        });

        // Append the sorted cart rows back to the cart
        for (var i = 0; i < cartRows.length; i++) {
            cartItemContainer.appendChild(cartRows[i]);
        }

        var total = 0;
        for (var i = 0; i < cartRows.length; i++) {
            var cartRow = cartRows[i];
            var priceElement = cartRow.getElementsByClassName('cart-price')[0];
            var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0];
            var price = parseFloat(priceElement.textContent.replace('RM ', ''));
            var quantity = parseInt(quantityElement.value);
            total += (price * quantity);
        }
        total = Math.round(total * 100) / 100;
        document.getElementsByClassName('cart-total-price')[0].innerText = 'RM ' + total.toFixed(2);
    }

    // Add this function to save the cart data to localStorage
    function saveCartData() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        localStorage.setItem('cartData', cartItemContainer.innerHTML);
    }

    // Add this function to load the cart data from localStorage
    function loadCartData() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        if (localStorage.getItem('cartData')) {
            cartItemContainer.innerHTML = localStorage.getItem('cartData');
        }
    }

    // Call loadCartData() function at the beginning
    loadCartData();

    document.getElementById('submitCart').addEventListener('click', submitCart);

    function submitCart(event) {
        event.preventDefault();
    
        var cartItems = document.getElementsByClassName('cart-items')[0];
        var cartRows = cartItems.getElementsByClassName('cart-row');
        var orderData = [];
    
        for (var i = 0; i < cartRows.length; i++) {
            var cartRow = cartRows[i];
    
            var selectedName = cartRow.getElementsByClassName('cart-order-name')[0].textContent;
            var title = cartRow.getElementsByClassName('cart-item-title')[0].textContent;
            var menuID = cartRow.getElementsByClassName('menu-item-id')[0].value;
            var price = parseFloat(cartRow.getElementsByClassName('cart-price')[0].textContent.replace('RM ', ''));
            var quantity = parseInt(cartRow.getElementsByClassName('cart-quantity-input')[0].value);
    
            orderData.push({
                name: selectedName,
                title: title,
                menuID: menuID,
                price: price,
                quantity: quantity
            });
        }
    
        // Send the orderData to your server
        sendDataToServer(orderData);
    }

    function sendDataToServer(orderData) {
        fetch('your-server-endpoint.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order submitted successfully');
            } else {
                alert('Error submitting order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error submitting order');
        });
    }
    

};