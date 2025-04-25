<?php
session_start();
require "connection/dbcon.php";

// Verify database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Validate session
$user_type = $_SESSION['user_type'] ?? '';
if (empty($user_type)) {
    die("User type not specified. Cannot proceed with verification.");
}

$message = "";
$email = "";
$stored_otp = "";

if (isset($_POST['verify'])) {
    // Sanitize input
    $entered_otp = mysqli_real_escape_string($conn, $_POST['otp']);
    
    // Use prepared statement with email
    $query = $user_type == 'applicant' 
        ? "SELECT email, otp FROM applicant_account WHERE email = ? AND status = 'pending' AND otp_send_time > DATE_SUB(NOW(), INTERVAL 15 MINUTE) LIMIT 1"
        : "SELECT email, otp FROM employer_account WHERE email = ? AND status = 'pending' AND otp_send_time > DATE_SUB(NOW(), INTERVAL 15 MINUTE) LIMIT 1";
    
    // Get email from session or previous query
    $email = $_SESSION['email'] ?? '';
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_otp = $row['otp'];
        $email = $row['email'];
        
        if ($entered_otp === $stored_otp) {
            // Update user status using email
            $update = $user_type == 'applicant'
                ? "UPDATE applicant_account SET status = 'verified' WHERE email = ?"
                : "UPDATE employer_account SET status = 'verified' WHERE email = ?";
            
            $stmt = mysqli_prepare($conn, $update);
            mysqli_stmt_bind_param($stmt, "s", $email);
            
            if (mysqli_stmt_execute($stmt)) {
                // Regenerate session ID for security
                session_regenerate_id(true);
                
                $_SESSION['verified'] = true;
                $_SESSION['email'] = $email;
                
                header("Location: ../{$user_type}/pages/{$user_type}-dashboard.php");
                exit();
            } else {
                $message = "Verification succeeded but failed to update database.";
            }
        } else {
            $message = "Invalid OTP. Please try again.";
        }
    } else {
        $message = "No pending OTP found for your email or OTP has expired.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification</title>
    <link rel="stylesheet" href="login-signup.css" />
  </head>
  <body>
    <div class="container">
      <div class="form-container">
         <!-- Verification form -->
        <div class="form login-form active" >
          <h2>Verify OTP</h2>
          <?php if ($email): ?>
          <div class="alert alert-info" role="alert">
              Your Email Is:<strong><?php echo htmlspecialchars($email); ?></strong>
          </div>
              <?php else:?>
          <div class="alert alert-info" role="alert">
            <?php echo $message;?>
          </div>
          <?php endif; ?>
          <form action="" method="POST">
            <div class="input-group">
              <span class="input-group"></span>
              <input type="text"" name="otp" id="otp" class="form-control" maxlength="6" placeholder="Enter Your Otp">
            </div>
            <button type="submit" name="verify" class="btn">Verify OTP</button>
          </form>
          <?php if ($message && !$email):?>
            <div class="alert alert-info" role="alert">
              <?php echo $message; ?>
            </div>
            <?php endif;?>
        </div>


      </div>
    </div>

    <!-- Scripts (unchanged) -->
    <!-- <script src="login-signup.js"></script> -->
    <!-- <script>
      function generateRandomNumber(){
        let min = 100000;
        let max = 999999;
        let randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;

        let lastGeneratedNUmber = localStorage.getItem('lastGeneratedNumber');
        while (randomNumber === parseInt(lastGeneratedNUmber)){
          randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;
        }
        localStorage.setItem('lastGeneratedNumber', randomNumber);
        return randomNumber;
      }
      document.getElementById('otp') && (document.getElementById('otp').value = generateRandomNumber());
    </script> -->
    <!-- <script>
      if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
      }

      window.addEventListener("pageshow", function(event) {
          if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
              window.location.reload();
          }
      });
    </script> -->
    <!-- <script>
      document.querySelector('.login-form form')?.addEventListener('submit', function(e) {
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
    </script> -->
  </body>
</html>
