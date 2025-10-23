<?php
require_once '../Function/check_login.php';
require_once '../Function/check-permission.php';
require_once '../../connection/dbcon.php';

$admin_ID = $_SESSION['admin_ID'];
$stmt = $conn->prepare("SELECT status, fullname, is_super_admin FROM admin_account WHERE admin_ID = ?");
$stmt->bind_param("i", $admin_ID);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$status = $admin['status'] ?? 'Active';

$stmt->close();

$sql = "
    SELECT 
        SUM(ea.b_status = 'verified') AS verified_count,
        SUM(ea.b_status = 'pending') AS pending_count,
        SUM(ea.b_status = 'revoked') AS revoked_count,
        SUM(ea.b_status = 'rejected') AS rejected_count,
        COUNT(DISTINCT jp.job_id) AS total_jobs
    FROM employer_account ea
    LEFT JOIN job_postings jp ON ea.employer_id = jp.employer_id
";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

$verifiedCount = $data['verified_count'] ?? 0;
$pendingCount = $data['pending_count'] ?? 0;
$totalJobs = $data['total_jobs'] ?? 0;

$sql_today = "
    SELECT COUNT(*) AS today_jobs
    FROM job_postings
    WHERE DATE(created_at) = CURDATE()
";
$result_today = $conn->query($sql_today);
$todayData = $result_today->fetch_assoc();
$todayJobs = $todayData['today_jobs'] ?? 0;

$conn->close();

if ($status === 'Disabled') :
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Disabled</title>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

  <div class="sidebar">
    <div class="logo">
      <div class="logo-icon">
        <img src="../../public/smb-images/pesosmb.png" alt="PESO Logo" />
      </div>
      <h2>PESO</h2>
    </div>
    <div class="sidebar-options">
    
      <ul class="nav-menu logout">
        <li>
          <a class="nav-item" href="../Function/logout.php">
            <span class="material-symbols-outlined">logout</span>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <main class="main-content">
    <div class="disabled-container">
      <div class="disabled-message">
        <span class="material-symbols-outlined" style="font-size: 70px; color: #e74c3c;">block</span>
        <h1>Account Disabled</h1>
        <p>This admin account has been disabled.</p>
      </div>
    </div>
  </main>

  <style>
    .disabled-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }

    .disabled-message h1 {
      font-size: 2rem;
      margin-top: 1rem;
      color: #e74c3c;
    }

    .disabled-message p {
      font-size: 1rem;
      color: #555;
      margin-top: 0.5rem;
    }
  </style>

</body>
</html>

<?php
exit;
endif;
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PESO Dashboard</title>
  <script src="../js/load-saved.js"></script>
  <script src="../js/dark-mode.js"></script>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/charts.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <div class="logo-icon">
        <img
          src="../../public/smb-images/pesosmb.png"
          alt="PESO Logo" />
      </div>
      <h2>PESO</h2>
    </div>
    <div class="sidebar-options">
      <ul class="nav-menu">
        <li>
          <a class="nav-item active" href="./dashboard.php">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
          </a>
        </li>

        <?php if (hasPermission('Pending Employers') || hasPermission('Verified Employers')): ?>
          <li>
            <a class="nav-item" href="./employer-table.php">
              <span class="material-symbols-outlined">apartment</span>
              <span>Employers</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (hasPermission('View job cards & applicants table')): ?>
          <li>
            <a class="nav-item" href="./job-listings.php">
              <span class="material-symbols-outlined">list_alt</span>
              <span>Job Listings</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (in_array('ALL_ACCESS', $_SESSION['admin_roles'])): ?>
          <li>
            <a class="nav-item" href="./new-admin.php">
              <span class="material-symbols-outlined">groups</span>
              <span>New Admin</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (
          hasPermission('Edit News') ||
          hasPermission('Delete News') ||
          hasPermission('Publish News')
        ): ?>
          <li>
            <a class="nav-item" href="./news-upload.php">
              <span class="material-symbols-outlined">newspaper</span>
              <span>News</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if (hasPermission('Set Events') || hasPermission('ALL_ACCESS')): ?>
          <li>
            <a class="nav-item" href="./job-fair.php">
              <span class="material-symbols-outlined">calendar_month</span>
              <span>Job Fair</span>
            </a>
          </li>
        <?php endif; ?>

        <li>
          <button class="nav-item" id="themeToggle" onclick="toggleTheme()">
            <span class="material-symbols-outlined" id="themeIcon">dark_mode</span>
            <span id="themeLabel">Theme toggle</span>
          </button>
        </li>
      </ul>
      <ul class="nav-menu logout">
        <li>
          <a class="nav-item" href="../Function/logout.php">
            <span class="material-symbols-outlined">settings</span>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <main class="main-content">
    <div class="header">
      <h1>Admin Dashboard</h1>
      <div style="display: flex; align-items: center; gap: 20px">
        <div class="user-profile">
          <img
            src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff"
            alt="Admin User" />
          <div>
            <p><?= htmlspecialchars($admin['fullname']) ?></p>
            <span><?= $admin['is_super_admin'] == 1 ? 'SUPER ADMIN' : 'ADMIN' ?></span>
          </div>
          <!-- <i class="fas fa-chevron-down"></i> -->
        </div>
      </div>
    </div>
    <div class="content-wrapper">
      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Verification</h3>
            <div class="stat-icon bg-success-light">
              <span class="material-symbols-outlined">verified_user</span>
            </div>
          </div>
          <div class="stat-value"><?= $verifiedCount ?></div>
          <div class="stat-label">Employers are verified</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Posts</h3>
            <div class="stat-icon bg-primary-light">
              <span class="material-symbols-outlined">work</span>
            </div>
          </div>
          <div class="stat-value"><?= $totalJobs ?></div>
          <div class="stat-label"><?= $todayJobs ?> new listings</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Pending</h3>
            <div class="stat-icon bg-warning-light">
              <span class="material-symbols-outlined">hourglass_top</span>
            </div>
          </div>
          <div class="stat-value"><?= $pendingCount ?></div>
          <div class="stat-label">Employers to verify</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Hires</h3>
            <div class="stat-icon bg-success-light">
              <span class="material-symbols-outlined">badge</span>
            </div>
          </div>
          <div class="stat-value">45</div>
          <div class="stat-label">12 this month</div>
        </div>

      </div>

      <!-- Charts Grid -->
      <div class="chart-grid">
        <div class="chart-container half-width">
          <div class="chart-header">
            <h2 class="chart-title"><span class="material-symbols-outlined">bar_chart</span>Monthly Applicants</h2>
            <select name="" id="">
              <option value="">2025</option>
              <option value="">2026</option>
              <option value="">2027</option>
              <option value="">2028</option>
            </select>
          </div>
          <canvas id="applicantsChart"></canvas>
        </div>

        <div class="chart-container half-width">
          <div class="chart-header">
            <h2 class="chart-title"><span class="material-symbols-outlined">trending_up</span>Monthly Employers</h2>
            <select name="" id="">
              <option value="">2025</option>
              <option value="">2026</option>
              <option value="">2027</option>
              <option value="">2028</option>
            </select>
          </div>
          <canvas id="employersChart"></canvas>
        </div>

        <div class="chart-container full-width">
          <div class="chart-header">
            <h2 class="chart-title"><span class="material-symbols-outlined">person_check</span>Monthly Hires & Job Vacancies</h2>
            <select name="" id="">
              <option value="">2025</option>
              <option value="">2026</option>
              <option value="">2027</option>
              <option value="">2028</option>
            </select>
          </div>
          <canvas id="hiresChart"></canvas>
        </div>

        <div class="chart-container half-width">
          <div class="chart-header">
            <h2 class="chart-title"><span class="material-symbols-outlined">female</span>Sex Distribution</h2>
            <select name="" id="">
              <option value="">2025</option>
              <option value="">2026</option>
              <option value="">2027</option>
              <option value="">2028</option>
            </select>
          </div>
          <canvas id="sexChart"></canvas>
        </div>

        <div class="chart-container half-width">
          <div class="chart-header">
            <h2 class="chart-title"><span class="material-symbols-outlined">layers</span>Age Range Report</h2>
            <select name="" id="">
              <option value="">2025</option>
              <option value="">2026</option>
              <option value="">2027</option>
              <option value="">2028</option>
            </select>
          </div>
          <canvas id="ageChart"></canvas>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/charts.js"></script>
  <script>

  </script>

</body>

</html>