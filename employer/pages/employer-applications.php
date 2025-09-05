<?php
require_once '../../landing/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login-signup.php");
  exit();
}
$sql = "SELECT applicant_ID, f_name, l_name, email, status, date_created  
        FROM applicant_account";
        $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Applications</title>
  <link rel="stylesheet" href="../css/employer-dashboard.css" />
  <link rel="stylesheet" href="../css/navs.css" />
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
          <img src="../assets/images/peso-logo.png" alt="" />
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
          <a href="./employer-dashboard.php">
            <span class="emoji"><img src="../../public-assets/icons/chart-histogram.svg" alt=""></span>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./employer-post.php">
            <span class="emoji"><img src="../../public-assets/icons/download.svg" style="transform:rotate(180deg);"></span>
            <span class="label">Post Job</span>
          </a>
        </li>
        <li>
          <a href="./employer-applications.php">
            <span class="emoji"><img src="../../public-assets/icons/briefcase.svg" alt=""></span>
            <span class="label">Job Applications</span>
          </a>
        </li>
        <li>
          <a href="./applicant-job-search.php">
            <span class="emoji"><img src="../../public-assets/icons/search.svg" alt=""></span>
            <span class="label">Applicant Search</span>
          </a>
        </li>
        <li>
          <a href="employer-profile.php">
            <span class="emoji"><img src="../../public-assets/icons/user.svg" alt=""></span>
            <span class="label">My Profile</span>
          </a>
        </li>
        <li>
          <a href="../../landing/functions/logout.php">
            <span class="emoji"><img src="../../public-assets/icons/download.svg" style="transform:rotate(90deg);"></span>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </aside>

    <main class="main-content">
      <section>
        <div class="job-application-status">
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
      </section>
    </main>
  </div>

  <script src="../js/responsive.js"></script>
  <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
      const hamburger = document.querySelector(".hamburger");
      const sidebar = document.querySelector(".sidebar");

      function isMobile() {
        return window.matchMedia("(max-width: 767px)").matches;
      }
      hamburger.addEventListener("click", function() {
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