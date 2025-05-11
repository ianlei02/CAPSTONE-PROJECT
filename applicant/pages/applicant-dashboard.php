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
   <title>Applicant Dashboard</title>
   <link rel="stylesheet" href="../css/applicant-dashboard.css" />
   <link rel="stylesheet" href="../css/navs.css">
   <link rel="stylesheet" href="../css/table.css">
   <link rel="stylesheet" href="../css/profile-completion.css">
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
       <div class="main-header">
         <h1>Welcome, Applicant!</h1>
         <!-- <p>
           You are now registered. Please update your
           <a href="">Profile</a> and upload your <a href="">CV</a> before you
           can find a job. Thank you and good luck to your journey!
         </p> -->
       </div>
       <div class="profile-completion-container">
         <!-- <h6 class="completion-title">Profile Completion</h6> -->
         <div class="progress-circle">
           <svg viewBox="0 0 100 100">
             <circle class="progress-circle-background" cx="50" cy="50" r="45"></circle>
             <circle class="progress-circle-progress" cx="50" cy="50" r="45"
               stroke-dasharray="282.743"
               stroke-dashoffset="113.097"></circle> <!-- 60% complete (282.743 * 0.4) -->
           </svg>
           <div class="progress-text">
             60%<span>COMPLETE</span>
           </div>
         </div>


         <div class="message-button">
           <div class="completion-message">
             Complete your profile to find jobs before you can apply. The more complete your profile is, the better
             your chances of getting hired.
           </div>
           <button class="complete-profile-btn">Complete My Profile</button>
         </div>

         <div class="missing-items">
           <strong>Missing information:</strong>
           <ul>
             <li>Work history</li>
             <li>Skills</li>
             <li>Profile photo</li>
           </ul>
         </div>
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
         <h2>Recent Job Applications</h2>
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
                 <td>Financial Data Analyst</td>
                 <td>Data Corp</td>
                 <td class="industry finance">Finance</td>
                 <td><span class="status applied">Applied</span></td>
                 <td class="table-date">2025-09-15</td>
               </tr>
               <tr>
                 <td>Project Manager</td>
                 <td>BuildSmart Inc.</td>
                 <td class="industry engineering">Engineering</td>
                 <td><span class="status referred">Referred</span></td>
                 <td class="table-date">2025-09-15</td>
               </tr>
               <tr>
                 <td>Clinical Data Analyst</td>
                 <td>HealthTech</td>
                 <td class="industry medicine">Medicine</td>
                 <td><span class="status hired">Hired</span></td>
                 <td class="table-date">2025-09-15</td>
               </tr>
               <tr>
                 <td>Operations Manager</td>
                 <td>Retail Logistics</td>
                 <td class="industry others">Others</td>
                 <td><span class="status declined">Declined</span></td>
                 <td class="table-date">2025-09-15</td>
               </tr>
             </tbody>

           </table>
         </div>
       </div>
     </main>
   </div>
   <script src="../js/responsive.js"></script>
   <script>
     function updateProgress(percent) {
       const progressCircle = document.querySelector('.progress-circle-progress');
       const progressText = document.querySelector('.progress-text');
       const circumference = 282.743; // 2 * π * r (where r = 45)

       const offset = circumference - (percent / 100) * circumference;
       progressCircle.style.strokeDashoffset = offset;
       progressText.innerHTML = `${percent}%<span>COMPLETE</span>`;

       if (percent >= 75) {
         progressCircle.style.stroke = '#2ecc71'; // Green
       } else if (percent >= 50) {
         progressCircle.style.stroke = '#3498db'; // Blue
       } else {
         progressCircle.style.stroke = '#e74c3c'; // Red
       }
     }

     setTimeout(() => updateProgress(75), 2000);
   </script>
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