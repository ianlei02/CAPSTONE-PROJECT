<?php
require_once '../../auth/functions/check_login.php';
require_once '../Functions/getinfo.php';
require_once '../Functions/getName.php';
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
          <a href="./applicant-dashboard.php" class="active">
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
          <a href="./applicant-applications.php">
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
          <h1>Dashboard</h1>
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
              <img src="<?php echo htmlspecialchars($profile_picture_url); ?>" alt="Profile Picture">
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
          <div id="notifBtn">
            <i id="notifIcon" data-lucide="bell"></i>
            <span id="notifCount">0</span>
            <div id="notifList">
            </div>
          </div>
        </div>
      </div>

    </nav>
    <div class="main-header">
      <h3>Welcome, <?= $fullName ?>!</h1>
        <!-- <a class="complete-profile-warning" href="./applicant-profile.php">
          <span>Before you can apply for a job, you should set up your profile first.</span>
          <span class="material-symbols-outlined">
            double_arrow
          </span>
        </a> -->
    </div>
    <div class="statistics-container ">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Applications</h3>
            <div class="stat-icon bg-primary-light">
              <i data-lucide="users"></i>
            </div>
          </div>
          <div class="stat-value">10</div>
          <div class="stat-label">5 pending applications</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Interviews</h3>
            <div class="stat-icon bg-purple-light">
              <i data-lucide="mic"></i>
            </div>
          </div>
          <div class="stat-value">2</div>
          <div class="stat-label">This month</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Referred</h3>
            <div class="stat-icon bg-warning-light">
              <i data-lucide="send"></i>
            </div>
          </div>
          <div class="stat-value">4</div>
          <div class="stat-label">2 new referrals</div>
        </div>

        <div class="stat-card">
          <div class="stat-header">
            <h3 class="stat-title">Hired</h3>
            <div class="stat-icon bg-success-light">
              <i data-lucide="check-circle"></i>
            </div>
          </div>
          <div class="stat-value">1</div>
          <div class="stat-label">This month</div>
        </div>
      </div>
    </div>
    <div class="content-wrapper">
      <div class="content-flex">
        <div class="profile-completion-card">
          <div class="card-header">
            <div class="card-title">Profile Completion</div>
            <div class="progress-percentage">
              <?php echo $progress; ?>%
            </div>
          </div>
          <div class="progress-section">
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
                <div class="progress-label">
                  <?php echo $progress; ?>%
                </div>
              </div>
            </div>
            <div class="progress-content">
              <!-- <div class="progress-stats">7 of 10 sections complete</div> -->
              <div class="progress-description">
                <?php echo 100 - $progress; ?>% remaining to unlock job applications
              </div>
            </div>
          </div>
          <div class="completion-message">
            <div class="message-text">
              <strong>Complete your profile</strong> to apply for jobs and get matched with employers
            </div>
          </div>
          <div class="action-section">
            <button class="complete-profile-btn" onclick="window.location.href='applicant-profile.php'">
              Complete Profile
            </button>
            <div class="benefits-note">
              100% completion required for job applications
            </div>
          </div>
        </div>
        <div class="quick-actions">
          <h2 class="section-title" style="display:flex; align-items:center; gap:4px;">
            <span><i data-lucide="zap"></i></span>
            <span>Quick Actions</span>
          </h2>

          <div class="actions-grid">
            <a class="action-card"
              href="./applicant-job-search.php">
              <div class="action-icon">
                <span data-lucide="plus"></span>
              </div>
              <div class="action-title">Apply for a Job</div>
            </a>

            <a class="action-card"
              href="./applicant-applications.php">
              <div class="action-icon">
                <span data-lucide="file-user"></span>
              </div>
              <div class="action-title">View Applications</div>
            </a>

            <a class="action-card" href="./applicant-profile.php">
              <div class="action-icon">
                <span data-lucide="user-pen"></span>
              </div>
              <div class="action-title">Edit My Profile</div>
            </a>
          </div>
        </div>
      </div>
      <div class="job-application-status">
        <div class="job-application-header">
          <h2>Recent Job Applications</h2>
          <a href="./applicant-applications.php" class="view-all">
            <i data-lucide="external-link"></i>
          </a>
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
    </div>
    <!-- <div id="calendar"></div> -->

  </main>
  <!-- <script src="https://unpkg.com/lucide@latest"></script> -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <script src="../js/responsive.js" defer></script>
  <script>
    const notifBtn = document.getElementById('notifBtn');
    const notifList = document.getElementById('notifList');
    const notifCount = document.getElementById('notifCount');
    let hasOpened = false;
    notifBtn.addEventListener('click', () => {
      const isHidden = notifList.style.display === 'none';
      notifList.style.display = isHidden ? 'block' : 'none';
      if (isHidden && !hasOpened) {
        hasOpened = true;
        notifCount.textContent = 0;
        notifCount.style.color = "gray";
        fetch('../Functions/seen.php')
          .then(() => {
            fetchNotifications();
          })
          .catch(err => console.error('Error marking seen:', err));
      }
    });

    function fetchNotifications() {
      fetch('../Functions/notification.php')
        .then(res => res.json())
        .then(data => {
          notifCount.textContent = data.count;
          notifCount.style.color = data.count > 0 ? "red" : "gray";
          if (data.notifications.length > 0) {
            notifList.innerHTML = data.notifications
              .map(n => `
              <div style="border-bottom:1px solid var(--border); padding:5px; ${n.seen == 0 ? 'background: var(--bg);' : ''}">
                <p style="margin:0;">${n.message}</p>
                <small style="color:gray;">${new Date(n.created_at).toLocaleString()}</small>
              </div>
            `)
              .join('');
          } else {
            notifList.innerHTML = "<p>No notifications yet</p>";
          }
        })
        .catch(err => console.error('Notification fetch error:', err));
    }
    setInterval(fetchNotifications, 10000);
    fetchNotifications();
  </script>
</body>

</html>