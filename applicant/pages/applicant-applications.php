<?php
require_once '../../auth/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
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
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Applications</title>
  <script src="../js/load-saved.js"></script>
  <!-- <link rel="stylesheet" href="../css/applicant-dashboard.css" /> -->
  <link rel="stylesheet" href="../css/navs.css" />
  <link rel="stylesheet" href="../css/applicant-applications.css" />
  <link rel="stylesheet" href="../../public-assets/library/datatable/dataTables.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <!-- <script src="../../public-assets/JS_JQUERY/jquery-3.7.1.min.js" defer></script>
  <script src="../../public-assets/library/datatable/dataTables.js" defer></script>
  <script src="../../public-assets/js/table-init.js" defer></script> -->
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
          <span class="material-symbols-outlined icon">dashboard</span>
          <span class="label">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="./applicant-applications.php">
          <span class="material-symbols-outlined icon">work</span>
          <span class="label">My Applications</span>
        </a>
      </li>
      <li>
        <a href="./applicant-job-search.php">
          <span class="material-symbols-outlined icon">search</span>
          <span class="label">Job Search</span>
        </a>
      </li>
      <li>
        <a href="./applicant-profile.php">
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
        <a href="../../landing/functions/logout.php" class="log-out-btn">
          <span class="material-symbols-outlined icon">logout</span>
          <span class="label">Log Out</span>
        </a>
      </li>
    </ul>
  </aside>

  <main class="main-content">
    <div class="job-application-header">
      <h2>Job Applications</h2>
    </div>
    <div class="job-application-status">
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

</body>

</html>