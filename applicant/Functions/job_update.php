<?php
session_start();
require "../../connection/dbcon.php";  

    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => ''];


    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
    }


    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
    }
    

    $applicant_id = $_SESSION['user_id'];

    
    $job_id = $_POST['job_id'] ?? null;
    $applicant_id = $_SESSION['user_id'] ?? null;
    $cover_letter = $_POST['cover_letter'] ?? null;
    $referral_source = $_POST['referral_source'] ?? null;
    $availability_date = $_POST['availability_date'] ?? null;

    if (!$job_id || !$applicant_id) {
        die("Missing job_id or applicant_id");
    }

    $sql = "INSERT INTO job_application 
                (job_id, applicant_id, cover_letter, referral_source, availability_date)
            VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
                cover_letter = VALUES(cover_letter),
                referral_source = VALUES(referral_source),
                availability_date = VALUES(availability_date),
                updated_at = CURRENT_TIMESTAMP";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
    $stmt->bind_param("iisss", $job_id, $applicant_id, $cover_letter, $referral_source, $availability_date);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Our admin will review your application.";
    } else {
        $response["message"] = "Error: " . $stmt->error;
    }

    $stmt->close();
    } else {
        $response["message"] = "Prepare failed: " . $conn->error;
    }

    $conn->close();

    echo json_encode($response);