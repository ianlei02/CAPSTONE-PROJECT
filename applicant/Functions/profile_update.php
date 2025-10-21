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

    $disability = $_POST['disability'] ?? [];
    $other = $_POST['others'] ?? '';

    if (!empty($other)) {
    $disability[] = $other;
    }
    $data_array['disability'] = implode(', ', $disability);

    $data = [
        'middleName'            => $_POST['middleName'] ?? '',
        'suffix'                => !empty($_POST['suffix']) ? $_POST['suffix'] : "N/A",
        'sex'                   => $_POST['gender'] ?? '',
        'religion'              => $_POST['religion'] ?? '',
        'birthDate'             => $_POST['birthDate'] ?? '',
        'civilStatus'           => $_POST['civilStatus'] ?? '',
        'nationality'           => $_POST['nationality'] ?? '',
        'height'                => $_POST['height'] ?? '',
        'tin'                   => $_POST['tin'] ?? '',
        'mobileNumber'          => $_POST['mobileNumber'] ?? '',
        'streetAddress'         => $_POST['streetAddress'] ?? '',
        'region_name'           => $_POST['region_name'] ?? '',
        'province_name'         => $_POST['province_name'] ?? '',
        'city_name'             => $_POST['city_name'] ?? '',
        'barangay_name'         => $_POST['barangay_name'] ?? '',
        'region_id'             => $_POST['region'] ?? '',
        'province_id'           => $_POST['province'] ?? '',
        'city_id'               => $_POST['cityMunicipality'] ?? '',
        'barangay_id'           => $_POST['barangay'] ?? '',
        'portfolioLink'         => $_POST['portfolioLink'] ?? '',
        'gdriveLink'            => $_POST['gdriveLink'] ?? '',
        'otherLinks'            => $_POST['otherLinks'] ?? '',

        'inSchool'              => $_POST['inSchool'] ?? 'no',
        'elementaryCourse'      => $_POST['elementaryCourse'] ?? null,
        'elementaryYear'        => $_POST['elementaryYear'] ?? null,
        'elementaryLevel'       => $_POST['elementaryLevel'] ?? null,
        'elementaryLastYear'    => $_POST['elementaryLastYear'] ?? null,
        'secondaryType'         => $_POST['secondaryType'] ?? null,
        'secondaryCourse'       => $_POST['secondaryCourse'] ?? null,
        'secondaryYear'         => $_POST['secondaryYear'] ?? null,
        'secondaryLevel'        => $_POST['secondaryLevel'] ?? null,
        'secondaryLastYear'     => $_POST['secondaryLastYear'] ?? null,
        'seniorHighStrand'      => $_POST['seniorHighStrand'] ?? null,
        'tertiaryCourse'        => $_POST['tertiaryCourse'] ?? null,
        'tertiaryYear'          => $_POST['tertiaryYear'] ?? null,
        'tertiaryLevel'         => $_POST['tertiaryLevel'] ?? null,
        'tertiaryLastYear'      => $_POST['tertiaryLastYear'] ?? null,
        'gradStudiesCourse'     => $_POST['gradStudiesCourse'] ?? null,
        'gradStudiesYear'       => $_POST['gradStudiesYear'] ?? null,
        'gradStudiesLevel'      => $_POST['gradStudiesLevel'] ?? null,
        'gradStudiesLastYear'    => $_POST['gradStudiesLastYear'] ?? null
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
    $relativePath = '../uploads/documents/' . $storedName;

    $oldFileQuery = $conn->prepare("SELECT file_path FROM applicant_documents WHERE applicant_id = ? AND document_type = ?");
    $oldFileQuery->bind_param("is", $applicant_id, $docType);
    $oldFileQuery->execute();
    $oldFileResult = $oldFileQuery->get_result();

    if ($oldFileResult->num_rows > 0) {
        $oldFile = $oldFileResult->fetch_assoc();
        $oldPath = __DIR__ . '/' . $oldFile['file_path'];

        if (file_exists($oldPath) && is_file($oldPath)) {
            unlink($oldPath);
        }

        $deleteStmt = $conn->prepare("DELETE FROM applicant_documents WHERE applicant_id = ? AND document_type = ?");
        $deleteStmt->bind_param("is", $applicant_id, $docType);
        $deleteStmt->execute();
    }

    if (!move_uploaded_file($file['tmp_name'], $filePath)) {
        throw new Exception("Failed to save {$file['name']}");
    }

    $stmt = $conn->prepare("INSERT INTO applicant_documents 
        (applicant_id, document_type, original_filename, stored_filename, file_path, file_type, file_size, port_link, drive_link, other_link) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("isssssisss", 
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

    $result = $stmt->execute();

    if (
        !empty($data['portfolioLink']) || 
        !empty($data['gdriveLink']) || 
        !empty($data['otherLinks'])
    ) {
        $stmt = $conn->prepare("INSERT INTO applicant_documents 
            (applicant_id, document_type, original_filename, stored_filename, file_path, file_type, file_size, port_link, drive_link, other_link) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $empty = ""; 
        $zero = 0; 
        $linkType = "links";

        $stmt->bind_param("isssssisss", 
            $applicant_id,
            $linkType,
            $empty,   
            $empty,   
            $empty,   
            $empty,   
            $zero,    
            $data['portfolioLink'],
            $data['gdriveLink'],
            $data['otherLinks']
        );

        $stmt->execute();
    }

    return $result;
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
    
    $unempReasons = null;

    if (!empty($_POST['unempReason']) || !empty($_POST['unempReasonOthers']) || !empty($_POST['otherTerm'])) {
        $reasons = array_map('trim', (array)($_POST['unempReason'] ?? []));

        foreach ($reasons as &$reason) {
            if ($reason === 'other' && !empty($_POST['unempReasonOthers'])) {
                $reason = 'other:' . trim($_POST['unempReasonOthers']);
            }
            if ($reason === 'terminated-abroad' && !empty($_POST['otherTerm'])) {
                $reason = 'terminated-abroad:' . trim($_POST['otherTerm']);
            }
        }
        unset($reason);
        $unempReasons = implode(', ', $reasons);
    }

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
        "isiississssss",
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

    function saveEducationAndTraining($conn, $applicant_id, $data) {
    try {

        $stmtEdu = $conn->prepare("INSERT INTO applicant_educ (
            applicant_id, in_school,
            elementary_course, elementary_year, elementary_level, elementary_last_year,
            secondary_type, secondary_course, secondary_year, secondary_level, secondary_last_year, senior_high_strand,
            tertiary_course, tertiary_year, tertiary_level, tertiary_last_year,
            grad_studies_course, grad_studies_year, grad_studies_level, grad_studies_last_year
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            in_school = VALUES(in_school),
            elementary_course = VALUES(elementary_course),
            elementary_year = VALUES(elementary_year),
            elementary_level = VALUES(elementary_level),
            elementary_last_year = VALUES(elementary_last_year),
            secondary_type = VALUES(secondary_type),
            secondary_course = VALUES(secondary_course),
            secondary_year = VALUES(secondary_year),
            secondary_level = VALUES(secondary_level),
            secondary_last_year = VALUES(secondary_last_year),
            senior_high_strand = VALUES(senior_high_strand),
            tertiary_course = VALUES(tertiary_course),
            tertiary_year = VALUES(tertiary_year),
            tertiary_level = VALUES(tertiary_level),
            tertiary_last_year = VALUES(tertiary_last_year),
            grad_studies_course = VALUES(grad_studies_course),
            grad_studies_year = VALUES(grad_studies_year),
            grad_studies_level = VALUES(grad_studies_level),
            grad_studies_last_year = VALUES(grad_studies_last_year),
            updated_at = CURRENT_TIMESTAMP
        ");

        $stmtEdu->bind_param(
            "isssssssssssssssssss",
            $applicant_id, 
            $data['inSchool'],
            $data['elementaryCourse'], 
            $data['elementaryYear'],
            $data['elementaryLevel'], 
            $data['elementaryLastYear'],
            $data['secondaryType'], 
            $data['secondaryCourse'], 
            $data['secondaryYear'], 
            $data['secondaryLevel'], 
            $data['secondaryLastYear'], 
            $data['seniorHighStrand'],
            $data['tertiaryCourse'], 
            $data['tertiaryYear'], 
            $data['tertiaryLevel'], 
            $data['tertiaryLastYear'],
            $data['gradStudiesCourse'], 
            $data['gradStudiesYear'], 
            $data['gradStudiesLevel'], 
            $data['gradStudiesLastYear']
        );

        if (!$stmtEdu->execute()) {
            throw new Exception("Failed to save/update education: " . $stmtEdu->error);
        }
        $stmtEdu->close();

        $newDataExists = false;
        for ($i = 1; $i <= 3; $i++) {
            if (
                !empty($_POST["trainingCourse{$i}"]) ||
                !empty($_POST["trainingHours{$i}"]) ||
                !empty($_POST["trainingInstitution{$i}"]) ||
                !empty($_POST["trainingSkills{$i}"]) ||
                !empty($_POST["trainingCertificates{$i}"])
            ) {
                $newDataExists = true;
                break;
            }
        }
        
        if ($newDataExists) {
        $delStmt = $conn->prepare("DELETE FROM applicant_training_info WHERE applicant_id = ?");
            $delStmt->bind_param("i", $applicant_id);
            $delStmt->execute();
            $delStmt->close();

            $course = $hours = $institution = $skills = $certificates = null;
            $stmtVoc = $conn->prepare("INSERT INTO applicant_training_info (
                applicant_id, training_course, training_hours, training_institution, training_skills, training_certificates
            ) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtVoc->bind_param("isisss", $applicant_id, $course, $hours, $institution, $skills, $certificates);

            for ($i = 1; $i <= 3; $i++) {
                $course       = $_POST["trainingCourse{$i}"] ?? null;
                $hours        = !empty($_POST["trainingHours{$i}"]) ? (int)$_POST["trainingHours{$i}"] : null;
                $institution  = $_POST["trainingInstitution{$i}"] ?? null;
                $skills       = $_POST["trainingSkills{$i}"] ?? null;
                $certificates = $_POST["trainingCertificates{$i}"] ?? null;

                if (!empty($course) || !empty($institution) || !empty($skills) || !empty($certificates) || !empty($hours)) {
                    if (!$stmtVoc->execute()) {
                        throw new Exception("Failed to save training {$i}: " . $stmtVoc->error);
                    }
                }
            }

            $stmtVoc->close();
        }

    } catch (Exception $e) {
        throw $e;
    }
    }

    function saveEligibilityExp($conn, $applicant_id) {
        $maxRows = max(2, 2, 3);

     for ($i = 1; $i <= $maxRows; $i++) {
        $eligibility = $_POST["eligibility$i"] ?? null;
        $eligibilityDate = !empty($_POST["eligibilityDate$i"]) ? $_POST["eligibilityDate$i"] : null;

        $license = $_POST["license$i"] ?? null;
        $licenseValid = !empty($_POST["licenseValid$i"]) ? $_POST["licenseValid$i"] : null;

        $company = $_POST["company$i"] ?? null;
        $address = $_POST["companyAddress$i"] ?? null;
        $position = $_POST["position$i"] ?? null;
        $months = !empty($_POST["months$i"]) ? intval($_POST["months$i"]) : null;
        $status = $_POST["status$i"] ?? null;

        if (!empty($eligibility) || !empty($license) || !empty($company)) {
            $stmt = $conn->prepare("
                INSERT INTO applicant_eligibility_exp 
                    (applicant_id, eligibility, eligibility_date, license, license_valid, 
                     company_name, company_address, position, months_worked, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    eligibility = VALUES(eligibility),
                    eligibility_date = VALUES(eligibility_date),
                    license = VALUES(license),
                    license_valid = VALUES(license_valid),
                    company_name = VALUES(company_name),
                    company_address = VALUES(company_address),
                    position = VALUES(position),
                    months_worked = VALUES(months_worked),
                    status = VALUES(status)
            ");

             $stmt->bind_param(
                "isssssssis",
                $applicant_id,
                $eligibility,
                $eligibilityDate,
                $license,
                $licenseValid,
                $company,
                $address,
                $position,
                $months,
                $status
            );

            $stmt->execute();
            $stmt->close();
        }
    }
   
    }

    function saveApplicantSkills($conn, $applicant_id) {
    $skills = $_POST['skills'] ?? [];
    $otherSkill = $_POST['skillOtherSpecify'] ?? null;

    if (!empty($otherSkill) && !in_array("others", $skills)) {
        $skills[] = "others";
    }

    $skills = array_unique($skills);

    if (!empty($skills)) {
        $placeholders = implode(',', array_fill(0, count($skills), '?'));
        $types = str_repeat('s', count($skills));
        $sqlDelete = "DELETE FROM applicant_skills 
                      WHERE applicant_id = ? 
                      AND skill NOT IN ($placeholders)";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i" . $types, $applicant_id, ...$skills);
        $stmtDelete->execute();
        $stmtDelete->close();
    } else {
        $stmtClear = $conn->prepare("DELETE FROM applicant_skills WHERE applicant_id = ?");
        $stmtClear->bind_param("i", $applicant_id);
        $stmtClear->execute();
        $stmtClear->close();
    }

     $stmt = $conn->prepare("
        INSERT INTO applicant_skills (applicant_id, skill, other_skill)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE
            other_skill = VALUES(other_skill)
    ");

    foreach ($skills as $skill) {
        if ($skill === "others") {
            $stmt->bind_param("iss", $applicant_id, $skill, $otherSkill);
        } else {
            $null = null;
            $stmt->bind_param("iss", $applicant_id, $skill, $null);
        }
        $stmt->execute();
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
                middle_name = IF(VALUES(middle_name) IS NULL OR VALUES(middle_name) = '', middle_name, VALUES(middle_name)),
                suffix = IF(VALUES(suffix) IS NULL OR VALUES(suffix) = '', suffix, VALUES(suffix)),
                sex = IF(VALUES(sex) IS NULL OR VALUES(sex) = '', sex, VALUES(sex)),
                date_of_birth = IF(VALUES(date_of_birth) IS NULL OR VALUES(date_of_birth) = '', date_of_birth, VALUES(date_of_birth)),
                civil_status = IF(VALUES(civil_status) IS NULL OR VALUES(civil_status) = '', civil_status, VALUES(civil_status)),
                nationality = IF(VALUES(nationality) IS NULL OR VALUES(nationality) = '', nationality, VALUES(nationality)),
                height = IF(VALUES(height) IS NULL OR VALUES(height) = '', height, VALUES(height)),
                tin = IF(VALUES(tin) IS NULL OR VALUES(tin) = '', tin, VALUES(tin)),
                disability = IF(VALUES(disability) IS NULL OR VALUES(disability) = '', disability, VALUES(disability)),
                profile_picture = IF(VALUES(profile_picture) IS NULL OR VALUES(profile_picture) = '', profile_picture, VALUES(profile_picture)),
                religion = IF(VALUES(religion) IS NULL OR VALUES(religion) = '', religion, VALUES(religion))
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
        saveEducationAndTraining($conn, $applicant_id, $data);
        saveEligibilityExp($conn, $applicant_id);
        saveApplicantSkills($conn, $applicant_id);
        
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

    
