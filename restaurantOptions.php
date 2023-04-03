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
    <?php session_start() ?>
    <header>
        <!-- Header -->
        <?php include 'header.php'; ?>
    </header>

    <div class="container pt-4 min-vh-100 d-flex flex-column  align-items-center">
        <div class="row m-0 col-10 d-flex align-items-start">
            <div class="col-12 d-flex justify-content-center mt-4 mb-3">
                <h1><strong>Select a <span style="color:var(--orange)">Restaurant</span></strong></h1>
            </div>

            <form class="col-12 d-flex flex-row justify-content-center align-items-center" action="restaurantOptions.php" method="GET">
                <div class="col-3"></div>
                <div class="col-5">
                    <div class="input-group">

                        <input type="text" class="form-control w-25" name="search" placeholder="Enter restaurant name..." value="<?php if (isset($_GET['search'])) {
                                                                                                                                        echo $_GET['search'];
                                                                                                                                    } ?>" autocomplete="off">
                    </div>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <button type="submit" id="dashboard-search" class=" btn orange-btn search-btn ms-3"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></i> Search
                    </button>
                </div>
                <div class="col-2"></div>
            </form>
        </div>


        <div class="row m-0 col-10 d-flex align-items-start">
            <div class="row col-12 g-5 m-0 mt-1 p-0 d-flex justify-content-center align-items-center">

                <?php
                if (isset($_GET['search'])) {
                    $filterValues = $_GET['search'];
                } else {
                    $filterValues = '';
                }

                include './includes/connection.inc.php';
                $sql = "SELECT * FROM Restaurants WHERE CONCAT(restaurantName, restaurantDescription) LIKE '%$filterValues%';";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="images/restaurants/<?php echo $rows['restaurantURL']; ?>" class="card-img-top" alt="<?php echo $rows['restaurantName']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><strong><?php echo $rows['restaurantName']; ?></strong></h5>
                                    <p class="card-text"><?php echo $rows['restaurantDescription']; ?></p>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn white-btn restaurant-button" data-bs-target="#exampleModalToggle" id="restaurantID" value="<?php echo $rows['restaurantID'] ?>" data-bs-toggle="modal"><b>Order</b></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="col-12 d-flex justify-content-center mt-5 p-0">
                            <h5><strong>No results found for <span style="color:var(--orange)">' . $filterValues . '</span></strong></h5>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-3 p-0">
                            <img src="images/search.png" alt="empty" class="img-fluid" style="width: 25%;">
                        </div>';
                } ?>
            </div>
        </div>
    </div>


    <?php include 'restaurantPopUp.php'; ?>
    </div>
    </div>

</body>

<script>
    const restaurantButtons = document.querySelectorAll('.restaurant-button');
    let restaurantIDInput = document.getElementById('restaurantID');
    const submitBtn = document.getElementById('submitBtn');

    let selectedRestaurantID = '';

    restaurantButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedRestaurantID = button.value;
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
        slotInput.setAttribute("autocomplete", "off");
        slotInput.setAttribute("placeholder", "Enter name here");
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
            urlParams.set('restaurantID', selectedRestaurantID);
            urlParams.set('namesArray', namesArray.join(','));
            const url = `foodOrdering.php?${urlParams.toString()}`;
            window.location.href = url;
        }
    });
</script>

</html>