<?php
require_once '../../landing/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login-signup.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Applications</title>
  <link rel="stylesheet" href="../css/applicant-dashboard.css" />
  <link rel="stylesheet" href="../css/navs.css" />
  <link rel="stylesheet" href="../css/table.css" />
  <link rel="stylesheet" href="../../public-assets/library/datatable/dataTables.css">
  <script src="../../public-assets/JS_JQUERY/jquery-3.7.1.min.js" defer></script>
  <script src="../../public-assets/library/datatable/dataTables.js" defer></script>
  <script src="../../public-assets/js/table-init.js" defer></script>
</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <div class="left-pos" style="display: flex; width: auto; height: auto">
        <button class="hamburger">☰</button>
        <div class="logo">
          <img src="../assets/images/logo without glass.png" alt="" />
        </div>
      </div>
      <div class="right-pos">
        <div class="profile">IAN</div>
      </div>
    </div>
  </nav>

  <div class="container">
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
      <div class="job-application-status">
        <h2>Job Application/s</h2>
        <div class="table-responsive">
          <table class="job-application-table" id="dashboardTable">
            <thead>
              <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Industry</th>
                <th>Status</th>
                <th>Date Applied</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Software Engineer</td>
                <td>Tech Company</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status interview">Interview</span></td>
                <td class="table-date">2025-10-01</td>
              </tr>
              <tr>
                <td>Data Analyst</td>
                <td>Data Corp</td>
                <td class="industry finance">Finance</td>
                <td><span class="status applied">Applied</span></td>
                <td class="table-date">2025-09-15</td>
              </tr>
              <tr>
                <td>Manager</td>
                <td>Data Corp</td>
                <td class="industry finance">Finance</td>
                <td><span class="status referred">Referred</span></td>
                <td class="table-date">2025-09-15</td>
              </tr>
              <tr>
                <td>Data Analyst</td>
                <td>Data Corp</td>
                <td class="industry finance">Finance</td>
                <td><span class="status hired">Hired</span></td>
                <td class="table-date">2025-09-15</td>
              </tr>
              <tr>
                <td>Manager</td>
                <td>Data Corp</td>
                <td class="industry finance">Finance</td>
                <td><span class="status declined">Declined</span></td>
                <td class="table-date">2025-09-15</td>
              </tr>
              <tr>
                <td>Frontend Developer</td>
                <td>Web Solutions</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status interview">Interview</span></td>
                <td class="table-date">2025-08-22</td>
              </tr>
              <tr>
                <td>UX Designer</td>
                <td>Design Studio</td>
                <td class="industry others">Others</td>
                <td><span class="status applied">Applied</span></td>
                <td class="table-date">2025-07-30</td>
              </tr>
              <tr>
                <td>Project Manager</td>
                <td>BuildSmart Inc.</td>
                <td class="industry engineering">Engineering</td>
                <td><span class="status referred">Referred</span></td>
                <td class="table-date">2025-08-10</td>
              </tr>
              <tr>
                <td>QA Tester</td>
                <td>QualitySoft</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status hired">Hired</span></td>
                <td class="table-date">2025-07-01</td>
              </tr>
              <tr>
                <td>DevOps Engineer</td>
                <td>CloudStack</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status declined">Declined</span></td>
                <td class="table-date">2025-09-05</td>
              </tr>
              <tr>
                <td>Backend Developer</td>
                <td>ServerTech</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status interview">Interview</span></td>
                <td class="table-date">2025-10-03</td>
              </tr>
              <tr>
                <td>AI Researcher</td>
                <td>NeuralNet AI</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status applied">Applied</span></td>
                <td class="table-date">2025-08-12</td>
              </tr>
              <tr>
                <td>Business Analyst</td>
                <td>MarketWise</td>
                <td class="industry finance">Finance</td>
                <td><span class="status referred">Referred</span></td>
                <td class="table-date">2025-07-25</td>
              </tr>
              <tr>
                <td>Scrum Master</td>
                <td>AgileWorks</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status hired">Hired</span></td>
                <td class="table-date">2025-06-18</td>
              </tr>
              <tr>
                <td>IT Support Specialist</td>
                <td>HelpDesk Pro</td>
                <td class="industry it">IT/Software</td>
                <td><span class="status declined">Declined</span></td>
                <td class="table-date">2025-07-09</td>
              </tr>
            </tbody>

          </table>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/responsive.js"></script>
</body>
</html>