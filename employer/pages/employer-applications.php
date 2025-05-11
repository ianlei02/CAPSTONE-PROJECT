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
              <tr>
                <td>John Doe</td>
                <td>john.doe@example.com</td>
                <td><span class="status interview">Interview</span></td>
                <td class="table-date">2025-10-01</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Jane Smith</td>
                <td>jane.smith@example.com</td>
                <td><span class="status applied">Applied</span></td>
                <td class="table-date">2025-09-15</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Alice Johnson</td>
                <td>alice.johnson@example.com</td>
                <td><span class="status declined">Declined</span></td>
                <td class="table-date">2025-09-14</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Bob Brown</td>
                <td>bob.brown@example.com</td>
                <td><span class="status hired">Hired</span></td>
                <td class="table-date">2025-09-13</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Charlie Davis</td>
                <td>charlie.davis@example.com</td>
                <td><span class="status pending">Pending</span></td>
                <td class="table-date">2025-09-12</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Emily Clark</td>
                <td>emily.clark@example.com</td>
                <td><span class="status applied">Applied</span></td>
                <td class="table-date">2025-09-11</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Daniel Lee</td>
                <td>daniel.lee@example.com</td>
                <td><span class="status interview">Interview</span></td>
                <td class="table-date">2025-09-10</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Grace Miller</td>
                <td>grace.miller@example.com</td>
                <td><span class="status declined">Declined</span></td>
                <td class="table-date">2025-09-09</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Henry Wilson</td>
                <td>henry.wilson@example.com</td>
                <td><span class="status hired">Hired</span></td>
                <td class="table-date">2025-09-08</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Ivy Moore</td>
                <td>ivy.moore@example.com</td>
                <td><span class="status pending">Pending</span></td>
                <td class="table-date">2025-09-07</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Jack Nguyen</td>
                <td>jack.nguyen@example.com</td>
                <td><span class="status applied">Applied</span></td>
                <td class="table-date">2025-09-06</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Karen White</td>
                <td>karen.white@example.com</td>
                <td><span class="status interview">Interview</span></td>
                <td class="table-date">2025-09-05</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Liam Thompson</td>
                <td>liam.thompson@example.com</td>
                <td><span class="status declined">Declined</span></td>
                <td class="table-date">2025-09-04</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Mia Taylor</td>
                <td>mia.taylor@example.com</td>
                <td><span class="status hired">Hired</span></td>
                <td class="table-date">2025-09-03</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Noah Anderson</td>
                <td>noah.anderson@example.com</td>
                <td><span class="status pending">Pending</span></td>
                <td class="table-date">2025-09-02</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button><button>Hire</button><button>Decline</button>
                </td>
              </tr>
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