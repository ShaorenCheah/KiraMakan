<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap JavaScript and jQuery libraries -->
    <title>Kira Makan</title>
</head>

<body>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container py-4 h-80">
        <div class="row col-11">
            <div class="col-12 d-flex justify-content-center my-4">
                <h1><strong>Select a restaurant</strong></h1>
            </div>


            <div id="myCarousel" class="carousel slide my-3" data-bs-ride="carousel">
                <?php
                include 'connection.php';
                $sql = "SELECT * FROM Restaurants";
                $run = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_all($run, MYSQLI_ASSOC);
                ?>

                <!-- Wrapper for slides -->
                <div class="carousel-inner pb-5">
                    <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="row">
                                <?php for ($j = $i; $j < $i + 3 && $j < count($rows); $j++) { ?>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img src="images/restaurants/<?php echo $rows[$j]['restaurantURL']; ?>" class="card-img-top" alt="<?php echo $rows[$j]['restaurantName']; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $rows[$j]['restaurantName']; ?></h5>
                                                <p class="card-text"><?php echo $rows[$j]['restaurantDescription']; ?></p>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary restaurant-button" data-bs-target="#exampleModalToggle" id="restaurantID" value="<?php echo $rows[$j]['restaurantID'] ?>" data-bs-toggle="modal"><b>Order</b></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="pt-5">
                    <!-- Indicators -->
                    <div class="carousel-indicators mt-5">
                        <?php for ($i = 0; $i < count($rows); $i += 3) { ?>
                            <button type="button" style="background-color:#005fbb;" data-bs-target="#myCarousel" data-bs-slide-to="<?php echo $i / 3; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>" aria-current="<?php echo $i == 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $i / 3 + 1; ?>"></button>
                        <?php } ?>
                    </div>
                </div>

                <!-- Left and right controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


            <?php include 'restaurantPopUp.php'; ?>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

<script>
    const restaurantButtons = document.querySelectorAll('.restaurant-button');
    let restaurantIDInput = document.getElementById('restaurantID');
    const submitBtn = document.getElementById('submitBtn');

    let selectedRestaurantID = '';

    restaurantButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedRestaurantID = button.value;
            restaurantIDInput.value = selectedRestaurantID;
        });
    });

    // Initialize slot count
    var slotCount = 2;
    var addSlotButton = document.getElementById("add-slot");

    // Add slot button click event
    addSlotButton.addEventListener("click", function() {
        var num = document.querySelectorAll(".numCol").length + 1;
        var slots = document.getElementById("slots");

        // Create new slot row
        var slotRow = document.createElement("div");
        slotRow.classList.add("row", "d-flex", "align-items-center");

        // Create number column
        var numCol = document.createElement("div");
        numCol.classList.add("col-1", "numCol");
        var numLabel = document.createElement("label");
        numLabel.setAttribute("for", "user-name");
        numLabel.innerText = num;
        numCol.appendChild(numLabel);

        // Create slot column
        var slotCol = document.createElement("div");
        slotCol.classList.add("col-9", "slotCol");
        var slotInput = document.createElement("input");
        slotInput.setAttribute("type", "text");
        slotInput.setAttribute("name", "user-name");
        slotInput.setAttribute("placeholder", "Enter the name here");
        slotInput.required = true;
        slotCol.appendChild(slotInput);

        // Create delete column
        var deleteCol = document.createElement("div");
        deleteCol.classList.add("col-2", "deleteCol");
        var deleteButton = document.createElement("button");
        deleteButton.setAttribute("type", "button");
        deleteButton.classList.add("btn", "btn-danger", "delete-slot");
        deleteButton.innerText = "Delete";
        deleteCol.appendChild(deleteButton);

        // Append columns to row
        slotRow.appendChild(numCol);
        slotRow.appendChild(slotCol);

        // Add delete column if it's not the first slot
        if (num > 1) {
            // Hide delete button for all slots except the last one
            var deleteButtons = document.querySelectorAll(".delete-slot");
            for (var i = 0; i < deleteButtons.length; i++) {
                deleteButtons[i].style.display = "none";
            }

            // Show delete button for the last slot
            slotRow.appendChild(deleteCol);
        } else {
            // Hide delete button for the first slot
            deleteButton.style.display = "none";
        }

        // Append row to slots container
        slots.appendChild(slotRow);

        // Increase slot count
        slotCount++;
    });

    // Delete slot button click event
    document.addEventListener("click", function(event) {
        if (event.target && event.target.classList.contains("delete-slot")) {
            var slotRow = event.target.closest(".row");
            var slots = document.getElementById("slots");

            // Check if the slot being deleted is not the first one
            if (slotRow.previousElementSibling) {
                // Remove slot row
                slotRow.remove();

                // Show delete button for the new last slot
                var deleteButtons = document.querySelectorAll(".delete-slot");
                deleteButtons[deleteButtons.length - 1].style.display = "inline-block";

                // Update slot numbers
                var numCols = slots.getElementsByClassName("numCol");
                for (var i = 0; i < numCols.length; i++) {
                    numCols[i].querySelector("label").innerText = i + 1;
                }
            }
        }
    });

    submitBtn.addEventListener('click', function() {
        window.location.href = 'foodOrdering.php?restaurantID=' + selectedRestaurantID;
    });

    document.getElementById('submit-btn').addEventListener('click', function(event) {
        event.preventDefault();

        // Check if all required fields are filled
        const form = document.getElementById('add-names');
        const inputs = form.querySelectorAll('input:not([type="submit"]):not([type="checkbox"]), textarea');

        let allInputsFilled = true;
        inputs.forEach(function(input) {
            if (input.value.trim() === '') {
                allInputsFilled = false;
                input.classList.add('is-invalid'); // Optional: add a CSS class to indicate invalid input
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (allInputsFilled) {
            // Store user names in an array
            const userNameInputs = document.querySelectorAll('input[name="user-name"]');
            const namesArray = [];
            userNameInputs.forEach(function(input) {
                const userName = input.value.trim();
                if (userName.length > 0) {
                    namesArray.push(userName);
                }
            });

            // Submit the form with names array and selectedRestaurantID attribute in URL
            const urlParams = new URLSearchParams();
            urlParams.set('namesArray', namesArray.join(','));
            urlParams.set('restaurantID', selectedRestaurantID);
            const url = `foodOrdering.php?${urlParams.toString()}`;
            window.location.href = url;
        }
    });
</script>

</html>