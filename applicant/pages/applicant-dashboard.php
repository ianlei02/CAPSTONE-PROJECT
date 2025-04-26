 
<?php
require_once '../../landing/functions/check_login.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login-signup.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Applicant Dashboard</title>
    <link rel="stylesheet" href="../css/applicant-dashboard.css" />
    <link rel="stylesheet" href="../css/navs.css">
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

              <span class="emoji"><img src="../../public-assets/icons/gauge-high-solid.svg" alt="Dashboard-icon"></span>
              <span class="label">Dashboard</span>
            </a>
          </li>
          <li>

            <a href="./applicant-applications.php">

              <span class="emoji"><img src="../../public-assets/icons/briefcase-solid.svg" alt="Applications-icon"></span>
              <span class="label">My Applications</span>
            </a>
          </li>
          <li>
            <a href="./applicant-job-search.php">

              <span class="emoji"><img src="../../public-assets/icons/magnifying-glass-solid.svg" alt="Job-Search-icon"></span>
              <span class="label">Job Search</span>
            </a>
          </li>
          <li>

            <a href="./applicant-profile.php">

              <span class="emoji"><img src="../../public-assets/icons/user-solid.svg" alt="Profile-icon"></span>
              <span class="label">My Profile</span>
            </a>
          </li>
          <li>

            <a href="../../landing/functions/logout.php">

              <span class="emoji"><img src="../../public-assets/icons/arrow-right-from-bracket-solid.svg" alt="Logout-icon"></span>
              <span class="label">Log Out</span>
            </a>
          </li>
        </ul>
      </aside>

      <main class="main-content">
        <div class="main-header">
          <h1>Welcome, Applicant!</h1>
          <p>
            You are now registered. Please update your
            <a href="">Profile</a> and upload your <a href="">CV</a> before you
            can find a job. Thank you and good luck to your journey!
          </p>
        </div>
        <div class="statistics-container gradient">
          <div class="statistic-card">
            <h2>Applications</h2>
            <p>5</p>
          </div>
          <div class="statistic-card">
            <h2>Interviews</h2>
            <p>3</p>
          </div>
          <div class="statistic-card">
            <h2>Referred</h2>
            <p>2</p>
          </div>
          <div class="statistic-card">
            <h2>Job Listings</h2>
            <p>104</p>
          </div>
          <div class="statistic-card">
            <h2>Registered Employers</h2>
            <p>59</p>
          </div>
          <div class="statistic-card">
            <h2>Registered Applicants</h2>
            <p>409</p>
          </div>
        </div>
        <div class="job-application-status">
          <h2>Job Application Status</h2>
          <table class="job-application-table">
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
            </tbody>
          </table>
        </div>
      </main>
    </div>
    <script src="../js/responsive.js"></script>
    <!-- <script>
      document.addEventListener("DOMContentLoaded", function () {
        const hamburger = document.querySelector(".hamburger");
        const sidebar = document.querySelector(".sidebar");

        function isMobile() {
          return window.matchMedia("(max-width: 767px)").matches;
        }
        hamburger.addEventListener("click", function () {
          if (isMobile()) {
            sidebar.classList.toggle("visible");
          } else {
            sidebar.classList.toggle("collapsed");
          }
        });
        function initSidebar() {
          if (isMobile()) {
            sidebar.classList.remove("collapsed");
            sidebar.classList.remove("visible");
          } else {
            sidebar.classList.remove("visible");
          }
        }
        window.addEventListener("resize", initSidebar);
        initSidebar();
      });
    </script> -->
  </body>
</html>
