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
  