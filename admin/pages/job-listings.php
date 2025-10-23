<?php
require_once '../Function/check_login.php';
require "../../connection/dbcon.php";
require_once "../../employer/Functions/dss.php";
require_once '../Function/check-permission.php';

$sql = "SELECT job_id, job_title, job_type, category, salary_range, location, vacancies, description, created_at 
        FROM job_postings 
        WHERE status = 'active' 
        ORDER BY created_at DESC";

$result = $conn->query($sql);

$job_id = $_POST['job_id'] ?? $_GET['job_id'] ?? 0;
$job_id = intval($job_id);

$applicants = [];
if ($job_id > 0) {
    $sql_app = "
        SELECT 
            a.applicant_id,
            CONCAT(a.f_name, ' ', a.l_name) AS applicant_name,
            j.job_title,
            ja.created_at AS date_applied
        FROM job_application ja
        INNER JOIN applicant_account a ON ja.applicant_id = a.applicant_id
        INNER JOIN job_postings j ON ja.job_id = j.job_id
        WHERE ja.job_id = ?
    ";
    $stmt = $conn->prepare($sql_app);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $res_app = $stmt->get_result();

    while ($row = $res_app->fetch_assoc()) {
        $row['score'] = calculateApplicantScore($row['applicant_id'], $job_id, $conn);
        $applicants[] = $row;
    }
    usort($applicants, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });
}

$showApplicants = ($job_id > 0);

?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jobs and Applications</title>
    <script src="../js/load-saved.js"></script>
    <script src="../js/dark-mode.js"></script>
    <link rel="stylesheet" href="../css/navs.css">
    <link rel="stylesheet" href="../css/job-listings.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../assets/library/datatable/dataTables.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-icon">
                <img
                    src="../../public/smb-images/pesosmb.png"
                    alt="PESO Logo" />
            </div>
            <h2>PESO</h2>
        </div>
        <ul class="nav-menu">
            <li>
            <a class="nav-item active" href="./dashboard.php">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>
            </li>

            <?php if (hasPermission('Pending Employers') || hasPermission('Verified Employers')): ?>
            <li>
                <a class="nav-item" href="./employer-table.php">
                <span class="material-symbols-outlined">apartment</span>
                <span>Employers</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (hasPermission('View job cards & applicants table')): ?>
            <li>
                <a class="nav-item" href="./job-listings.php">
                <span class="material-symbols-outlined">list_alt</span>
                <span>Job Listings</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (in_array('ALL_ACCESS', $_SESSION['admin_roles'])): ?>
            <li>
                <a class="nav-item" href="./new-admin.php">
                <span class="material-symbols-outlined">groups</span>
                <span>New Admin</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (
            hasPermission('Edit News') ||
            hasPermission('Delete News') ||
            hasPermission('Publish News')
            ): ?>
            <li>
                <a class="nav-item" href="./news-upload.php">
                <span class="material-symbols-outlined">newspaper</span>
                <span>News</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (hasPermission('Set Events') || hasPermission('ALL_ACCESS')): ?>
            <li>
                <a class="nav-item" href="./job-fair.php">
                <span class="material-symbols-outlined">calendar_month</span>
                <span>Job Fair</span>
                </a>
            </li>
            <?php endif; ?>

            <li>
            <button class="nav-item" id="themeToggle" onclick="toggleTheme()">
                <span class="material-symbols-outlined" id="themeIcon">dark_mode</span>
                <span id="themeLabel">Theme toggle</span>
            </button>
            </li>
        </ul>
        <ul class="nav-menu logout">
            <li>
                <a class="nav-item" href="../Function/logout.php">
                    <span class="material-symbols-outlined">settings</span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>

    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Jobs and Applications</h1>
            <div style="display: flex; align-items: center; gap: 20px">
                <div class="user-profile">
                    <img
                        src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff"
                        alt="Admin User" />
                    <div>
                        <p>Ian Lei Castillo</p>
                        <span>SUPER ADMIN</span>
                    </div>
                    <!-- <i class="fas fa-chevron-down"></i> -->
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <!-- Job Cards Section -->
            <div class="job-listing-section">
                <div class="search-filter">
                    <div class="search-box">
                        <span></span>
                        <input type="text" placeholder="Search for jobs..." />
                    </div>
                    <select class="filter" id="jobFieldFilter">
                        <option value="">All Fields</option>
                        <option value="IT">IT/Software</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Healthcare">Medicine/Healthcare</option>
                        <option value="Business">Business/Finance</option>
                        <option value="Education">Education</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Construction">Construction</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Other">Other Fields</option>
                    </select>
                </div>
                <div class="job-listing-section" style="display: <?= $showApplicants ? 'none' : 'grid'; ?>;">
                    <div class="job-listings">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <div class="job-card hidden" data-field="<?php echo htmlspecialchars($row['category']); ?>">
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
                                        <a href="job-listings.php?job_id=<?= urlencode($row['job_id']); ?>" class="view-btn">View Applicants</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No job postings available.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- Applicants Section -->
            <section class="applications-section" id="applications-section" style="display: <?= $showApplicants ? 'flex' : 'none'; ?>;">
                <div class="section-header">
                    <button class="back-button" id="back-to-jobs">
                        <span class="material-symbols-outlined">arrow_back</span>
                        <span>Back to Job Lists</span>
                    </button>
                    <h2 id="applicants-title">
                        Applicants for <?= !empty($applicants) ? htmlspecialchars($applicants[0]['job_title']) : 'this job'; ?>
                    </h2>
                </div>

                <div class="table-container">
                    <table id="applicants-table" class="display">
                        <thead>
                            <tr>
                                <th>Applicant Name</th>
                                <th>Position Applied</th>
                                <th>Date Applied</th>
                                <th>Score</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($applicants)): ?>
                                <?php foreach ($applicants as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['applicant_name']); ?></td>
                                        <td><?= htmlspecialchars($row['job_title']); ?></td>
                                        <td><?= htmlspecialchars($row['date_applied']); ?></td>
                                        <td><span class="badge"><?= htmlspecialchars($row['score']); ?>%</span></td>
                                        <td>
                                            <button class="view-btn view-applicant-profile" data-applicant="<?= $row['applicant_id']; ?>">
                                                <span class="material-symbols-outlined">visibility</span> View
                                            </button>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No applicants yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <!-- Application Modal -->
    <div class="modal" id="applicationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    Applicant Profile
                </h2>
                <button class="close-btn">&times;</button>
            </div>
            <div class="modal-body">


                <form  class="application-form">
                    <!-- //TODO APPLICANT PROFILE HERE OR NEW PAGE? -->

                    <h2>Applicant Profile</h2>
                    <div id="profileContent">Loading...</div>


                    <div class="form-actions">
                        <button
                            type="button"
                            class="btn btn-outline"
                            id="cancelApplication"
                            data-status="rejected">
                            Reject
                        </button>
                        <button type="submit" class="btn btn-primary"  id="referApplication" data-status="referred">
                            Refer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
    <script src="../assets/library/datatable/dataTables.js"></script>
    <script src="../js/table-init.js"></script>
    <!-- Jobs, Modals, and Lazy load -->
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
        const viewProfileBtn = document.querySelectorAll('.view-applicant-profile');
        const closeBtn = document.querySelector('.close-btn');
        const cancelBtn = document.getElementById('cancelApplication');
        const modalJobTitle = document.getElementById('modalJobTitle');

        // Open modal when Apply button is clicked
        viewProfileBtn.forEach(button => {
            button.addEventListener('click', function() {
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
        //FOR LAZY LOAD ANIMATION NOT YET FINISHED BECAUSE I NEED AJAX BRUHHHHHHHHHH
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
        document.addEventListener("DOMContentLoaded", () => {
            const viewApplications = document.querySelectorAll(".view-applications");
            const backToJobs = document.getElementById("back-to-jobs");
            const applicationSection = document.getElementById('applications-section');
            const jobListingSection = document.querySelector(".job-listing-section");

            viewApplications.forEach(button => {
                button.addEventListener('click', () => {
                    jobListingSection.style.display = 'none';
                    applicationSection.style.display = 'flex';
                    // Fix DataTable layout when section becomes visible
                    $("table").DataTable().columns.adjust().draw().responsive.recalc();
                });

                backToJobs.addEventListener('click', () => {
                    applicationSection.style.display = 'none';
                    jobListingSection.style.display = 'grid';
                });
            });
        });
        document.getElementById("back-to-jobs").addEventListener("click", function() {
            window.location.href = window.location.pathname;
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("applicationModal");
            const profileContent = document.getElementById("profileContent");
            const closeBtn = document.querySelector(".close-btn");
            const cancelBtn = document.getElementById("cancelApplication");

            document.querySelectorAll(".view-applicant-profile").forEach(btn => {
                btn.addEventListener("click", function() {
                    const applicantId = this.getAttribute("data-applicant");

                    profileContent.innerHTML = "Loading...";
                    modal.style.display = "flex";
                    document.body.style.overflow = "hidden";

                    fetch("../../employer/Functions/get_profile.php?applicant_id=" + applicantId)
                        .then(res => res.text())
                        .then(data => {
                            profileContent.innerHTML = data;
                        })
                        .catch(err => {
                            profileContent.innerHTML = "Error loading profile.";
                        });
                });
            });
        });
    </script>
    <script>
    
    document.addEventListener("DOMContentLoaded", function() {
        const referBtn = document.getElementById("referApplication");
        const rejectBtn = document.getElementById("cancelApplication");
        const modal = document.getElementById("applicationModal");
        let currentApplicantId = null;
                document.querySelectorAll(".view-applicant-profile").forEach(btn => {
            btn.addEventListener("click", function() {
                currentApplicantId = this.getAttribute("data-applicant");
                modal.style.display = "block";
                document.body.style.overflow = "hidden";
            });
        });
        function updateApplicationStatus(status) {
            if (!currentApplicantId) return alert("No applicant selected");

            const urlParams = new URLSearchParams(window.location.search);
            const jobId = urlParams.get('job_id');

            fetch("../Function/update-status.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: `applicant_id=${currentApplicantId}&job_id=${jobId}&status=${status}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(`Application ${status === 'referred' ? 'referred' : 'rejected'} successfully.`);
                    modal.style.display = "none";
                    document.body.style.overflow = "auto";
                    location.reload();
                    } else {
                    alert("Error: " + data.error);
                }
            })
            .catch(err => console.error("Error updating status:", err));
        }

        referBtn.addEventListener("click", (e) => {
            e.preventDefault();
            updateApplicationStatus("referred");
        });

        rejectBtn.addEventListener("click", (e) => {
            e.preventDefault();
            updateApplicationStatus("rejected");
        });
    });
    </script>
</body>

</html>