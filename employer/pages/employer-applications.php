<?php
require_once '../../auth/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
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
$sql = "SELECT applicant_ID, f_name, l_name, email, status, date_created  
        FROM applicant_account";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Applications</title>
  <script src="../js/load-saved.js"></script>
  <link rel="stylesheet" href="../css/employer-dashboard.css" />
  <link rel="stylesheet" href="../css/navs.css" />

</head>

<body>
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo">
        <img src="../../public/smb-images/pesosmb.png" alt="" />
        <h3>PESO</h3>
      </div>
      <button class="hamburger"><i data-lucide="panel-left"></i></button>
    </div>
    <div class="sidebar-options">
      <ul class="sidebar-menu">
        <li>
          <a href="./employer-dashboard.php">
            <i data-lucide="layout-dashboard" class="icon"></i>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="employer-profile.php">
            <i data-lucide="id-card" class="icon"></i>
            <span class="label">My Profile</span>
          </a>
        </li>
        <?php if ($isVerified): ?>
          <li>
            <a href="./employer-post.php">
              <i data-lucide="briefcase" class="icon"></i>
              <span class="label">Post Job</span>
            </a>
          </li>
          <li>
            <a href="./referred_users.php">
              <i data-lucide="user-check" class="icon"></i>
              <span class="label">Referred Applicants</span>
            </a>
          </li>
        <?php else: ?>
          <li class="disabled-link" title="Requires verification">
            <a href="#" onclick="alert('Your account is not verified yet. Please complete verification to access this feature.'); return false;">
              <i data-lucide="lock" class="icon"></i>
              <span class="label">Post Job (Locked)</span>
            </a>
          </li>
          <li class="disabled-link" title="Requires verification">
            <a href="#" onclick="alert('Your account is not verified yet. Please complete verification to access this feature.'); return false;">
              <i data-lucide="lock" class="icon"></i>
              <span class="label">Referred Applicants (Locked)</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
      <ul>
        <li>
          <a href="../../auth/functions/logout.php" class="log-out-btn">
            <i data-lucide="log-out" class="icon"></i>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content">
    <nav class="navbar">
      <div class="navbar-left">
        <div class="left-pos">
          <button class="hamburger">☰</button>
          <h1>Applications</h1>
        </div>
        <div class="right-pos">
          <div class="profile">IAN</div>
        </div>
      </div>
    </nav>
    <div class="job-application-status" style="margin-top: 100px;">
      <h2>Applicant List</h2>
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
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['f_name'] . " " . $row['l_name']) . "</td>";
              echo "<td>" . htmlspecialchars($row['email']) . "</td>";
              echo "<td><span class='status " . strtolower($row['status']) . "'>"
                . htmlspecialchars($row['status']) . "</span></td>";
              echo "<td class='table-date'>" . htmlspecialchars($row['date_created']) . "</td>";
              echo "<td class='action-btns'>
                              <button>View</button>
                              <button>Interview</button>
                              <button>Hire</button>
                              <button>Decline</button>
                            </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>No applicants found</td></tr>";
          }
          ?>
        </tbody>

      </table>
    </div>
  </main>

  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="../js/responsive.js" defer></script>


</body>

</html>