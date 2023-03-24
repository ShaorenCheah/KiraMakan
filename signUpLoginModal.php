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
          <form action="signUpLogin.php" method="post">

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
            <div class="col-12 d-flex justify-content-center">
              <button type="submit" class="btn btn-outline-secondary" name="loginSubmit">Login</button>
            </div>
          </form>
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
        <form action="signUpLogin.php" method="post">

          <div class="input-group mb-3">
            <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope"
                viewBox="0 0 16 16">
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
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required
                autocomplete="off">
              <label for="password">Password</label>
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
              <input type="password" class="form-control" id="repeatPassword" name="repeatPassword"
                placeholder="Repeat Password" required autocomplete="off">
              <label for="repeatPassword">Repeat Password</label>
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
</div>