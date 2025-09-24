<?php
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


if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
$applicantId = $_SESSION['user_id'] ?? 0;
function getProfileCompletion($applicantId, $conn)
{
  $totalTables = 4;
  $completed = 0;

  $stmt = $conn->prepare("SELECT f_name, l_name, email FROM applicant_account WHERE applicant_ID = ?");
  $stmt->bind_param("i", $applicantId);
  $stmt->execute();
  $data = $stmt->get_result()->fetch_assoc();
  if (!empty($data['f_name']) && !empty($data['l_name']) && !empty($data['email'])) {
    $completed++;
  }

  $stmt = $conn->prepare("SELECT * FROM applicant_contact_info WHERE applicant_ID = ?");
  $stmt->bind_param("i", $applicantId);
  $stmt->execute();
  if ($stmt->get_result()->num_rows > 0) {
    $completed++;
  }

  $stmt = $conn->prepare("SELECT * FROM applicant_documents WHERE applicant_ID = ?");
  $stmt->bind_param("i", $applicantId);
  $stmt->execute();
  if ($stmt->get_result()->num_rows > 0) {
    $completed++;
  }

  $stmt = $conn->prepare("SELECT * FROM applicant_profile WHERE applicant_ID = ?");
  $stmt->bind_param("i", $applicantId);
  $stmt->execute();
  if ($stmt->get_result()->num_rows > 0) {
    $completed++;
  }

  $completionPercentage = ($completed / $totalTables) * 100;
  return round($completionPercentage);
}

$progress = getProfileCompletion($applicantId, $conn);
$radius = 45;
$circumference = 2 * M_PI * $radius;
$offset = $circumference - ($progress / 100) * $circumference;

$sql = "
        SELECT
            (SELECT COUNT(*) FROM job_postings WHERE employer_id = ?) AS employer_total_jobs,
            (SELECT COUNT(*) FROM job_postings) AS total_jobs,
            (SELECT COUNT(*) FROM employer_account) AS total_employers,
            (SELECT COUNT(*) FROM applicant_account) AS total_applicants,
            (SELECT COUNT(*) FROM job_postings WHERE status = 'active') AS total_active
    ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();