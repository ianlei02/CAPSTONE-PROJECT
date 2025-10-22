<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About us</title>
  <script src="../../public/js/dark-mode.js"></script>
  <link rel="icon" href="../../public/smb-images/pesosmb.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/aboutus.css" />
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
      <li><a class="nav-link" href="../../index.php">Home</a></li>
      <li><a class="nav-link" href="./find-job.php">Job Listings</a></li>
      <li><a class="nav-link" href="./aboutus.php">About Us</a></li>
      <li class="auth-buttons">
        <a href="auth/login-signup.php?form=login" class="btn btn-primary login">Login</a>
        <!-- <a href="auth/login-signup.php?form=signup"><button class="btn-signup">Sign Up</button></a> -->
      </li>
    </ul>
  </aside>

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
            <p>Creating the Province of Bulacan as a Province that provides reliable and sustainable employment facilitation services that contribute to poverty alleviation and economic development in commitment and accordance with the People's Agenda 10.</p>
          </div>

          <div class="card animate delay-2">
            <h2>Our Mission</h2>
            <p>To facilitate equal employment opportunities to the province's constituents through Job Matching and Coaching, employability enhancement and referrals for livelihood or training, and promotion of industrial peace through tripartism.</p>
          </div>
        </div>

        <!-- <div class="cta-section animate delay-3">
          <h2>Ready to take the next step in your career?</h2>
          <div class="btn-group">
            <a href="#learn-more" class="btn btn-primary">
              <i class="fas fa-book-open"></i> Learn More
            </a>
            <a href="#contact" class="btn btn-outline">
              <i class="fas fa-envelope"></i> Contact Us
            </a>
          </div>
        </div> -->
      </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
      <div class="container">
        <div class="section-header">
          <h1>Meet Our Development Team</h1>
          <p>The talented developers behind our innovative Job Hiring Decision Support System</p>
        </div>
        <div class="team-grid">
          <div class="team-card">
            <div class="team-image">
              <img src="../team-images/IanLeiCastillo.png" alt="">
            </div>
            <h3 class="team-name">Ian Lei C. Castillo</h3>
            <div class="team-role">Project Manager / Frontend Developer</div>
            <div class="team-divider"></div>
            <p class="team-description">
              Ian steers the project with a clear vision, ensuring our goals align with user needs while crafting the dynamic interface you interact with.
            </p>
            <div class="team-skills">
              <span class="skill-tag">Project Management</span>
              <!-- <span class="skill-tag">React</span> -->
              <span class="skill-tag">UI Development</span>
            </div>
          </div>

          <div class="team-card">
            <div class="team-image">
              <img src="../team-images/JustinLouieCruz.png" alt="">
            </div>
            <h3 class="team-name">Justin Louie Cruz</h3>
            <div class="team-role">Backend Developer</div>
            <div class="team-divider"></div>
            <p class="team-description">
              Louie architects the robust and intelligent backend that powers our analytical core, processing information with precision and speed.
            </p>
            <div class="team-skills">
              <span class="skill-tag">PHP</span>
              <span class="skill-tag">Database Design</span>
              <!-- <span class="skill-tag">API Development</span> -->
            </div>
          </div>

          <div class="team-card">
            <div class="team-image">
              <img src="../team-images/KateroseChico.png" alt="">
            </div>
            <h3 class="team-name">Katerose B. Chico</h3>
            <div class="team-role">UI/UX Designer</div>
            <div class="team-divider"></div>
            <p class="team-description">
              Kate designs intuitive and accessible user experiences, making complex data feel simple and actionable for all users.
            </p>
            <div class="team-skills">
              <span class="skill-tag">Figma</span>
              <span class="skill-tag">User Research</span>
              <span class="skill-tag">Prototyping</span>
            </div>
          </div>
          <div class="team-card">
            <div class="team-image">
              <img src="../team-images/VincentBaydal.png" alt="">
            </div>
            <h3 class="team-name">Vincent M. Baydal</h3>
            <div class="team-role">Document Specialist</div>
            <div class="team-divider"></div>
            <p class="team-description">
              Vincent brings clarity and coherence to the entire process, translating complex technical concepts into accessible documentation.
            </p>
            <div class="team-skills">
              <span class="skill-tag">Technical Writing</span>
              <!-- <span class="skill-tag">User Guides</span> -->
              <span class="skill-tag">Process Documentation</span>
            </div>
          </div>



          <div class="team-card">
            <div class="team-image">
              <img src="../team-images/AndreiPerez.png" alt="">
            </div>
            <h3 class="team-name">Ryan Andrei Perez</h3>
            <div class="team-role">Lead Researcher</div>
            <div class="team-divider"></div>
            <p class="team-description">
              Andrei ensures our algorithms are both cutting-edge and conscientious through deep research into equitable hiring practices.
            </p>
            <div class="team-skills">
              <span class="skill-tag">Data Analysis</span>
              <!-- <span class="skill-tag">Algorithm Design</span> -->
              <span class="skill-tag">Ethical AI</span>
            </div>
          </div>
        </div>
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
    document.addEventListener('DOMContentLoaded', function() {
      const animatedElements = document.querySelectorAll('.animate');

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1
      });

      animatedElements.forEach(element => {
        observer.observe(element);
      });
    });
  </script>
  </script>
</body>

</html>