<?php
require  '../../auth/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../auth/login-signup.php");
  exit();
}
$employer_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM job_postings WHERE employer_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

   if ($action === 'editJob') {
    $stmt = $conn->prepare("SELECT * FROM job_postings WHERE job_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $job = $stmt->get_result()->fetch_assoc();

    if (!$job) {
      echo "<p>Job not found.</p>";
      exit;
    }

     $salaryParts = explode('-', $job['salary_range'] ?? '');
    $salaryMin = isset($salaryParts[0]) ? trim(str_replace('₱', '', $salaryParts[0])) : '';
    $salaryMax = isset($salaryParts[1]) ? trim(str_replace('₱', '', $salaryParts[1])) : '';

    ?>
    <form id="editJobForm">
      <div class="form-row">
        <div class="form-group">
          <label for="title">Job Title</label>
          <input type="text" name="title" id="title" value="<?= htmlspecialchars($job['job_title']) ?>" required />
        </div>

        <div class="form-group">
          <label for="category">Job Category</label>
          <select id="category" name="category" required>
            <option value="">Select Category</option>
            <?php
            $categories = [
              "Education" => "Education",
              "Finance" => "Financial Service",
              "Transpo" => "Transportation",
              "D-economy" => "Digital Economy",
              "B-economy" => "Blue Economy",
              "C-economy" => "Creative Economy",
              "G-economy" => "Green Economy",
              "Housing" => "Housing",
              "Food" => "Food & Advanced Manufacturing",
              "Health" => "Health",
              "Agri" => "Agribusiness, Agriculture, Forestry, and Fisheries",
              "Tourism" => "Tourism",
              "Construction" => "Construction"
            ];
            foreach ($categories as $value => $label) {
              $selected = ($job['category'] === $value) ? 'selected' : '';
              echo "<option value='$value' $selected>$label</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="type">Job Type</label>
          <input type="text" name="type" id="type" value="<?= htmlspecialchars($job['job_type']) ?>" required />
        </div>
        <div class="form-group">
          <label for="vacancies">Vacancies</label>
          <input type="number" name="vacancies" id="vacancies" value="<?= (int)$job['vacancies'] ?>" />
        </div>
      </div>

      <div class="form-group">
        <label>Salary Range (₱)</label>
        <input type="number" name="salary[]" value="<?= htmlspecialchars($salaryMin) ?>" placeholder="Min" />
        <input type="number" name="salary[]" value="<?= htmlspecialchars($salaryMax) ?>" placeholder="Max" />
      </div>

      <div class="form-group">
        <label for="expiry_date">Deadline</label>
        <input type="date" name="expiry_date" id="expiry_date" value="<?= htmlspecialchars($job['expiry_date']) ?>" />
      </div>

      <div class="form-group">
        <label for="description">Job Description</label>
        <textarea name="description" id="description" rows="5"><?= htmlspecialchars($job['description']) ?></textarea>
      </div>
    </form>
    <?php
    exit;
  }

  if ($action === 'saveJob') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $vacancies = isset($_POST['vacancies']) ? (int)$_POST['vacancies'] : 0;
    $expiry_date = trim($_POST['expiry_date'] ?? '');
    $description = trim($_POST['description'] ?? '');

    $salary = $_POST['salary'] ?? [];
    $salaryRange = implode('-', array_filter(array_map('trim', $salary)));

    $stmt = $conn->prepare("
      UPDATE job_postings 
      SET job_title = ?, category = ?, job_type = ?, vacancies = ?, expiry_date = ?, description = ?, salary_range = ?
      WHERE job_id = ?
    ");

    if (!$stmt) {
      echo "Prepare failed: " . $conn->error;
      exit;
    }

    $stmt->bind_param("sssisssi", $title, $category, $type, $vacancies, $expiry_date, $description, $salaryRange, $id);

    if ($stmt->execute()) {
      echo "Job updated successfully";
    } else {
      echo "Error updating job: " . $stmt->error;
    }

    exit;
  }
  if ($action === 'deleteJob') {
      $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

      if (!$id) {
        echo "Invalid job ID";
        exit;
      }

      $stmt = $conn->prepare("DELETE FROM job_postings WHERE job_id = ?");
      $stmt->bind_param("i", $id);

      if ($stmt->execute()) {
        echo "Job deleted successfully";
      } else {
        echo "Error deleting job: " . $stmt->error;
      }

      exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employer Dashboard</title>
  <script src="../js/load-saved.js"></script>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/employer-post.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <div class="left-pos">
        <h1>Job Posting</h1>
      </div>
      <div class="right-pos">
        <div class="profile">IAN</div>
      </div>
    </div>
  </nav>
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo">
        <img src="../../public/images/pesosmb.png" alt="" />
        <h3>PESO</h3>
      </div>
      <button class="hamburger"><span class="material-symbols-outlined">dock_to_right</span></button>
    </div>
    <div class="sidebar-options">
      <ul class="sidebar-menu">
        <li>
          <a href="./employer-dashboard.php">
            <span class="material-symbols-outlined icon">dashboard</span>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./employer-post.php" class="active">
            <span class="material-symbols-outlined icon">work</span>
            <span class="label">Post Job</span>
          </a>
        </li>
        <!-- <li>
          <a href="./employer-applications.php">
            <span class="material-symbols-outlined icon">people</span>
            <span class="label">Job Applications</span>
          </a>
        </li> -->
        <li>
          <a href="employer-profile.php">
            <span class="material-symbols-outlined icon">id_card</span>
            <span class="label">My Profile</span>
          </a>
        </li>
        <li>
          <button onclick="toggleTheme()" class="dark-mode-toggle">
            <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
            <span id="themeLabel">Dark Mode</span>
          </button>
        </li>
      </ul>
      <ul>
        <li>
          <a href="../../auth/functions/logout.php" class='log-out-btn'>
            <span class="material-symbols-outlined icon">logout</span>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="main-content">
    <section class="job-posting-section card">
      <h2>Post a New Job</h2>
      <form id="jobPostForm" class="job-form" method="POST" action="../Functions/job_post.php">
        <div class="form-row">
          <div class="form-group">
            <label for="jobTitle" class="required">Job Title</label>
            <input type="text" id="jobTitle" name="jobTitle" required placeholder="e.g., Senior Frontend Developer">
          </div>
          <div class="form-group">
            <label for="jobType" class="required">Job Type</label>
            <select id="jobType" name="jobType" required>
              <option value="">Select Job Type</option>
              <option value="Full-time">Full-time</option>
              <option value="Part-time">Part-time</option>
              <option value="Contract">Contract</option>
              <option value="Internship">Internship</option>
              <option value="Temporary">Temporary</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="location" class="required">Location</label>
            <input type="text" id="location" name="location" required placeholder="e.g., New York, NY or Remote">
          </div>
          <div class="form-group">
            <label for="category" class="required">Category</label>
            <select id="category" name="category" required>
              <option value="">Select Category</option>
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
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="vacancies" class="required">Number of Vacancies</label>
            <input type="number" id="vacancies" name="vacancies" required min="1" placeholder="e.g., 2">
          </div>
          <div class="form-group">
            <label for="expiryDate" class="required">Application Deadline</label>
            <input type="date" id="expiryDate" name="expiryDate">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="salary" class="required">Salary Range</label>
            <input type="number" id="salary" name="salary[]" placeholder="e.g., ₱80,000" style="width: 49%;">
            <input type="number" id="salary" name="salary[]" placeholder="e.g., ₱100,000" style="width: 49%;">
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="required">Job Description and Requirements</label>
          <textarea id="description" name="description" rows="5" required placeholder="Detailed description of the job responsibilities..."></textarea>
        </div>
        <div class="form-actions">
          <button type="reset" class="btn btn-secondary">Clear Form</button>
          <button type="submit" class="btn btn-primary">Post Job Opening</button>
        </div>
      </form>
    </section>

    <!-- Job Monitoring Section -->
    <section class="job-monitoring-section card" id="jobsPosted">
      <div class="section-header">
        <form action="employer-post.php" method="GET">
          <h2>Jobs Posted</h2>
          <div class="search-filter">
            <select class="status-filter">
              <option value="all">All Statuses</option>
              <option value="active">Active</option>
              <option value="closed">Closed</option>
              <option value="draft">Draft</option>
            </select>
          </div>
      </div>

      <div class="table-responsive">
        <table class="jobs-table" id="myTable">
          <thead>
            <tr>
              <th>Job Title</th>
              <th>Category</th>
              <th>Type</th>
              <th>Vacancies</th>
              <th>Deadline</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="jobsTableBody">
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['job_title']) ?></td>
                <td>
                  <span class="tag tag-<?= strtolower($row['category']) ?>"><?= htmlspecialchars($row['category']) ?></span>
                </td>
                <td><?= htmlspecialchars($row['job_type']) ?></td>
                <td class="vacancies"><?= htmlspecialchars($row['vacancies']) ?></td>
                <td class="expiry-date"><?= htmlspecialchars($row['expiry_date']) ?></td>
                <td><span class="status-badge <?= htmlspecialchars($row['status']) ?>"><?= ucfirst($row['status']) ?></span></td>

                <td class="action-buttons">
                  <button type="button" class="action-btn view" onclick="editJob(<?= $row['job_id'] ?>)">View</button>
                  <button type="button" class="action-btn delete" onclick="deleteJob(<?= $row['job_id'] ?>)">Delete</button>
                  <a href="dss_results.php?job_id=<?= $row['job_id'] ?>" class="action-btn run-dss">Run DSS</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <script src="../js/responsive.js"></script>
  <script src="../js/dark-mode.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const jobForm = document.getElementById("jobPostForm");

      jobForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(jobForm);

        fetch(jobForm.action, {
            method: "POST",
            body: formData
          })
          .then(response => response.text())
          .then(data => {
            Swal.fire({
              icon: 'success',
              title: 'Job Posted!',
              text: 'Your job opening has been successfully posted.',
              confirmButtonText: 'OK'
            }).then(() => {
              jobForm.reset();
            });
          })
          .catch(error => {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong. Please try again.',
            });
            console.error("Error posting job:", error);
          });
      });
    });
  </script>
  <script>
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
      if (button.tagName.toLowerCase() === "button") {
        button.addEventListener("click", (e) => e.preventDefault());
      }
    });


    function viewApplicants(jobId) {
      fetch(`employer-post.php?action=viewApplicants&id=${jobId}`)
        .then(res => res.text())
        .then(data => {
          Swal.fire({
            title: 'Applicants',
            html: data,
            width: 600
          });
        });
    }

    function editJob(jobId) {
    fetch(`employer-post.php?action=editJob&id=${jobId}`)
      .then(res => res.text())
      .then(data => {
        Swal.fire({
          title: 'Edit Job',
          html: data,
          showCancelButton: true,
          confirmButtonText: 'Save',
          focusConfirm: false,
          preConfirm: () => {
            const form = document.getElementById('editJobForm');
            const formData = new FormData(form);
            return fetch(`employer-post.php?action=saveJob&id=${jobId}`, {
                method: 'POST',
                body: formData
              })
              .then(res => res.text())
              .then(result => {
                if (result.includes('successfully')) {
                  Swal.fire('Updated!', 'Job updated successfully.', 'success');
                  setTimeout(() => location.reload(), 1000);
                } else {
                  Swal.showValidationMessage(`Update failed: ${result}`);
                }
              })
              .catch(err => {
                Swal.showValidationMessage(`Request failed: ${err}`);
              });
          }
        });
      });
    }

    function deleteJob(jobId) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This will permanently delete the job posting.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!'
    }).then(result => {
      if (result.isConfirmed) {
        fetch(`employer-post.php?action=deleteJob&id=${jobId}`)
          .then(res => res.text())
          .then(() => {
            Swal.fire('Deleted!', 'Job deleted.', 'success');
            document.getElementById(`jobRow${jobId}`).remove();
          });
      }
    });
  }
  </script>
</body>

</html>