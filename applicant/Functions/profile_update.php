<?php
session_start();
require "../connection/dbcon.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if (!isset($_SESSION['user_id'])) {
        die("Error: User not logged in");
    }

    $applicant_id = $_SESSION['user_id'];

    $middle_name = $_POST['middleName'] ?? '';
    $suffix = $_POST['suffix'] ?? '';
    $sex = $_POST['gender'] ?? '';
    $date_of_birth = $_POST['birthDate'] ?? '';
    $civil_status = $_POST['civilStatus'] ?? '';
    $nationality = $_POST['nationality'] ?? '';

    $profile_picture = null;


    $stmt = $conn->prepare("INSERT INTO applicant_profile (applicant_id, middle_name, suffix, sex, date_of_birth, civil_status, nationality, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssb", $applicant_id, $middle_name, $suffix, $sex, $date_of_birth, $civil_status, $nationality, $profile_picture);

    if ($stmt->execute()) {
        
        header("Location: ../pages/applicant-profile.php?success=1");
        exit();
    } else {
        
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>