<div id="account-modal">
  <!-- Login Modal -->
  <div class="modal fade" id="loginModalToggle" aria-hidden="true" aria-labelledby="loginModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="loginModalToggleLabel">Login Account</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="login-modal">
          <form action="signUpLogin.php" method="post" novalidate onsubmit="return validateLoginForm()">
            <div class="input-group mb-3">
              <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-envelope" viewBox="0 0 16 16">
                  <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                </svg>
              </span>
              <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required
                  autocomplete="off">
                <label for="email">Email address</label>
              </div>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                </svg>
              </span>
              <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                  required autocomplete="off">
                <label for="password">Password</label>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-center flex-column">
              <button type="submit" class="btn btn-outline-secondary btn-b mx-auto d-block fs-6"
                name="loginSubmit">Login</button>
          </form>
          <button type="button" class="btn bg-transparent border-0 text-secondary text-decoration-underline"
            data-bs-target="#forgetPasswordModalToggle" data-bs-toggle="modal"><span class="fs-6">Forget
              Password?</span></button>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#userSignUpModalToggle" data-bs-toggle="modal"><span
            class="fs-6">Register Account?</span></button>
      </div>
    </div>
  </div>
</div>

<!-- User Registration Modal -->
<div class="modal fade" id="userSignUpModalToggle" aria-hidden="true" aria-labelledby="userSignUpModalToggleLabel"
  tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModalToggleLabel">Register Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="login-modal">
        <form action="signUpLogin.php" method="post" novalidate onsubmit="return validateRegisterForm()">
          <div class="input-group mb-3">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
              </svg>
            </span>
            <div class="form-floating">
              <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Name" required
                autocomplete="off">
              <label for="customerName">Name</label>
            </div>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope"
                viewBox="0 0 16 16">
                <path
                  d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
              </svg>
            </span>
            <div class="form-floating">
              <input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="name@example.com"
                required autocomplete="off">
              <label for="regEmail">Email address</label>
            </div>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone"
                viewBox="0 0 16 16">
                <path
                  d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
              </svg>
            </span>
            <div class="form-floating">
              <input type="tel" class="form-control" id="phoneNo" name="phoneNo" placeholder="Enter your phone number"
                required autocomplete="off">
              <label for="phoneNo">Phone Number</label>
            </div>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock"
                viewBox="0 0 16 16">
                <path
                  d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
              </svg>
            </span>
            <div class="form-floating">
              <input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Password"
                required autocomplete="off">
              <label for="regPassword">Password</label>
            </div>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-check2-circle" viewBox="0 0 16 16">
                <path
                  d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                <path
                  d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
              </svg>
            </span>
            <div class="form-floating">
              <input type="password" class="form-control" id="regRepeatPassword" name="regRepeatPassword"
                placeholder="Repeat Password" required autocomplete="off">
              <label for="regRepeatPassword">Repeat Password</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-secondary" name="userRegisterSubmit">Register</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#loginModalToggle" data-bs-toggle="modal"><span
            class="fs-6">Back to Login</span></button>
      </div>
    </div>
  </div>
</div>

<!-- Forget Password Modal -->
<div class="modal fade" id="forgetPasswordModalToggle" aria-hidden="true"
  aria-labelledby="forgetPasswordModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModalToggleLabel">Please input an email:</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="login-modal">
        <form action="forgetPassword.php" novalidate method="post" onsubmit="return validateForgetForm()">
          <div class="input-group mb-3">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope"
                viewBox="0 0 16 16">
                <path
                  d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
              </svg>
            </span>
            <div class="form-floating">
              <input type="email" class="form-control" id="altEmail" name="altEmail" placeholder="name@example.com"
                required autocomplete="off">
              <label for="altEmail">Email address</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-secondary" name="forgetSubmit">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#loginModalToggle" data-bs-toggle="modal"><span
            class="fs-6">Back to Login</span></button>
      </div>
    </div>
  </div>
</div>

</div>