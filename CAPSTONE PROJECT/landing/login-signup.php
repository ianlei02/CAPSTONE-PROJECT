<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");

if (isset($_SESSION['user_id'])) {
    // Redirect to the appropriate dashboard based on user type
    if ($_SESSION['user_type'] === 'applicant') {
        header("Location: applicant/pages/applicant-dashboard.php");
    } elseif ($_SESSION['user_type'] === 'employer') {
        header("Location: employer/pages/employer-dashboard.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="login-signup.css" />
   

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
                    checked
                  />
                  <label for="applicant">Applicant</label>
                </div>
                <div class="radio-option">
                  <input
                    type="radio"
                    id="employer"
                    name="user-type"
                    value="employer"
                    
                  />
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
              <input type="password" id="signupPassword" name="password" required />
            </div>
            <div class="terms">
              <input type="checkbox" id="terms" required />
              <label for="terms"
                >I agree to the
                <a id="termsLink">Terms and Conditions</a></label
              >
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
                    checked
                  />
                  <label for="loginApplicant">Applicant</label>
                </div>
                <div class="radio-option">
                  <input
                    type="radio"
                    id="loginEmployer"
                    name="user-type-login"
                    value="employer"
                  />
                  <label for="loginEmployer">Employer</label>
                </div>
              </div>
            </div>
            <div class="input-group">
              <label for="loginEmail">Email</label>
              <input type="email" id="loginEmail" required />
            </div>
            
            <div class="input-group">
              <label for="loginPassword">Password</label>
              <input type="password" id="loginPassword" required />
            </div>
            <div class="input-group remember-me">
                <input type="checkbox" id="rememberMe" name="remember_me">
                <label for="rememberMe">Remember me</label>
            </div>
            <div class="forgot-password">
              <a href="#" onclick="openForgotPasswordModal()"
                >Forgot Password?</a
              >
            </div>
            <button type="submit" class="btn" id="loginBtn" name="remember_login" >Login</button>
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

        <form id="forgotPasswordForm">
          <div class="form-group">
            <label for="forgot-email">Email Address</label>
            <input
              type="email"
              id="forgot-email"
              name="email"
              required
              placeholder="cardodalisay@gmail.com"
            />
          </div>

          <button type="submit" class="submit-btn">Send Reset Link</button>

          <div class="modal-footer">
            <p>
              Remember your password? <a href="#" class="login-link">Log in</a>
            </p>
          </div>
        </form>
      </div>
    </div>
    <script src="login-signup.js"></script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    window.addEventListener("pageshow", function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            // This means the page was loaded from back/forward cache
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
                  window.location.href = data.redirect_url;
              } else {
                  alert(data.message);
              }
          })
          .catch(error => {
              console.error('Error:', error);
              alert('Login failed. Please try again.');
          });
      });
    </script>
    <!-- <script>

      function redirect(){
        const selected = document.querySelector('input[name="user-type-login"]:checked').value;
      if (selected === 'applicant') {
        window.location.href = '../applicant/pages/applicant-dashboard.html';
      } else if (selected === 'employer') {
        window.location.href = '../employer/pages/employer-dashboard.html'; 
      }
      }
    </script> -->
  </body>
</html>
