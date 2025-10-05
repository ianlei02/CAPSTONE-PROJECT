<?php
require_once '../../connection/dbcon.php';
require_once '../../auth/functions/check_login.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$currentPassword = $_POST['currentPassword'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';

if (empty($currentPassword) || empty($newPassword)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all fields.']);
    exit;
}

$stmt = $conn->prepare("SELECT password FROM applicant_account WHERE applicant_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($currentPassword, $user['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
    exit;
}

$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
$updateStmt = $conn->prepare("UPDATE applicant_account SET password = ? WHERE applicant_id = ?");
$updateStmt->bind_param("si", $newPasswordHash, $user_id);

if ($updateStmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
}

$stmt->close();
$updateStmt->close();
$conn->close();