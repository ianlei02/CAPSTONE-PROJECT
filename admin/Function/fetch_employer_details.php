<?php
require_once '../../connection/dbcon.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employer_id = $_POST['employer_id'] ?? null;
    $status = $_POST['status'] ?? null;

    if ($employer_id && $status) {
        $stmt = $conn->prepare("UPDATE employer_company_info SET status = ? WHERE employer_id = ?");
        $stmt->bind_param("si", $status, $employer_id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Status updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update status."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid parameters."]);
    }
}