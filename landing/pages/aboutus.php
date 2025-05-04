<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PESO Landing</title>
    <link rel="shortcut icon" href="./assets/images/pesosmb.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/aboutus.css" />
    <link rel="stylesheet" href="../css/footer.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    

  </head>
  <body>
    <div class="header-info">
      <div class="city-name"><a href="index.php" style="text-decoration: none; color: #fff;">PESO</a></div>
      <div class="office-hours">
        <span>Office Hours: Mon - Fri: 8.00 am. - 5.00 pm.</span>
        <span style="margin-left: 2rem;">Email: sanmiguelbulacanpeso@gmail.com</span>
      </div>
    </div>

    <nav class="navbar">
      <div class="container">
        <a class="navbar-brand" href="../index.php">
          <img
            src="../../landing/assets/images/logo without glass.png"
            alt="PESO logo"
            class="logo"
          />
        </a>
        <ul class="navbar-links">
          <li><a class="nav-link" href="../index.php">Home</a></li>
          <li class="dropdown">
                    Job Portal <span class="arrow-down">&#9662;</span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="login-signup.php?form=signup">Job Listings</a></li>
                        <li><a class="dropdown-item" href="login-signup.php?form=signup">Post a Job</a></li>
                        <li><a class="dropdown-item" href="#">User's Guide</a></li>
                    </ul>
                </li>
                <li><a class="nav-link" href="./pages/aboutus.php">About Us</a></li>
                <li class="auth-buttons">
                    <a href="login-signup.php?form=login"><button <a class="btn-login">Login</button></a>
                    <a href="login-signup.php?form=signup"><button <a class="btn-signup">Sign Up</button></a>
                    <!-- <a class="btn-login" target="_self" href="login-signup.php">Login/Signup</a> -->
                    <!-- <a class="btn-signup" target="_blank" href="applicant-login-signup.html">Applicant</a> -->
                </li>
        </ul>
      </div>
    </nav>

    <main>
        <section class="about-section">
            <div class="container">
                <div class="section-header animate">
                    <h1>About Us</h1>
                    <p>Welcome to <span class="highlight">PESO San Miguel, Bulacan</span>, where talent meets opportunity. As a trusted partner in the job market, we bridge the gap between exceptional candidates and forward-thinking employers.</p>
                </div>
    
                <div class="vision-mission-grid">
                    <div class="card animate delay-1">
                        <h2>Our Vision</h2>
                        <p>Ang pagkakaloob ng isang matatag at mapanatili na trabaho para sa isang kwalipikadong manggagawa na masigasig na nagtatrabaho sa bansa o sa ibang bansa.</p>
                    </div>
    
                    <div class="card animate delay-2">
                        <h2>Our Mission</h2>
                        <p>Upang maisakatuparan ang aming pantay na mga oportunidad sa pagtatrabaho para sa lahat na may mabilis, pabago-bago, mahusay, at nakatuon na mga tagapagbigay ng serbisyo sa trabaho na suportado sa tumutugon na mga linya ng ahensya ng gobyerno na kasangkot sa trabaho tungo sa pandaigdigang kumpetensiya na pwersa ng trabaho.</p>
                    </div>
                </div>
    
                <div class="cta-section animate delay-3">
                    
                    <div class="btn-group">
                        <a href="#learn-more" class="btn btn-primary">
                            <i class="fas fa-book-open"></i> Learn More
                        </a>
                        <a href="#contact" class="btn btn-outline">
                            <i class="fas fa-envelope"></i> Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </section>



    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <img src="../../landing/assets/images/pesosmb.png" style="width: 150px;" alt="PESO Logo">
            </div>
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We are committed to delivering the best services in tech and innovation. Join us in making a difference.</p>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">X (Twitter)</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: sanmiguelbulacanpeso@gmail.com</p>
                <p>Phone: +123 456 7890</p>
                <p>Address: 123 Tech Street, Innovation City</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 PESO. All rights reserved.</p>
        </div>
    </footer>


    <script>
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
      document.addEventListener("contextmenu", (e) => {
        e.preventDefault();
      });
    </script>
    <script>
          document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                    }
                });
            }, { threshold: 0.1 });
            
            animateElements.forEach(element => {
                element.style.opacity = 0;
                observer.observe(element);
            });
        });
    </script>
  </body>
</html>
