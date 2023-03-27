<!DOCTYPE html>
<html>
  <head>
    <title>My Form</title>
    <style>
      /* Center the form */
      form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      /* Style the input fields */
      input[type="text"] {
        padding: 10px;
        margin: 10px;
        border: none;
        border-radius: 5px;
        box-shadow: 0px 0px 5px #ccc;
        width: 300px;
      }
      /* Style the delete button */
      .delete-btn {
        margin-left: 10px;
        padding: 5px;
        border: none;
        border-radius: 5px;
        background-color: #f44336;
        color: white;
        cursor: pointer;
      }
      /* Style the submit button */
      input[type="submit"] {
        margin: 10px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <form action="submit.php" method="GET">
      <label for="my-name">My Name:</label>
      <input type="text" name="my-name" id="my-name" value="Your Name" readonly>
      <label for="user-name">User Name:</label>
      <input type="text" name="user-name" id="user-name">
      <div id="slots"></div>
      <button type="button" id="add-slot">Add Slot</button>
      <input type="submit" value="Submit">
    </form>

    <script>
      const addSlotBtn = document.getElementById("add-slot");
      const slotsDiv = document.getElementById("slots");
      let slotCount = 1;

      addSlotBtn.addEventListener("click", function() {
        // Create a new input field
        const slotInput = document.createElement("input");
        slotInput.type = "text";
        slotInput.name = `slot-${slotCount}`;
        slotInput.placeholder = "Slot Name";
        slotsDiv.appendChild(slotInput);

        // Create a delete button for the input field
        const deleteBtn = document.createElement("button");
        deleteBtn.type = "button";
        deleteBtn.classList.add("delete-btn");
        deleteBtn.textContent = "X";
        deleteBtn.addEventListener("click", function() {
          slotsDiv.removeChild(slotInput);
          slotsDiv.removeChild(deleteBtn);
        });
        slotsDiv.appendChild(deleteBtn);

        slotCount++;
      });
    </script>
  </body>
</html>
