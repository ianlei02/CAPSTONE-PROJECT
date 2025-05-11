<?php
session_start();
require __DIR__ . "/connection/dbcon.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

$user_type = $_SESSION['user_type'] ?? $_POST['user_type'] ?? '';
if (empty($user_type)) {
    die("User type not specified. Cannot proceed with password reset.");
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
} else {
    $message = "No verified account found for this session.";
}

// Handle password reset form submission
if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($new_password !== $confirm_password) {
        $message = "Passwords do not match.";
    } elseif (strlen($new_password) < 6) {
        $message = "Password must be at least 6 characters.";
    } elseif (!$email) {
        $message = "Email not found or session expired.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update = "UPDATE " . ($user_type == 'applicant' ? 'applicant' : 'employer') . "_account 
                   SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            $_SESSION['reset_success'] = "Password has been reset. You can now log in.";
            header("Location: login-signup.php");
            exit();
        } else {
            $message = "Failed to update password.";
            error_log("Password update error: " . $conn->error);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Reset Password</title>
    <link rel="stylesheet" href="./css/login-signup.css" />
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Reset Password Form -->
            <div class="form login-form active">
                <h2>Reset Password</h2>
                <div class="input-group">
                    Your Email Is: <strong><?php echo htmlspecialchars($email); ?></strong>
                </div>
                <form action="" method="POST">
                    <div class="input-group">
                        <input type="password" name="new_password" placeholder="New Password" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" name="reset_password" class="btn">Reset Password</button>
                </form>
                <div class="toggle-form">
                    <a href="login-signup.php">Back to Login</a>
                </div>
                <?php if ($message): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
