<?php
session_start();
require "../../connection/dbcon.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);


$swal="";
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
    $update = "UPDATE " . ($user_type == 'applicant' ? 'applicant' : 'employer') . "_account 
               SET status = 'verified' WHERE email = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $_SESSION['verified_email'] = $email;
        $swal = "
        Swal.fire({
            title: 'Verified!',
            text: 'Your account has been successfully verified.',
            icon: 'success',
            confirmButtonText: 'Go to Login'
        }).then(() => {
            window.location.href = '../login-signup.php';
        });
        ";
    } else {
        
        $swal = "
        Swal.fire({
            title: 'Invalid OTP',
            text: 'The OTP you entered is incorrect. Please try again.',
            icon: 'error',
            confirmButtonText: 'Retry'
        });
        ";
    }
}}}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification</title>
    <link rel="stylesheet" href="../css/login-signup.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                  <a href="../login-signup.php">Back to Login</a>
              </div>
              <?php if ($message && !$email): ?>
              <div class="alert alert-info" role="alert">
                  <?php echo $message; ?>
              </div>
              <?php endif; ?>
          </div>

      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    <?php if (!empty($swal)) { echo $swal; } ?>
    </script>

    
  </body>

</html>
