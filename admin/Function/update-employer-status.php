<?php
require_once "../../connection/dbcon.php";
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $status = $_POST['status'] ?? '';

    if (empty($email) || empty($status)) {
        echo json_encode(["success" => false, "message" => "Missing data."]);
        exit;
    }
$validStatuses = ['pending', 'verified', 'revoked'];
    if (!in_array($status, $validStatuses)) {
        echo json_encode(["success" => false, "message" => "Invalid status value."]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE employer_account SET b_status = ? WHERE email = ?");
    $stmt->bind_param("ss", $status, $email);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Status updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update status."]);
    }

    $stmt->close();
    $conn->close();
}