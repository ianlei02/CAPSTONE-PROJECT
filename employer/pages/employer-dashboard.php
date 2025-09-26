<?php
require_once '../../auth/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
$employer_id = $_SESSION['user_id'];

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


</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <div class="left-pos" style="display: flex; width: auto; height: auto">
        <button class="hamburger">☰</button>
        <div class="logo">
          <img src="../assets/images/peso-logo.png" alt="" />
        </div>
      </div>
      <div class="right-pos">
        <div class="profile">IAN</div>
      </div>
    </div>
  </nav>

  <aside class="sidebar">
    <ul class="sidebar-menu">
      <li>
        <a href="./employer-dashboard.php">
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
      <li>
        <a href="./employer-applications.php">
          <span class="material-symbols-outlined icon">people</span>
          <span class="label">Job Applications</span>
        </a>
      </li>
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
  </aside>

  <main class="main-content">
    <div class="main-header">
      <h1>Welcome, Employer!</h1>
    </div>
    <div class="statistics-container ">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Jobs Posted</h3>
            <div class="stat-icon bg-primary-light">
              <i class="fas fa-building"></i>
            </div>
          </div>
          <div class="stat-value">
            <?php echo $data['employer_total_jobs']; ?>
          </div>
          <div class="stat-label"><?php echo $data['total_active']; ?> pending applications</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Active Jobs</h3>
            <div class="stat-icon bg-success-light">
              <i class="fas fa-user-graduate"></i>
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
              <i class="fas fa-briefcase"></i>
            </div>
          </div>
          <div class="stat-value">4</div>
          <div class="stat-label">2 new referrals</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Hired</h3>
            <div class="stat-icon bg-danger-light">
              <i class="fas fa-tasks"></i>
            </div>
          </div>
          <div class="stat-value">1</div>
          <div class="stat-label">7 high priority</div>
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
        </div>
        <div class="verification-section">
          <div class="verification-badge pending">
            Pending
          </div>
          <button class="action-button">Complete Profile</button>
        </div>
      </div>
    </div>

    <div class="job-application-status">
      <h2>Applicant List</h2>
      <div class="table-responsive">
        <table class="job-application-table" id="employerDashboardTable">
          <thead>
            <tr>
              <th>Applicant Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Date Applied</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John Doe</td>
              <td>john.doe@example.com</td>
              <td><span class="status interview">Interview</span></td>
              <td class="table-date">2025-10-01</td>
              <td class="action-btns">
                <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
              </td>
            </tr>
            <tr>
              <td>Jane Smith</td>
              <td>jane.smith@example.com</td>
              <td><span class="status applied">Applied</span></td>
              <td class="table-date">2025-09-15</td>
              <td class="action-btns">
                <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
              </td>
            </tr>
            <tr>
              <td>Alice Johnson</td>
              <td>alice.johnson@example.com</td>
              <td><span class="status declined">Declined</span></td>
              <td class="table-date">2025-09-15</td>
              <td class="action-btns">
                <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
              </td>
            </tr>
            <tr>
              <td>Bob Brown</td>
              <td>bob.brown@example.com</td>
              <td><span class="status hired">Hired</span></td>
              <td class="table-date">2025-09-15</td>
              <td class="action-btns">
                <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
              </td>
            </tr>
            <tr>
              <td>Charlie Davis</td>
              <td>charlie.davis@example.com</td>
              <td><span class="status pending">Pending</span></td>
              <td class="table-date">2025-09-15</td>
              <td class="action-btns">
                <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <script src="../js/responsive.js"></script>
  <script src="../js/dark-mode.js"></script>

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
</body>

</html>