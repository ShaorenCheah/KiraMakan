if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

function ready() {

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

    function removeCartItem(event) {
        var buttonClicked = event.target;
        buttonClicked.parentElement.parentElement.remove();
        updateCartTotal();
    };

    function quantityChanged(event) {
        var input = event.target;
        if (isNaN(input.value) || input.value <= 0) {
            input.value = 1;
        }
        updateCartTotal();
    };

    function addToCartClicked(event) {
        var button = event.target;
        var shopItem = button.closest('.shop-item-details');
        var title = shopItem.getElementsByClassName('menu-item-name')[0].value;
        var quantity = shopItem.querySelector('input[name="quantity"]').value; 
        var price = shopItem.getElementsByClassName('menu-item-price')[0].value;
        var menuID = shopItem.getElementsByClassName('menu-item-id')[0].value;
        console.log(quantity);
        addItemToCart(title, quantity, price, menuID);
        updateCartTotal();
    };


    function addItemToCart(title, quantity, price, menuID) {
        var cartItems = document.getElementsByClassName('cart-items')[0];
        var cartItemsID = cartItems.getElementsByClassName('menu-item-id');

        // Check if item already exists in cart
        for (var i = 0; i < cartItemsID.length; i++) {
            var cartItemId = cartItemsID[i].value;
            if (cartItemId == menuID) {
                alert('This item is already added to the cart');
                return;
            };
        };

        var cartRow = document.createElement('div');
        cartRow.classList.add('cart-row');
        var cartRowContents = `
          <div class="cart-item cart-column">
            <span class="cart-item-title">${title}</span>
            <input class="menu-item-id" type="hidden" value="${menuID}">
          </div>
          <div class="cart-price cart-column">RM ${price}</div>
          <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="${quantity}">
            <button class="btn btn-danger" type="button">REMOVE</button>
          </div>
        `;
        cartRow.innerHTML = cartRowContents;
        cartItems.append(cartRow);
        cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem);
        cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged);
    };


    function updateCartTotal() {
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        var cartRows = cartItemContainer.getElementsByClassName('cart-row');
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

};