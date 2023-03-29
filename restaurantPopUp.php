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

            <button class="btn btn-primary" type="submit" id="submitBtn">Just me</button>

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
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="submit.php" method="GET" id="name-list">
          <label for="my-name">My Name:</label>
          <input type="text" name="my-name" id="my-name" value="Your Name" readonly>
          <label for="user-name">User Name:</label>
          <input type="text" name="user-name" id="user-name">
          <div id="slots"></div>
          <button type="button" id="add-slot">Add Slot</button>
          <input type="submit" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>