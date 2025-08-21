<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PESO Landing</title>
    <link rel="shortcut icon" href="./assets/images/pesosmb.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/css-reset.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/breakpoints.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
</head>

<body>
    <!-- <div class="header-info">
        <div class="city-name"><a href="index.php" style="text-decoration: none; color: #fff;">PESO</a></div>
        <div class="office-hours">
            <span>Office Hours: Mon - Fri: 8.00 am. - 5.00 pm.</span>
            <span style="margin-left: 2rem;">Email: sanmiguelbulacanpeso@gmail.com</span>
        </div>
    </div> -->

    <nav class="navbar">
        <a class="navbar-brand" href="#">
            <img
                src="../public-assets/smb-images/pesosmb.png"
                alt="PESO logo"
                class="logo" />
            <img
                src="../public-assets/smb-images/smb-logo.png"
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
        <section class="hero" id="hero">
            <div class="hero-text">
                <h1>PUBLIC EMPLOYMENT SERVICE OFFICE OF <br /><span class="sanmiguel">SAN MIGUEL, BULACAN</span></h1>
                <p>Your gateway to amazing job opportunities.</p>
                <div class="hero-btn">
                    <a href="login-signup.php?form=signup" class="get-started">Get Started &#10132;</a>
                </div>
            </div>
            <div class="hero-image-container">
                <img
                    src="./assets/images/hero-asset.png"
                    alt="Hero Image"
                    class="hero-img" />
            </div>
        </section>

        <section class="statistics">
            <div class="container">
                <div>
                    <h2>PORTAL STATISTICS</h2>
                    <hr />
                </div>
                <div class="stats-container">
                    <div class="stats-card appear-animation">
                        <h4>Registered Applicants</h4>
                        <p class="stat-number" data-target="123">0</p>
                    </div>
                    <div class="stats-card appear-animation">
                        <h4>Registered Employers</h4>
                        <p class="stat-number" data-target="456">0</p>
                    </div>
                    <div class="stats-card appear-animation">
                        <h4>Job Listings</h4>
                        <p class="stat-number" data-target="789">0</p>
                    </div>
                    <div class="stats-card appear-animation">
                        <h4>Hired Applicants</h4>
                        <p class="stat-number" data-target="312">0</p>
                    </div>
                </div>
            </div>


        </section>


        <section class="news">
            <div class="section-header">
                <h2><i class="fas fa-bullhorn"></i> Announcements & Updates</h2>
            </div>
            <!-- Slider container -->
            <div class="swiper newsSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <article class="news-card">
                            <img src="" alt="Job Fair" class="news-image">
                            <div class="news-content">
                                <h3 class="news-title">Annual Job Fair 2023</h3>
                                <div class="news-date">
                                    <i class="far fa-calendar-alt"></i> October 15, 2023
                                </div>
                                <p class="news-excerpt">
                                    Join us for the biggest job fair of the year with over 100 employers looking to hire local talent.
                                </p>
                                <a href="#" class="news-link">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="news-card">
                            <img src="" alt="Workshop" class="news-image">
                            <div class="news-content">
                                <h3 class="news-title">Resume Writing Workshop</h3>
                                <div class="news-date">
                                    <i class="far fa-calendar-alt"></i> November 2, 2023
                                </div>
                                <p class="news-excerpt">
                                    Learn professional resume writing techniques from industry experts in this free workshop.
                                </p>
                                <a href="#" class="news-link">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="news-card">
                            <img src="https://source.unsplash.com/random/600x400/?interview" alt="Interview" class="news-image">
                            <div class="news-content">
                                <h3 class="news-title">New Hiring Initiatives</h3>
                                <div class="news-date">
                                    <i class="far fa-calendar-alt"></i> September 28, 2023
                                </div>
                                <p class="news-excerpt">
                                    Municipal government announces new programs to connect job seekers with local businesses.
                                </p>
                                <a href="#" class="news-link">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="news-card">
                            <img src="" alt="Training" class="news-image">
                            <div class="news-content">
                                <h3 class="news-title">Skills Development Program</h3>
                                <div class="news-date">
                                    <i class="far fa-calendar-alt"></i> October 5, 2023
                                </div>
                                <p class="news-excerpt">
                                    Free technical training programs now available for unemployed youth and career changers.
                                </p>
                                <a href="#" class="news-link">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="news-card">
                            <img src="" alt="Business" class="news-image">
                            <div class="news-content">
                                <h3 class="news-title">Employer Networking Event</h3>
                                <div class="news-date">
                                    <i class="far fa-calendar-alt"></i> November 15, 2023
                                </div>
                                <p class="news-excerpt">
                                    Connect with local employers and learn about current job openings in our monthly networking event.
                                </p>
                                <a href="#" class="news-link">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- Pagination bullets -->
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <!-- <section class="registered-employers">
            <h2>REGISTERED EMPLOYERS</h2>
            <div class="scroller" data-direction="right" data-speed="fast">
                <div class="scroller__inner">
                    <img src="./assets/images/company-logos/7-eleven_logo.svg.png" alt="" />
                    <img src="./assets/images/company-logos/Chowking_logo.svg.png" alt="" />
                    <img src="./assets/images/company-logos/Jollibee.png" alt="" />
                    <img src="./assets/images/company-logos/kfc.png" alt="" />
                    <img src="./assets/images/company-logos/mang-inasal-logo-png_seeklogo-543182.png" alt="" />
                    <img src="./assets/images/company-logos/robinsons.png" alt="" />
                    <img src="./assets/images/company-logos/rcs.png" alt="">

                </div>
            </div>
            <br>
            <div class="scroller" data-direction="left" data-speed="fast">
                <div class="scroller__inner">
                    <img src="./assets/images/company-logos/7-eleven_logo.svg.png" alt="" />
                    <img src="./assets/images/company-logos/Chowking_logo.svg.png" alt="" />
                    <img src="./assets/images/company-logos/Jollibee.png" alt="" />
                    <img src="./assets/images/company-logos/kfc.png" alt="" />
                    <img src="./assets/images/company-logos/mang-inasal-logo-png_seeklogo-543182.png" alt="" />
                    <img src="./assets/images/company-logos/robinsons.png" alt="" />
                    <img src="./assets/images/company-logos/rcs.png" alt="">
                </div>
            </div>
        </section> -->

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

        <!-- How It Works Section -->
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

        <section class="job-listings">
            <div class="job-list-heading">
                <h2>Recent Job Listings</h2>
            </div>
            <div class="job-cards">
                <div class="job-cards">
                    <div class="job-card" data-field="Engineering">
                        <div class="job-field">Engineering</div>
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
                    <div class="job-card" data-field="Engineering">
                        <div class="job-field">Engineering</div>
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
                    <div class="job-card" data-field="Engineering">
                        <div class="job-field">Engineering</div>
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
                </div>
            </div>
        </section>
        <!-- Job Categories Section -->
        <section class="job-categories">
            <div class="container">
                <div class="section-title">
                    <h2>Popular Job Categories</h2>
                    <p>Explore opportunities in these high-demand fields</p>
                </div>
                <div class="categories-grid">
                    <div class="category-card">
                        <i class="fas fa-laptop-code"></i>
                        <h3>IT & Software</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-hard-hat"></i>
                        <h3>Engineering</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-stethoscope"></i>
                        <h3>Healthcare</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-chart-line"></i>
                        <h3>Finance</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>Education</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-store"></i>
                        <h3>Retail</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-utensils"></i>
                        <h3>Hospitality</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-paint-brush"></i>
                        <h3>Creative</h3>
                    </div>
                    <div class="category-card">
                        <i class="fas fa-hammer"></i>
                        <h3>Construction</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->

        <section class="cta" ">
            <div class=" container" style="width: auto;">
            <h2>Ready to Take the Next Step?</h2>
            <p>Join thousands of professionals and companies who found their perfect match through PESO</p>
            <div style="display: flex; justify-content: center; gap: 20px;">
                <button class="btn btn-outline" style="background-color: transparent; border-color: var(--light-clr-700); color: var(--light-clr-700);" onclick="window.location.href='login-signup.php'">I'm Hiring</button>
                <button class="btn btn-primary" style="background-color: var(--light-clr-700); color: var(--primary-blue-color);" onclick="window.location.href='login-signup.php'">Find Jobs</button>
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

<div id="preloader">
  <div class="loader"></div>
</div>

    <script>
    window.addEventListener("load", function () {
        const preloader = document.getElementById("preloader");
        preloader.style.opacity = "0";
        setTimeout(() => {
        preloader.style.display = "none";
        }, 500); 
    });
    </script>

    <!-- <script>
        const scrollers = document.querySelectorAll(".scroller");
        if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            addAnimation();
        }

        function addAnimation() {
            scrollers.forEach((scroller) => {
                scroller.setAttribute("data-animated", true);

                const scrollerInner = scroller.querySelector(".scroller__inner");
                const scrollerContent = Array.from(scrollerInner.children);

                scrollerContent.forEach((item) => {
                    const duplicatedItem = item.cloneNode(true);
                    duplicatedItem.setAttribute("aria-hidden", true);
                    scrollerInner.appendChild(duplicatedItem);
                });
            });
        }
        //document.addEventListener("contextmenu", (e) => {
          //  e.preventDefault();
      //  });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const statNumbers = document.querySelectorAll(".stat-number");

            const animateNumbers = (entry) => {
                if (entry.isIntersecting) {
                    const target = +entry.target.getAttribute("data-target");
                    const increment = Math.ceil(target / 100);

                    let current = 0;
                    const updateNumber = () => {
                        current += increment;
                        if (current > target) {
                            current = target;
                        }
                        entry.target.textContent = current;
                        if (current < target) {
                            requestAnimationFrame(updateNumber);
                        }
                    };
                    updateNumber();
                    observer.unobserve(entry.target);
                }
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(animateNumbers);
            }, {
                threshold: 0.5
            });

            statNumbers.forEach((number) => observer.observe(number));
        });
    </script> -->
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.newsSwiper', {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
    </script>
</body>

</html>