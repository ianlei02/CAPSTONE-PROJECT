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

$company_name = $_POST['companyName'] ?? '';
$company_type = $_POST['companyType'] ?? '';
$industry = $_POST['industry'] ?? '';
$company_size = $_POST['companySize'] ?? '';
$address = $_POST['address'] ?? '';
$contact_number = $_POST['contactNumber'] ?? '';
$email = $_POST['email'] ?? '';


$contact_person = $_POST['contactPerson'] ?? '';
$contact_position = $_POST['position'] ?? '';
$contact_mobile = $_POST['mobileNumber'] ?? '';
$contact_email = $_POST['contactEmail'] ?? '';

$allowedImageTypes = [
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/webp'
];
$maxImageSize = 5 * 1024 * 1024; 

function handleProfilePictureUpload($conn, $employer_id, $allowedTypes, $maxImageSize) {
    if (empty($_FILES['profilePicture']['name'])) {
        return null;
    }

    $file = $_FILES['profilePicture'];

    if ($file['size'] > $maxImageSize) {
        throw new Exception("Profile picture exceeds 5MB limit");
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $finfo->file($file['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        throw new Exception("Only JPG, PNG, GIF, or WebP images are allowed for profile pictures");
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $storedName = 'profile_' . $employer_id . '_' . bin2hex(random_bytes(8)) . '.' . $extension;

    $uploadDir = __DIR__ . '/../uploads/profile_pictures/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $oldPicture = $conn->query("SELECT profile_picture FROM employer_company_info WHERE employer_id = $employer_id")->fetch_assoc();
    if ($oldPicture && !empty($oldPicture['profile_picture'])) {
        $oldPath = __DIR__ . '/../' . $oldPicture['profile_picture'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    $filePath = $uploadDir . $storedName;
    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        throw new Exception("Failed to save profile picture");
    }

    $relativePath = 'uploads/profile_pictures/' . $storedName;
    $stmt = $conn->prepare("UPDATE employer_company_info SET profile_picture = ? WHERE employer_id = ?");
    $stmt->bind_param("si", $relativePath, $employer_id);
    $stmt->execute();

    return $relativePath;
}

$uploadDir = __DIR__ . '/uploads/company_docs/';
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0777, true)) {
        die("Failed to create upload directory");
    }
}
if (!is_writable($uploadDir)) {
    die("Upload directory is not writable");
}

$conn->begin_transaction();

try {
   
    $stmt_info = $conn->prepare("INSERT INTO employer_company_info (
        employer_id, company_type, company_name, industry, company_size, address,
        contact_number, email, contact_person, contact_position, contact_mobile, contact_email
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
        company_type = VALUES(company_type),
        company_name = VALUES(company_name),
        industry = VALUES(industry),
        company_size = VALUES(company_size),
        address = VALUES(address),
        contact_number = VALUES(contact_number),
        email = VALUES(email),
        contact_person = VALUES(contact_person),
        contact_position = VALUES(contact_position),
        contact_mobile = VALUES(contact_mobile),
        contact_email = VALUES(contact_email)");

    $stmt_info->bind_param("isssssssssss",
        $employer_id,
        $company_type,
        $company_name,
        $industry,
        $company_size,
        $address,
        $contact_number,
        $email,
        $contact_person,
        $contact_position,
        $contact_mobile,
        $contact_email
    );

    if (!$stmt_info->execute()) {
        throw new Exception("Failed to save company info: " . $stmt_info->error);
    }

    $docFields = [
        "bir" => "bir_certification",
        "business-permit" => "business_permit",
        "dole" => "dole_certification",
        "migrant" => "migrant_certification",
        "philjob" => "philjob_certification"
    ];

    $uploadedFiles = [];
    $timestamps = [];

    foreach ($docFields as $field => $column) {
        $fileKey = "upload-" . $field;

        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$fileKey];

            $allowedTypes = [
                'application/pdf',
                'image/jpeg',
                'image/png',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];

            if (!in_array($file['type'], $allowedTypes)) {
                throw new Exception("Invalid file type for $field. Only PDF, JPG, PNG, DOC, and DOCX are allowed.");
            }

            if ($file['size'] > 5242880) {
                throw new Exception("File too large for $field. Maximum size is 5MB.");
            }

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = "doc_{$employer_id}_{$field}_" . time() . ".$ext";
            $targetPath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $uploadedFiles[$column] = "employer/Functions/uploads/company_docs/" . $filename;
                $timestamps[$column . "_uploaded_at"] = date("Y-m-d H:i:s");
            } else {
                throw new Exception("Failed to move uploaded file: " . $file['name']);
            }
        }
    }

        if (!empty($uploadedFiles)) {
        $check = $conn->prepare("SELECT doc_id FROM employer_company_docs WHERE employer_id = ?");
        $check->bind_param("i", $employer_id);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
                
                $setParts = [];
            $values = [];
            $types = "";

            foreach ($uploadedFiles as $col => $path) {
                $setParts[] = "$col = ?";
                $values[] = $path;
                $types .= "s";

                $setParts[] = $col . "_uploaded_at = ?";
                $values[] = $timestamps[$col . "_uploaded_at"];
                $types .= "s";
            }

            $values[] = $employer_id;
            $types .= "i";

            $setClause = implode(", ", $setParts);
            $update_query = "UPDATE employer_company_docs SET $setClause WHERE employer_id = ?";
            $stmt_update = $conn->prepare($update_query);
            $stmt_update->bind_param($types, ...$values);

            if (!$stmt_update->execute()) {
                throw new Exception("Failed to update documents: " . $stmt_update->error);
            }
        } else {
                
                $columns = array_merge(array_keys($uploadedFiles), array_keys($timestamps), ['employer_id']);
            $placeholders = rtrim(str_repeat("?, ", count($columns)), ", ");
            $values = array_merge(array_values($uploadedFiles), array_values($timestamps), [$employer_id]);
            $types = str_repeat("s", count($values) - 1) . "i";
            $columnsStr = implode(", ", $columns);

            $insert_query = "INSERT INTO employer_company_docs ($columnsStr) VALUES ($placeholders)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param($types, ...$values);

            if (!$stmt_insert->execute()) {
                throw new Exception("Failed to insert documents: " . $stmt_insert->error);
                }
            }
        }
        $profilePicturePath = handleProfilePictureUpload($conn, $employer_id, $allowedImageTypes, $maxImageSize);

        $conn->commit();

        header("Location: ../pages/employer-profile.php?success=1");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        error_log("Employer profile update error: " . $e->getMessage());

        // Show the actual error for debugging (you can remove later)
        echo "<pre>Error: " . htmlspecialchars($e->getMessage()) . "</pre>";
        exit();
    } finally {
        if (isset($stmt_info)) $stmt_info->close();
        if (isset($check)) $check->close();
        if (isset($stmt_update)) $stmt_update->close();
        if (isset($stmt_insert)) $stmt_insert->close();
        $conn->close();
    }