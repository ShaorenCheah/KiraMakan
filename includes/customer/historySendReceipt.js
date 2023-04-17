let orderbtn = document.querySelector('.order-button');
let selectedorderID = '';

const checkOrderButtons = document.querySelectorAll('.order-button');
checkOrderButtons.forEach(button => {
    button.addEventListener('click', () => {
        selectedorderID = button.value;
        console.log(selectedorderID);
    });
});

let opID = document.querySelector('.opID');
let selectedopID = '';
const sendEmailButtons = document.querySelectorAll('.send-email');
sendEmailButtons.forEach(button => {
    button.addEventListener('click', () => {
        selectedopID = button.value;
        console.log(selectedopID);
    });
});

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
// select the submit button element
const submitBtn = document.querySelector('#submit-btn');

// add a click event listener to the submit button
submitBtn.addEventListener('click', () => {

    // get the values of the inputs
    // get the selectedopID value
    const recEmail = document.getElementById('recEmail').value;

    // validate the email input
    if (!isValidEmail(recEmail)) {
        alert('Please enter a valid email address');
        return;
    }

    // create a JavaScript object with the values
    const data = {
        recEmail: recEmail,
        orderID: selectedorderID,
        opID: selectedopID
    };
    console.log(data); // log the data object

    fetch('/kiramakan/includes/customer/emailRecipient.inc.php', {
            method: 'POST',
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log(response);
            return response.json();
        })
        .then(data => {
            console.log(data);
            if (data.success) {
                alert('Receipt sent successfully');
            } else {
                alert('Error sending receipt');
            }
        });
});