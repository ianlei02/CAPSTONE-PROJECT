<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");

if (isset($_SESSION['user_id'])) {

  if ($_SESSION['user_type'] === 'applicant') {
    header("Location: applicant/pages/applicant-dashboard.php");
  } elseif ($_SESSION['user_type'] === 'employer') {
    header("Location: employer/pages/employer-dashboard.php");
  }
  exit();
}

if (isset($_SESSION['verification_success'])) {
  echo "<script>alert('" . $_SESSION['verification_success'] . "');</script>";
  unset($_SESSION['verification_success']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login & Signup Form</title>
  <link rel="stylesheet" href="./css/login-signup.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container">
    <div class="form-container">
      <div class="tab-container">
        <div class="tab login-tab active" onclick="showTab('login')">Login</div>
        <div class="tab signup-tab" onclick="showTab('signup')">
          Sign Up
        </div>
      </div>

      <!-- Signup Form -->
      <div class="form signup-form ">
        <h2>Create an Account</h2>
        <form action="functions/register.php" method="POST">

          <div class="user-type">
            <h4>Register as:</h4>
            <div class="radio-container">
              <div class="radio-option">
                <input
                  type="radio"
                  id="applicant"
                  name="user-type"
                  value="applicant"
                  checked />
                <label for="applicant">Applicant</label>
              </div>
              <div class="radio-option">
                <input
                  type="radio"
                  id="employer"
                  name="user-type"
                  value="employer" />
                <label for="employer">Employer</label>
              </div>
            </div>
          </div>
          <div class="name-inputs">
            <div class="input-group">
              <label for="firstName">First Name</label>
              <input type="text" id="firstName" name="f_name" required />
            </div>
            <div class="input-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" name="l_name" required />

            </div>
          </div>
          <div class="input-group">
            <label for="signupEmail">Email</label>
            <input type="email" id="signupEmail" name="email" required />
          </div>
          <div class="input-group">
            <label for="signupPassword">Password</label>
            <input type="password" id="signupPassword" name="password" minlength="8" title="Password must be at least 8 characters" required  />
          </div>
          <div class="input-group">
            <input type="hidden" id="otp" name="otp" class="form-control" required />
            <input type="hidden" id="subject" name="subject" class="form-control" value="Received OTP" required />
          </div>
          <div class="terms">
            <input type="checkbox" id="terms" required />
            <label style="margin-top: 8px;" for="terms">I agree to the
              <a id="termsLink">Terms and Conditions</a></label>
          </div>

          <button type="submit" class="btn" id="signupBtn" name="signupBtn">Sign Up</button>
          <div class="toggle-form">
            Already have an account? <a onclick="showTab('login')">Login</a>
          </div>
        </form>
      </div>

      <!-- Login Form -->
      <div class="form login-form active">
        <h2>Welcome Back</h2>
        <form action="" method="POST">

          <div class="user-type">
            <h4>Login as:</h4>
            <div class="radio-container">
              <div class="radio-option">
                <input
                  type="radio"
                  id="loginApplicant"
                  name="user-type-login"
                  value="applicant"
                  checked />
                <label for="loginApplicant">Applicant</label>
              </div>
              <div class="radio-option">
                <input
                  type="radio"
                  id="loginEmployer"
                  name="user-type-login"
                  value="employer" />
                <label for="loginEmployer">Employer</label>
              </div>
            </div>
          </div>
          <div class="input-group">
            <label for="loginEmail">Email</label>
            <input type="email" id="loginEmail" required />
          </div>

          <div class="input-group" style="position:relative;">
            <label for="loginPassword">Password</label>
            <input type="password" id="loginPassword" name="password" required />
            <button type="button" id="togglePassword" style="position:absolute; right:10px; top:40px; background:none; border:none; cursor:pointer; padding:0;">
              <span id="toggleIcon" style="font-size:18px;">👁</span>
            </button>
          </div>

          <div class="input-group remember-me" style="display: flex; align-items: center; gap: 0.5rem; justify-content: space-between; ">
            <div style="display: flex; align-items: center;">
              <input type="checkbox" id="rememberMe" name="remember_me" >
              <label style="margin-top: 8px; margin-left: 4px;" for="rememberMe">Remember me</label>
            </div>
            <div class="forgot-password">
              <a  href="#" onclick="openForgotPasswordModal()">Forgot Password?</a>
            </div>
          </div>


          <button type="submit" class="btn" id="loginBtn" name="remember_login">Login</button>

          <div class="toggle-form">
            Don't have an account? <a onclick="showTab('signup')">Sign Up</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="termsModal">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Terms and Conditions</div>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <h3>1. Introduction</h3>
        <p>
          Welcome to our platform. These Terms and Conditions govern your use
          of our services and website. By using our platform, you agree to
          these terms in full.
        </p>

        <h3>2. Account Registration</h3>
        <p>
          When you register for an account, you must provide accurate and
          complete information. You are responsible for maintaining the
          security of your account and password.
        </p>

        <h3>3. Privacy Policy</h3>
        <p>
          Your use of our platform is also governed by our Privacy Policy,
          which can be found on our website.
        </p>

        <h3>4. User Conduct</h3>
        <p>
          You agree not to use our platform for any illegal purposes or in any
          way that might damage or disable the platform or interfere with any
          other user's enjoyment of the platform.
        </p>

        <h3>5. Termination</h3>
        <p>
          We reserve the right to terminate or suspend your account at any
          time without notice if we believe you have violated these Terms.
        </p>

        <h3>6. Changes to Terms</h3>
        <p>
          We may modify these Terms at any time. If we make changes, we will
          notify you by posting the updated terms on our platform.
        </p>

        <h3>7. Disclaimer</h3>
        <p>
          Our platform is provided "as is" without any warranties, expressed
          or implied.
        </p>

        <h3>8. Limitation of Liability</h3>
        <p>
          We shall not be liable for any indirect, incidental, special,
          consequential or punitive damages resulting from your use of or
          inability to use our platform.
        </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="modal-btn" id="acceptTerms">
          Accept
        </button>
      </div>
    </div>
  </div>

  <div id="forgotPasswordModal" class="forgot-modal">
      <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Reset Your Password</h2>
        <p>
          Enter your email address and we'll send you a link to reset your
          password.
        </p>

        <form action="" method="POST" id="forgotPasswordForm">
          <div class="form-group">
            <label for="forgot-email">Email Address</label>
            <input
              type="email"
              id="forgot-email"
              name="email-reset"
              required
              placeholder="cardodalisay@gmail.com"
            />
          </div>

          <button type="submit" name="resetLink" value="Submit" class="submit-btn">Send Reset Link</button>

        <div class="modal-footer">
          <p>
            Remember your password? <a href="#" class="login-link">Log in</a>
          </p>
        </div>
      </form>
    </div>
  </div>

  <div id="resetPasswordModal" class="forgot-modal">
  <div class="modal-content">
    <span class="close-reset">&times;</span>
    <h2>Reset Your Password</h2>
    <form id="resetPasswordForm" method="POST">
      <input type="hidden" id="reset-email" name="email">
      <input type="hidden" id="reset-token" name="token">

      <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="new_password" minlength="8" required>
      </div>

      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirm_password" minlength="8" required>
      </div>

      <button type="submit" onclick="success()" class="submit-btn">Change Password</button>
    </form>
  </div>
</div>
<div id="preloader">
  <div class="loader"></div>
</div>

    <script>
    window.addEventListener("load", function () {
        const preloader = document.getElementById("preloader");
        preloader.style.opacity = "0";
        setTimeout(() => {
        preloader.style.display = "none";
        }, 500); 
    });
    </script>
  <script src="login-signup.js"></script>
  <script>
    function generateRandomNumber() {

      let min = 100000;
      let max = 999999;
      let randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;

      let lastGeneratedNUmber = localStorage.getItem('lastGeneratedNumber');
      while (randomNumber === parseInt(lastGeneratedNUmber)) {


        randomNumber = Math.floor(Math.random() * ma(max - min + 1)) + min;
      }
      localStorage.setItem('lastGeneratedNumber', randomNumber);
      return randomNumber
    }
    document.querySelector('.signup-form form').addEventListener('submit', function() {
      document.getElementById('otp').value = generateRandomNumber();
    });
  </script>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    window.addEventListener("pageshow", function(event) {
      if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {

        window.location.reload();
      }
    });
  </script>
  <script>
    document.querySelector('.login-form form').addEventListener('submit', function(e) {
  e.preventDefault();

  const email = document.getElementById('loginEmail').value;
  const password = document.getElementById('loginPassword').value;
  const userType = document.querySelector('input[name="user-type-login"]:checked').value;

  fetch("functions/login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&user-type-login=${userType}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === "success") {
        Swal.fire({
          title: "Login Successful",
          text: "Redirecting to your dashboard...",
          icon: "success",
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          window.location.href = data.redirect_url;
        });
      } else {
        Swal.fire({
          title: "Login Failed",
          text: data.message,
          icon: "error"
        });
      }
    })
    .catch(error => {
      console.error('Error:', error);
      Swal.fire({
        title: "Error",
        text: "Login failed. Please try again.",
        icon: "error"
      });
    });
});

  
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('loginPassword');
      const icon = document.getElementById('toggleIcon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = '🙈'; 
      } else {
        passwordInput.type = 'password';
        icon.textContent = '👁'; 
      }
    });

  </script>
  <script>
  document.getElementById("forgotPasswordForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const email = document.getElementById("forgot-email").value;

  fetch("functions/forgot_password.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `email-reset=${encodeURIComponent(email)}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === "success") {
      Swal.fire({
        title: "Success!",
        text: data.message,
        icon: "success",
        confirmButtonText: "OK"
      });
    } else {
      Swal.fire({
        title: "Error",
        text: data.message,
        icon: "error",
        confirmButtonText: "Try Again"
      });
    }
  })
  .catch(err => {
    Swal.fire({
      title: "Oops...",
      text: "Error sending reset link.",
      icon: "error"
    });
  });
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("reset")) {
    const email = urlParams.get("email");
    const token = urlParams.get("token");

    document.getElementById("reset-email").value = email;
    document.getElementById("reset-token").value = token;

    document.getElementById("resetPasswordModal").style.display = "block";
  }

  document.querySelector(".close-reset").onclick = function () {
    document.getElementById("resetPasswordModal").style.display = "none";
  };
});
</script>
<script>
document.getElementById("resetPasswordForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const email = document.getElementById("reset-email").value;
  const token = document.getElementById("reset-token").value;
  const newPassword = document.getElementById("newPassword").value;
  const confirmPassword = document.getElementById("confirmPassword").value;

  fetch("functions/reset_password.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `email=${encodeURIComponent(email)}&token=${encodeURIComponent(token)}&new_password=${encodeURIComponent(newPassword)}&confirm_password=${encodeURIComponent(confirmPassword)}`
  })
  .then(res => res.json()) 
  .then(data => {
    if (data.status === "success") {
      Swal.fire({
        title: "Password Updated!",
        text: data.message,
        icon: "success",
        confirmButtonText: "OK"
      }).then(() => {
        window.location.href = "login-signup.php";
      });
    } else {
      Swal.fire({
        title: "Oops...",
        text: data.message,
        icon: "error",
        confirmButtonText: "Try Again"
      });
    }
  })
  .catch(() => {
    Swal.fire({
      title: "Error!",
      text: "Something went wrong while resetting your password.",
      icon: "error"
    });
  });
});

</script>
</body>

</html>