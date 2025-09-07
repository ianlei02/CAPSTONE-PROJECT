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
            <li><a class="nav-link" href="#">Home</a></li>
            <li class="dropdown">
                Job Portal <span style="rotate: 90deg; padding: 4px;">></span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="login-signup.php?form=signup">Job Listings</a></li>
                    <li><a class="dropdown-item" href="login-signup.php?form=signup">Post a Job</a></li>
                    <li><a class="dropdown-item" href="./pages/user-guide.php">User's Guide</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="./pages/aboutus.php">About Us</a></li>
            <li class="auth-buttons">
                <a href="login-signup.php?form=login"><button <a class="btn-login">Login</button></a>
                <a href="login-signup.php?form=signup"><button <a class="btn-signup">Sign Up</button></a>
            </li>
        </ul>

    </nav>
    <main>
        <section class="job-listings">
            <div class="job-list-heading">
                <h2>Job Listings</h2>
            </div>
            <div class="filter-section">
                <div style="display:flex;">
                    <input type="text" name="search-filter" placeholder="Search Jobs">
                    <button>Search</button>
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
                    <select id="type-filter">
                        <option value="all">All Employment Types</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                    </select>
                    <select id="location-filter">
                        <option value="all">All Locations</option>
                        <option value="Quezon City">Quezon City</option>
                        <option value="Manila">Manila</option>
                        <option value="Makati">Makati</option>
                        <option value="Cebu">Cebu</option>
                        <option value="Davao">Davao</option>
                    </select>
                </div>
            </div>
            <div class="job-cards">
                <div class="job-card" data-field="Construction">
                    <div class="job-field">Construction</div>
                    <div class="job-header">
                        <div>
                            <h3 class="job-title">Civil Engineer</h3>
                            <div class="job-company">BuildRight Construction</div>
                        </div>
                        <div>
                            <span class="job-salary">₱45,000 - ₱60,000/month</span>
                        </div>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-briefcase"></i> Full-time</span>
                        <span><i class="fas fa-map-marker-alt"></i> Quezon City</span>
                        <span><i class="fas fa-users"></i> Vacancies: 2</span>
                    </div>
                    <div class="job-description">
                        Seeking a licensed Civil Engineer to oversee construction
                        projects. Must have at least 5 years experience in high-rise
                        building construction. Knowledge of AutoCAD and project
                        management required.
                    </div>
                    <div class="job-footer">
                        <div class="job-posted">Posted: May 17, 2023</div>
                        <button class="apply-btn" data-job-id="102">Apply Now</button>
                    </div>
                </div>
                <div class="job-card" data-field="Manufacturing">
                    <div class="job-field">Manufacturing</div>
                    <div class="job-header">
                        <div>
                            <h3 class="job-title">Mechanical Engineer</h3>
                            <div class="job-company">TechnoMech Solutions</div>
                        </div>
                        <div>
                            <span class="job-salary">₱40,000 - ₱55,000/month</span>
                        </div>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-briefcase"></i> Full-time</span>
                        <span><i class="fas fa-map-marker-alt"></i> Makati City</span>
                        <span><i class="fas fa-users"></i> Vacancies: 3</span>
                    </div>
                    <div class="job-description">
                        Looking for a Mechanical Engineer with experience in HVAC design
                        and manufacturing processes. Strong background in AutoCAD, SolidWorks,
                        and project implementation preferred.
                    </div>
                    <div class="job-footer">
                        <div class="job-posted">Posted: June 12, 2023</div>
                        <button class="apply-btn" data-job-id="201">Apply Now</button>
                    </div>
                </div>
                <div class="job-card" data-field="Energy">
                    <div class="job-field">Energy</div>
                    <div class="job-header">
                        <div>
                            <h3 class="job-title">Electrical Engineer</h3>
                            <div class="job-company">PowerGrid Philippines</div>
                        </div>
                        <div>
                            <span class="job-salary">₱42,000 - ₱58,000/month</span>
                        </div>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-briefcase"></i> Full-time</span>
                        <span><i class="fas fa-map-marker-alt"></i> Pasig City</span>
                        <span><i class="fas fa-users"></i> Vacancies: 4</span>
                    </div>
                    <div class="job-description">
                        Hiring Electrical Engineers for power systems and energy distribution.
                        Applicants must have PRC license and background in electrical safety codes.
                    </div>
                    <div class="job-footer">
                        <div class="job-posted">Posted: June 15, 2023</div>
                        <button class="apply-btn" data-job-id="202">Apply Now</button>
                    </div>
                </div>
                <div class="job-card" data-field="Information Technology">
                    <div class="job-field">Information Technology</div>
                    <div class="job-header">
                        <div>
                            <h3 class="job-title">Software Engineer</h3>
                            <div class="job-company">InnoTech Systems</div>
                        </div>
                        <div>
                            <span class="job-salary">₱50,000 - ₱70,000/month</span>
                        </div>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-briefcase"></i> Full-time</span>
                        <span><i class="fas fa-map-marker-alt"></i> Taguig City</span>
                        <span><i class="fas fa-users"></i> Vacancies: 5</span>
                    </div>
                    <div class="job-description">
                        Seeking Software Engineers proficient in JavaScript, React, and Node.js.
                        Knowledge in cloud technologies and databases is an advantage.
                    </div>
                    <div class="job-footer">
                        <div class="job-posted">Posted: June 20, 2023</div>
                        <button class="apply-btn" data-job-id="203">Apply Now</button>
                    </div>
                </div>
                <div class="job-card" data-field="Electronics">
                    <div class="job-field">Electronics</div>
                    <div class="job-header">
                        <div>
                            <h3 class="job-title">Electronics Engineer</h3>
                            <div class="job-company">CircuitWorks Inc.</div>
                        </div>
                        <div>
                            <span class="job-salary">₱38,000 - ₱52,000/month</span>
                        </div>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-briefcase"></i> Full-time</span>
                        <span><i class="fas fa-map-marker-alt"></i> Cebu City</span>
                        <span><i class="fas fa-users"></i> Vacancies: 2</span>
                    </div>
                    <div class="job-description">
                        Electronics Engineer needed for PCB design, testing, and product
                        development. Must be knowledgeable in embedded systems and circuit analysis.
                    </div>
                    <div class="job-footer">
                        <div class="job-posted">Posted: June 25, 2023</div>
                        <button class="apply-btn" data-job-id="204">Apply Now</button>
                    </div>
                </div>
                <div class="job-card" data-field="Chemical">
                    <div class="job-field">Chemical</div>
                    <div class="job-header">
                        <div>
                            <h3 class="job-title">Chemical Engineer</h3>
                            <div class="job-company">GreenChem Industries</div>
                        </div>
                        <div>
                            <span class="job-salary">₱44,000 - ₱62,000/month</span>
                        </div>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-briefcase"></i> Full-time</span>
                        <span><i class="fas fa-map-marker-alt"></i> Davao City</span>
                        <span><i class="fas fa-users"></i> Vacancies: 3</span>
                    </div>
                    <div class="job-description">
                        Chemical Engineer required for process optimization and environmental
                        compliance. Experience in plant operations and chemical safety preferred.
                    </div>
                    <div class="job-footer">
                        <div class="job-posted">Posted: July 1, 2023</div>
                        <button class="apply-btn" data-job-id="205">Apply Now</button>
                    </div>
                </div>
                <div class="job-card" data-field="Logistics">
                    <div class="job-field">Logistics</div>
                    <div class="job-header">
                        <div>
                            <h3 class="job-title">Industrial Engineer</h3>
                            <div class="job-company">ProdMax Solutions</div>
                        </div>
                        <div>
                            <span class="job-salary">₱39,000 - ₱54,000/month</span>
                        </div>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-briefcase"></i> Full-time</span>
                        <span><i class="fas fa-map-marker-alt"></i> Manila</span>
                        <span><i class="fas fa-users"></i> Vacancies: 4</span>
                    </div>
                    <div class="job-description">
                        Industrial Engineer needed to improve production efficiency and
                        streamline operations. Knowledge in lean manufacturing and Six Sigma is a plus.
                    </div>
                    <div class="job-footer">
                        <div class="job-posted">Posted: July 5, 2023</div>
                        <button class="apply-btn" data-job-id="206">Apply Now</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <img src="../landing/assets/images/pesosmb.png" style="width: 150px;" alt="PESO Logo">
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