<?php
session_start();
require __DIR__ . "/connection/dbcon.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

$user_type = $_SESSION['user_type'] ?? $_POST['user_type'] ?? '';
if (empty($user_type)) {
    die("User type not specified. Cannot proceed with verification.");
}

$email = '';
$message = '';
$ip_address = $_SERVER['REMOTE_ADDR'];

if ($user_type == 'applicant') {
    $query = "SELECT email FROM applicant_account 
             WHERE ip = ? AND status = 'pending'
             ORDER BY otp_send_time DESC LIMIT 1";
} else {
    $query = "SELECT email FROM employer_account 
             WHERE ip = ? AND status = 'pending'
             ORDER BY otp_send_time DESC LIMIT 1";
}

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $ip_address);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
}

if (isset($_POST['verify'])) {
    $entered_otp = mysqli_real_escape_string($conn, $_POST['otp']);

    if ($user_type == 'applicant') {
        $query = "SELECT email, otp FROM applicant_account 
                  WHERE ip = ? AND status = 'pending'
                  ORDER BY otp_send_time DESC LIMIT 1";
    } else {
        $query = "SELECT email, otp FROM employer_account 
                  WHERE ip = ? AND status = 'pending'
                  ORDER BY otp_send_time DESC LIMIT 1";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $ip_address);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_otp = $row['otp'];
        $email = $row['email'];

        if ($entered_otp === $stored_otp) {
            $update = "UPDATE ".($user_type == 'applicant' ? 'applicant' : 'employer')."_account 
                      SET status = 'verified' WHERE email = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("s", $email);
            
            if ($stmt->execute()) {
                $_SESSION['verified_email'] = $email;
                $_SESSION['verification_success'] = "Your account has been verified. You can now login.";
                header("Location: login-signup.php");
                exit();
            } else {
                $message = "Failed to update user status.";
                error_log("Update error: ".$conn->error);
            }
        } else {
            $message = "Incorrect OTP entered.";
        }
    } else {
        $message = "No pending OTP found for this session.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification</title>
    <link rel="stylesheet" href="./css/login-signup.css" />
  </head>
  <body>
    <div class="container">
      <div class="form-container">
         <!-- Verification form -->
          <div class="form login-form active">
              <h2>Verify OTP</h2>
               <div class="input-group" >
                  Your Email Is: <strong><?php echo htmlspecialchars($email); ?></strong>
              </div>         
              <form action="" method="POST">
                  <div class="input-group">
                      <input type="text" name="otp" id="otp" class="form-control" maxlength="6" placeholder="Enter Your OTP">
                  </div>
                  <button type="submit" name="verify" class="btn">Verify OTP</button>
              </form>
              <div class="toggle-form">
                  <a href="login-signup.php">Back to Login</a>
              </div>
              <?php if ($message && !$email): ?>
              <div class="alert alert-info" role="alert">
                  <?php echo $message; ?>
              </div>
              <?php endif; ?>
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
