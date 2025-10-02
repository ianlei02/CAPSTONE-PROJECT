<?php
require "../../connection/dbcon.php";
$sql = "SELECT job_id, job_title, job_type, category, salary_range, location, vacancies, description, created_at 
        FROM job_postings 
        WHERE status = 'active' 
        ORDER BY created_at DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jobs and Applications</title>
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
                    src="../../landing/assets/images/pesosmb.png"
                    alt="PESO Logo" />
            </div>
            <h2 style="font-size: 2.25rem">PESO</h2>
        </div>
        <ul class="nav-menu">
            <li>
                <a class="nav-item" href="./dashboard.php">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="nav-item" href="./employer-table.php">
                    <span class="material-symbols-outlined">apartment</span>
                    <span>Employers</span>
                </a>
            </li>
            <li>
                <a class="nav-item active" href="./job-listings.php">
                    <span class="material-symbols-outlined">list_alt</span>
                    <span>Job Listings</span>
                </a>
            </li>
            <li>
                <a class="nav-item" href="./new-admin.php">
                    <span class="material-symbols-outlined">groups</span>
                    <span>New Admin</span>
                </a>
            </li>
            <li>
                <a class="nav-item" href="./news-upload.php">
                    <span class="material-symbols-outlined">newspaper</span>
                    <span>News</span>
                </a>
            </li>
            <li>
                <a class="nav-item" href="../Function/logout.php">
                    <span class="material-symbols-outlined">settings</span>
                    <span>Logout</span>
                </a>
            </li>
            <li></li>
            <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
                <span class="material-symbols-outlined">dark_mode</span>
            </button>
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
                                    <button class="view-btn view-applications">View Applicants</button>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No job postings available.</p>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Applicants Section -->
            <section class="applications-section" id="applications-section">
                <div class="section-header">
                    <button class="back-button" id="back-to-jobs">
                        <span class="material-icons">arrow_back</span>
                        Back to Jobs
                    </button>
                    <h2 id="applicants-title">Applicants for </h2>
                </div>
                <div class="table-container">
                    <table id="applicants-table" class="display">
                        <thead>
                            <tr>
                                <th>Applicant Name</th>
                                <th>Position Applied</th>
                                <th>Date Applied</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sarah Johnson</td>
                                <td>Senior Frontend Developer</td>
                                <td>2023-10-15</td>
                                <td>
                                    <button class="view-btn view-applicant-profile">
                                        <span class="material-symbols-outlined">visibility</span>
                                        View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Michael Chen</td>
                                <td>Senior Frontend Developer</td>
                                <td>2023-10-14</td>
                                <td>
                                    <button class="view-btn view-applicant-profile">
                                        <span class="material-symbols-outlined">visibility</span>
                                        View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Emily Rodriguez</td>
                                <td>Senior Frontend Developer</td>
                                <td>2023-10-13</td>
                                <td>
                                    <button class="view-btn view-applicant-profile">
                                        <span class="material-symbols-outlined">visibility</span>
                                        View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>David Kim</td>
                                <td>Senior Frontend Developer</td>
                                <td>2023-10-12</td>
                                <td>
                                    <button class="view-btn view-applicant-profile">
                                        <span class="material-symbols-outlined">visibility</span>
                                        View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jessica Williams</td>
                                <td>Senior Frontend Developer</td>
                                <td>2023-10-11</td>
                                <td>
                                    <button class="view-btn view-applicant-profile">
                                        <span class="material-symbols-outlined">visibility</span>
                                        View
                                    </button>
                                </td>
                            </tr>
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
                <form class="application-form">
                    //TODO APPLICANT PROFILE HERE OR NEW PAGE?
                    <!-- //TODO APPLICANT PROFILE HERE OR NEW PAGE? -->

                    <div class="form-actions">
                        <button
                            type="button"
                            class="btn btn-outline"
                            id="cancelApplication">
                            Reject
                        </button>
                        <button type="submit" class="btn btn-primary">
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
    </script>
</body>

</html>