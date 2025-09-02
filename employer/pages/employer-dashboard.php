<?php
require_once '../../landing/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login-signup.php");
  exit();
}
$employer_id = $_SESSION['user_id'];

$sql = "
SELECT 
    ea.email, ea.email, ea.password,
    ed.business_permit, ed.dole_certification, ed.bir_certification, ed.migrant_certification, ed.philjob_certification,
    ei.company_type, ei.company_size, ei.industry, ei.contact_number, ei.address, ei.contact_person, ei.contact_position, ei.contact_mobile, ei.contact_email
FROM employer_account ea
LEFT JOIN employer_company_docs ed ON ea.employer_id = ed.employer_id
LEFT JOIN employer_company_info ei ON ea.employer_id = ei.employer_id
WHERE ea.employer_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$total_fields = count($data); 
$filled = 0;

foreach ($data as $value) {
    if (!empty($value)) {
        $filled++;
    }
}

$completion = round(($filled / $total_fields) * 100);

$radius = 45;
$circumference = 2 * M_PI * $radius;
$offset = $circumference - ($completion / 100 * $circumference);

$sql = "
    SELECT
        (SELECT COUNT(*) FROM job_postings WHERE employer_id = ?) AS employer_total_jobs,
        (SELECT COUNT(*) FROM job_postings) AS total_jobs,
        (SELECT COUNT(*) FROM employer_account) AS total_employers,
        (SELECT COUNT(*) FROM applicant_account WHERE status = 'verified') AS total_applicants,
        (SELECT COUNT(*) FROM job_postings WHERE status = 'active') AS total_active
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employer Dashboard</title>
  <link rel="stylesheet" href="../css/employer-dashboard.css" />
  <link rel="stylesheet" href="../css/navs.css">
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
      <div class="main-header">
        <h1>Welcome, Employer!</h1>
        <!-- <p>
            You are now registered. Please update your
            <a href="">Profile</a> and upload your
            <a href="">Business Permit</a> before you can find an applicant. Thank
            you and good luck to your journey!
          </p> -->
      </div>
      <div class="status-card">
        <div class="progress-circle-container" style="position: relative; width:120px; height:120px;">
          <svg class="progress-circle-svg" viewBox="0 0 100 100">
            <circle class="progress-circle-bg" cx="50" cy="50" r="45"></circle>
            <circle class="progress-circle-fill"
                    cx="50" cy="50" r="45"
                    stroke-dasharray="<?php echo $circumference; ?>"
                    stroke-dashoffset="<?php echo $offset; ?>"></circle>
          </svg>
          <div class="progress-text"><?php echo $completion; ?>%</div>
        </div>

        <div class="progress-details">
          <div class="progress-header">
            <div class="progress-title">Company Profile Completion</div>
            <div>13/20 fields</div>
          </div>

          <div class="progress-message">
            Complete your profile to attract top talent and get verified
          </div>

          <div class="missing-items">
            <strong>Missing information:</strong>
            <ul>
              <li>Company Documents</li>
              <li>Company Logo</li>
              
            </ul>
          </div>
        </div>

        <div class="verification-section">
          <div class="verification-badge pending">
            <i class="fas fa-clock badge-icon"></i>
            Pending
          </div>
          <!-- Other options:
            <div class="verification-badge verified">
                <i class="fas fa-check-circle badge-icon"></i>
                Verified
            </div>
            <div class="verification-badge unverified">
                <i class="fas fa-times-circle badge-icon"></i>
                Unverified
            </div> -->

          <div class="verification-text">
            Account verification status
          </div>

          <button class="action-button">Complete Profile</button>
        </div>
      </div>
      <div class="statistics-container gradient">
        <div class="statistic-card">
          <h2>Jobs Posted</h2>
          <p>
            <?php
            echo $data['employer_total_jobs'];
            ?>
          </p>
        </div>
        <div class="statistic-card">
          <h2>Pending Job Vacancies</h2>
          <p>
            <?php
            echo $data['total_active'];
            ?>
          </p>
        </div>
        <div class="statistic-card">
          <h2>Referred Applicants</h2>
          <p>2</p>
        </div>
        <div class="statistic-card">
          <h2>Job Listings</h2>
          <p>
            <?php
            echo $data['total_jobs'];
            ?>
          </p>
        </div>
        <div class="statistic-card">
          <h2>Registered Employers</h2>
          <p>
            <?php
            echo $data['total_employers'];
            ?>
          </p>
        </div>
        <div class="statistic-card">
          <h2>Registered Applicants</h2>
          <p>
            <?php
            echo $data['total_applicants'];
            ?>
          </p>
        </div>
      </div>
      <div class="job-application-status">
        <h2>Applicant List</h2>
        <div class="table-responsive">
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
                  <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Jane Smith</td>
                <td>jane.smith@example.com</td>
                <td><span class="status applied">Applied</span></td>
                <td class="table-date">2025-09-15</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Alice Johnson</td>
                <td>alice.johnson@example.com</td>
                <td><span class="status declined">Declined</span></td>
                <td class="table-date">2025-09-15</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Bob Brown</td>
                <td>bob.brown@example.com</td>
                <td><span class="status hired">Hired</span></td>
                <td class="table-date">2025-09-15</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
                </td>
              </tr>
              <tr>
                <td>Charlie Davis</td>
                <td>charlie.davis@example.com</td>
                <td><span class="status pending">Pending</span></td>
                <td class="table-date">2025-09-15</td>
                <td class="action-btns">
                  <button>View</button><button>Interview</button> <button>Hire</button><button>Decline</button>
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
    function setVerificationStatus(status) {
  const badge = document.querySelector('.verification-badge');
  if (!badge) return;

  badge.className = `verification-badge ${status}`;

  if (status === 'verified') {
    badge.textContent = 'Verified';
  } else if (status === 'pending') {
    badge.textContent = 'Pending';
  } else {
    badge.textContent = 'Unverified';
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const progressText = document.querySelector('.progress-text');
  if (!progressText) return;

  const completion = parseInt(progressText.textContent.replace('%', '')); 

  if (completion >= 100) {
    setVerificationStatus('verified');
  } else {
    setVerificationStatus('pending');
  }
});

  </script>
  <!-- <script>
     $(document).ready(function() {
       $("#employerDashboardTable").DataTable({
         responsive: true,
         columnDefs: [{
           target: "_all",
           defaultContent: "-",
         }, ],
       });
     });
   </script> -->
</body>

</html>