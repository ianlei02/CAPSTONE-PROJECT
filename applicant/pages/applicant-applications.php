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
  <link rel="stylesheet" href="../../public-assets/library/datatable/dataTables.css">
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
                <th>Status</th>
                <th>Date Applied</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Software Engineer</td>
                <td>Tech Company</td>
                <td><span class="status interviewed">Interview</span></td>
                <td>2025-10-01</td>
              </tr>
              <tr>
                <td>Data Analyst</td>
                <td>Data Corp</td>
                <td><span class="status applied">Applied</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Manager</td>
                <td>Data Corp</td>
                <td><span class="status referred">Reffered</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Data Analyst</td>
                <td>Data Corp</td>
                <td><span class="status hired">Hired</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Manager</td>
                <td>Data Corp</td>
                <td><span class="status rejected">Rejected</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Software Engineer</td>
                <td>Tech Company</td>
                <td><span class="status interviewed">Interview</span></td>
                <td>2025-10-01</td>
              </tr>
              <tr>
                <td>Data Analyst</td>
                <td>Data Corp</td>
                <td><span class="status applied">Applied</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Manager</td>
                <td>Data Corp</td>
                <td><span class="status referred">Reffered</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Data Analyst</td>
                <td>Data Corp</td>
                <td><span class="status hired">Hired</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Manager</td>
                <td>Data Corp</td>
                <td><span class="status rejected">Rejected</span></td>
                <td>2025-09-15</td>
              </tr>
              <tr>
                <td>Software Engineer</td>
                <td>Tech Company</td>
                <td><span class="status interviewed">Interview</span></td>
                <td>2025-10-01</td>
              </tr>
              <tr>
                <td>Data Analyst</td>
                <td>Data Corp</td>
                <td><span class="status applied">Applied</span></td>
                <td>2025-09-15</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/responsive.js"></script>
  <script src="../../public-assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
  <script src="../../public-assets/library/datatable/dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $("#dashboardTable").DataTable({
        responsive: true,
        columnDefs: [{
          target: "_all",
          defaultContent: "-",
        }, ],
      });
    });
  </script>


</body>

</html>