<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");

if (isset($_SESSION['user_id'])) {

  if ($_SESSION['user_type'] === 'applicant') {
    header("Location: ../applicant/pages/applicant-dashboard.php");
  } elseif ($_SESSION['user_type'] === 'employer') {
    header("Location: ../employer/pages/employer-dashboard.php");
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
  <script src="js/dark-mode.js"></script>
  <link rel="stylesheet" href="css/login-signup.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container">
    <!-- Left Panel - Forms go here -->
    <div class="left-panel">
      <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
        <i data-lucide="moon" id="themeIcon"></i>
      </button>

      <div class="form-container">
        <div class="tab-container">
          <div class="tab login-tab active" onclick="showTab('login')">Login</div>
          <div class="tab signup-tab" onclick="showTab('signup')">
            Sign Up
          </div>
        </div>

        <!-- Signup Form -->
        <div class="form signup-form">
          <h2 class="form-title">Create an Account</h2>
          <p class="form-subtitle">Sign in to your account to continue</p>

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
              <div style="display:flex;align-items:center;">
                <input type="password" id="signupPassword" name="password" minlength="8" title="Password must be at least 8 characters" required />
                <label id="password-rules">?</label>
              </div>
              <div id="password-strength">
                <div id="strength-bar"></div>
                <span id="strength-text"></span>
              </div>
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
          <h2 class="form-title">Welcome Back</h2>
          <p class="form-subtitle">Sign in to your account to continue</p>

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
              <button type="button" id="togglePassword" style="position:absolute; right:10px; top:45px; background:none; border:none; cursor:pointer; padding:0;">
                <span id="toggleIcon" style="display:none; font-size:14px; color: #131313ff;">Show</span>
              </button>
            </div>

            <div class="input-group remember-me" style="display: flex; align-items: center; gap: 0.5rem; justify-content: space-between; ">
              <div style="display: flex; align-items: center;">
                <input type="checkbox" id="rememberMe" name="remember_me">
                <label style="margin-top: 8px; margin-left: 4px;" for="rememberMe">Remember me</label>
              </div>
              <div class="forgot-password">
                <a href="#" onclick="openForgotPasswordModal()">Forgot Password?</a>
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
    <!-- Right Panel - Visual content -->
    <div class="right-panel">
      <div class="logo">PESO</div>
      <h2 class="welcome-text" id="welcomeText">Welcome Back!</h2>
      <p class="sub-text" id="subText">Sign in to access your personalized dashboard...</p>
      <div class="illustration" id="illustration">
        <svg
          class="illustration"
          id="illustration"
          viewBox="0 0 500 400"
          xmlns="http://www.w3.org/2000/svg">
          <!-- Login illustration -->
          <g id="loginIllustration">
            <path
              fill="#fff"
              d="M207.5,175.5c0,28.9-23.4,52.3-52.3,52.3s-52.3-23.4-52.3-52.3s23.4-52.3,52.3-52.3S207.5,146.6,207.5,175.5z"
              opacity="0.1" />
            <path
              fill="#fff"
              d="M375,175.5c0,28.9-23.4,52.3-52.3,52.3s-52.3-23.4-52.3-52.3s23.4-52.3,52.3-52.3S375,146.6,375,175.5z"
              opacity="0.1" />
            <path
              fill="#fff"
              d="M291.2,300.5c0,0,22.3-54.5,83.8-54.5s83.8,54.5,83.8,54.5v45.5H291.2V300.5z" />
            <path
              fill="#fff"
              d="M125,300.5c0,0,22.3-54.5,83.8-54.5s83.8,54.5,83.8,54.5v45.5H125V300.5z" />
            <ellipse fill="#fff" cx="291.2" cy="246" rx="83.8" ry="54.5" />
            <ellipse fill="#fff" cx="125" cy="246" rx="83.8" ry="54.5" />
            <circle fill="#fff" cx="125" cy="246" r="41.8" />
            <circle fill="#fff" cx="291.2" cy="246" r="41.8" />
            <circle fill="#fff" cx="125" cy="246" r="16.7" />
            <circle fill="#fff" cx="291.2" cy="246" r="16.7" />
            <path
              fill="#fff"
              d="M250,136.5c0,0-27.5-31-62.5-31s-62.5,31-62.5,31s28,19,62.5,19S250,136.5,250,136.5z" />
            <path
              fill="#fff"
              d="M416.2,136.5c0,0-27.5-31-62.5-31s-62.5,31-62.5,31s28,19,62.5,19S416.2,136.5,416.2,136.5z" />
          </g>
          <!-- Signup illustration (hidden by default) -->
          <g id="signupIllustration" style="display: none">
            <path
              fill="#fff"
              d="M250,100c83.9,0,152,68.1,152,152s-68.1,152-152,152S98,335.9,98,252S166.1,100,250,100z"
              opacity="0.1" />
            <circle fill="#fff" cx="250" cy="200" r="80" />
            <path
              fill="#fff"
              d="M207.5,300.5c0,0-22.3,54.5-83.8,54.5s-83.8-54.5-83.8-54.5v-45.5h167.5V300.5z" />
            <path
              fill="#fff"
              d="M375,300.5c0,0-22.3,54.5-83.8,54.5s-83.8-54.5-83.8-54.5v-45.5H375V300.5z" />
            <ellipse fill="#fff" cx="291.2" cy="255" rx="83.8" ry="54.5" />
            <ellipse fill="#fff" cx="125" cy="255" rx="83.8" ry="54.5" />
            <circle fill="#fff" cx="125" cy="255" r="41.8" />
            <circle fill="#fff" cx="291.2" cy="255" r="41.8" />
            <path
              fill="#fff"
              d="M170,150c0,0,20-30,80-30s80,30,80,30"
              stroke="#fff"
              stroke-width="8"
              stroke-linecap="round"
              fill="none" />
          </g>
        </svg>
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

  <div class="modal" id="password-rules-modal">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Password Rules</div>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <p>
          To keep your account safe and secure, your password must follow these rules:
        </p>
        <br>
        <h3>1. Minimum Length</h3>
        <p>
          Your password must be at least 8 characters long.
        </p>
        <h3>2. Uppercase Letters</h3>
        <p>
          Include at least one uppercase letter (A–Z).
        </p>
        <h3>3. Lowercase Letters</h3>
        <p>
          Include at least one lowercase letter (a–z).
        </p>
        <h3>4. Numbers</h3>
        <p>
          Include at least one number (0–9).
        </p>
        <h3>5. Unique Password</h3>
        <p>
          Do not reuse passwords from other accounts. Always use a unique password for this platform.
        </p>
      </div>

      <div class="modal-footer">
        <button class="close btn btn-danger">Close</button>
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
            placeholder="cardodalisay@gmail.com" />
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

  <!-- <div id="preloader">
    <div class="loader"></div>
  </div> -->

  <!-- //TODO COMMENTED NAHEHELO AQ -->
  <!-- Preloader -->
  <!-- <script>
    window.addEventListener("load", function() {
      const preloader = document.getElementById("preloader");
      preloader.style.opacity = "0";
      setTimeout(() => {
        preloader.style.display = "none";
      }, 500);
    });
  </script> -->

  <script src="js/login-signup.js"></script>
  <!-- Development version -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <!-- // <script src="https://unpkg.com/lucide@latest"></script> -->
  <script>
    lucide.createIcons();
  </script>
  <!-- OTP -->
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
  <!-- Performance -->
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
  <!-- Login Validation -->
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
    const icon = document.getElementById('toggleIcon');
    const passwordInput = document.getElementById('loginPassword');

    passwordInput.addEventListener('input', () => {
      if (loginPassword.value.length > 0) {
        icon.style.display = 'inline-block';
      } else {
        icon.style.display = 'none';
      }
    });
    document.getElementById('togglePassword').addEventListener('click', function() {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = 'Hide';
      } else {
        passwordInput.type = 'password';
        icon.textContent = 'Show';
      }
    });
  </script>
  <!-- Forgot Password Function -->
  <script>
    document.getElementById("forgotPasswordForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const email = document.getElementById("forgot-email").value;

      fetch("functions/forgot_password.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
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
  <!-- Reset Password Function -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has("reset")) {
        const email = urlParams.get("email");
        const token = urlParams.get("token");

        document.getElementById("reset-email").value = email;
        document.getElementById("reset-token").value = token;

        document.getElementById("resetPasswordModal").style.display = "block";
      }

      document.querySelector(".close-reset").onclick = function() {
        document.getElementById("resetPasswordModal").style.display = "none";
      };
    });
  </script>
  <!-- New Password Validation -->
  <script>
    document.getElementById("resetPasswordForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const email = document.getElementById("reset-email").value;
      const token = document.getElementById("reset-token").value;
      const newPassword = document.getElementById("newPassword").value;
      const confirmPassword = document.getElementById("confirmPassword").value;

      fetch("functions/reset_password.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
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