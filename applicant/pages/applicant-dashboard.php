 <?php
  require_once '../../landing/functions/check_login.php';

  $profile_picture_url = '../assets/images/profile.png';
  if (isset($_SESSION['user_id'])) {
  $applicant_id = $_SESSION['user_id'];
  $query = "SELECT profile_picture FROM applicant_profile WHERE applicant_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $applicant_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['profile_picture'])) {
      $filename = basename($row['profile_picture']);
      $absolute_path = __DIR__ . '/../uploads/profile_pictures/' . $filename;
      $web_path = '../uploads/profile_pictures/' . $filename;

      error_log("Checking: " . $absolute_path);

      if (file_exists($absolute_path)) {
        $profile_picture_url = $web_path;
      }
    }
  }
  $stmt->close();
}

  if (!isset($_SESSION['user_id'])) {
    header("Location: ../login-signup.php");
    exit();
  }
  $applicantId = $_SESSION['user_id'] ?? 0;
  function getProfileCompletion($applicantId, $conn)
  {
    $totalTables = 7;
    $completed = 0;

    $stmt = $conn->prepare("SELECT f_name, l_name, email FROM applicant_account WHERE applicant_ID = ?");
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    if (!empty($data['f_name']) && !empty($data['l_name']) && !empty($data['email'])) {
      $completed++;
    }

    $stmt = $conn->prepare("SELECT * FROM applicant_contact_info WHERE applicant_ID = ?");
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
      $completed++;
    }

    $stmt = $conn->prepare("SELECT * FROM applicant_educ WHERE applicant_ID = ?");
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
      $completed++;
    }

    $stmt = $conn->prepare("SELECT * FROM applicant_work_exp WHERE applicant_ID = ?");
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
      $completed++;
    }


    $stmt = $conn->prepare("SELECT * FROM applicant_documents WHERE applicant_ID = ?");
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
      $completed++;
    }

    $stmt = $conn->prepare("SELECT * FROM applicant_skills WHERE applicant_ID = ?");
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
      $completed++;
    }

    $stmt = $conn->prepare("SELECT * FROM applicant_profile WHERE applicant_ID = ?");
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
      $completed++;
    }

    $completionPercentage = ($completed / $totalTables) * 100;
    return round($completionPercentage);
  }

  $progress = getProfileCompletion($applicantId, $conn);
  $radius = 45;
  $circumference = 2 * M_PI * $radius;
  $offset = $circumference - ($progress / 100) * $circumference;
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
         <div class="profile">
           <label
             class="profile-pic-container"
             id="profilePicContainer"
             for="profilePicInput">
             <img
               src="<?php echo htmlspecialchars($profile_picture_url); ?>"
               alt="Profile Picture"
               class="profile-pic"
               id="profilePicc" style="width: 50px !important;" />
             <div class="upload-icon">
               <svg
                 width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">
                 ['\\ ']
                 <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                 <polyline points="17 8 12 3 7 8"></polyline>
                 <line x1="12" y1="3" x2="12" y2="15"></line>
               </svg>
             </div>
           </label>
         </div>
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
           <div class="completion-message">
             Complete your profile to find jobs before you can apply. The more complete your profile is, the better
             your chances of getting hired.
           </div>
           <button class="complete-profile-btn" onclick=" windows.location.href = 'application-profile.php'">Complete My Profile</button>
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
         <table class="job-application-table" id="dashboardTable">
           <thead>
             <tr>
               <th>Job Title</th>
               <th>Company</th>
               <th>Industry</th>
               <th>Status</th>
               <th>Date Applied</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td>Software Engineer</td>
               <td>Tech Company</td>
               <td class="industry it">IT/Software</td>
               <td><span class="status interview">Interview</span></td>
               <td class="table-date">2025-10-01</td>
               <td>
                 <button class="action-btn cancel-btn">Cancel</button>
               </td>
             </tr>
             <tr>
               <td>Financial Data Analyst</td>
               <td>Data Corp</td>
               <td class="industry finance">Finance</td>
               <td><span class="status applied">Applied</span></td>
               <td class="table-date">2025-09-15</td>
               <td>
                 <button class="action-btn cancel-btn">Cancel</button>
               </td>
             </tr>
             <tr>
               <td>Project Manager</td>
               <td>BuildSmart Inc.</td>
               <td class="industry engineering">Engineering</td>
               <td><span class="status referred">Referred</span></td>
               <td class="table-date">2025-09-15</td>
               <td>
                 <button class="action-btn cancel-btn">Cancel</button>
               </td>
             </tr>
             <tr>
               <td>Clinical Data Analyst</td>
               <td>HealthTech</td>
               <td class="industry medicine">Medicine</td>
               <td><span class="status hired">Hired</span></td>
               <td class="table-date">2025-09-15</td>
               <td>
                 <button class="action-btn cancel-btn">Cancel</button>
               </td>
             </tr>
             <tr>
               <td>Operations Manager</td>
               <td>Retail Logistics</td>
               <td class="industry others">Others</td>
               <td><span class="status declined">Declined</span></td>
               <td class="table-date">2025-09-15</td>
               <td>
                 <button class="action-btn cancel-btn">Cancel</button>
               </td>
             </tr>
           </tbody>
         </table>
       </div>
   </div>
   </main>
   </div>

   <script src="../js/responsive.js"></script>
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