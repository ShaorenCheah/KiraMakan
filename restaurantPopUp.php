<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Select number of customers</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex h-auto flex-row w-100 container-fluid justify-content-between" id="type-modal">

        <div class=" col-6 d-flex flex-column">
          <div class="d-flex justify-content-center">

            <button class="btn btn-primary" type="button" id="submitBtn">Just me</button>

          </div>
          <div class="d-flex justify-content-center mt-3 ms-1">
            <!-- Image -->
          </div>
        </div>

        <div class=" col-6 d-flex flex-column">
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">In a group</button>
          </div>
          <div class="d-flex justify-content-center mt-3 ms-1">
            <!-- Image -->
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Add Customers Name</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="foodOrdering.php" method="GET">
          <div id="slots" class="row d-flex">
            <div class="col-1">
              <label for="user-name">1</label>
            </div>
            <div class="col-11">
              <input type="text" name="slot-1" placeholder="Enter the name here" required>
            </div>
          </div>
          <button type="button" id="add-slot">Add Slot</button>
          <input type="submit" value="Submit">
        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back</button>
      </div>
    </div>
  </div>
</div>