<?php
require_once '../../auth/functions/check_login.php';
require_once '../Functions/getName.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
$profile_picture_url = '../assets/images/guy.svg';
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
$sql = "
  SELECT 
    ja.application_id,
    ja.job_id,
    ja.status,
    ja.referral_source,
    ja.created_at,
    ja.updated_at,
    jp.job_title,
    jp.job_type,
    jp.salary_range,
    jp.location,
    jp.description,
    jp.employer_id,
    ec.company_name,
    ec.profile_picture
  FROM job_application ja
  INNER JOIN job_postings jp ON ja.job_id = jp.job_id
  INNER JOIN employer_company_info ec ON jp.employer_id = ec.employer_id
  WHERE ja.applicant_id = ?
  ORDER BY ja.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $applicant_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Applications</title>
  <script src="../js/load-saved.js"></script>
  <link rel="stylesheet" href="../css/navs.css" />
  <link rel="stylesheet" href="../css/applicant-applications.css" />
  <link rel="stylesheet" href="../../public/library/datatable/dataTables.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo">
        <img src="../../public/images/pesosmb.png" alt="" />
        <h3>PESO</h3>
      </div>
      <button class="hamburger"><i data-lucide="panel-left"></i></button>
    </div>
    <div class="sidebar-options">
      <ul class="sidebar-menu">
        <li>
          <a href="./applicant-dashboard.php">
            <i data-lucide="home" class="icon"></i>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./applicant-profile.php">
            <i data-lucide="user" class="icon"></i>
            <span class="label">My Profile</span>
          </a>
        </li>
        <li>
          <a href="./applicant-applications.php" class="active">
            <i data-lucide="briefcase-business" class="icon"></i>
            <span class="label">My Applications</span>
          </a>
        </li>
        <li>
          <a href="./applicant-job-search.php">
            <i data-lucide="search" class="icon"></i>
            <span class="label">Job Search</span>
          </a>
        </li>
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
        <div class="left-pos" style="display: flex; width: auto; height: auto">
          <button class="hamburger">☰</button>
          <h1>Job Applications</h1>
        </div>
        <div class="right-pos">
          <div class="profile">
            <img
              src="<?php echo htmlspecialchars($profile_picture_url); ?>"
              alt="Profile Picture"
              class="profile-pic"
              id="profilePicc" style="width: 50px !important;" />
            <div class="user-name">
              <h4><?= $fullName ?></h4>
              <p>Applicant</p>
            </div>
          </div>

          <div class="dropdown-menu" id="dropdownMenu">
            <div class="dropdown-arrow"></div>
            <div class="dropdown-header">
              <img src="../../<?= htmlspecialchars($row['profile_picture']); ?>" alt="company-logo"
                style="width:70px;height:70px;object-fit:cover;border-radius:6px;">
              <a class="user-info" href="./applicant-profile.php">
                <h3><?= $fullName ?></h3>
                <p>See your profile</p>
              </a>
            </div>

            <div class="dropdown-links">
              <a href="./account-settings.php" class="dropdown-item">
                <span class="material-symbols-outlined">settings</span>
                <span>Account Settings</span>
              </a>
              <a onclick="toggleTheme()" class="dropdown-item">
                <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
                <span id="themeLabel">Dark Mode</span>
              </a>

              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item logout-item">
                <span class="material-symbols-outlined icon">logout</span>
                <span>Log Out</span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </nav>
    <div class="job-application-status">
      <div class="application-cards">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <?php
            $rawLogoPath = "../../employer/" . htmlspecialchars($row['profile_picture']);
            $defaultLogo = "../assets/images/profile.png";

            if (!empty($row['profile_picture']) && file_exists($rawLogoPath)) {
              $logoPath = $rawLogoPath;
            } else {
              $logoPath = $defaultLogo;
            }
            ?>
            <div class="application-item" data-id="<?= $row['application_id']; ?>">
              <div class="application-info">
                <div class="application-logo">
                  <img src="<?= $logoPath; ?>" alt="company-logo" onerror="this.onerror=null;this.src='<?= $defaultLogo; ?>';" style="width:70px; height:70px; object-fit:contain; border-radius:6px;">
                </div>
                <div class="application-details">
                  <h3 class="application-title"><?= htmlspecialchars($row['job_title']); ?></h3>
                  <div class="application-company"><?= htmlspecialchars($row['company_name']); ?></div>
                  <div class="application-location-date">
                    <span><?= htmlspecialchars($row['location']); ?></span>
                    <span><?= date("m/d/Y", strtotime($row['created_at'])); ?></span>
                  </div>
                </div>
              </div>

              <div class="status-action">
                <span class="application-status <?= strtolower($row['status']); ?>">
                  <?= htmlspecialchars($row['status']); ?>
                </span>
                <button
                  class="view-btn"
                  data-job-title="<?= htmlspecialchars($row['job_title']); ?>"
                  data-company="<?= htmlspecialchars($row['company_name']); ?>"
                  data-location="<?= htmlspecialchars($row['location']); ?>"
                  data-date="<?= date("m/d/Y", strtotime($row['created_at'])); ?>"
                  data-referral="<?= htmlspecialchars($row['referral_source']); ?>"
                  data-status="<?= htmlspecialchars($row['status']); ?>"
                  data-description="<?= htmlspecialchars($row['description']); ?>"
                  data-salary="<?= htmlspecialchars($row['salary_range']); ?>"
                  data-logo="<?= $logoPath; ?>">
                  View
                </button>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="no-applications">
            <p>You have not applied to any jobs yet.</p>
            <img src="../../public/svg/job-hunt.svg">
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <!-- Application Modal -->
  <div class="modal" id="applicationModal" style="display:none;">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Application Details</h2>
        <button class="close-btn" id="modalCloseTop">&times;</button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="modalJobId" name="job_id" value="">

        <div class="modal-row" style="display:flex; gap:16px; align-items:flex-start;">
          <div style="flex:0 0 80px;">
            <img id="modalCompanyLogo" src="../../public/images/company-logos/default.png" alt="logo" style="width:70px;height:70px;object-fit:contain;border-radius:6px;">
          </div>
          <div style="flex:1;">
            <h3 id="modalJobTitleText" style="margin:0 0 6px 0;"></h3>
            <div style="color:#666;margin-bottom:8px;">
              <strong id="modalCompanyName"></strong> • <span id="modalJobLocation"></span>
            </div>
            <div style="margin-bottom:8px;"><strong>Posted:</strong> <span id="modalJobPosted"></span></div>
            <div style="margin-bottom:8px;"><strong>Salary:</strong> <span id="modalSalaryRange"></span></div>
          </div>
        </div>

        <hr>

        <div style="margin-bottom:12px;">
          <h4 style="margin:0 0 6px 0;">Application Status</h4>
          <div id="modalApplicationStatus" style="font-weight:700;color:#000;"></div>
          <div id="modalAppliedAt" style="color:#666;font-size:0.95rem;margin-top:4px;"></div>
        </div>

        <div style="margin-bottom:12px;">
          <h4 style="margin:0 0 6px 0;">Remarks / Notes</h4>
          <p id="modalApplicationRemarks" style="white-space:pre-wrap;color:#333;">No remarks available.</p>
        </div>

        <div style="margin-top:8px;">
          <h4 style="margin:0 0 6px 0;">Job Description</h4>
          <div id="modalJobDescription" style="white-space:pre-wrap;color:#333;"></div>
        </div>

        <div class="form-actions" style="margin-top:18px;display:flex;gap:8px;">
          <button type="button" class="btn btn-outline" id="applicationModalClose">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/responsive.js" defer></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const modal = document.getElementById("applicationModal");
      const closeBtns = [
        document.getElementById("applicationModalClose"),
        document.getElementById("modalCloseTop")
      ];
      document.querySelectorAll(".view-btn").forEach(btn => {
        btn.addEventListener("click", () => {
          document.getElementById("modalJobTitleText").textContent = btn.dataset.jobTitle;
          document.getElementById("modalCompanyName").textContent = btn.dataset.company;
          document.getElementById("modalJobLocation").textContent = btn.dataset.location;
          document.getElementById("modalJobPosted").textContent = btn.dataset.date;
          document.getElementById("modalSalaryRange").textContent = btn.dataset.salary || "Not specified";
          document.getElementById("modalApplicationStatus").textContent = btn.dataset.status;
          document.getElementById("modalAppliedAt").textContent = "Applied on " + btn.dataset.date;
          document.getElementById("modalApplicationRemarks").textContent = btn.dataset.referral || "No remarks available.";
          document.getElementById("modalJobDescription").textContent = btn.dataset.description || "No description provided.";

          const logo = btn.dataset.logo || "../assets/images/profile.png";
          const logoEl = document.getElementById("modalCompanyLogo");
          logoEl.src = logo;
          logoEl.onerror = () => logoEl.src = "../assets/images/profile.png";

          modal.style.display = "block";
        });
      });

      closeBtns.forEach(btn => btn.addEventListener("click", () => modal.style.display = "none"));
      window.addEventListener("click", e => {
        if (e.target === modal) modal.style.display = "none";
      });
    });
  </script>

</body>

</html>