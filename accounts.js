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

  // check if name is empty
  if (customerName === '') {
    alert('Please enter your name.');
    return false;
  }

  // check if email is empty or in the wrong format
  if (regEmail === '' || !emailRegex.test(regEmail)) {
    alert('Please enter a valid email address.');
    return false;
  }

  // check if phone number is empty
  if (phoneNo === '' || (!phoneNoRegex10.test(phoneNo) && !phoneNoRegex11.test(phoneNo))) {
    alert('Please enter a valid phone number.');
    return false;
  }

  // check if password is empty or too short
  if (regPassword === '' || password.length < 8) {
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
