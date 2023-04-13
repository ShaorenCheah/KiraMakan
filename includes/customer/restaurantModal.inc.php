<div class="modal modal-lg fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body d-flex h-auto flex-column w-100 container-fluid justify-content-between my-3" id="type-modal">
        <div class="col-12 d-flex justify-content-center align-items-center mt-2 mb-4">
          <h3 class="fw-bold mb-2">Select number of customers</h3>
        </div>
        <div class="d-flex flex-row">
          <div class=" col-6 d-flex flex-column align-items-center" style="border-right: 1px solid #ccc;">
            <div class="d-flex justify-content-center my-2 ">
              <button class="btn orange-btn" type="button" id="submitBtn">Just me</button>
            </div>
            <div class="d-flex justify-content-center align-items-center">
              <!-- Image -->
              <img src="images/justMe.jpg" alt="Just me" class="img-fluid w-50 mt-2" id="justMeImg">
            </div>
          </div>

          <div class=" col-6 d-flex flex-column">
            <div class="d-flex justify-content-center my-2">
              <button class="btn orange-btn" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">In a group</button>
            </div>
            <div class="d-flex justify-content-center align-items-center">
              <!-- Image -->
              <image src="images/group.jpg" alt="In a group" class="img-fluid w-50" id="inAGroupImg">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div id="names-form" class="modal-body">
        <div class="col-12 d-flex justify-content-center align-items-center mt-2 mb-4">
          <h3 class="fw-bold mb-2">Enter customer names</h3>
        </div>
        <form id="add-names" action="foodOrdering.php" method="GET">
          <div id="slots">
            <div class="row d-flex align-items-center">
              <div class="col-1 numCol">
                <label for="user-name">1</label>
              </div>
              <div class="col-9 slotCol">
                <input type="text" name="user-name" class="form-control" placeholder="Enter name here" required autocomplete="off">
              </div>
              <div class="col-2"></div>
            </div>
          </div>
          <div class="d-flex flex-row mt-2">
            <button type="button" class="btn white-btn m-3" id="add-slot">Add Slot</button>
            <input type="submit" id="submit-btn" class="btn orange-btn m-3" value="Submit">
          </div>
        </form>
        <div class="col-12 d-flex justify-content-end">
          <button class="btn back-btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
              </svg></i>Back</button>
        </div>
      </div>
    </div>
  </div>
</div>