<?php
require_once '../../auth/functions/check_login.php';
require_once '../Functions/getinfo.php';
require_once '../Functions/getName.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
$sql = "SELECT 
            jp.job_id, 
            jp.job_title, 
            jp.job_type, 
            jp.category, 
            jp.salary_range, 
            jp.location, 
            jp.vacancies, 
            jp.description, 
            jp.created_at,
            ec.employer_id,
            ec.company_name
        FROM job_postings jp
        INNER JOIN employer_company_info ec 
            ON jp.employer_id = ec.employer_id
        WHERE jp.status = 'Active'
        ORDER BY jp.created_at DESC";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Search</title>
  <script src="../js/load-saved.js"></script>
  <link rel="stylesheet" href="../css/applicant-job-search.css" />
  <link rel="stylesheet" href="../css/navs.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>


  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo">
        <img src="../../public/images/pesosmb.png" alt="" />
        <h3>PESO</h3>
      </div>
      <button class="hamburger"><i data-lucide="panel-left"></i></button>
    </div>
    <div class="sidebar-options">
      <ul class="sidebar-menu">
        <li>
          <a href="./applicant-dashboard.php">
            <i data-lucide="home" class="icon"></i>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./applicant-profile.php">
            <i data-lucide="user" class="icon"></i>
            <span class="label">My Profile</span>
          </a>
        </li>
        <li>
          <a href="./applicant-applications.php">
            <i data-lucide="briefcase-business" class="icon"></i>
            <span class="label">My Applications</span>
          </a>
        </li>
        <li>
          <a href="./applicant-job-search.php" class="active">
            <i data-lucide="search" class="icon"></i>
            <span class="label">Job Search</span>
          </a>
        </li>
      </ul>
      <ul>
        <li>
          <a href="../../auth/functions/logout.php" class="log-out-btn">
            <i data-lucide="log-out" class="icon"></i>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content">
    <nav class="navbar">
      <div class="navbar-left">
        <div class="left-pos" style="display: flex; width: auto; height: auto">
          <button class="hamburger">☰</button>
          <h1>Job Listings</h1>
        </div>
        <div class="right-pos">
          <div class="profile">
            <img
              src="<?php echo htmlspecialchars($profile_picture_url); ?>"
              alt="Profile Picture"
              class="profile-pic"
              id="profilePicc" style="width: 50px !important;" />
            <div class="user-name">
              <h4><?= $fullName ?></h4>
              <p>Applicant</p>
            </div>
          </div>

          <div class="dropdown-menu" id="dropdownMenu">
            <div class="dropdown-arrow"></div>
            <div class="dropdown-header">
              <img src="<?php echo htmlspecialchars($profile_picture_url); ?>" alt="Profile Picture">
              <a class="user-info" href="./applicant-profile.php">
                <h3><?= $fullName ?></h3>
                <p>See your profile</p>
              </a>
            </div>

            <div class="dropdown-links">
              <a href="./account-settings.php" class="dropdown-item">
                <span class="material-symbols-outlined">settings</span>
                <span>Account Settings</span>
              </a>
              <a onclick="toggleTheme()" class="dropdown-item">
                <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
                <span id="themeLabel">Dark Mode</span>
              </a>

              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item logout-item">
                <span class="material-symbols-outlined icon">logout</span>
                <span>Log Out</span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </nav>
    <div class="container-job-search">
      <!-- <div class="header">
        <h1>Job Listings</h1>
        <div>Showing 10 jobs</div>
      </div> -->

      <div class="search-filter">
        <div class="search-box">
          <span></span>
          <input type="text" placeholder="Search for jobs..." />
        </div>
        <select class="filter" id="jobFieldFilter">
          <option value="">All Fields</option>
          <option value="Education">Education</option>
          <option value="Finance">Financial Service</option>
          <option value="Transpo">Transportation</option>
          <option value="D-economy">Digital Economy</option>
          <option value="B-economy">Blue Economy</option>
          <option value="C-economy">Creative Economy</option>
          <option value="G-economy">Green Economy</option>
          <option value="Housing">Housing</option>
          <option value="Food">Food & Advanced Manufacturing</option>
          <option value="Health">Health</option>
          <option value="Agri">Agribusiness, Agriculture, Forestry, and Fisheries</option>
          <option value="Tourism">Tourism</option>
          <option value="Construction">Construction</option>
        </select>
      </div>

      <div class="job-listings" id="job-listings">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <?php
            $jobId = $row['job_id'];
            $status = 'Not Applied';

            // Check if applicant already applied
            $statusSql = "SELECT status FROM job_application WHERE applicant_id = ? AND job_id = ?";
            $stmt = $conn->prepare($statusSql);
            $stmt->bind_param("ii", $applicant_id, $jobId);
            $stmt->execute();
            $statusResult = $stmt->get_result();
            if ($statusResult->num_rows > 0) {
              $status = ucfirst($statusResult->fetch_assoc()['status']);
            }
            $stmt->close();
            ?>

            <div class="job-card hidden <?= $status ?>" data-field="<?php echo htmlspecialchars($row['category']); ?>">
              <div class="job-field"><?php echo htmlspecialchars($row['category']); ?></div>

              <div class="job-header">
                <div>
                  <h3 class="job-title"><?php echo htmlspecialchars($row['job_title']); ?></h3>
                  <div class="job-company"><?php echo htmlspecialchars($row['company_name']); ?></div>
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

                <?php if ($status === 'Pending' || $status === 'Referred' || $status === 'Rejected' || $status === 'Interview'): ?>
                  <button class="status-btn" data-job-id="<?php echo (int)$row['job_id']; ?>">
                    <?= ($status === 'Pending') ? 'Applied' : 'View Status'; ?>
                  </button>

                <?php else: ?>
                  <?php if ($progress == 100): ?>
                    <button class="apply-btn" data-job-id="<?php echo (int)$row['job_id']; ?>">Apply Now</button>
                  <?php else: ?>
                    <button class="apply-btn disabled" disabled>Complete Your Profile First</button>
                  <?php endif; ?>
                <?php endif; ?>
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
            Apply for <span id="modalJobTitle">Haduken</span>
          </h2>
          <button class="close-btn">&times;</button>
        </div>
        <div class="modal-body">
          <form class="application-form" action="../Functions/job_update.php" method="POST" id="app-form">

            <input type="hidden" name="job_id" id="modalJobId">
            <div class="section">
              <h3 style="color: var(--primary-blue-color); margin-bottom: 20px;">
                Job requirements
              </h3>
              <div class="job-description">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus natus dolore autem est, nobis obcaecati voluptate labore qui animi commodi, cumque numquam. Repellat nulla enim delectus cum impedit praesentium natus?
              </div>
            </div>

            <div class="section">
              <!-- <h3
                style="
                      color: var(--primary-blue-color);
                      margin-bottom: 20px;
                    ">
                Application Details
              </h3> -->

              <!-- <div class="form-group">
                <label>Cover Letter</label>
                <textarea name="cover_letter"
                  placeholder="Tell the employer why you're a good fit for this position..."></textarea>
              </div> -->
              <div class="form-group">
                <label>How did you hear about this position?</label>
                <select name="referral_source">
                  <option value="">Select</option>
                  <option>Job Portal</option>
                  <option>Company Website</option>
                  <option>Referral</option>
                  <option>Social Media</option>
                  <option>Other</option>
                </select>
              </div>

            </div>

            <div class="section">
              <div class="info-section">
                <p>
                  <i
                    class="fas fa-info-circle"
                    style="color: var(--color-blue-500)"></i>
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

  <script src="../js/responsive.js" defer></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    document.querySelectorAll("[data-alert]").forEach(btn => {
      btn.addEventListener("click", () => {
        alert("Please complete your profile before applying for a job.");
      });
    });


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
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const jobCards = document.querySelectorAll(".job-card");

      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.remove("hidden");
            entry.target.classList.add("visible");
            obs.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1
      });

      jobCards.forEach(card => {
        observer.observe(card);
      });
    });
  </script>
  <script>
    document.querySelectorAll('.apply-btn').forEach(button => {
      button.addEventListener('click', function() {
        const jobId = this.getAttribute('data-job-id');
        document.getElementById('modalJobId').value = jobId;
        document.getElementById('applicationModal').style.display = 'block';
      });
    });
  </script>
  <script>
    document.getElementById('app-form').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = this;
      const formData = new FormData(form);

      const confirm = await Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to apply for this job?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, apply',
        cancelButtonText: 'Cancel'
      });
      if (!confirm.isConfirmed) return;

      try {
        const res = await fetch(form.action, {
          method: 'POST',
          body: formData,
          credentials: 'same-origin'
        });
        const text = await res.text();
        let data;
        try {
          data = JSON.parse(text);
        } catch (parseErr) {
          console.error('Server returned non-JSON response:', text);
          await Swal.fire('Server error', 'Invalid JSON response from server. Open console or Network tab to inspect server response.', 'error');
          return;
        }
        if (data.success) {
          await Swal.fire({
            icon: 'success',
            title: 'Application submitted successfully!',
            text: data.message || 'Your application was saved.',
            confirmButtonColor: '#3085d6'
          });
          form.reset();
          if (typeof closeModal === 'function') closeModal();
          location.reload();
        } else {
          await Swal.fire('Error', data.message || 'Server returned an error.', 'error');
        }
      } catch (err) {
        console.error('Fetch error:', err);
        await Swal.fire('Error', err.message || 'Something went wrong, please try again.', 'error');
      }
    });
  </script>
</body>

</html>