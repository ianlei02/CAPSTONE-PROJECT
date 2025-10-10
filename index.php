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
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PESO Landing</title>
    <link rel="shortcut icon" href="public/images/pesosmb.png" type="image/x-icon">
    <link rel="stylesheet" href="public/css/css-reset.css" />
    <link rel="stylesheet" href="public/css/index.css" />
    <link rel="stylesheet" href="public/css/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
      -->
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
        </a>
        <ul class="navbar-links topbar">
            <li><a class="nav-link" href="index.php">Home</a></li>
            <li><a class="nav-link" href="landing/pages/find-job.php">Job Listings</a></li>
            <li><a class="nav-link" href="landing/pages/aboutus.php">About Us</a></li>
            <li class="auth-buttons">
                <a href="auth/login-signup.php?form=login" class="btn-primary">Login</a>
                <!-- <a href="auth/login-signup.php?form=signup"><button class="btn-signup">Sign Up</button></a> -->
            </li>
        </ul>
        <button onclick="sidebarToggle()" class="hamburger">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </nav>
    <aside>
        <ul class="navbar-links sidebar">
            <li><a class="nav-link" href="index.php">Home</a></li>
            <li><a class="nav-link" href="./pages/find-job.php">Job Listings</a></li>
            <li><a class="nav-link" href="./pages/aboutus.php">About Us</a></li>
            <li class="auth-buttons">
                <a href="auth/login-signup.php?form=login" class="btn-primary">Login</a>
                <!-- <a href="auth/login-signup.php?form=signup"><button class="btn-signup">Sign Up</button></a> -->
            </li>
        </ul>
    </aside>

    <main>
        <section class="hero" id="hero">
            <div class="hero-left">
                <div class="hero-text">
                    <h1>PUBLIC EMPLOYMENT SERVICE OFFICE OF SAN MIGUEL, BULACAN</h1>
                    <p>Your gateway to amazing job opportunities.</p>
                    <div class="hero-btn">
                        <a href="auth/login-signup.php?form=signup" class="get-started">Get Started &#10132;</a>
                    </div>
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
                    src="public/images/hero-asset.png"
                    alt="Hero Image"
                    class="hero-img" />
            </div>
        </section>

        <section class="news">
            <div class="section-header">
                <h2><i class="fas fa-bullhorn"></i> Announcements & Updates</h2>
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
                                        Read More <i class="fas fa-arrow-right"></i>
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
        </section>

        <section class="features">
            <div class="container">
                <div class="section-title">
                    <h2>Why Choose PESO?</h2>
                    <p>We make job hunting and hiring simple, efficient, and effective</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3>Quality Job Listings</h3>
                        <p>Access thousands of verified job opportunities from top employers across various industries.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3>Professional Matching</h3>
                        <p>Our office reviews all applications to ensure the best matches between candidates and employers.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Secure Platform</h3>
                        <p>Your personal information is protected with our advanced security measures and privacy controls.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3>Reliable Support</h3>
                        <p>Our dedicated support team is available during office hours to assist you with any inquiries or issues.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="how-it-works">
            <div class="container">
                <div class="section-title">
                    <h2>How It Works</h2>
                    <p>Simple steps to get you hired or find the perfect candidate</p>
                </div>
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Create Your Profile</h3>
                        <p>Complete your professional profile with your skills, experience, and documents.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Find Opportunities</h3>
                        <p>Browse jobs or candidates that match your preferences and qualifications.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Apply or Connect</h3>
                        <p>Submit your application or reach out to potential candidates through our platform.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <h3>Get Matched</h3>
                        <p> Our office reviews applications and connects qualified candidates with employers.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class=" container" style="width: auto;">
                <h2>Ready to Take the Next Step?</h2>
                <p>Join thousands of professionals and companies who found their perfect match through PESO</p>
                <div style="display: flex; justify-content: center; gap: 20px;">
                    <button class="btn btn-outline" style="background-color: transparent; border-color: var(--light-clr-700); color: var(--light-clr-700);" onclick="window.location.href='login-signup.php'">I'm Hiring</button>
                    <button class="btn btn-primary" style="background-color: var(--light-clr-700); color: var(--primary-blue-color);" onclick="window.location.href='login-signup.php'">Find Jobs</button>
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
    </div>

    <script>
        window.addEventListener("load", function() {
            const preloader = document.getElementById("preloader");
            preloader.style.opacity = "0";
            setTimeout(() => {
                preloader.style.display = "none";
            }, 500);
        });
    </script> -->
    <!-- Swiper JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script> -->
    <script src="public/library/swiper/swiper-bundle.min.js"></script>
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
                    e.preventDefault();

                    document.getElementById("newsModalTitle").textContent = this.dataset.title;
                    document.getElementById("newsModalDate").textContent = "📅 " + this.dataset.date;
                    document.getElementById("newsModalImage").src = this.dataset.image;
                    document.getElementById("newsModalContent").innerHTML = this.dataset.content;
                    modal.style.display = "block";
                });
            });
            closeBtn.onclick = () => modal.style.display = "none";
            window.onclick = (e) => {
                if (e.target == modal) modal.style.display = "none";
            };
        });

        function sidebarToggle() {
            const aside = document.querySelector('aside');
            aside.classList.toggle('show')
        }
    </script>
</body>

</html>