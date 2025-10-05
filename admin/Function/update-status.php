<?php
require "../../connection/dbcon.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicant_id = intval($_POST['applicant_id'] ?? 0);
    $job_id = intval($_POST['job_id'] ?? 0);
    $status = $_POST['status'] ?? '';

    if (!$applicant_id || !$job_id || !in_array($status, ['referred', 'rejected'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE job_application SET status = ? WHERE applicant_id = ? AND job_id = ?");
    $stmt->bind_param("sii", $status, $applicant_id, $job_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Database update failed"]);
    }

    $notif = $conn->prepare("INSERT INTO notifications (applicant_id, message, seen, created_at) VALUES (?, ?, 0, NOW())");
    $message = ($status === 'referred') ? "Your application has been referred." : "Your application has been rejected.";
    $notif->bind_param("is", $applicant_id, $message);
    $notif->execute();
    $notif->close();
    
    $stmt->close();
    $conn->close();
}