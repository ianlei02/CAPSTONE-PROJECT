<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PESO Landing</title>
  <script src="../../public/js/dark-mode.js"></script>
  <link rel="icon" href="../../public/smb-images/pesosmb.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/aboutus.css" />
  <link rel="stylesheet" href="../css/footer.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->


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
      <li><a class="nav-link" href="find-job.php">Job Listings</a></li>
      <li><a class="nav-link" href="aboutus.php">About Us</a></li>
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
  </script>
</body>

</html>