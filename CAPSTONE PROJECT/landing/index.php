<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PESO Landing</title>
    <link rel="shortcut icon" href="./assets/images/pesosmb.png" type="image/x-icon">
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      :root {
          --primary-blue-color: #4285f4;
          --secondary-blue-color: #5c9eff;
          --primary-red-color: #ff4c4c;
          --secondary-red-color: #ff6b6b;
          --dark-clr-700: #000;
          --dark-clr-600: #333;
          --light-clr-700: #fff;
          --light-clr-600: #fafafa;
          --light-clr-500: #f3f3f3;
          --border: #ddd;
      }

      * {
          /* box-sizing: border-box; */
          margin: 0;
          padding: 0;
          /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
      }

      body {
          background-color: var(--light-clr-600);
          color: var(--dark-clr-600);
          line-height: 1.6;
      }

      .container {
          /* max-width: 1200px; */
          margin: 0 auto;
          padding: 0 20px;
      }

      /* Header Styles */
      header {
          background-color: var(--light-clr-700);
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          position: fixed;
          width: 100%;
          z-index: 100;
      }

      nav {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 20px 0;
      }

      .logo {
          font-size: 24px;
          font-weight: 700;
          color: var(--primary-blue-color);
          text-decoration: none;
      }

      .logo span {
          color: var(--primary-red-color);
      }

      .nav-links {
          display: flex;
          gap: 30px;
      }

      .nav-links a {
          color: var(--dark-clr-600);
          text-decoration: none;
          font-weight: 500;
          transition: color 0.3s;
      }

      .nav-links a:hover {
          color: var(--primary-blue-color);
      }

      .auth-buttons {
          display: flex;
          gap: 15px;
      }

      .btn {
          padding: 10px 20px;
          border-radius: 4px;
          font-weight: 500;
          cursor: pointer;
          transition: all 0.3s;
      }

      .btn-outline {
          background: transparent;
          border: 1px solid var(--primary-blue-color);
          color: var(--primary-blue-color);
      }

      .btn-outline:hover {
          background-color: var(--light-clr-500);
      }

      .btn-primary {
          background-color: var(--primary-blue-color);
          color: var(--light-clr-700);
          border: none;
      }

      .btn-primary:hover {
          background-color: var(--secondary-blue-color);
      }
 
      /* Features Section */
      .features {
          padding: 80px 0;
          background-color: var(--light-clr-700);
      }

      .section-title {
          text-align: center;
          margin-bottom: 50px;
      }

      .section-title h2 {
          font-size: 36px;
          color: var(--dark-clr-700);
          margin-bottom: 15px;
      }

      .section-title p {
          color: var(--dark-clr-600);
          max-width: 700px;
          margin: 0 auto;
      }

      .features-grid {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
          gap: 30px;
      }

      .feature-card {
          background-color: var(--light-clr-600);
          border-radius: 8px;
          padding: 30px;
          text-align: center;
          transition: transform 0.3s;
      }

      .feature-card:hover {
          transform: translateY(-10px);
      }

      .feature-icon {
          width: 80px;
          height: 80px;
          background-color: var(--primary-blue-color);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          margin: 0 auto 20px;
          color: var(--light-clr-700);
          font-size: 30px;
      }

      .feature-card h3 {
          margin-bottom: 15px;
          color: var(--dark-clr-700);
      }

      /* How It Works Section */
      .how-it-works {
          padding: 80px 0;
          background-color: var(--light-clr-500);
      }

      .steps {
          display: flex;
          justify-content: space-between;
          margin-top: 50px;
          flex-wrap: wrap;
          gap: 20px;
      }

      .step {
          flex: 1;
          min-width: 250px;
          text-align: center;
          position: relative;
      }

      .step-number {
          width: 50px;
          height: 50px;
          background-color: var(--primary-blue-color);
          color: var(--light-clr-700);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 24px;
          font-weight: 700;
          margin: 0 auto 20px;
      }

      .step h3 {
          margin-bottom: 15px;
          color: var(--dark-clr-700);
      }

      .step p {
          color: var(--dark-clr-600);
      }

      /* Job Categories Section */
      .job-categories {
          padding: 80px 0;
          background-color: var(--light-clr-700);
      }

      .categories-grid {
          display: grid;
          grid-template-columns: repeat(3 , 1fr);
          gap: 20px;
          margin-top: 40px;
      }

      .category-card {
          background-color: var(--light-clr-600);
          border-radius: 8px;
          padding: 20px;
          text-align: center;
          transition: all 0.3s;
          cursor: pointer;
      }

      .category-card:hover {
          background-color: var(--primary-blue-color);
          color: var(--light-clr-700);
      }

      .category-card i {
          font-size: 30px;
          margin-bottom: 15px;
          color: var(--primary-blue-color);
      }

      .category-card:hover i {
          color: var(--light-clr-700);
      }

      /* CTA Section */
      .cta {
          padding: 100px 0;
          background: linear-gradient(135deg, var(--primary-blue-color) 0%, var(--secondary-blue-color) 100%);
          color: var(--light-clr-700);
          text-align: center;
      }

      .cta h2 {
          font-size: 36px;
          margin-bottom: 20px;
      }

      .cta p {
          max-width: 700px;
          margin: 0 auto 40px;
          font-size: 18px;
      }

      /* Footer */
      footer {
          background-color: var(--dark-clr-700);
          color: var(--light-clr-700);
          padding: 60px 0 20px;
      }

      .footer-content {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
          gap: 40px;
          margin-bottom: 40px;
      }

      .footer-column h3 {
          font-size: 18px;
          margin-bottom: 20px;
          color: var(--light-clr-700);
      }

      .footer-column ul {
          list-style: none;
      }

      .footer-column ul li {
          margin-bottom: 10px;
      }

      .footer-column ul li a {
          color: var(--light-clr-500);
          text-decoration: none;
          transition: color 0.3s;
      }

      .footer-column ul li a:hover {
          color: var(--light-clr-700);
      }

      .social-links {
          display: flex;
          gap: 15px;
      }

      .social-links a {
          color: var(--light-clr-700);
          font-size: 20px;
      }

      .copyright {
          text-align: center;
          padding-top: 20px;
          border-top: 1px solid rgba(255, 255, 255, 0.1);
          color: var(--light-clr-500);
          font-size: 14px;
      }

      /* Responsive Styles */
      @media (max-width: 768px) {
          .nav-links {
              display: none;
          }

          .hero h1 {
              font-size: 36px;
          }

          .hero p {
              font-size: 18px;
          }

          .steps {
              flex-direction: column;
          }

          .step:not(:last-child)::after {
              content: "↓";
              display: block;
              text-align: center;
              margin: 20px 0;
              color: var(--primary-blue-color);
              font-size: 24px;
          }
      }
  </style>
  </head>
  <body>
    <div class="header-info">
      <div class="city-name"><a href="index.html" style="text-decoration: none; color: #fff;">PESO</a></div>
      <div class="office-hours">
        <span>Office Hours: Mon - Fri: 8.00 am. - 5.00 pm.</span>
        <span style="margin-left: 2rem;">Email: pesosanmiguel@gmail.com</span>
      </div>
    </div>

    <nav class="navbar">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img
            src="./assets/images/logo without glass.png"
            alt="PESO logo"
            class="logo"
          />
        </a>
        <ul class="navbar-links">
          <li><a class="nav-link" href="#">Home</a></li>
          <li class="dropdown">
            Job Portal <span class="arrow-down">&#9662;</span>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Job Listings</a></li>
              <li><a class="dropdown-item" href="#">Post a Job</a></li>
            </ul>
          </li>
          <li><a class="nav-link" href="#">About Us</a></li>
          <li class="auth-buttons">

            <a class="btn-login" target="_blank" href="login-signup.html">Login/Signup</a>
            <!-- <a class="btn-signup" target="_blank" href="applicant-login-signup.html">Applicant</a> -->

          </li>
        </ul>
      </div>
    </nav>

    <main>
      <section class="hero">
        <div class="hero-text">
          <h1>PUBLIC EMPLOYMENT SERVICE OFFICE OF <br /><span class="sanmiguel">SAN MIGUEL, BULACAN</span></h1>
          <p>Your gateway to amazing job opportunities.</p>
          <div class="hero-btn">
            <button class="find-job">Browse jobs</button>
            <button class="find-talent">Find Talent</button>
          </div>
        </div>
        <div class="hero-image-container">
          <img
            src="./assets/images/people.png"
            alt="Hero Image"
            class="hero-img"
          />
        </div>
      </section>

      <section class="statistics">
        <h2>PORTAL STATISTICS</h2>
        <hr />
        <div class="stats-container">
          <div class="stats-card appear-animation">
            <h4>Registered Applicants</h4>
            <p>123</p>
          </div>
          <div class="stats-card appear-animation">
            <h4>Registered Employers</h4>
            <p>456</p>
          </div>
          <div class="stats-card appear-animation">
            <h4>Job Listings</h4>
            <p>789</p>
          </div>
          <div class="stats-card appear-animation">
            <h4>Hired Applicants</h4>
            <p>312</p>
          </div>
        </div>
      </section>


      <section class="registered-employers">
        <h2>REGISTERED EMPLOYERS</h2>
        
          

        <div class="scroller" data-direction="right" data-speed="fast">
          <div class="scroller__inner">
            <img src="./assets/images/company-logos/7-eleven_logo.svg.png" alt="" />
            <img src="./assets/images/company-logos/Chowking_logo.svg.png" alt="" />
            <img src="./assets/images/company-logos/Jollibee.png" alt="" />
            <img src="./assets/images/company-logos/kfc.png" alt="" />
            <img src="./assets/images/company-logos/mang-inasal-logo-png_seeklogo-543182.png" alt="" />
            <img src="./assets/images/company-logos/robinsons.png" alt="" />
            <!-- <img src="./assets/images/company-logos/Puregold_logo.svg.png" alt=""> -->
            <img src="./assets/images/company-logos/rcs.png" alt="" >
    
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
            <!-- <img src="./assets/images/company-logos/Puregold_logo.svg.png" alt=""> -->
            <img src="./assets/images/company-logos/rcs.png" alt="" >
          </div>
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
                    <p>Our office reviews applications and connects qualified candidates with employers.</p>
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
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" style="width: 100vw;">
        <div class="container" style="width: auto;">
            <h2>Ready to Take the Next Step?</h2>
            <p>Join thousands of professionals and companies who found their perfect match through PESO</p>
            <div style="display: flex; justify-content: center; gap: 20px;">
                <button class="btn btn-outline" style="background-color: transparent; border-color: var(--light-clr-700); color: var(--light-clr-700);">I'm Hiring</button>
                <button class="btn btn-primary" style="background-color: var(--light-clr-700); color: var(--primary-blue-color);">Find Jobs</button>
            </div>
        </div>
    </section>

    </main>
    <footer>
      <div class="footer-container">
        <img src="./assets/images/pesosmb.png" alt="" style="width: 150px;">
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
  </body>
</html>
