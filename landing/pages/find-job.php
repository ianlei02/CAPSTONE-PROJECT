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
    <link rel="shortcut icon" href="../assets/images/pesosmb.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/css-reset.css" />
    <link rel="stylesheet" href="../css/find-job.css" />
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/breakpoints.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">
            <img
                src="../../public-assets/smb-images/pesosmb.png"
                alt="PESO logo"
                class="logo" />
            <img
                src="../../public-assets/smb-images/smb-logo.png"
                alt="PESO logo"
                class="logo" />
        </a>
        <ul class="navbar-links">
            <li><a class="nav-link" href="../../index.php">Home</a></li>
            <li><a class="nav-link" href="./find-job.php">Job Listings</a></li>
            <li><a class="nav-link" href="./aboutus.php">About Us</a></li>
            <li class="auth-buttons">
                <a href="../login-signup.php?form=login"><button <a class="btn-login">Login</button></a>
                <a href="../login-signup.php?form=signup"><button <a class="btn-signup">Sign Up</button></a>
            </li>
        </ul>

    </nav>

    <section class="job-listings">
        <div class="job-list-heading">
            <h2>Job Listings</h2>
        </div>
        <div class="filter-section">
            <div style="display:flex;">
                <input type="text" name="search-filter" placeholder="Search Jobs">
                <!-- <button>Search</button> -->
            </div>
            <div class="filter-options">
                <select id="field-filter">
                    <option value="all">All Job Fields</option>
                    <option value="Engineering">Engineering</option>
                    <option value="IT">Information Technology</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Education">Education</option>
                    <option value="Finance">Finance</option>
                </select>
                <!-- <select id="type-filter">
                    <option value="all">All Employment Types</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                    <option value="Internship">Internship</option>
                </select> -->
            </div>
        </div>
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
                                <span class="job-salary"><?php echo htmlspecialchars($row['salary_range']); ?></span>
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
                            <button class="apply-btn" onclick="window.location.href='../login-signup.php'">Apply Now</button>
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

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <img src="../../landing/assets/images/pesosmb.png" style="width: 150px;" alt="PESO Logo">
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


</body>

</html>