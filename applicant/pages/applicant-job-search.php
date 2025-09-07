<?php
require_once '../../landing/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login-signup.php");
  exit();
}
$sql = "SELECT job_id, job_title, job_type, category, salary_range, location, vacancies, description, created_at 
        FROM job_postings 
        WHERE status = 'active' 
        ORDER BY created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Search</title>
  <link rel="stylesheet" href="../css/applicant-job-search.css" />
  <link rel="stylesheet" href="../css/navs.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <div class="container-job-search">
      <div class="header">
        <h1>Job Listings</h1>
        <div>Showing 10 jobs</div>
      </div>

      <div class="search-filter">
        <div class="search-box">
          <i class="fas fa-search search-icon"></i>
          <input type="text" placeholder="Search for jobs..." />
        </div>
        <select class="filter" id="jobFieldFilter">
          <option value="">All Fields</option>
          <option value="IT">IT/Software</option>
          <option value="Engineering">Engineering</option>
          <option value="Medicine">Medicine/Healthcare</option>
          <option value="Business">Business/Finance</option>
          <option value="Education">Education</option>
          <option value="Marketing">Marketing</option>
          <option value="Construction">Construction</option>
          <option value="Manufacturing">Manufacturing</option>
          <option value="Other">Other Fields</option>
        </select>
      </div>

      <div class="job-listings">
        <!-- IT Job -->
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="job-card" data-field="<?php echo htmlspecialchars($row['category']); ?>">
              <div class="job-field"><?php echo htmlspecialchars($row['category']); ?></div>

              <div class="job-header">
                <div>
                  <h3 class="job-title"><?php echo htmlspecialchars($row['job_title']); ?></h3>
                  <div class="job-company"><?php echo htmlspecialchars($row['job_title']); ?></div>
                </div>
                <div>
                  <span class="job-salary"><?php echo htmlspecialchars($row['salary_range']); ?><br> Salary/Month</span>
                </div>
              </div>

              <div class="job-meta">
                <span><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($row['job_type']); ?></span>
                <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></span>
                <span><i class="fas fa-users"></i> Vacancies: <?php echo (int)$row['vacancies']; ?></span>
              </div>

              <div class="job-description">
                <?php echo nl2br(htmlspecialchars($row['description'])); ?>
              </div>

              <div class="job-footer">
                <div class="job-posted">Posted: <?php echo date("M d, Y", strtotime($row['created_at'])); ?></div>
                <button class="apply-btn" data-job-id="<?php echo (int)$row['job_id']; ?>">Apply Now</button>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No job postings available.</p>
        <?php endif; ?>

      </div>
    </div>

    <!-- Application Modal -->
    <div class="modal" id="applicationModal">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">
            Apply for <span id="modalJobTitle">Frontend Developer</span>
          </h2>
          <button class="close-btn">&times;</button>
        </div>
        <div class="modal-body">
          <form class="application-form">
            <div class="section">
              <h3 style="color: var(--primary-blue-color); margin-bottom: 20px;">
                Personal Information
              </h3>
              <!-- <div class="form-group">
                  <label class="required">Full Name</label>
                  <input type="text" required />
                </div>
                <div class="form-group">
                  <label class="required">Email Address</label>
                  <input type="email" required />
                </div>
                <div class="form-group">
                  <label class="required">Contact Number</label>
                  <input type="tel" required />
                </div> -->
            </div>

            <div class="section">
              <h3
                style="
                      color: var(--primary-blue-color);
                      margin-bottom: 20px;
                    ">
                Application Details
              </h3>
              <div class="form-group">
                <label>Cover Letter</label>
                <textarea
                  placeholder="Tell the employer why you're a good fit for this position..."></textarea>
              </div>
              <div class="form-group">
                <label>How did you hear about this position?</label>
                <select>
                  <option value="">Select</option>
                  <option>Job Portal</option>
                  <option>Company Website</option>
                  <option>Referral</option>
                  <option>Social Media</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label>Availability to Start</label>
                <input type="date" />
              </div>
            </div>

            <div class="section">
              <div
                style="
                      background-color: var(--light-clr-500);
                      padding: 15px;
                      border-radius: 4px;
                    ">
                <p style="margin: 0; color: var(--dark-clr-600)">
                  <i
                    class="fas fa-info-circle"
                    style="color: var(--primary-blue-color)"></i>
                  Your resume/CV and other documents from your profile will
                  be automatically included with this application.
                </p>
              </div>
            </div>

            <div class="form-actions">
              <button
                type="button"
                class="btn btn-outline"
                id="cancelApplication">
                Cancel
              </button>
              <button type="submit" class="btn btn-primary">
                Submit Application
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/responsive.js"></script>
  <script>
    // Job Field Filter
    const jobFieldFilter = document.getElementById('jobFieldFilter');
    const jobCards = document.querySelectorAll('.job-card');
    jobFieldFilter.addEventListener('change', function() {
      const selectedField = this.value;
      jobCards.forEach(card => {
        if (selectedField === "" || card.getAttribute('data-field') === selectedField) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
    // Application Modal
    const modal = document.getElementById('applicationModal');
    const applyButtons = document.querySelectorAll('.apply-btn');
    const closeBtn = document.querySelector('.close-btn');
    const cancelBtn = document.getElementById('cancelApplication');
    const modalJobTitle = document.getElementById('modalJobTitle');

    // Open modal when Apply button is clicked
    applyButtons.forEach(button => {
      button.addEventListener('click', function() {
        const jobCard = this.closest('.job-card');
        const jobTitle = jobCard.querySelector('.job-title').textContent;
        modalJobTitle.textContent = jobTitle;
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
      });
    });
    // Close modal
    function closeModal() {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    // Close when clicking outside modal
    window.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModal();
      }
    });

    // Form Submission
    const applicationForm = document.querySelector('.application-form');
    applicationForm.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Application submitted successfully! Our office will review your application and contact you if you are shortlisted.');
      closeModal();
    });

    // Job Card Expansion
    // const jobDescription = document.querySelectorAll('.job-description');
    // jobDescription.forEach(desc => {
    //   desc.addEventListener('click', function() {
    //     this.classList.toggle('expand');
    //     if (this.classList.contains('expand')) {
    //       this.style.maxHeight = 'none';
    //     } else {
    //       this.style.maxHeight = '100px'; 
    //     }
    //   });
    // });

    // Read More functionality
    const readMoreLinks = document.querySelectorAll('.read-more');
    readMoreLinks.forEach(link => {
      link.addEventListener('click', function() {
        const jobDesc = this.previousElementSibling;
        jobDesc.classList.toggle('expand');
        if (jobDesc.classList.contains('expand')) {
          this.textContent = 'Read Less';
        } else {
          this.textContent = 'Read More';
        }
      });
    });
  </script>


</body>

</html>