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

    
    $mobile_number = $_POST['mobileNumber'] ?? '';
    $alternate_contact = $_POST['alternateContact'] ?? '';
    $street_address = $_POST['streetAddress'] ?? '';
    $region = $_POST['region'] ?? '';
    $province = $_POST['province'] ?? '';
    $city_municipality = $_POST['cityMunicipality'] ?? '';
    $barangay = $_POST['barangay'] ?? '';

    
    $conn->begin_transaction();

    try {
        
        $stmt_profile = $conn->prepare("INSERT INTO applicant_profile (applicant_id, middle_name, suffix, sex, date_of_birth, civil_status, nationality, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_profile->bind_param("issssssb", $applicant_id, $middle_name, $suffix, $sex, $date_of_birth, $civil_status, $nationality, $profile_picture);
        $stmt_profile->execute();
        
       
        $stmt_contact = $conn->prepare("INSERT INTO applicant_contact_info (applicant_id, mobile_number, alternate_contact_number, street_address, region, province, city_municipality, barangay) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_contact->bind_param("isssssss", $applicant_id, $mobile_number, $alternate_contact, $street_address, $region, $province, $city_municipality, $barangay);
        $stmt_contact->execute();
        
        
        $conn->commit();
        
        header("Location: ../pages/applicant-profile.php?success=1");
        exit();
        
    } catch (Exception $e) {
        // Roll back if any error occurs
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        // Close statements if they were created
        if (isset($stmt_profile)) $stmt_profile->close();
        if (isset($stmt_contact)) $stmt_contact->close();
        $conn->close();
    }
        

?>