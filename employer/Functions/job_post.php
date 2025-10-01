<?php
session_start();
require "../../connection/dbcon.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);   
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in");
}

    $employer_id = $_SESSION['user_id'];

    $jobTitle    = trim($_POST['jobTitle'] ?? '');
    $jobType     = trim($_POST['jobType'] ?? '');
    $location    = trim($_POST['location'] ?? '');
    $category    = trim($_POST['category'] ?? '');
    $vacancies   = intval($_POST['vacancies'] ?? 0);
    $expiryDate  = !empty($_POST['expiryDate']) ? $_POST['expiryDate'] : null;
    $salary      = $_POST['salary'] ?? [];
    $description = trim($_POST['description'] ?? '');
    $salaryRange = '';

    if (count($salary) === 2) {
        $min = intval($salary[0]);
        $max = intval($salary[1]);
        $salaryRange = "₱{$min}-₱{$max}";
    }

    if (empty($jobTitle) || empty($jobType) || empty($location) || empty($category) || $vacancies <= 0) {
        die("Error: Missing required fields.");
    }

    $sql = "INSERT INTO job_postings 
            (employer_id, job_title, job_type, location, category, vacancies, expiry_date, salary_range, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "issssisss", 
            $employer_id, $jobTitle, $jobType, $location, $category,
            $vacancies, $expiryDate, $salaryRange, $description
        );
        
        if ($stmt->execute()) {
            header("Location: ../pages/employer-post.php?success=1");
            exit;
        } else {
            header("Location:  ../pages/employer-post.php?error=db");
            exit;
        }
    } else {
        header("Location:  ../pages/employer-post.php?error=stmt");
        exit;
    }


    
    
