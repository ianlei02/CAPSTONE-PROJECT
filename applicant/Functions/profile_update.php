<?php
session_start();
require "../connection/dbcon.php";  

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

    $disability = $_POST['disability'] ?? [];
    $other = $_POST['others'] ?? '';

    if (!empty($other)) {
    $disability[] = $other;
    }
    $data_array['disability'] = implode(', ', $disability);

    $data = [
        'middleName'       => $_POST['middleName'] ?? '',
        'suffix'           => !empty($_POST['suffix']) ? $_POST['suffix'] : "N/A",
        'sex'              => $_POST['gender'] ?? '',
        'religion'         => $_POST['religion'] ?? '',
        'birthDate'        => $_POST['birthDate'] ?? '',
        'civilStatus'      => $_POST['civilStatus'] ?? '',
        'nationality'      => $_POST['nationality'] ?? '',
        'height'           => $_POST['height'] ?? '',
        'tin'              => $_POST['tin'] ?? '',
        'mobileNumber'     => $_POST['mobileNumber'] ?? '',
        'streetAddress'    => $_POST['streetAddress'] ?? '',
        'region_name'      => $_POST['region_name'] ?? '',
        'province_name'    => $_POST['province_name'] ?? '',
        'city_name'        => $_POST['city_name'] ?? '',
        'barangay_name'    => $_POST['barangay_name'] ?? '',
        'region_id'        => $_POST['region'] ?? '',
        'province_id'      => $_POST['province'] ?? '',
        'city_id'          => $_POST['cityMunicipality'] ?? '',
        'barangay_id'      => $_POST['barangay'] ?? '',
        'portfolioLink'    => $_POST['portfolioLink'] ?? '',
        'gdriveLink'       => $_POST['gdriveLink'] ?? '',
        'otherLinks'       => $_POST['otherLinks'] ?? ''
    ];
   
    $allowedTypes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'image/jpeg',
        'image/png'
    ];
    $maxFileSize = 10 * 1024 * 1024; 

    ini_set('upload_max_filesize', '10M');
    ini_set('post_max_size', '12M');
    ini_set('memory_limit', '32M');

    
    function handleFileUpload($fieldName, $docType, $conn, $applicant_id, $data, $allowedTypes, $maxFileSize) {
        if (empty($_FILES[$fieldName]['name'])) {
            return true; 
        }

        $file = $_FILES[$fieldName];

        if ($file['size'] > $maxFileSize) {
            throw new Exception("{$file['name']} exceeds 10MB limit");
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileType = $finfo->file($file['tmp_name']);
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        
        $allowedExtensions = ['pdf', 'doc', 'docx', 'jpeg', 'jpg', 'png'];
        if (!in_array($fileType, $allowedTypes) || !in_array($extension, $allowedExtensions)) {
            throw new Exception("Invalid file type or extension for {$file['name']}");
        }

        $storedName = bin2hex(random_bytes(16)) . '.' . $extension;

       
        $uploadDir = __DIR__ . '/../uploads/documents/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $filePath = $uploadDir . $storedName;

        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new Exception("Failed to save {$file['name']}");
        }

        
        $relativePath = '../uploads/documents/' . $storedName;

        $stmt = $conn->prepare("INSERT INTO applicant_documents 
                            (applicant_id, document_type, original_filename, stored_filename, file_path, file_type, file_size, portfolio_link, gdrive_link, other_links) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("isssssi", 
            $applicant_id,
            $docType,
            $file['name'],
            $storedName,
            $relativePath,
            $fileType,
            $file['size'],
            $data['portfolioLink'],
            $data['gdriveLink'],
            $data['otherLinks']
        );

        return $stmt->execute();
    }

    function handleApplicantProfilePictureUpload($conn, $applicant_id, $allowedTypes, $maxFileSize) {
        if (empty($_FILES['profilePicture']['name']) || $_FILES['profilePicture']['error'] !== UPLOAD_ERR_OK) {
            return null; // No file uploaded or upload error
        }
    
        $file = $_FILES['profilePicture'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $fileType = $finfo->file($file['tmp_name']);
    
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid profile picture format. Only JPG, PNG, or WebP allowed.");
        }
    
        if ($file['size'] > $maxFileSize) {
            throw new Exception("Profile picture exceeds the " . ($maxFileSize / 1024 / 1024) . "MB limit.");
        }
    
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $storedName = 'profile_' . $applicant_id . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
    
        $uploadDir = __DIR__ . '/../uploads/profile_pictures/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception("Failed to create upload directory.");
            }
        }
    
        if (!is_writable($uploadDir)) {
            throw new Exception("Upload directory is not writable.");
        }
    
        // Delete old picture if not default
        $query = "SELECT profile_picture FROM applicant_profile WHERE applicant_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $applicant_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $oldPath = $row['profile_picture'];
            if ($oldPath && $oldPath !== '../assets/images/profile.png') {
                $fullOldPath = __DIR__ . '/../' . ltrim($oldPath, './');
                if (file_exists($fullOldPath)) {
                    unlink($fullOldPath);
                }
            }
        }
    
       
        $filePath = $uploadDir . $storedName;
        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new Exception("Failed to upload profile picture.");
        }
    
        $relativePath = 'uploads/profile_pictures/' . $storedName;
    
        // Update DB
        $stmt = $conn->prepare("UPDATE applicant_profile SET profile_picture = ? WHERE applicant_id = ?");
        $stmt->bind_param("si", $relativePath, $applicant_id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update applicant profile picture in the database.");
        }
    
        return $relativePath;
    }

    function saveEmploymentStatus($conn, $applicant_id) {
    $employmentStatus = $_POST['employmentStatus'] ?? 'Unemployed';

    $wageEmployed = isset($_POST['wageEmployed']) ? 1 : 0;
    $selfEmployed = ($employmentStatus === "Self-Employed") ? 1 : 0;

    $selfEmployedType = !empty($_POST['selfEmployedType']) ? implode(', ', (array)$_POST['selfEmployedType']) : null;
    $selfEmployedOther = $_POST['selfEmployedOther'] ?? null;

    $jobSearchDuration = !empty($_POST['jobSearchDuration']) ? (int)$_POST['jobSearchDuration'] : null;
    $unempReasons = !empty($_POST['unempReason']) ? implode(', ', (array)$_POST['unempReason']) : null;

    $ofw = $_POST['ofw'] ?? 'no';
    $ofwCountry = $_POST['ofwCountry'] ?? null;

    $formerOfw = $_POST['formerOfw'] ?? 'no';
    $formerOfwCountry = $_POST['formerOfwCountry'] ?? null;
    $returnDateInput = $_POST['returnDate'] ?? null;
    $returnDate = null;

    if (!empty($returnDateInput)) {
        if (preg_match('/^\d{4}-\d{2}$/', $returnDateInput)) {
            $returnDate = $returnDateInput . '-01';
        } elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $returnDateInput)) {
            $returnDate = $returnDateInput;
        } else {
             $returnDate = null;
        }
    }

    $stmt = $conn->prepare("
        INSERT INTO applicant_employment_stat 
        (applicant_id, employment_status, wage_employed, self_employed, self_employed_type, self_employed_other, job_search_duration, unemp_reasons, ofw, ofw_country, former_ofw, former_ofw_country, return_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            employment_status = VALUES(employment_status),
            wage_employed = VALUES(wage_employed),
            self_employed = VALUES(self_employed),
            self_employed_type = VALUES(self_employed_type),
            self_employed_other = VALUES(self_employed_other),
            job_search_duration = VALUES(job_search_duration),
            unemp_reasons = VALUES(unemp_reasons),
            ofw = VALUES(ofw),
            ofw_country = VALUES(ofw_country),
            former_ofw = VALUES(former_ofw),
            former_ofw_country = VALUES(former_ofw_country),
            return_date = VALUES(return_date),
            updated_at = CURRENT_TIMESTAMP
    ");

    $stmt->bind_param(
        "isiiissssssss",
        $applicant_id,       
        $employmentStatus,   
        $wageEmployed,       
        $selfEmployed,       
        $selfEmployedType,   
        $selfEmployedOther,  
        $jobSearchDuration,  
        $unempReasons,       
        $ofw,               
        $ofwCountry,        
        $formerOfw,         
        $formerOfwCountry,   
        $returnDate          
    );

    if (!$stmt->execute()) {
        throw new Exception("Employment status save failed: " . $stmt->error);
    }
    $stmt->close();
    }

    function saveJobLanguageData($conn, $applicant_id) {
        $prefEmploymentTypes = !empty($_POST['prefEmploymentType']) ? json_encode((array)$_POST['prefEmploymentType']) : json_encode([]);
        $prefOccupations = json_encode(array_filter([
            $_POST['prefOccupation1'] ?? null,
            $_POST['prefOccupation2'] ?? null,
            $_POST['prefOccupation3'] ?? null
        ]));
        $prefLocalWorkLocations = json_encode(array_filter([
            $_POST['prefLocal1'] ?? null,
            $_POST['prefLocal2'] ?? null,
            $_POST['prefLocal3'] ?? null
        ]));
        $prefOverseasWorkLocations = json_encode(array_filter([
            $_POST['prefOverseas1'] ?? null,
            $_POST['prefOverseas2'] ?? null,
            $_POST['prefOverseas3'] ?? null
        ]));
        
        $languages = ['english', 'filipino', 'mandarin', 'other'];
        $languageProficiency = [];

        foreach ($languages as $lang) {
            $languageProficiency[$lang] = [
                'read' => isset($_POST["{$lang}Read"]) ? 1 : 0,
                'write' => isset($_POST["{$lang}Write"]) ? 1 : 0,
                'speak' => isset($_POST["{$lang}Speak"]) ? 1 : 0,
                'understand' => isset($_POST["{$lang}Understand"]) ? 1 : 0
        ];

        if ($lang === 'other') {
            $languageProficiency[$lang]['name'] = $_POST['otherLanguage'] ?? '';
        }
        }

        $languageProficiencyJson = json_encode($languageProficiency);

        $stmt = $conn->prepare("
                INSERT INTO applicant_job_language_data 
                (applicant_id, pref_employment_types, pref_occupations, pref_local_work_locations, pref_overseas_work_locations, language_proficiency)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                    pref_employment_types = VALUES(pref_employment_types),
                    pref_occupations = VALUES(pref_occupations),
                    pref_local_work_locations = VALUES(pref_local_work_locations),
                    pref_overseas_work_locations = VALUES(pref_overseas_work_locations),
                    language_proficiency = VALUES(language_proficiency),
                    updated_at = CURRENT_TIMESTAMP
            ");

            $stmt->bind_param(
                "isssss",
                $applicant_id,
                $prefEmploymentTypes,
                $prefOccupations,
                $prefLocalWorkLocations,
                $prefOverseasWorkLocations,
                $languageProficiencyJson
            );

            if (!$stmt->execute()) {
                throw new Exception("Job/Language data save failed: " . $stmt->error);
            }

            $stmt->close();
    }
            
    $conn->begin_transaction();


    try {
        
        // Handle profile picture upload and get the path
        $uploadedProfilePic = handleApplicantProfilePictureUpload($conn, $applicant_id, ['image/jpeg', 'image/png', 'image/webp'], $maxFileSize);
        if ($uploadedProfilePic !== null) {
            $profile_picture = $uploadedProfilePic;
        }

       $stmt_profile = $conn->prepare("
            INSERT INTO applicant_profile 
            (applicant_id, middle_name, suffix, sex, date_of_birth, civil_status, nationality, height, tin, disability, profile_picture, religion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                middle_name = VALUES(middle_name),
                suffix = VALUES(suffix),
                sex = VALUES(sex),
                date_of_birth = VALUES(date_of_birth),
                civil_status = VALUES(civil_status),
                nationality = VALUES(nationality),
                height = VALUES(height),
                tin = VALUES(tin),
                disability = VALUES(disability),
                profile_picture = VALUES(profile_picture),
                religion = VALUES(religion)
        ");

        $stmt_profile->bind_param(
            "isssssssssss",
            $applicant_id,
            $data['middleName'],
            $data['suffix'],
            $data['sex'],
            $data['birthDate'],
            $data['civilStatus'],
            $data['nationality'],
            $data['height'],
            $data['tin'],
            $data_array['disability'],
            $profile_picture,
            $data['religion']
    );

        $stmt_profile->execute();
                
            $stmt_contact = $conn->prepare("
            INSERT INTO applicant_contact_info 
            (applicant_id, mobile_number, street_address, region, province, city_municipality, barangay, region_id, province_id, city_id, barangay_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                mobile_number = VALUES(mobile_number),
                street_address = VALUES(street_address),
                region = VALUES(region),
                province = VALUES(province),
                city_municipality = VALUES(city_municipality),
                barangay = VALUES(barangay),
                region_id = VALUES(region_id),
                province_id = VALUES(province_id),
                city_id = VALUES(city_id),
                barangay_id = VALUES(barangay_id)
        ");

        $stmt_contact->bind_param(
            "issssssssss",
            $applicant_id,
            $data['mobileNumber'],
            $data['streetAddress'],
            $data['region_name'],
            $data['province_name'],
            $data['city_name'],
            $data['barangay_name'],
            $data['region_id'],
            $data['province_id'],
            $data['city_id'],
            $data['barangay_id']
        );

        $stmt_contact->execute();
        
        saveEmploymentStatus($conn, $applicant_id);
        saveJobLanguageData($conn, $applicant_id);
        
        handleFileUpload('resumeFile', 'resume', $conn, $applicant_id, $data, $allowedTypes, $maxFileSize);
        handleFileUpload('idFile', 'valid_id', $conn, $applicant_id, $data, $allowedTypes, $maxFileSize);


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

                handleFileUpload('singleCertFile', 'certification', $conn, $applicant_id, $data, $allowedTypes, $maxFileSize);

            }
        }

        
        $conn->commit();
        
        $response['success'] = true;
        $response['message'] = 'Profile saved successfully!';

        
        
        
    } catch (Exception $e) {
        
        $conn->rollback();
        $response['message'] = 'Error: ' . $e->getMessage();
    } finally {
        
        if (isset($stmt_profile)) $stmt_profile->close();
        if (isset($stmt_contact)) $stmt_contact->close();
        $conn->close();
    }
    if ($response['success']) {
    
    header("Location: ../pages/applicant-profile.php?status=success&msg=" . urlencode($response['message']));
    exit();
} else {
    
    header("Location: ../pages/applicant-profile.php?status=error&msg=" . urlencode($response['message']));
    exit();
}

    
