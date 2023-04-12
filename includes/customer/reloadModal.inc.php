<div class="modal fade" id="reloadModalToggle" aria-hidden="true" aria-labelledby="reloadModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body m-3">
        <div class="col-md-12 d-flex flex-row justify-content-center align-items-center mt-2 mb-4">
          <h4 class="fw-bold mb-2">Reload <span style="color:var(--orange)">E-Wallet</span></h4>
        </div>

        <form class="row d-flex flex-row g-3">
          <div class="col-md-5 d-flex justify-content-end align-items-center mb-2">
            <h4 class=" me-2 my-1">RM</h4>
          </div>
          <div class="col-md-4">
            <input type="number" class="form-control" id="cashAmount" value="0.00" autocomplete="off">
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-12">
            <label for="exampleInputEmail1" class="form-label">Credit Card Holder Name</label>
            <input type="text" class="form-control" id="creditName" autocomplete="off">
          </div>
          <div class="col-md-12">
            <label for="exampleInputEmail1" class="form-label">Credit Card Number</label>
            <input type="text" class="form-control" id="creditNum" maxlength="19" placeholder="x x x x  x x x x  x x x x  x x x x" autocomplete="off">
            <div id="emailHelp" class="form-text">We currently accept <img src="images/visa.png" class="img-fluid ms-1 me-2"> <img src="images/mastercard.png" class="img-fluid"></div>
          </div>
          <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">Expiry Date</label>
            <input type="month" class="form-control" id="creditDate" placeholder="y y / m m" autocomplete="off">
          </div>
          <div class="col-md-6">
            <label for="exampleInputEmail1" class="form-label">CVV</label>
            <input type="password" class="form-control" id="creditCVV" minlength="3" maxlength="3" placeholder="x x x" autocomplete="off">
          </div>
          <div class="col-md-12 d-flex justify-content-center mt-4">
            <button type="button" class="btn orange-btn w-25" id="top-up">Top Up</button>
          </div>
        </form>

        <div class="col-12 d-flex justify-content-end mt-4">
          <button class="btn back-btn" data-bs-target="#manageAccountModalToggle" data-bs-toggle="modal"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
              </svg></i>Back
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const cashAmountInput = document.getElementById("cashAmount");
  cashAmountInput.oninput = function() {
    let cashAmount = cashAmountInput.value;

    // Remove any non-numeric characters and leading zeros
    cashAmount = cashAmount.replace(/[^0-9.]/g, '').replace(/^0+/, '');

    // Limit the cash amount to 1000
    if (parseFloat(cashAmount) > 1000) {
      cashAmount = "1000";
    }

    // Round the cash amount to 2 decimal places
    cashAmount = parseFloat(cashAmount).toFixed(2);

    // Set the formatted value back into the input field
    cashAmountInput.value = cashAmount;
  };

  const cardNumberInput = document.getElementById("creditNum");
  cardNumberInput.oninput = function() {
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
  const submitBtn = document.querySelector('#top-up');

  submitBtn.addEventListener('click', () => {

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
  });
</script>