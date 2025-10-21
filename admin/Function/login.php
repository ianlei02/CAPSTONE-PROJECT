<?php
session_start();
require_once '../../connection/dbcon.php'; 

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in both fields.']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM admin_account WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    if (password_verify($password, $admin['password'])) {

        $_SESSION['admin_ID'] = $admin['admin_ID'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_fullname'] = $admin['fullname'];
        $_SESSION['is_super_admin'] = $admin['is_super_admin'];
        $_SESSION['role'] = $admin['role'];

        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful!',
            'redirect' => '../pages/dashboard.php' 
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Username not found.']);
}

$stmt->close();
$conn->close();
?>
