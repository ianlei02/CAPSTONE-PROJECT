<?php
session_start();
require "../../connection/dbcon.php"; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';

if (isset($_POST['email-reset'])) {
    $email = trim($_POST['email-reset']);

    $stmt = $conn->prepare("SELECT email FROM applicant_account WHERE email = ? 
                            UNION 
                            SELECT email FROM employer_account WHERE email = ?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Email not found."]);
        exit;
    }

    $token = bin2hex(random_bytes(32));
    $expires = date("U") + 1800; // 30 mins

    $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)
                            ON DUPLICATE KEY UPDATE token=?, expires=?");
    $stmt->bind_param("sssss", $email, $token, $expires, $token, $expires);
    $stmt->execute();

    $resetLink = "http://auth/login-signup.php?reset=1&email=" . urlencode($email) . "&token=$token";

    $mail = new PHPMailer(true);

    try {
    
        $mail->isSMTP();
        $mail->Host       = "smtp.gmail.com"; 
        $mail->SMTPAuth   = true;
        $mail->Username   = "justincruz9812@gmail.com";  
        $mail->Password   = "fvxzodcnxnoxqfrc"; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom("justincruz9812@gmail.com", "PESO PH");
        $mail->addAddress($email);

        
        $mail->isHTML(true);
        $mail->Subject = "Password Reset Request";
        $mail->Body    = "
            <h2>Password Reset</h2>
            <p>We received a request to reset your password. Click the link below to reset it:</p>
            <p><a href='$resetLink' target='_blank'>Reset Password</a></p>
            <p>This link will expire in 30 minutes.</p>
        ";
        $mail->AltBody = "Click this link to reset your password: $resetLink";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Check your email for the reset link."]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Mailer Error: {$mail->ErrorInfo}"]);
    }
}
?>
