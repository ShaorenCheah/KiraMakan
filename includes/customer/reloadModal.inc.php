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

<script><?php include 'reload.js'; ?></script>