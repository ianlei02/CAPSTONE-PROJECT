<?php
require_once '../../landing/functions/check_login.php';

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
  header("Location: ../login-signup.php");
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

?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Applicant Dashboard</title>
  <link rel="stylesheet" href="../css/applicant-dashboard.css" />
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/table.css">
  <link rel="stylesheet" href="../css/profile-completion.css">
  <link rel="stylesheet" href="../../public-assets/library/datatable/dataTables.css">
  <script src="../../public-assets/JS_JQUERY/jquery-3.7.1.min.js" defer></script>
  <script src="../../public-assets/library/datatable/dataTables.js" defer></script>
  <script src="../../public-assets/js/table-init.js" defer></script>
</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <div class="left-pos" style="display: flex; width: auto; height: auto">
        <button class="hamburger" ">☰</button>
        <div class=" logo">
          <img src="../assets/images/peso-logo.png" alt="" />
      </div>
    </div>
    <button onclick="toggleTheme()" style="padding: 0.5rem; font-size: 1rem;">DARK MODE PRACTICE LANG MUNA</button>
    <div class="right-pos">
      <div class="profile">
        <img
          src="<?php echo htmlspecialchars($profile_picture_url); ?>"
          alt="Profile Picture"
          class="profile-pic"
          id="profilePicc" style="width: 50px !important;" />
      </div>
    </div>
    </div>
  </nav>
  <aside class="sidebar">
    <ul class="sidebar-menu">
      <li>
        <a href="./applicant-dashboard.php">
          <span class="emoji"><img src="../../public-assets/icons/chart-histogram.svg" alt="Dashboard-icon"></span>
          <span class="label">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="./applicant-applications.php">
          <span class="emoji"><img src="../../public-assets/icons/briefcase.svg" alt="Applications-icon"></span>
          <span class="label">My Applications</span>
        </a>
      </li>
      <li>
        <a href="./applicant-job-search.php">
          <span class="emoji"><img src="../../public-assets/icons/search.svg" alt="Job-Search-icon"></span>
          <span class="label">Job Search</span>
        </a>
      </li>
      <li>
        <a href="./applicant-profile.php">
          <span class="emoji"><img src="../../public-assets/icons/user.svg" alt="Profile-icon"></span>
          <span class="label">My Profile</span>
        </a>
      </li>
      <li>
        <a href="../../landing/functions/logout.php">
          <span class="emoji"><img src="../../public-assets/icons/download.svg" alt="Logout-icon" style="transform: rotate(90deg);"></span>
          <span class="label">Log Out</span>
        </a>
      </li>
    </ul>
  </aside>
  <main class="main-content">
    <div class="main-header">
      <h1>Welcome, Applicant!</h1>
    </div>
    <div class="profile-completion-container">
      <div class="progress-circle">
        <svg viewBox="0 0 100 100">
          <circle class="progress-circle-background" cx="50" cy="50" r="<?php echo $radius; ?>"></circle>
          <circle class="progress-circle-progress"
            cx="50" cy="50" r="<?php echo $radius; ?>"
            stroke-dasharray="<?php echo $circumference; ?>"
            stroke-dashoffset="<?php echo $offset; ?>">
          </circle>
        </svg>
        <div class="progress-text">
          <?php echo $progress; ?>%
          <span>COMPLETE</span>
        </div>
      </div>
      <div class="message-button">
        <div class="completion-message">
          Complete your profile to find jobs before you can apply. The more complete your profile is, the better
          your chances of getting hired.
        </div>
        <button class="complete-profile-btn" onclick=" windows.location.href = 'application-profile.php'">Complete My Profile</button>
      </div>
      <div class="missing-items">
        <strong>Missing information:</strong>
        <ul>
          <li>Work history</li>
          <li>Skills</li>
          <li>Profile photo</li>
        </ul>
      </div>
    </div>
    <div class="statistics-container gradient">
      <div class="statistic-card">
        <h2>Applications</h2>
        <p>5</p>
      </div>
      <div class="statistic-card">
        <h2>Interviews</h2>
        <p>3</p>
      </div>
      <div class="statistic-card">
        <h2>Referred</h2>
        <p>2</p>
      </div>
      <div class="statistic-card">
        <h2>Job Listings</h2>
        <p>
          <?php
          echo $data['total_jobs'];
          ?>
        </p>
      </div>
      <div class="statistic-card">
        <h2>Registered Employers</h2>
        <p>
          <?php
          echo $data['total_employers'];
          ?>
        </p>
      </div>
      <div class="statistic-card">
        <h2>Registered Applicants</h2>
        <p>
          <?php
          echo $data['total_applicants'];
          ?>
        </p>
      </div>
    </div>
    <div class="job-application-status">
      <div class="job-application-header">
        <h2>Recent Job Applications</h2> <a href="./applicant-applications.php" class="view-all">View All &RightArrow;</a>
      </div>
      <div class="application-cards">
        <div class="application-item">
          <div class="application-info">
            <div class="application-logo">
              <img src="../../landing/assets/images/company-logos/Jollibee.png" alt="company-logo">
            </div>
            <div class="application-details">
              <h3 class="application-title">Waiter</h3>
              <div class="application-company">Jollibee Corp.</div>
              <div class="application-location-date">
                <span>San Ildefonso, Bulacan</span>
                <span>9/20/2025</span>
              </div>
            </div>
          </div>
          <div class="status-action">
            <span class="application-status status-scheduled">Interview Scheduled</span>
            <button>View</button>
          </div>
        </div>
        <div class="application-item">
          <div class="application-info">
            <div class="application-logo">
              <img src="../../landing/assets/images/company-logos/7-eleven_logo.svg.png" alt="company-logo">
            </div>
            <div class="application-details">
              <h3 class="application-title">Cashier</h3>
              <div class="application-company">7-11</div>
              <div class="application-location-date">
                <span>San Ildefonso, Bulacan</span>
                <span>9/20/2025</span>
              </div>
            </div>
          </div>
          <div class="status-action">
            <span class="application-status status-scheduled">Interview Scheduled</span>
            <button>View</button>
          </div>
        </div>
        <div class="application-item">
          <div class="application-info">
            <div class="application-logo">
              <img src="../../landing/assets/images/company-logos/mang-inasal-logo-png_seeklogo-543182.png" alt="company-logo">
            </div>
            <div class="application-details">
              <h3 class="application-title">Janitor</h3>
              <div class="application-company">Mang Inasal</div>
              <div class="application-location-date">
                <span>San Ildefonso, Bulacan</span>
                <span>9/20/2025</span>
              </div>
            </div>
          </div>
          <div class="status-action">
            <span class="application-status status-scheduled">Interview Scheduled</span>
            <button>View</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/responsive.js"></script>
  <script src="../js/dark-mode.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const statisticCards = document.querySelectorAll(".statistic-card p");

      statisticCards.forEach(card => {
        const targetNumber = parseInt(card.textContent, 10);
        let currentNumber = 0;

        const increment = Math.ceil(targetNumber / 100);
        const interval = setInterval(() => {
          currentNumber += increment;
          if (currentNumber >= targetNumber) {
            currentNumber = targetNumber;
            clearInterval(interval);
          }
          card.textContent = currentNumber;
        }, 20);
      });
    });
  </script>
</body>

</html>