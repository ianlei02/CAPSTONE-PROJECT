<?php
require_once '../../auth/functions/check_login.php';
require_once '../Functions/getinfo.php';
?>

<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Applicant Dashboard</title>
  <script src="../js/load-saved.js"></script>
  <link rel="stylesheet" href="../css/applicant-dashboard.css" />
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/profile-completion.css">
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
        <h1>Dashboard</h1>
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
          <a href="../../auth/functions/logout.php" class="log-out-btn">
            <span class="material-symbols-outlined icon">logout</span>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content">
    <!-- <div class="main-header">
      <h1>Welcome, Applicant!</h1>
    </div> -->
    <div class="statistics-container ">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Applications</h3>
            <div class="stat-icon bg-primary-light">
              <i class="fas fa-building"></i>
            </div>
          </div>
          <div class="stat-value">10</div>
          <div class="stat-label">5 pending applications</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Interviews</h3>
            <div class="stat-icon bg-success-light">
              <i class="fas fa-user-graduate"></i>
            </div>
          </div>
          <div class="stat-value">2</div>
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
          <!-- <div class="completion-message">
            Complete your profile before you apply.
          </div> -->
          <button class="complete-profile-btn" onclick=" windows.location.href = 'application-profile.php'">Complete My Profile</button>
        </div>
        <!-- <div class="missing-items">
          <strong>Missing information:</strong>
          <ul>
            <li>Work history</li>
            <li>Skills</li>
            <li>Profile photo</li>
          </ul>
        </div> -->
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
              <img src="../../public/images/company-logos/Jollibee.png" alt="company-logo">
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
            <span class="application-status hired">Hired </span>
            <button>View</button>
          </div>
        </div>
        <div class="application-item">
          <div class="application-info">
            <div class="application-logo">
              <img src="../../public/images/company-logos/7-eleven_logo.svg.png" alt="company-logo">
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
            <span class="application-status pending">Pending</span>
            <button>View</button>
          </div>
        </div>
        <div class="application-item">
          <div class="application-info">
            <div class="application-logo">
              <img src="../../public/images/company-logos/Chowking_logo.svg.png" alt="company-logo">
            </div>
            <div class="application-details">
              <h3 class="application-title">Cashier</h3>
              <div class="application-company">Chowking</div>
              <div class="application-location-date">
                <span>San Ildefonso, Bulacan</span>
                <span>9/20/2025</span>
              </div>
            </div>
          </div>
          <div class="status-action">
            <span class="application-status interview">Interview</span>
            <button>View</button>
          </div>
        </div>
        <div class="application-item">
          <div class="application-info">
            <div class="application-logo">
              <img src="../../public/images/company-logos/kfc.png" alt="company-logo">
            </div>
            <div class="application-details">
              <h3 class="application-title">Janitor</h3>
              <div class="application-company">KFC</div>
              <div class="application-location-date">
                <span>San Ildefonso, Bulacan</span>
                <span>9/20/2025</span>
              </div>
            </div>
          </div>
          <div class="status-action">
            <span class="application-status rejected ">Rejected</span>
            <button>View</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- <button class="floating-icon">
    <span class="material-symbols-outlined">dark_mode</span>
  </button> -->

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