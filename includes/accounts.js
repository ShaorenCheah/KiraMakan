function validateLoginForm() {

  // get input values
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  // regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // check if email is empty or in the wrong format
  if (email === '' || !emailRegex.test(email)) {
    alert('Please enter a valid email address.');
    return false;
  }

  // check if password is empty or too short
  if (password === '' || password.length < 8) {
    alert('Please enter a password that is at least 8 characters long.');
    return false;
  }

  // if form is valid, return true to submit form
  return true;

}

function validateRegisterForm() {

  // get input values
  const customerName = document.getElementById('customerName').value.trim();
  const regEmail = document.getElementById('regEmail').value.trim();
  const phoneNo = document.getElementById('phoneNo').value.trim();
  const regPassword = document.getElementById('regPassword').value.trim();
  const regRepeatPassword = document.getElementById('regRepeatPassword').value.trim();

  // regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // regular expression for phone number validation
  const phoneNoRegex10 = /^01\d{8}$/;
  const phoneNoRegex11 = /^01\d{9}$/;

  // array to hold incomplete fields
  const incompleteFields = [];

  // loop through input fields and check for empty values
  const inputFields = [customerName, regEmail, phoneNo, regPassword, regRepeatPassword];
  const fieldNames = ['Name', 'Email', 'Phone number', 'Password', 'Repeat password'];

  for (let i = 0; i < inputFields.length; i++) {
    if (inputFields[i] === '') {
      incompleteFields.push(fieldNames[i]);
    }
  }

  // if any fields are incomplete, alert the user
  if (incompleteFields.length > 0) {
    alert('Please fill in all input fields.');
    return false;
  }

  // check if email is in the wrong format
  if (!emailRegex.test(regEmail)) {
    alert('Please enter a valid email address.');
    return false;
  }

  // check if phone number is invalid
  if (!phoneNoRegex10.test(phoneNo) && !phoneNoRegex11.test(phoneNo)) {
    alert('Please enter a valid phone number.');
    return false;
  }

  // check if password is too short
  if (regPassword.length < 8) {
    alert('Please enter a password that is at least 8 characters long.');
    return false;
  }

  // check if confirm password is the same as password
  if (regRepeatPassword !== regPassword) {
    alert('Please type the same password for confirm password.');
    return false;
  }

  // if form is valid, return true to submit form
  return true;

}


function validateForgetForm() {

  // get input values
  const altEmail = document.getElementById('altEmail').value.trim();

  // regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // check if email is empty or in the wrong format
  if (altEmail === '' || !emailRegex.test(altEmail)) {
    alert('Please enter a valid email address.');
    return false;
  }

  // if form is valid, return true to submit form
  return true;

}

function validateOTPForm() {

  // get input values
  const otp = document.getElementById('otp').value.trim();

  // regular expression for numeric values
  const numericRegex = /^[1-9]+$/;

  // check if otp is empty
  if (otp === '') {
    alert('Please enter the OTP sent to your email.');
    return false;
  }

  // check if otp is 6 digits with no letters
  if (!numericRegex.test(otp) || otp.length !== 6) {
    alert('Please enter a valid OTP.');
    return false;
  }

  // if form is valid, return true to submit form
  return true;

}

function validateNewPasswordForm() {

  // get input values
  const newPassword = document.getElementById('newPassword').value.trim();
  const newRepeatPassword = document.getElementById('newRepeatPassword').value.trim();

  // array to hold incomplete fields
  const incompleteFields = [];

  // loop through input fields and check for empty values
  const inputFields = [newPassword, newRepeatPassword];
  const fieldNames = ['Password', 'Repeat password'];

  for (let i = 0; i < inputFields.length; i++) {
    if (inputFields[i] === '') {
      incompleteFields.push(fieldNames[i]);
    }
  }

  // if any fields are incomplete, alert the user
  if (incompleteFields.length > 0) {
    alert('Please fill in all input fields.');
    return false;
  }

  // check if password is empty or too short
  if (newPassword === '' || newPassword.length < 8) {
    alert('Please enter a password that is at least 8 characters long.');
    return false;
  }

  // check if confirm password is the same as password
  if (newRepeatPassword !== newPassword) {
    alert('Please type the same password for repeat password.');
    return false;
  }

  // if form is valid, return true to submit form
  return true;

}

function validateRecipientForm() {

  // get input values
  const recEmail = document.getElementById('recEmail').value.trim();

  // regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // check if email is empty or in the wrong format
  if (recEmail === '' || !emailRegex.test(altEmail)) {
    alert('Please enter a valid email address.');
    return false;
  }

  // if form is valid, return true to submit form
  return true;

}
