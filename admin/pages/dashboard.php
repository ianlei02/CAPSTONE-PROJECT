<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PESO Dashboard</title>
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
      <h2 style="font-size: 2.25rem">PESO</h2>
    </div>
    <ul class="nav-menu">
      <li>
        <a class="nav-item active" href="./dashboard.php">
          <span class="material-symbols-outlined">dashboard</span>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./employer-table.php">
          <span class="material-symbols-outlined">apartment</span>
          <span>Employers</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./job-listings.php">
          <span class="material-symbols-outlined">list_alt</span>
          <span>Job Listings</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./new-admin.php">
          <span class="material-symbols-outlined">groups</span>
          <span>New Admin</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./news-upload.php">
          <span class="material-symbols-outlined">newspaper</span>
          <span>News</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="../Function/logout.php">
          <span class="material-symbols-outlined">settings</span>
          <span>Logout</span>
        </a>
      </li>
      <li></li>
      <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
        <span class="material-symbols-outlined">dark_mode</span>
      </button>
    </ul>

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
            <p>Ian Lei Castillo</p>
            <span>SUPER ADMIN</span>
          </div>
          <!-- <i class="fas fa-chevron-down"></i> -->
        </div>
      </div>
    </div>
    <div class="content-wrapper">
      <!-- Stats Cards -->
      <div class="stats-grid">
        <!-- <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Applicants</h3>
            <div class="stat-icon bg-success-light">
              <span class="material-symbols-outlined">school</span>
            </div>
          </div>
          <div class="stat-value">542</div>
          <div class="stat-label">89 new this week</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Employers</h3>
            <div class="stat-icon bg-primary-light">
              <span class="material-symbols-outlined">apartment</span>
            </div>
          </div>
          <div class="stat-value">128</div>
          <div class="stat-label">24 pending verification</div>
        </div> -->
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Verification</h3>
            <div class="stat-icon bg-success-light">
              <span class="material-symbols-outlined">verified_user</span>
            </div>
          </div>
          <div class="stat-value">24</div>
          <div class="stat-label">Employers to verify</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Posts</h3>
            <div class="stat-icon bg-primary-light">
              <span class="material-symbols-outlined">work</span>
            </div>
          </div>
          <div class="stat-value">76</div>
          <div class="stat-label">15 new listings</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Pending</h3>
            <div class="stat-icon bg-danger-light">
              <span class="material-symbols-outlined">hourglass_top</span>
            </div>
          </div>
          <div class="stat-value">18</div>
          <div class="stat-label">7 high priority</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Hires</h3>
            <div class="stat-icon bg-secondary-light">
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