<?php
session_start();
include "../../connection/dbcon.php";

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $token = trim($_POST['token'] ?? '');
    $newPassword = trim($_POST['new_password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');

    if (empty($email) || empty($token) || empty($newPassword) || empty($confirmPassword)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM password_resets WHERE email = ? AND token = ? AND expires >= ?");
    $currentTime = time();
    $stmt->bind_param("ssi", $email, $token, $currentTime);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Invalid or expired reset link."]);
        exit;
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE applicant_account SET password=? WHERE email=?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        $stmt = $conn->prepare("UPDATE employer_account SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();
    }

    $stmt = $conn->prepare("DELETE FROM password_resets WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    echo json_encode(["status" => "success", "message" => "Your password has been updated successfully."]);
    exit;
}

echo json_encode(["status" => "error", "message" => "Invalid request."]);
exit;
?>
