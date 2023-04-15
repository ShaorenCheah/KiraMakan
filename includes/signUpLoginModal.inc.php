<div id="account-modal">
  <!-- Login Modal -->
  <div class="modal fade" id="loginModalToggle" aria-hidden="true" aria-labelledby="loginModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-body" id="login-modal">
          <div class="row m-0 d-flex justify-content-center align-items-center">
            <div class="col-12 d-flex justify-content-center align-items-center mt-5">
              <img src="images/KiraMakanIcon.png" class="img-fluid" alt="Kira Makan Icon" style="width: 75px;">
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center mt-4">
              <h3 class="fw-bold mb-2 text-uppercase">Login</h3>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center">
              <p class=" mb-3">Please enter your email and password</p>
            </div>

            <form action="includes/signUpLogin.inc.php" method="post" novalidate onsubmit="return validateLoginForm()" class="col-12 row g-4 m-0">
              <div class="col-1"></div>
              <div class="col-10 px-5">
                <div class="form-floating">
                  <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required autocomplete="off">
                  <label for="email">Email address</label>
                </div>
              </div>
              <div class="col-1"></div>
              <div class="col-1"></div>
              <div class="col-10 px-5">
                <div class="form-floating">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="off">
                  <label for="password">Password</label>
                </div>
              </div>
              <div class="col-1"></div>
              <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                <button type="button" style="text-decoration:none;" class="btn bg-transparent border-0 text-secondary mute-btn" data-bs-target="#forgetPasswordModalToggle" data-bs-toggle="modal"><span class="fs-6">Forgot
                    Password?</span></button>
              </div>
              <div class="col-12 d-flex justify-content-center flex-column mb-5">
                <button type="submit" class="btn orange-btn btn-b mx-auto px-3 d-block fs-5" name="loginSubmit">Login</button>
              </div>
            </form>
            <div class="col-12 d-flex justify-content-center align-items-center mb-3">
              Don't have an account? <a class="btn p-0 ms-1" data-bs-target="#userSignUpModalToggle" data-bs-toggle="modal"><span class="fs-6 text-muted mute-btn"> Sign Up</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- User Registration Modal -->
<div class="modal modal-lg fade" id="userSignUpModalToggle" aria-hidden="true" aria-labelledby="userSignUpModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content ">
      <div class="modal-body d-flex flex-column m-4" id="login-modal">
        <div class="col-md-12 d-flex flex-row">
          <div class="col-md-6 d-flex flex-column justify-content-center">
            <h2 class="fw-bold">The best website <br><span style="color:var(--orange)">for your dining experience</span></h2>
            <p class="text-muted mt-4 pe-5">Register with KiraMakan for streamlined food ordering, tailored receipts for easy bill splitting, and convenient access to your favorite restaurants. Enjoy a better dining experience that saves you time and effort.</p>
          </div>

          <form action="includes/signUpLogin.inc.php" method="POST" novalidate onsubmit="return validateRegisterForm()" class="col-md-6 card shadow border-0">
            <div class="gap-3 p-3">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Name" required autocomplete="off">
                <label for="customerName">Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="name@example.com" required autocomplete="off">
                <label for="regEmail">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="phoneNo" name="phoneNo" placeholder="Enter your phone number" required autocomplete="off">
                <label for="phoneNo">Phone Number</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Password" required autocomplete="off">
                <label for="regPassword">Password</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="regRepeatPassword" name="regRepeatPassword" placeholder="Repeat Password" required autocomplete="off">
                <label for="regRepeatPassword">Repeat Password</label>
              </div>
              <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn white-btn" name="userRegisterSubmit">Register</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-12 d-flex mt-4 justify-content-end">
          <button class="btn back-btn text-muted" data-bs-target="#loginModalToggle" data-bs-toggle="modal" style="font-size:13px"><i class="me-2"></i>Already have an account?</button>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Forget Password Modal -->
<div class="modal fade" id="forgetPasswordModalToggle" aria-hidden="true" aria-labelledby="forgetPasswordModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content d-flex">
      <div class="modal-body mx-4" id="login-modal d-flex justify-content-center align-items-center">
        <div class="col-12 d-flex justify-content-center align-items-center mt-4">
          <h3 class="fw-bold mb-2 text-uppercase">Forgot Password</h3>
        </div>
        <div class="col-12 w-auto d-flex justify-content-center align-items-center">
          <p class=" mb-3">Please enter your email to reset your password</p>
        </div>
        <form action="includes/forgetPassword.inc.php" class="mt-3 d-flex flex-column justify-content-center" novalidate method="post" onsubmit="return validateForgetForm()">
          <div class="col-md-12 d-flex justify-content-center align-items-center">
            <div class="form-floating w-75">
              <input type="email" class="form-control" id="altEmail" name="altEmail" placeholder="name@example.com" required autocomplete="off">
              <label for="altEmail">Email address</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-center mt-4">
            <button type="submit" class="btn white-btn" name="forgetSubmit">Submit</button>
          </div>
        </form>
        <div class="col-12 d-flex justify-content-end mt-3">
          <button class="btn back-btn" data-bs-target="#loginModalToggle" data-bs-toggle="modal"><i class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--orange)" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
              </svg></i>Back to Login</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>