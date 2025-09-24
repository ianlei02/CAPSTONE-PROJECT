<?php

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}

$userId = $_SESSION['user_id'];
$mainSql = "
    SELECT 
      a.*, 
      p.*, 
      c.*, 
      e.*, 
      el.*, 
      es.*, 
      jl.*
    FROM applicant_account a
    LEFT JOIN applicant_profile p 
      ON a.applicant_id = p.applicant_id
    LEFT JOIN applicant_contact_info c 
      ON a.applicant_id = c.applicant_id
    LEFT JOIN applicant_educ e 
      ON a.applicant_id = e.applicant_id
    LEFT JOIN applicant_eligibility_exp el 
      ON a.applicant_id = el.applicant_id
    LEFT JOIN applicant_employment_stat es 
      ON a.applicant_id = es.applicant_id
    LEFT JOIN applicant_job_language_data jl 
      ON a.applicant_id = jl.applicant_id
    
    WHERE a.applicant_id = ?
";
$mainStmt = $conn->prepare($mainSql);
$mainStmt->bind_param("i", $userId);
$mainStmt->execute();
$mainResult = $mainStmt->get_result();
$mainData = $mainResult->fetch_assoc();

$accountData   = $mainData ? array_intersect_key($mainData, array_flip(array_keys($mainData))) : [];
$profileData   = $mainData ? $mainData : [];
$contactData   = $mainData ? $mainData : [];

$docsStmt = $conn->prepare("SELECT * FROM applicant_documents WHERE applicant_id = ?");
$docsStmt->bind_param("i", $userId);
$docsStmt->execute();
$docsResult = $docsStmt->get_result();
$docsData = $docsResult->fetch_all(MYSQLI_ASSOC);

$docsLStmt = $conn->prepare("SELECT port_link, drive_link, other_link FROM applicant_documents WHERE applicant_id = ?");
$docsLStmt->bind_param("i", $userId);
$docsLStmt->execute();
$docsResultt = $docsLStmt->get_result();
$docsLink = $docsResultt->fetch_all(MYSQLI_ASSOC);

$filteredLinks = array_filter($docsLink, function($item) {
    return !empty($item['other_link']);
});

$docsLinkJson = json_encode(array_values($filteredLinks));
$accountJson   = json_encode($accountData ?: []);
$profileJson   = json_encode($profileData ?: []);
$contactJson   = json_encode($contactData ?: []);
$docsJson      = json_encode($docsData ?: []);


$profile_picture_url = '../assets/images/profile.png';

if (isset($_SESSION['user_id'])) {
  $applicant_id = $_SESSION['user_id'];
  $query = "SELECT profile_picture FROM applicant_profile WHERE applicant_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $applicant_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['profile_picture'])) {
      $filename = basename($row['profile_picture']);
      $absolute_path = __DIR__ . '/../uploads/profile_pictures/' . $filename;
      $web_path = '../uploads/profile_pictures/' . $filename;

      error_log("Checking: " . $absolute_path);

      if (file_exists($absolute_path)) {
        $profile_picture_url = $web_path;
      }
    }
  }
  $stmt->close();
}

$applicant_id = $userId;
$stmt = $conn->prepare("SELECT street_address, region_id, province_id, city_id, barangay FROM applicant_contact_info WHERE applicant_ID = ?");
$stmt->bind_param("i", $applicant_id);
$stmt->execute();
$result = $stmt->get_result();
$userAddress = $result->fetch_assoc();

$saved_street = $userAddress['street_address'] ?? '';
$saved_region = $userAddress['region_id'] ?? '';
$saved_province = $userAddress['province_id'] ?? '';
$saved_city = $userAddress['city_id'] ?? '';
$saved_barangay = $userAddress['barangay'] ?? '';

function fetchMultipleUrls($urls)
{
  $multiHandle = curl_multi_init();
  $curlHandles = [];
  $responses = [];

  foreach ($urls as $key => $url) {
    $ch = curl_init();
    curl_setopt_array($ch, [
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_TIMEOUT => 20
    ]);
    curl_multi_add_handle($multiHandle, $ch);
    $curlHandles[$key] = $ch;
  }

  $running = null;
  do {
    curl_multi_exec($multiHandle, $running);
    curl_multi_select($multiHandle);
  } while ($running > 0);

  foreach ($curlHandles as $key => $ch) {
    $responses[$key] = json_decode(curl_multi_getcontent($ch), true);
    curl_multi_remove_handle($multiHandle, $ch);
    curl_close($ch);
  }

  curl_multi_close($multiHandle);
  return $responses;
}

$cacheFile = __DIR__ . "/psgc_offline_full.json";
$data = json_decode(file_get_contents($cacheFile), true);
$regions   = $data["regions"]["data"] ?? [];
$provinces = $data["provinces"]["data"] ?? [];
$cities    = $data["cities"]["data"] ?? [];
$barangays = $data["barangays"]["data"] ?? [];

function getName($item) {
    return $item['name'] ?? $item['regionName'] ?? $item['provinceName'] ?? $item['cityName'] ?? $item['barangayName'] ?? 'Unknown';
}

function getCode($item) {
    return $item['code'] ?? $item['psgc_id'] ?? null;
}

$skills = [];
$otherSkill = "";

$sql = "SELECT skill, other_skill FROM applicant_skills WHERE applicant_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $applicant_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if ($row['skill'] === 'others') {
        $otherSkill = $row['other_skill'] ?? "";
    } else {
        $skills[] = $row['skill'];
    }
}

$trainingSql = "SELECT * FROM applicant_training_info WHERE applicant_id = ?";
$stmt2 = $conn->prepare($trainingSql);
$stmt2->bind_param("i", $userId);
$stmt2->execute();
$trainingResult = $stmt2->get_result();

$trainingInfo = [];
while ($row = $trainingResult->fetch_assoc()) {
    $trainingInfo[] = $row;
}
$trainingJson = json_encode($trainingInfo ?: []);

$empStmt = $conn->prepare("SELECT * FROM applicant_employment_stat WHERE applicant_id = ?");
$empStmt->bind_param("i", $userId);
$empStmt->execute();
$empResult = $empStmt->get_result();
$employmentData = $empResult->fetch_assoc();

$employmentJson = json_encode($employmentData);

$jobStmt = $conn->prepare("SELECT * FROM applicant_job_language_data WHERE applicant_id = ?");
$jobStmt->bind_param("i", $userId);
$jobStmt->execute();
$jobResult = $jobStmt->get_result();
$jobData = $jobResult->fetch_assoc();

$joblngJson = json_encode($jobData);

$eligsql = "SELECT * FROM applicant_eligibility_exp WHERE applicant_id = ?";
$eligstmt = $conn->prepare($eligsql);
$eligstmt->bind_param("i", $userId);
$eligstmt->execute();
$eligresult = $eligstmt->get_result();

$eligibilities = [];
$licenses = [];
$work_experience = [];

while ($row = $eligresult->fetch_assoc()) {
    if (!empty($row['eligibility'])) {
        $eligibilities[] = [
            'eligibility' => $row['eligibility'],
            'eligibility_date' => $row['eligibility_date']
        ];
    }
    if (!empty($row['license'])) {
        $licenses[] = [
            'license' => $row['license'],
            'license_valid' => $row['license_valid']
        ];
    }
    if (!empty($row['company_name'])) {
        $work_experience[] = [
            'company_name' => $row['company_name'],
            'company_address' => $row['company_address'],
            'position' => $row['position'],
            'months_worked' => $row['months_worked'],
            'status' => $row['status']
        ];
    }
}
$stmt->close();
