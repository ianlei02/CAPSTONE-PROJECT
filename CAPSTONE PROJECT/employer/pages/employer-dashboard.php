<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employer Dashboard</title>
    <link rel="stylesheet" href="../css/employer-dashboard.css" />
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
            <a href="./employer-dashboard.html">
              <span class="emoji"><img src="../../public-assets/icons/gauge-high-solid.svg" alt=""></span>
              <span class="label">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="./employer-applications.html">
              <span class="emoji"><img src="../../public-assets/icons/briefcase-solid.svg" alt=""></span>
              <span class="label">Job Applications</span>
            </a>
          </li>
          <li>
            <a href="./applicant-job-search.html">
              <span class="emoji"><img src="../../public-assets/icons/magnifying-glass-solid.svg" alt=""></span>
              <span class="label">Applicant Search</span>
            </a>
          </li>
          <li>
            <a href="./employer-profile.html">
              <span class="emoji"><img src="../../public-assets/icons/user-solid.svg" alt=""></span>
              <span class="label">My Profile</span>
            </a>
          </li>
          <li>
            <a href="../../landing/index.html">
              <span class="emoji"><img src="../../public-assets/icons/arrow-right-from-bracket-solid.svg" alt=""></span>
              <span class="label">Log Out</span>
            </a>
          </li>
        </ul>
      </aside>

      <main class="main-content">
        <section>
          <div class="main-header">
            <h1>Welcome, Employer!</h1>
            <p>
              You are now registered. Please update your
              <a href="">Profile</a> and upload your
              <a href="">Business Permit</a> before you can find an applicant. Thank
              you and good luck to your journey!
            </p>
          </div>
          <div class="statistics-container gradient">
            <div class="statistic-card">
              <h2>Jobs Posted</h2>
              <p>5</p>
            </div>
            <div class="statistic-card">
              <h2>Pending Job Vacancies</h2>
              <p>3</p>
            </div>
            <div class="statistic-card">
              <h2>Referred Applicants</h2>
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
            <h2>Applicant List</h2>
            <table class="job-application-table">
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
                  <td class="status interviewed">Interview</td>
                  <td>2023-10-01</td>
                  <td>
                    <button>Hire</button><button>Reject</button
                    ><button>View Profile</button><button>Interview</button>
                  </td>
                </tr>
                <tr>
                  <td>Jane Smith</td>
                  <td>jane.smith@example.com</td>
                  <td class="status applied">Applied</td>
                  <td>2023-09-15</td>
                  <td>
                    <button>Hire</button><button>Reject</button
                    ><button>View Profile</button><button>Interview</button>
                  </td>
                </tr>
                <tr>
                  <td>Alice Johnson</td>
                  <td>alice.johnson@example.com</td>
                  <td class="status referred">Referred</td>
                  <td>2023-09-15</td>
                  <td>
                    <button>Hire</button><button>Reject</button
                    ><button>View Profile</button><button>Interview</button>
                  </td>
                </tr>
                <tr>
                  <td>Bob Brown</td>
                  <td>bob.brown@example.com</td>
                  <td class="status hired">Hired</td>
                  <td>2023-09-15</td>
                  <td>
                    <button>Hire</button><button>Reject</button
                    ><button>View Profile</button><button>Interview</button>
                  </td>
                </tr>
                <tr>
                  <td>Charlie Davis</td>
                  <td>charlie.davis@example.com</td>
                  <td class="status referred">Referred</td>
                  <td>2023-09-15</td>
                  <td>
                    <button>Hire</button><button>Reject</button
                    ><button>View Profile</button><button>Interview</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </main>
    </div>

    <script>
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
    </script>
  </body>
</html>
