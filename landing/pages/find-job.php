<?php
require '../../connection/dbcon.php';

$sql_job = "
    SELECT 
        jp.job_id, 
        jp.job_title,
        jp.job_type, 
        jp.category, 
        jp.salary_range, 
        jp.location, 
        jp.vacancies, 
        jp.description, 
        jp.created_at,
        eci.company_name
    FROM job_postings jp
    INNER JOIN employer_company_info eci 
        ON jp.employer_id = eci.employer_id
    WHERE jp.status = 'active'
    ORDER BY jp.created_at DESC
";
$result_job = $conn->query($sql_job);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PESO Landing</title>
    <script src="../../public/js/dark-mode.js"></script>
    <link rel="shortcut icon" href="../assets/images/pesosmb.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/find-job.css" />
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">
            <img
                src="../../public/smb-images/smb-logo.png"
                alt="SMB logo"
                class="logo" />
            <img
                src="../../public/smb-images/pesosmb.png"
                alt="PESO logo"
                class="logo" />
            <!-- <span class="brand-text">PESO</span> -->
        </a>
        <ul class="navbar-links topbar">
            <li><a class="nav-link" href="../../index.php">
                    <i data-lucide="house"></i>
                    <span>Home</span>
                </a></li>
            <li><a class="nav-link" href="find-job.php">
                    <i data-lucide="briefcase-business"></i>
                    <span>Find Jobs</span>
                </a></li>
            <li><a class="nav-link" href="aboutus.php">
                    <i data-lucide="circle-question-mark"></i>
                    <span>About us</span>
                </a></li>
            <li class="auth-buttons">
                <hr>
                <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
                    <i data-lucide="moon" id="themeIcon"></i>
                </button>
                <hr>
                <a href="auth/login-signup.php" class="btn btn-primary login" style="display: flex; align-items: center; gap: 5px;">
                    <span>Login</span><i data-lucide="log-in"></i>
                </a>
                <!-- <a href="auth/login-signup.php?form=signup"><button class="btn-signup">Sign Up</button></a> -->
            </li>
        </ul>
        <button onclick="sidebarToggle()" class="hamburger">
            <i data-lucide="menu"></i>
        </button>
    </nav>
    <aside>
        <ul class="navbar-links sidebar">
            <li><a class="nav-link" href="index.php">Home</a></li>
            <li><a class="nav-link" href="find-job.php">Job Listings</a></li>
            <li><a class="nav-link" href="aboutus.php">About Us</a></li>
            <li class="auth-buttons">
                <a href="auth/login-signup.php?form=login" class="btn btn-primary login">Login</a>
                <!-- <a href="auth/login-signup.php?form=signup"><button class="btn-signup">Sign Up</button></a> -->
            </li>
        </ul>
    </aside>
    <main>
        <section>
            <div class="job-list-heading">
                <h2>Job Listings</h2>
            </div>
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
        </section>
        <section class="job-listings">
            <div class="job-cards">
                <?php
                if ($result_job->num_rows > 0) {
                    while ($row = $result_job->fetch_assoc()) {
                ?>
                        <div class="job-card" data-field="<?php echo htmlspecialchars($row['category']); ?>">
                            <div class="job-field"><?php echo htmlspecialchars($row['category']); ?></div>
                            <div class="job-header">
                                <div>
                                    <h3 class="job-title"><?php echo htmlspecialchars($row['job_title']); ?></h3>
                                    <div class="job-company"><?php echo htmlspecialchars($row['company_name']); ?></div>
                                </div>
                                <div>
                                    <span class="job-salary"><?php echo htmlspecialchars($row['salary_range']); ?> /Month</span>
                                </div>
                            </div>
                            <div class="job-meta">
                                <span><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($row['job_type']); ?></span>
                                <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></span>
                                <span><i class="fas fa-users"></i> Vacancies: <?php echo htmlspecialchars($row['vacancies']); ?></span>
                            </div>
                            <div class="job-description">
                                <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                            </div>
                            <div class="job-footer">
                                <div class="job-posted">Posted: <?php echo date("M d, Y", strtotime($row['created_at'])); ?></div>
                                <button class="apply-btn" onclick="window.location.href='../../auth/login-signup.php'">Apply Now</button>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No active job postings found.</p>";
                }
                ?>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <img src="../../public/smb-images/pesosmb.png" style="width: 150px;" alt="PESO Logo">
            </div>
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We are dedicated to connecting job seekers and employers for a brighter future.</p>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#hero">Home</a></li>
                    <li><a href="./pages/aboutus.php">About Us</a></li>
                    <li><a href="./pages/user-guide.php">User's Guide</a></li>
                    <li><a href="../landing/login-signup.php">Job Portal</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                    <li><a href="#">Facebook</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: sanmiguelbulacanpeso@gmail.com</p>
                <p>Phone: (+63)975-440-4362</p>
                <p>Address: Ground Floor, Juan F. Dela Cruz Building, Municipal Compound, Poblacion, San Miguel, Bulacan</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 PESO. All rights reserved.</p>
        </div>
    </footer>
    <!-- Development version -->
    <!-- <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script> -->
    <!-- Production version -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        function sidebarToggle() {
            const aside = document.querySelector('aside');
            aside.classList.toggle('show')
        }
    </script>
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
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector(".search-box input");
            const filterSelect = document.getElementById("jobFieldFilter");
            const jobCards = document.querySelectorAll(".job-card");

            function filterJobs() {
                const searchText = searchInput.value.toLowerCase();
                const selectedField = filterSelect.value.toLowerCase();

                jobCards.forEach(card => {
                    const title = card.querySelector(".job-title").textContent.toLowerCase();
                    const company = card.querySelector(".job-company").textContent.toLowerCase();
                    const field = card.getAttribute("data-field").toLowerCase();

                    const matchesSearch = title.includes(searchText) || company.includes(searchText);
                    const matchesField = selectedField === "" || field === selectedField;

                    if (matchesSearch && matchesField) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            }
            searchInput.addEventListener("input", filterJobs);
            filterSelect.addEventListener("change", filterJobs);
        });
    </script>
</body>

</html>