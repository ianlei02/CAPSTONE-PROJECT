<?php
require_once '../../auth/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
$employer_id = $_SESSION['user_id'];
$accountStmt = $conn->prepare("SELECT * FROM employer_company_info WHERE employer_ID = ?");
$accountStmt->bind_param("s", $userId);
$accountStmt->execute();
$accountResult = $accountStmt->get_result();
$accountData = $accountResult->fetch_assoc();

$accountJson = json_encode($accountData ?: []);

$profile_picture_url = '../assets/images/profile.png';

if (isset($_SESSION['user_id'])) {
  $employer_id = $_SESSION['user_id'];
  $query = "SELECT profile_picture FROM employer_company_info WHERE employer_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $employer_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['profile_picture'])) {

      if (file_exists('../' . $row['profile_picture'])) {
        $profile_picture_url = '../' . $row['profile_picture'];
      }
    }
  }
  $stmt->close();
}
$sql = "
SELECT 
    ea.email, ea.email, ea.password,
    ed.business_permit, ed.dole_certification, ed.bir_certification, ed.migrant_certification, ed.philjob_certification,
    ei.company_type, ei.company_size, ei.industry, ei.contact_number, ei.address, ei.contact_person, ei.contact_position, ei.contact_mobile, ei.contact_email
FROM employer_account ea
LEFT JOIN employer_company_docs ed ON ea.employer_id = ed.employer_id
LEFT JOIN employer_company_info ei ON ea.employer_id = ei.employer_id
WHERE ea.employer_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$total_fields = count($data);
$filled = 0;

foreach ($data as $value) {
  if (!empty($value)) {
    $filled++;
  }
}

$completion = round(($filled / $total_fields) * 100);

$radius = 45;
$circumference = 2 * M_PI * $radius;
$offset = $circumference - ($completion / 100 * $circumference);

$sql = "
    SELECT
        (SELECT COUNT(*) FROM job_postings WHERE employer_id = ?) AS employer_total_jobs,
        (SELECT COUNT(*) FROM job_postings) AS total_jobs,
        (SELECT COUNT(*) FROM employer_account) AS total_employers,
        (SELECT COUNT(*) FROM applicant_account WHERE status = 'verified') AS total_applicants,
        (SELECT COUNT(*) FROM job_postings WHERE employer_id = ? AND status = 'active') AS total_active
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $employer_id, $employer_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employer Dashboard</title>
  <script src="../js/load-saved.js"></script>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/employer-dashboard.css" />
  <link rel="stylesheet" href="../css/profile-completion.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <div class="left-pos">
        <h1>
          <!-- <span class="material-symbols-outlined">dashboard</span> -->
          <span>Dashboard</span>
        </h1>
      </div>
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
    <div class="sidebar-logo">
      <div class="logo">
        <img src="../../public/images/pesosmb.png" alt="" />
        <h3>PESO</h3>
      </div>
      <button class="hamburger"><span class="material-symbols-outlined">dock_to_right</span></button>
    </div>
    <div class="sidebar-options">
      <ul class="sidebar-menu">
        <li>
          <a href="./employer-dashboard.php" class="active">
            <span class="material-symbols-outlined icon">dashboard</span>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./employer-post.php">
            <span class="material-symbols-outlined icon">work</span>
            <span class="label">Post Job</span>
          </a>
        </li>
        <!-- <li>
          <a href="./employer-applications.php">
            <span class="material-symbols-outlined icon">people</span>
            <span class="label">Job Applications</span>
          </a>
        </li> -->
        <li>
          <a href="employer-profile.php">
            <span class="material-symbols-outlined icon">id_card</span>
            <span class="label">My Profile</span>
          </a>
        </li>
        <li>
          <button onclick="toggleTheme()" class="dark-mode-toggle">
            <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
            <span id="themeLabel">Dark Mode</span>
          </button>
        </li>
      </ul>
      <ul>
        <li>
          <a href="../../auth/functions/logout.php" class='log-out-btn'>
            <span class="material-symbols-outlined icon">logout</span>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content">
    <div class="statistics-container ">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Jobs Posted</h3>
            <div class="stat-icon bg-primary-light">
              <span class="material-symbols-outlined">work</span>
            </div>
          </div>
          <div class="stat-value">
            <?php echo $data['employer_total_jobs']; ?>
          </div>
          <div class="stat-label"><?php echo $data['total_active']; ?> inactive</div>
        </div>
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Active Jobs</h3>
            <div class="stat-icon bg-success-light">
              <span class="material-symbols-outlined">business_center</span>
            </div>
          </div>
          <div class="stat-value">
            <?php echo $data['total_active']; ?>
          </div>
          <div class="stat-label">This month</div>
        </div>
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Referred</h3>
            <div class="stat-icon bg-warning-light">
              <span class="material-symbols-outlined">group</span>
            </div>
          </div>
          <div class="stat-value">4</div>
          <div class="stat-label">2 new referrals</div>
        </div>
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Hired</h3>
            <div class="stat-icon bg-success-light">
              <span class="material-symbols-outlined">group_add</span>
            </div>
          </div>
          <div class="stat-value">1</div>
          <div class="stat-label">This month</div>
        </div>
      </div>
      <div class="status-card">
        <div class="progress-circle-container">
          <svg class="progress-circle-svg" viewBox="0 0 100 100">
            <circle class="progress-circle-bg" cx="50" cy="50" r="45"></circle>
            <circle class="progress-circle-fill"
              cx="50" cy="50" r="45"
              stroke-dasharray="<?php echo $circumference; ?>"
              stroke-dashoffset="<?php echo $offset; ?>"></circle>
          </svg>
          <div class="progress-text"><?php echo $completion; ?>%</div>
          <div class="verification-badge pending">
            Pending
          </div>
        </div>
        <div class="verification-section">
          <button class="action-button">Complete Profile</button>
        </div>
      </div>
    </div>

    <div class="content-grid">
      <div class="quick-actions">
        <h2 class="section-title">
          <span class="material-symbols-outlined">bolt</span>
          <span>Quick Actions</span>
        </h2>
        <div class="actions-grid">
          <a class="action-card" href="./employer-post.php">
            <div class="action-icon">
              <span class="material-symbols-outlined">add</span>
            </div>
            <div class="action-title">Post a Job</div>
            <div class="action-desc">Create a new job posting</div>
          </a>
          <a class="action-card" href="./employer-post.php#jobsPosted">
            <div class="action-icon">
              <span class="material-symbols-outlined">people</span>
            </div>
            <div class="action-title">Review Applicants</div>
            <div class="action-desc">Screen and filter candidates</div>
          </a>
          <a class="action-card" href="./employer-profile.php">
            <div class="action-icon">
              <span class="material-symbols-outlined">apartment</span>
            </div>
            <div class="action-title">Edit Company Profile</div>
            <div class="action-desc">Update company information</div>
          </a>
        </div>
      </div>
      <div class="calendar-container">
        <h2 class="section-title">
          <span class="material-symbols-outlined">calendar_month</span>
          <span>Calendar</span>
        </h2>
        <div id="calendar"></div>
      </div>

    </div>

  </main>

  <script src="../js/responsive.js"></script>
  <script src="../js/dark-mode.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

  <script>
    function setVerificationStatus(status) {
      const badge = document.querySelector('.verification-badge');
      if (!badge) return;

      badge.className = `verification-badge ${status}`;

      if (status === 'verified') {
        badge.textContent = 'Verified';
      } else if (status === 'pending') {
        badge.textContent = 'Pending';
      } else {
        badge.textContent = 'Unverified';
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      const progressText = document.querySelector('.progress-text');
      if (!progressText) return;

      const completion = parseInt(progressText.textContent.replace('%', ''));

      if (completion >= 100) {
        setVerificationStatus('verified');
      } else {
        setVerificationStatus('pending');
      }
    });
  </script>
  <!-- //? CALENDAR -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // default view
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          // right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: [{
            title: 'Sample Event',
            start: '2025-09-29'
          },
          {
            title: 'Meeting',
            start: '2025-09-30T10:00:00',
            end: '2025-09-30T12:00:00'
          }
        ]
      });
      calendar.render();
    });
  </script>

</body>

</html>