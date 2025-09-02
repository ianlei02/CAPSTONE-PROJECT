<?php
session_start();
require "../connection/dbcon.php";

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($conn->connect_error) {
    $response['message'] = "Database connection failed";
    echo json_encode($response);
    exit();
}

if (!isset($_SESSION['user_id'])) {
    $response['message'] = "User not logged in";
    echo json_encode($response);
    exit();
}

$applicant_id = $_SESSION['user_id'];

$middle_name = $_POST['middleName'] ?? '';
$suffix = $_POST['suffix'] ?? '';
$sex = $_POST['gender'] ?? '';
$date_of_birth = $_POST['birthDate'] ?? '';
$civil_status = $_POST['civilStatus'] ?? '';
$nationality = $_POST['nationality'] ?? '';

$mobile_number = $_POST['mobileNumber'] ?? '';
$alternate_contact = $_POST['alternateContact'] ?? '';
$street_address = $_POST['streetAddress'] ?? '';
$region = $_POST['region_name'] ?? '';
$province = $_POST['province_name'] ?? '';
$city_municipality = $_POST['city_name'] ?? '';
$barangay = $_POST['barangay_name'] ?? '';

$primary_skills = $_POST['primarySkills'] ?? '';
$technical_skills = $_POST['technicalSkills'] ?? '';
$language = $_POST['language'] ?? 'English';
$proficiency_level = $_POST['proficiencyLevel'] ?? 'Basic';

$education_level = $_POST['educationLevel'] ?? '';
$school_name = $_POST['schoolName'] ?? '';
$course_or_degree = $_POST['courseDegree'] ?? '';
$year_graduated = $_POST['yearGraduated'] ?? '';

$company_name = $_POST['companyName'] ?? '';
$position = $_POST['position'] ?? '';
$industry = $_POST['industry'] ?? '';
$employment_start = $_POST['employmentStart'] ?? '';
$employment_end = $_POST['employmentEnd'] ?? '';
$key_responsibilities = $_POST['keyResponsibilities'] ?? '';


$allowedTypes = [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'image/jpeg',
    'image/png'
];
$maxFileSize = 10 * 1024 * 1024; 

function handleFileUpload($fieldName, $docType, $conn, $applicant_id, $allowedTypes, $maxFileSize) {
    if (empty($_FILES[$fieldName]['name'])) {
        return true;
    }

    $file = $_FILES[$fieldName];

    if ($file['size'] > $maxFileSize) {
        throw new Exception("File exceeds 10MB limit");
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $finfo->file($file['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        throw new Exception("Invalid file type");
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $storedName = bin2hex(random_bytes(16)) . '.' . $extension;

    $uploadDir = __DIR__ . '/../uploads/documents/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $filePath = $uploadDir . $storedName;

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        throw new Exception("Failed to save file");
    }

    $relativePath = '../uploads/documents/' . $storedName;

    $conn->query("DELETE FROM applicant_documents WHERE applicant_id = $applicant_id AND document_type = '$docType'");

    $stmt = $conn->prepare("INSERT INTO applicant_documents 
                    (applicant_id, document_type, original_filename, stored_filename, file_path, file_type, file_size) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("isssssi", 
        $applicant_id,
        $docType,
        $file['name'],
        $storedName,
        $relativePath,
        $fileType,
        $file['size']
    );

    return $stmt->execute();
}

$conn->begin_transaction();

try {
   
    $stmt_profile = $conn->prepare("UPDATE applicant_profile SET 
        middle_name = ?, 
        suffix = ?, 
        sex = ?, 
        date_of_birth = ?, 
        civil_status = ?, 
        nationality = ? 
        WHERE applicant_id = ?");
    
    $stmt_profile->bind_param("ssssssi", 
        $middle_name, $suffix, $sex, $date_of_birth, $civil_status, $nationality, $applicant_id);
    $stmt_profile->execute();

    $stmt_contact = $conn->prepare("UPDATE applicant_contact_info SET 
        mobile_number = ?, 
        alternate_contact_number = ?, 
        street_address = ?, 
        region = ?, 
        province = ?, 
        city_municipality = ?, 
        barangay = ? 
        WHERE applicant_id = ?");
    
    $stmt_contact->bind_param("sssssssi", 
        $mobile_number, $alternate_contact, $street_address, $region, 
        $province, $city_municipality, $barangay, $applicant_id);
    $stmt_contact->execute();

    $stmt_skills = $conn->prepare("UPDATE applicant_skills SET 
        primary_skills = ?, 
        technical_skills = ?, 
        language = ?, 
        proficiency_level = ? 
        WHERE applicant_id = ?");
    
    $stmt_skills->bind_param("ssssi", 
        $primary_skills, $technical_skills, $language, $proficiency_level, $applicant_id);
    $stmt_skills->execute();

    $conn->query("DELETE FROM applicant_educ WHERE applicant_id = $applicant_id");
    
    if (!empty($education_level) && !empty($school_name)) {
        $stmt_educ = $conn->prepare("INSERT INTO applicant_educ 
            (applicant_id, education_level, school_name, course_or_degree, year_graduated) 
            VALUES (?, ?, ?, ?, ?)");
        $stmt_educ->bind_param("issss", 
            $applicant_id, $education_level, $school_name, $course_or_degree, $year_graduated);
        $stmt_educ->execute();
    }

    $conn->query("DELETE FROM applicant_work_exp WHERE applicant_id = $applicant_id");
    
    if (!empty($company_name)) {
        $stmt_work_exp = $conn->prepare("INSERT INTO applicant_work_exp 
            (applicant_id, company_name, position, industry, employment_start, employment_end, key_responsibilities) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt_work_exp->bind_param("issssss", 
            $applicant_id,
            $company_name,
            $position,
            $industry,
            $employment_start,
            $employment_end,
            $key_responsibilities);
        $stmt_work_exp->execute();
    }

    // 6. Handle file uploads
    handleFileUpload('resumeFile', 'resume', $conn, $applicant_id, $allowedTypes, $maxFileSize);
    handleFileUpload('idFile', 'valid_id', $conn, $applicant_id, $allowedTypes, $maxFileSize);

    // 7. Handle multiple certification files
    if (!empty($_FILES['certFiles']['name'][0])) {
        foreach ($_FILES['certFiles']['name'] as $index => $filename) {
            $fileArray = [
                'name'     => $_FILES['certFiles']['name'][$index],
                'type'     => $_FILES['certFiles']['type'][$index],
                'tmp_name' => $_FILES['certFiles']['tmp_name'][$index],
                'error'    => $_FILES['certFiles']['error'][$index],
                'size'     => $_FILES['certFiles']['size'][$index],
            ];

            $_FILES['singleCertFile'] = $fileArray;
            handleFileUpload('singleCertFile', 'certification', $conn, $applicant_id, $allowedTypes, $maxFileSize);
        }
    }

    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Profile updated successfully!';

} catch (Exception $e) {
    $conn->rollback();
    $response['message'] = 'Error: ' . $e->getMessage();
} finally {
    if (isset($stmt_profile)) $stmt_profile->close();
    if (isset($stmt_contact)) $stmt_contact->close();
    if (isset($stmt_skills)) $stmt_skills->close();
    if (isset($stmt_educ)) $stmt_educ->close();
    if (isset($stmt_work_exp)) $stmt_work_exp->close();
    $conn->close();
}

 if ($response['success']) {
    
    header("Location: ../pages/applicant-profile.php?status=success&msg=" . urlencode($response['message']));
    exit();
} else {
    
    header("Location: ../pages/applicant-profile.php?status=error&msg=" . urlencode($response['message']));
    exit();
}

    