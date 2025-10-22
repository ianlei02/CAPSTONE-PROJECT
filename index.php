<?php
require 'connection/dbcon.php';
$sql = "
    SELECT
        (SELECT COUNT(*) FROM job_postings WHERE employer_id = 0) AS employer_total_jobs,
        (SELECT COUNT(*) FROM job_postings) AS total_jobs,
        (SELECT COUNT(*) FROM employer_account) AS total_employers,
        (SELECT COUNT(*) FROM applicant_account) AS total_applicants,
        (SELECT COUNT(*) FROM job_postings WHERE status = 'active') AS total_active
";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$announcements = $conn->query("SELECT * FROM announcement ORDER BY publish_date DESC LIMIT 10");

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PESO Landing</title>
    <script src="public/js/dark-mode.js"> </script>
    <link rel="shortcut icon" href="public/images/pesosmb.png" type="image/x-icon">
    <link rel="stylesheet" href="public/css/css-reset.css" />
    <link rel="stylesheet" href="public/css/index.css" />
    <link rel="stylesheet" href="public/css/footer.css">
    <link rel="stylesheet" href="public/library/swiper/swiper-bundle.min.css">
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">
            <img
                src="public/smb-images/smb-logo.png"
                alt="SMB logo"
                class="logo" />
            <img
                src="public/smb-images/pesosmb.png"
                alt="PESO logo"
                class="logo" />
            <!-- <span class="brand-text">PESO</span> -->
        </a>
        <ul class="navbar-links topbar">
            <li><a class="nav-link" href="index.php">
                    <i data-lucide="house" class="icon"></i>
                    <span>Home</span>
                </a></li>
            <li><a class="nav-link" href="landing/pages/find-job.php">
                    <i data-lucide="briefcase-business" class="icon"></i>
                    <span>Find Jobs</span>
                </a></li>
            <li><a class="nav-link" href="landing/pages/aboutus.php">
                    <i data-lucide="circle-question-mark" class="icon"></i>
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
            <li><a class="nav-link" href="landing/pages/find-job.php">Job Listings</a></li>
            <li><a class="nav-link" href="landing/pages/aboutus.php">About Us</a></li>
            <li class="auth-buttons">
                <a href="auth/login-signup.php?form=login" class="btn btn-primary login">Login</a>
                <!-- <a href="auth/login-signup.php?form=signup"><button class="btn-signup">Sign Up</button></a> -->
            </li>
        </ul>
    </aside>

    <main>
        <section class="hero" id="hero">
            <div class="hero-left">
                <h1>Where Talent Meets Opportunity</h1>
                <p>Connect with employers and discover job openings in your area with the PESO San Miguel, Bulacan</p>
                <div class="hero-btn">
                    <a href="auth/login-signup.php?form=signup" class="get-started">Get Started &#10132;</a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <h2><?php
                            echo $data['total_applicants'], '+';
                            ?>
                        </h2>
                        <p>Registered Applicants</p>
                    </div>
                    <div class="hero-stat">
                        <h2><?php
                            echo $data['total_employers'], '+';
                            ?>
                        </h2>
                        <p>Registered Employers</p>
                    </div>
                    <div class="hero-stat">
                        <h2><?php
                            echo $data['total_jobs'], '+';
                            ?>
                        </h2>
                        <p>Job Listings</p>
                    </div>
                </div>
            </div>
            <div class="hero-image-container">
                <img
                    src="public/svg/Resume-amico.svg"
                    alt="Hero Image"
                    class="hero-img" />
            </div>
        </section>

        <section class="news">
            <div class="container">
                <div class="section-title">
                    <h2>
                        <i data-lucide="megaphone" class="icon"></i>
                        <span>Announcements & Updates</span>
                    </h2>
                </div>
                <div class="swiper newsSwiper">
                    <div class="swiper-wrapper">
                        <?php while ($news = $announcements->fetch_assoc()): ?>
                            <div class="swiper-slide">
                                <article class="news-card">
                                    <img src="admin/<?= $news['image'] ?>"
                                        alt="<?= htmlspecialchars($news['title']); ?>"
                                        class="news-image">
                                    <div class="news-content">
                                        <h3 class="news-title"><?= htmlspecialchars($news['title']); ?></h3>
                                        <div class="news-date">
                                            <i class="far fa-calendar-alt"></i> <?= htmlspecialchars($news['publish_date']); ?>
                                        </div>
                                        <p class="news-excerpt">
                                            <?= htmlspecialchars($news['excerpt']); ?>
                                        </p>
                                        <a href="#"
                                            class="news-link readMoreBtn"
                                            data-title="<?= htmlspecialchars($news['title']); ?>"
                                            data-date="<?= htmlspecialchars($news['publish_date']); ?>"
                                            data-image="<?= $news['image'] ? '/admin/' . $news['image'] : 'https://via.placeholder.com/600x400'; ?>"
                                            data-content="<?= htmlspecialchars($news['content']); ?>">
                                            Read More <i data-lucide="arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <section class="how-it-works">
            <div class="container">
                <div class="section-title">
                    <h2>
                        <i data-lucide="settings" class="icon"></i>
                        <span>How It Works</span>
                    </h2>
                    <p>Simple steps to get you hired or find the perfect candidate</p>
                </div>
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Create an Account</h3>
                        <p>Sign up as a job seeker or employer. Build your profile with your details, skills, and documents.</p>
                    </div>

                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Browse Opportunities</h3>
                        <p>Explore available job listings or look for candidates that match your preferences and qualifications.</p>
                    </div>

                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Apply or Post Jobs</h3>
                        <p>Job seekers can apply for available positions, while employers can post job openings to find qualified applicants.</p>
                    </div>

                    <div class="step">
                        <div class="step-number">4</div>
                        <h3>Track Application Status</h3>
                        <p>Monitor the progress of your applications or job posts directly through your dashboard in real time.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="peso-faq-section">
            <div class="container">
                <div class="section-title">
                    <h2>
                        <i data-lucide="circle-question-mark" class="icon"></i>
                        <span>Frequently Asked Questions</span>
                    </h2>
                </div>
                <div class="faq-list" id="faq-list">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What is PESO?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>The Public Employment Service Office (PESO) is a non-fee charging multi-employment service facility or entity established or accredited pursuant to Republic Act No. 8759, otherwise known as the PESO Act of 1999.</p>
                            <p>PESO is a community-based facility that provides employment information and services to job seekers, employers, and other clients. It serves as a referral and information center for the various programs and services of the Department of Labor and Employment (DOLE) and other government agencies involved in employment promotion.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What services does PESO offer?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>PESO offers a wide range of employment services including:</p>
                            <ul>
                                <li>Employment information and referral</li>
                                <li>Job matching and placement</li>
                                <li>Career guidance and employment coaching</li>
                                <li>Livelihood and self-employment assistance</li>
                                <li>Special programs for disadvantaged workers (PWDs, indigenous people, etc.)</li>
                                <li>Labor market information</li>
                                <li>Job fair organization</li>
                                <li>Pre-employment documentation assistance</li>
                                <li>Skills training and development programs</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>How can I register or apply for jobs?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Job seekers can register with PESO through the following methods:</p>
                            <ol>
                                <li><strong>Online Registration:</strong> Visit our website and complete the online registration form in our Job Hiring Decision Support System.</li>
                                <li><strong>In-Person Registration:</strong> Visit the PESO office and fill out the registration form. Please bring valid IDs and other required documents.</li>
                                <li><strong>Job Fair Registration:</strong> Register during job fairs organized by PESO.</li>
                            </ol>
                            <p>Once registered, your profile will be included in our database and matched with suitable job opportunities based on your qualifications and preferences.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Is there a fee for PESO services?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>No, all PESO services are completely free of charge for both job seekers and employers. PESO is mandated to provide non-fee charging employment services as stipulated in the PESO Act of 1999.</p>
                            <p>We are funded by the local government unit and the Department of Labor and Employment to ensure accessible employment services for all.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What are the requirements for job seekers and employers?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p><strong>For Job Seekers:</strong></p>
                            <ul>
                                <li>Valid government-issued ID (SSS, PhilHealth, Pag-IBIG, Passport, Driver's License, etc.)</li>
                                <li>Resume with detailed work experience and educational background</li>
                                <li>Certificate of employment or work experience (if applicable)</li>
                                <li>Educational credentials (diploma, transcript of records)</li>
                                <li>Other relevant certificates (training, seminars, etc.)</li>
                            </ul>
                            <p><strong>For Employers:</strong></p>
                            <ul>
                                <li>Company registration documents (DTI/SEC)</li>
                                <li>Mayor's permit or business permit</li>
                                <li>List of job vacancies with complete job descriptions</li>
                                <li>Company profile</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>How often does PESO hold job fairs?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>PESO regularly organizes job fairs throughout the year, with increased frequency during special occasions such as:</p>
                            <ul>
                                <li>Labor Day (May 1)</li>
                                <li>PESO Anniversary (month of September)</li>
                                <li>Christmas season</li>
                                <li>Graduation season (March-April)</li>
                            </ul>
                            <p>We typically hold monthly job fairs at our main office and quarterly mega job fairs at larger venues. Additionally, we conduct special job fairs for specific sectors (e.g., tourism, BPO, manufacturing) and for special groups (PWDs, senior citizens, indigenous people).</p>
                            <p>Check our website or visit our office for the updated schedule of job fairs.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Does PESO assist with overseas employment?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, PESO provides assistance for overseas employment through:</p>
                            <ul>
                                <li>Referral to licensed recruitment agencies</li>
                                <li>Pre-employment orientation seminars (PEOS)</li>
                                <li>Assistance in processing overseas employment documents</li>
                                <li>Information on country-specific requirements and regulations</li>
                                <li>Guidance on legitimate overseas job opportunities</li>
                            </ul>
                            <p>However, please note that PESO itself does not directly deploy workers abroad. We work in coordination with the Philippine Overseas Employment Administration (POEA) and accredited recruitment agencies to ensure safe and legal overseas employment.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Where is the PESO office located and how can it be contacted?</h3>
                            <span class="faq-icon">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Our main PESO office is located at:</p>
                            <p><strong>123 Government Center, City Hall Compound, Your City, Province 1234</strong></p>
                            <p>You can contact us through:</p>
                            <ul>
                                <li>Telephone: 0912 345 6789</li>
                                <li>Email: pesosanmiguelbulacan@gmail.com</li>
                                <li>Social Media: Facebook.com/PESOSanMiguel
                            </ul>
                            <p>We are open from Monday to Friday, 8:00 AM to 5:00 PM.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>Ready to Take the Next Step?</h2>
                <p>Join thousands of professionals and companies who found their perfect match through PESO</p>
                <div style="display: flex; justify-content: center; gap: 20px;">
                    <button class="btn btn-secondary" onclick="window.location.href='login-signup.php'">I'm Hiring</button>
                    <button class="btn btn-primary" onclick="window.location.href='login-signup.php'">Find Jobs</button>
                </div>

            </div>
        </section>
        <!-- News Details Modal -->
        <div id="customNewsModal" class="custom-modal">
            <div class="custom-modal-content">
                <span class="custom-modal-close">&times;</span>
                <h2 id="newsModalTitle"></h2>
                <p id="newsModalDate" class="text-muted"></p>
                <img id="newsModalImage" src="" alt="" class="modal-img">
                <div id="newsModalContent"></div>
            </div>
        </div>

    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <img src="public/images/pesosmb.png" style="width: 150px;" alt="PESO Logo">
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

    <!-- //TODO NAHEHELO AQ -->
    <!-- <div id="preloader">
        <div class="loader"></div> 
    </div> -->
    <script src="public/js/preloader.js"> </script>
    <script src="public/library/swiper/swiper-bundle.min.js"></script>
    <!-- Development version -->
    <!-- <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script> -->
    <!-- Production version -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    <script>
        const swiper = new Swiper('.newsSwiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            loopedSlides: 4,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: { // >= 640px
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: { // >= 768px
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: { // >= 1024px
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
        window.addEventListener("resize", () => {
            swiper.update();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("customNewsModal");
            const closeBtn = document.querySelector(".custom-modal-close");
            document.querySelectorAll(".readMoreBtn").forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault()
                    document.getElementById("newsModalTitle").textContent = this.dataset.title;
                    document.getElementById("newsModalDate").textContent = "📅 " + this.dataset.date;
                    document.getElementById("newsModalImage").src = this.dataset.image;
                    document.getElementById("newsModalContent").innerHTML = this.dataset.content;
                    modal.style.display = "flex";
                });
            });
            closeBtn.onclick = () => modal.style.display = "none";
            window.onclick = (e) => {
                if (e.target == modal) modal.style.display = "none";
            };
            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('.faq-icon');

                    faqQuestions.forEach(otherQuestion => {
                        if (otherQuestion !== this) {
                            const otherAnswer = otherQuestion.nextElementSibling;
                            const otherIcon = otherQuestion.querySelector('.faq-icon');
                            otherAnswer.classList.remove('active');
                            otherIcon.textContent = '+';
                        }
                    });
                    answer.classList.toggle('active');
                    if (answer.classList.contains('active')) {
                        icon.textContent = '−';
                    } else {
                        icon.textContent = '+';
                    }
                });
            });
        });

        function sidebarToggle() {
            const aside = document.querySelector('aside');
            aside.classList.toggle('show')
        }
    </script>
</body>

</html>