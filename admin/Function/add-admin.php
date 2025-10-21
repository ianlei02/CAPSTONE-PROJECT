<?php
require_once '../../connection/dbcon.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON data."]);
    exit;
}

$fullName = $data['name'] ?? '';
$username = $data['username'] ?? '';
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';
$permissions = $data['permissions'] ?? [];

if (!$fullName || !$username || !$email || !$password) {
    echo json_encode(["status" => "error", "message" => "All fields are required."]);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$rolesJson = json_encode($permissions);
$isSuperAdmin = 0;

$sql = "INSERT INTO admin_account (fullname, username, email, password, is_super_admin, role)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fullName, $username, $email, $hashedPassword, $isSuperAdmin, $rolesJson);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "New admin added successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to add admin.", "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
