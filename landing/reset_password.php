<?php
require "../connection/dbcon.php";

if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    $stmt = $conn->prepare("SELECT * FROM password_resets WHERE email = ? AND token = ? AND expires >= ?");
    $timeNow = time();
    $stmt->bind_param("ssi", $email, $token, $timeNow);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Invalid or expired reset link.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Password</title>
    <link rel="stylesheet" href="./css/login-signup.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <h2>Reset Your Password</h2>
        <form action="../functions/reset_password.php" method="POST">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <div class="input-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" name="new_password" minlength="8" required>
            </div>
            <div class="input-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirm_password" minlength="8" required>
            </div>

            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</div>
</body>
</html>
