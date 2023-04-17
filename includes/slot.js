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
    slotInput.classList.add("form-control");
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