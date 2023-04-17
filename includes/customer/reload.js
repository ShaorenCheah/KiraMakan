if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}
function ready() {
    function getRestaurantIDFromURL() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('restaurantID');
    }

    const cashAmountInput = document.getElementById("cashAmount");
    cashAmountInput.oninput = function () {
        let cashAmount = cashAmountInput.value;

        // Remove any non-numeric characters and leading zeros
        cashAmount = cashAmount.replace(/[^0-9.]/g, '').replace(/^0+/, '');

        // Limit the cash amount to 10000
        if (parseFloat(cashAmount) > 1000) {
            cashAmount = "1000";
        }

        // Round the cash amount to 2 decimal places
        cashAmount = parseFloat(cashAmount).toFixed(2);

        // Set the formatted value back into the input field
        cashAmountInput.value = cashAmount;
    };

    const cardNumberInput = document.getElementById("creditNum");
    cardNumberInput.oninput = function () {
        let cardNumber = cardNumberInput.value.replace(/[\s\-]/g, "");

        if (cardNumber.length > 16) {
            cardNumber = cardNumber.slice(0, 16);
        }

        if (cardNumber.length > 4 && cardNumber.length < 9) {
            cardNumber = cardNumber.slice(0, 4) + " " + cardNumber.slice(4);
        } else if (cardNumber.length > 8 && cardNumber.length < 13) {
            cardNumber = cardNumber.slice(0, 4) + " " + cardNumber.slice(4, 8) + " " + cardNumber.slice(8);
        } else if (cardNumber.length > 12 && cardNumber.length < 17) {
            cardNumber = cardNumber.slice(0, 4) + " " + cardNumber.slice(4, 8) + " " + cardNumber.slice(8, 12) + " " + cardNumber.slice(12);
        }

        cardNumberInput.value = cardNumber;
    };

    function validateCreditCardDetails(cashAmount, creditName, creditNum, creditDate, creditCVV) {
        const namePattern = /^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$/;

        // Remove any spaces or dashes from the card number
        creditNum = creditNum.replace(/[\s\-]/g, "");

        const expiryDatePattern = /^(0[1-9]|1[0-2])\/\d{2}$/;

        // Check if the CVV input has a value of exactly 3 digits
        const cvvPattern = /^\d{3}$/;

        // Check if any input field is blank or none
        if (creditName === "" || creditNum === "" || creditDate === "" || creditCVV === "" ||
            creditName === "none" || creditNum === "none" || creditDate === "none" || creditCVV === "none") {
            alert("Please fill in all the required fields.");
            return false;
        }

        if (cashAmount == "0.00") {
            alert("Please enter a valid amount.");
            return false;
        }

        if (!namePattern.test(creditName)) {
            alert("Please enter a valid name.");
            return false;
        }

        if (!/^\d{16}$/.test(creditNum)) {
            alert("Please enter a valid 16-digit credit card number.");
            return false;
        }

        if (!cvvPattern.test(creditCVV)) {
            alert("Please enter a valid CVV.");
            return false;
        }

        // All the credit card details have passed all checks and are valid
        return true;
    }




    // select the submit button element
    const topUpBtn = document.querySelector('#top-up');

    topUpBtn.addEventListener('click', () => {

        // get the values of the inputs
        const cashAmount = document.getElementById('cashAmount').value;
        const creditName = document.getElementById('creditName').value;
        const creditNum = document.getElementById('creditNum').value;
        const creditDate = document.getElementById('creditDate').value;
        const creditCVV = document.getElementById('creditCVV').value;

        if (validateCreditCardDetails(cashAmount, creditName, creditNum, creditDate, creditCVV)) {
            // create a JavaScript object with the values
            const data = {
                cashAmount,
                creditName,
                creditNum,
                creditDate,
                creditCVV
            };
            console.log(data); // log the data object
            const restaurantID = getRestaurantIDFromURL();

            if (restaurantID !== null && restaurantID !== undefined) {
                fetch('/kiramakan/includes/customer/topUp.inc.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(response => {
                        console.log(response);
                        if (response.success) {
                            alert('Top Up Success. RM' + response.cashAmount + ' has been added to your account. You now have RM' + response.balance + ' in your account.');
                            window.location.href = "/kiramakan/foodOrdering.php?restaurantID=" + restaurantID + "";
                        } else {
                            alert('Top Up Failed');
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });

            } else {
                fetch('/kiramakan/includes/customer/topUp.inc.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(response => {
                        console.log(response);
                        if (response.success) {
                            alert('Top Up Success. RM' + response.cashAmount + ' has been added to your account. You now have RM' + response.balance + ' in your account.');
                            window.location.href = "/kiramakan/index.php";
                        } else {
                            alert('Top Up Failed');
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            }
        }
    });
};