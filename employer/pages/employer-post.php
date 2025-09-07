<?php
require_once '../../landing/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../../landing/login-signup.php");
  exit();
}
$employer_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM job_postings WHERE employer_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  $id = intval($_GET['id']);

  if ($action === 'viewApplicants') {
    $stmt = $conn->prepare("SELECT a.*, u.name FROM job_applications a JOIN users u ON u.id = a.applicant_id WHERE a.job_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    echo "<ul>";
    while ($row = $res->fetch_assoc()) {
      echo "<li>" . htmlspecialchars($row['name']) . "</li>";
    }
    echo "</ul>";
    exit;
  }

  if ($action === 'deleteJob') {
    $stmt = $conn->prepare("DELETE FROM job_postings WHERE job_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    exit;
  }

  if ($action === 'editJob') {
    $stmt = $conn->prepare("SELECT * FROM job_postings WHERE job_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $job = $stmt->get_result()->fetch_assoc();
?>
    <form id="editJobForm">
      <input type="text" name="title" value="<?= htmlspecialchars($job['job_title']) ?>" />
      <input type="text" name="category" value="<?= htmlspecialchars($job['category']) ?>" />
      <input type="text" name="type" value="<?= htmlspecialchars($job['job_type']) ?>" />
      <input type="number" name="vacancies" value="<?= $job['vacancies'] ?>" />
      <input type="date" name="expiry_date" value="<?= $job['expiry_date'] ?>" />
      <textarea name="description" rows="5"><?= htmlspecialchars($job['description']) ?></textarea>
    </form>
<?php
    exit;
  }

  if (isset($_GET['action']) && $_GET['action'] === 'saveJob') {
    $id = $_GET['id'];

    $title = $_POST['title'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $vacancies = $_POST['vacancies'];
    $expiry_date = $_POST['expiry_date'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE job_postings SET job_title=?, category=?, job_type=?, vacancies=?, expiry_date=?, description=? WHERE job_id=?");
    $stmt->bind_param("ssssssi", $title, $category, $type, $vacancies, $expiry_date, $description, $id);
    $stmt->execute();

    echo "Job updated successfully";
    exit;
  }

  if ($action === 'saveJob') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $vacancies = $_POST['vacancies'];
    $expiry = $_POST['expiry_date'];

    $stmt = $conn->prepare("UPDATE job_postings SET title=?, category=?, type=?, vacancies=?, expiry_date=? WHERE job_id=?");
    $stmt->bind_param("sssisi", $title, $category, $type, $vacancies, $expiry, $id);
    $stmt->execute();
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employer Dashboard</title>

  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/employer-post.css">
  <link rel="stylesheet" href="../../public-assets/library/datatable/dataTables.css">
  <script src="../../public-assets/JS_JQUERY/jquery-3.7.1.min.js" defer></script>
  <script src="../../public-assets/library/datatable/dataTables.js" defer></script>
  <script src="../../public-assets/js/table-init.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      <li>
        <a href="./employer-applications.php">
          <span class="emoji"><img src="../../public-assets/icons/briefcase.svg" alt=""></span>
          <span class="label">Job Applications</span>
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
    <section class="job-posting-section card">
      <h2>Post a New Job</h2>
      <form id="jobPostForm" class="job-form" method="POST" action="../Functions/job_post.php">
        <div class="form-row">
          <div class="form-group">
            <label for="jobTitle">Job Title*</label>
            <input type="text" id="jobTitle" name="jobTitle" required placeholder="e.g., Senior Frontend Developer">
          </div>
          <div class="form-group">
            <label for="jobType">Job Type*</label>
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
            <label for="location">Location*</label>
            <input type="text" id="location" name="location" required placeholder="e.g., New York, NY or Remote">
          </div>
          <div class="form-group">
            <label for="category">Category*</label>
            <select id="category" name="category" required>
              <option value="">Select Category</option>
              <option value="IT">Information Technology</option>
              <option value="Business">Business</option>
              <option value="Engineering">Engineering</option>
              <option value="Healthcare">Healthcare</option>
              <option value="Education">Education</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="vacancies">Number of Vacancies*</label>
            <input type="number" id="vacancies" name="vacancies" required min="1" placeholder="e.g., 2">
          </div>
          <div class="form-group">
            <label for="expiryDate">Application Deadline</label>
            <input type="date" id="expiryDate" name="expiryDate">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="salary">Salary Range</label>
            <input type="text" id="salary" name="salary" placeholder="e.g., $80,000 - $100,000 per year" style="width: 49%;">
          </div>

        </div>

        <div class="form-group">
          <label for="description">Job Description and Requirements</label>
          <textarea id="description" name="description" rows="5" required placeholder="Detailed description of the job responsibilities..."></textarea>
        </div>


        <div class="form-actions">
          <button type="reset" class="btn btn-secondary">Clear Form</button>
          <button type="submit" class="btn btn-primary">Post Job Opening</button>
        </div>
      </form>
    </section>

    <!-- Job Monitoring Section -->
    <section class="job-monitoring-section card">
      <div class="section-header">
        <form action="employer-post.php" method="GET">
          <h2>Your Job Postings</h2>
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
                <td>
                  <button class="action-btn view" onclick="viewApplicants(<?= $row['job_id'] ?>)">View</button>
                  <button class="action-btn edit" onclick="editJob(<?= $row['job_id'] ?>)">Edit</button>
                  <button class="action-btn delete" onclick="deleteJob(<?= $row['job_id'] ?>)">Delete</button>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <script src="../js/responsive.js"></script>
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
            preConfirm: () => {
              const form = document.getElementById('editJobForm');
              const formData = new FormData(form);
              return fetch(`employer-post.php?action=saveJob&id=${jobId}`, {
                  method: 'POST',
                  body: formData
                })
                .then(res => res.text());
            }
          }).then(() => location.reload());
        });
    }

    preConfirm: () => {
      const form = document.getElementById('editJobForm');
      const formData = new FormData(form);
      return fetch(`employer-post.php?action=saveJob&id=${jobId}`, {
          method: 'POST',
          body: formData
        })
        .then(res => res.text());
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