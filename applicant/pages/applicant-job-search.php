<?php
require_once '../../landing/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login-signup.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Search</title>
  <link rel="stylesheet" href="../css/applicant-job-search.css" />
  <link rel="stylesheet" href="../css/navs.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <div class="left-pos" style="display: flex; width: auto; height: auto">
        <button class="hamburger">☰</button>
        <div class="logo">
          <img src="../assets/images/logo without glass.png" alt="" />
        </div>
      </div>
      <div class="right-pos">
        <div class="profile">IAN</div>
      </div>
    </div>
  </nav>

  <div class="container">
    <aside class="sidebar">
      <ul class="sidebar-menu">
        <li>
          <a href="./applicant-dashboard.php">
            <span class="emoji"><img src="../../public-assets/icons/chart-histogram.svg" alt="Dashboard-icon"></span>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./applicant-applications.php">
            <span class="emoji"><img src="../../public-assets/icons/briefcase.svg" alt="Applications-icon"></span>
            <span class="label">My Applications</span>
          </a>
        </li>
        <li>

          <a href="./applicant-job-search.php">

            <span class="emoji"><img src="../../public-assets/icons/search.svg" alt="Job-Search-icon"></span>
            <span class="label">Job Search</span>
          </a>
        </li>
        <li>

          <a href="./applicant-profile.php">

            <span class="emoji"><img src="../../public-assets/icons/user.svg" alt="Profile-icon"></span>
            <span class="label">My Profile</span>
          </a>
        </li>
        <li>
          <a href="../../landing/functions/logout.php">
            <span class="emoji"><img src="../../public-assets/icons/download.svg" alt="Logout-icon" style="transform: rotate(90deg);"></span>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </aside>

    <main class="main-content">
      <div class="container-job-search">
        <div class="header">
          <h1>Job Listings</h1>
          <div>Showing 10 jobs</div>
        </div>

        <div class="search-filter">
          <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" placeholder="Search for jobs..." />
          </div>
          <select class="filter" id="jobFieldFilter">
            <option value="">All Fields</option>
            <option value="IT">IT/Software</option>
            <option value="Engineering">Engineering</option>
            <option value="Medicine">Medicine/Healthcare</option>
            <option value="Business">Business/Finance</option>
            <option value="Education">Education</option>
            <option value="Marketing">Marketing</option>
            <option value="Construction">Construction</option>
            <option value="Manufacturing">Manufacturing</option>
            <option value="Other">Other Fields</option>
          </select>
        </div>

        <div class="job-listings">
          <!-- Business Job -->
          <div class="job-card" data-field="Business">
            <div class="job-card-top">
              <div class="job-field">Business/Finance</div>
              <div class="job-header">
                <div>
                  <h3 class="job-title">Financial Analyst</h3>
                  <div class="job-company">Prime Capital Inc.</div>
                </div>
                <div>
                  <span class="job-salary">₱60,000 - ₱80,000/month</span>
                </div>
              </div>
              <div class="job-meta">
                <span><i class="fas fa-briefcase"></i> Full-time</span>
                <span><i class="fas fa-map-marker-alt"></i> Makati City</span>
                <span><i class="fas fa-users"></i> Vacancies: 1</span>
              </div>
            </div>
            <div class="job-description">
              Looking for a CFA with 4+ years experience in investment
              analysis. Responsibilities include financial modeling, market
              research, and preparing investment recommendations.
              Looking for a CFA with 4+ years experience in investment
              analysis. Responsibilities include financial modeling, market
              research, and preparing investment recommendations. 
            </div>
            <span class="read-more">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: May 18, 2023</div>
              <button class="apply-btn" data-job-id="104">Apply Now</button>
            </div>
          </div>
            <!-- IT Job -->
            <div class="job-card" data-field="IT">
            <div class="job-card-top">
              <div class="job-field">IT/Software</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">Frontend Developer</h3>
                <div class="job-company">Tech Innovators PH</div>
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
            </div>
            <div class="job-description">
              Seeking a React.js developer with 2+ years experience. Responsibilities include UI development, API integration, and collaborating with backend teams.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: June 30, 2024</div>
              <button class="apply-btn" data-job-id="201">Apply Now</button>
            </div>
            </div>

            <!-- Engineering Job -->
            <div class="job-card" data-field="Engineering">
            <div class="job-card-top">
              <div class="job-field">Engineering</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">Civil Engineer</h3>
                <div class="job-company">BuildRight Construction</div>
              </div>
              <div>
                <span class="job-salary">₱50,000 - ₱70,000/month</span>
              </div>
              </div>
              <div class="job-meta">
              <span><i class="fas fa-briefcase"></i> Full-time</span>
              <span><i class="fas fa-map-marker-alt"></i> Pasig City</span>
              <span><i class="fas fa-users"></i> Vacancies: 3</span>
              </div>
            </div>
            <div class="job-description">
              Licensed Civil Engineer needed for site supervision and project management. Must have at least 3 years experience in construction projects.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: July 10, 2024</div>
              <button class="apply-btn" data-job-id="202">Apply Now</button>
            </div>
            </div>

            <!-- Medicine Job -->
            <div class="job-card" data-field="Medicine">
            <div class="job-card-top">
              <div class="job-field">Medicine/Healthcare</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">Registered Nurse</h3>
                <div class="job-company">St. Luke's Medical Center</div>
              </div>
              <div>
                <span class="job-salary">₱35,000 - ₱45,000/month</span>
              </div>
              </div>
              <div class="job-meta">
              <span><i class="fas fa-briefcase"></i> Full-time</span>
              <span><i class="fas fa-map-marker-alt"></i> Taguig City</span>
              <span><i class="fas fa-users"></i> Vacancies: 5</span>
              </div>
            </div>
            <div class="job-description">
              Registered Nurse with PRC license. Experience in hospital setting preferred. Rotating shifts, patient care, and documentation required.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: July 5, 2024</div>
              <button class="apply-btn" data-job-id="203">Apply Now</button>
            </div>
            </div>

            <!-- Education Job -->
            <div class="job-card" data-field="Education">
            <div class="job-card-top">
              <div class="job-field">Education</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">High School Math Teacher</h3>
                <div class="job-company">Bright Future Academy</div>
              </div>
              <div>
                <span class="job-salary">₱25,000 - ₱35,000/month</span>
              </div>
              </div>
              <div class="job-meta">
              <span><i class="fas fa-briefcase"></i> Full-time</span>
              <span><i class="fas fa-map-marker-alt"></i> Manila</span>
              <span><i class="fas fa-users"></i> Vacancies: 2</span>
              </div>
            </div>
            <div class="job-description">
              Licensed teacher for junior and senior high school math. Must have LET and at least 1 year teaching experience.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: June 25, 2024</div>
              <button class="apply-btn" data-job-id="204">Apply Now</button>
            </div>
            </div>

            <!-- Marketing Job -->
            <div class="job-card" data-field="Marketing">
            <div class="job-card-top">
              <div class="job-field">Marketing</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">Digital Marketing Specialist</h3>
                <div class="job-company">AdVantage Solutions</div>
              </div>
              <div>
                <span class="job-salary">₱30,000 - ₱50,000/month</span>
              </div>
              </div>
              <div class="job-meta">
              <span><i class="fas fa-briefcase"></i> Full-time</span>
              <span><i class="fas fa-map-marker-alt"></i> Cebu City</span>
              <span><i class="fas fa-users"></i> Vacancies: 1</span>
              </div>
            </div>
            <div class="job-description">
              Manage social media campaigns, SEO/SEM, and analytics. 2+ years experience in digital marketing required.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: July 1, 2024</div>
              <button class="apply-btn" data-job-id="205">Apply Now</button>
            </div>
            </div>

            <!-- Construction Job -->
            <div class="job-card" data-field="Construction">
            <div class="job-card-top">
              <div class="job-field">Construction</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">Site Foreman</h3>
                <div class="job-company">MegaBuild Corp.</div>
              </div>
              <div>
                <span class="job-salary">₱28,000 - ₱40,000/month</span>
              </div>
              </div>
              <div class="job-meta">
              <span><i class="fas fa-briefcase"></i> Full-time</span>
              <span><i class="fas fa-map-marker-alt"></i> Davao City</span>
              <span><i class="fas fa-users"></i> Vacancies: 2</span>
              </div>
            </div>
            <div class="job-description">
              Oversee daily site operations, supervise workers, and ensure safety compliance. At least 2 years experience required.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: June 28, 2024</div>
              <button class="apply-btn" data-job-id="206">Apply Now</button>
            </div>
            </div>

            <!-- Manufacturing Job -->
            <div class="job-card" data-field="Manufacturing">
            <div class="job-card-top">
              <div class="job-field">Manufacturing</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">Production Supervisor</h3>
                <div class="job-company">FoodPro Manufacturing</div>
              </div>
              <div>
                <span class="job-salary">₱32,000 - ₱42,000/month</span>
              </div>
              </div>
              <div class="job-meta">
              <span><i class="fas fa-briefcase"></i> Full-time</span>
              <span><i class="fas fa-map-marker-alt"></i> Calamba, Laguna</span>
              <span><i class="fas fa-users"></i> Vacancies: 1</span>
              </div>
            </div>
            <div class="job-description">
              Supervise production line, ensure quality standards, and manage team schedules. Experience in food manufacturing preferred.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: July 8, 2024</div>
              <button class="apply-btn" data-job-id="207">Apply Now</button>
            </div>
            </div>

            <!-- Other Fields Job -->
            <div class="job-card" data-field="Other">
            <div class="job-card-top">
              <div class="job-field">Other Fields</div>
              <div class="job-header">
              <div>
                <h3 class="job-title">Customer Service Representative</h3>
                <div class="job-company">Global Connect BPO</div>
              </div>
              <div>
                <span class="job-salary">₱22,000 - ₱28,000/month</span>
              </div>
              </div>
              <div class="job-meta">
              <span><i class="fas fa-briefcase"></i> Full-time</span>
              <span><i class="fas fa-map-marker-alt"></i> Iloilo City</span>
              <span><i class="fas fa-users"></i> Vacancies: 10</span>
              </div>
            </div>
            <div class="job-description">
              Handle inbound customer calls, resolve issues, and provide excellent service. Good communication skills required.
            </div>
            <span class="read-more" style="color:var(--primary-blue-color)">Read More</span>
            <div class="job-footer">
              <div class="job-posted">Expiration: June 20, 2024</div>
              <button class="apply-btn" data-job-id="208">Apply Now</button>
            </div>
            </div>

        </div>
      </div>

      <!-- Application Modal -->
      <div class="modal" id="applicationModal">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">
              Apply for <span id="modalJobTitle">Frontend Developer</span>
            </h2>
            <button class="close-btn">&times;</button>
          </div>
          <div class="modal-body">
            <form class="application-form">
              <div class="section">
                <h3 style="color: var(--primary-blue-color); margin-bottom: 20px;">
                  Personal Information
                </h3>
                <!-- <div class="form-group">
                  <label class="required">Full Name</label>
                  <input type="text" required />
                </div>
                <div class="form-group">
                  <label class="required">Email Address</label>
                  <input type="email" required />
                </div>
                <div class="form-group">
                  <label class="required">Contact Number</label>
                  <input type="tel" required />
                </div> -->
              </div>

              <div class="section">
                <h3
                  style="
                      color: var(--primary-blue-color);
                      margin-bottom: 20px;
                    ">
                  Application Details
                </h3>
                <div class="form-group">
                  <label>Cover Letter</label>
                  <textarea
                    placeholder="Tell the employer why you're a good fit for this position..."></textarea>
                </div>
                <div class="form-group">
                  <label>How did you hear about this position?</label>
                  <select>
                    <option value="">Select</option>
                    <option>Job Portal</option>
                    <option>Company Website</option>
                    <option>Referral</option>
                    <option>Social Media</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Availability to Start</label>
                  <input type="date" />
                </div>
              </div>

              <div class="section">
                <div
                  style="
                      background-color: var(--light-clr-500);
                      padding: 15px;
                      border-radius: 4px;
                    ">
                  <p style="margin: 0; color: var(--dark-clr-600)">
                    <i
                      class="fas fa-info-circle"
                      style="color: var(--primary-blue-color)"></i>
                    Your resume/CV and other documents from your profile will
                    be automatically included with this application.
                  </p>
                </div>
              </div>

              <div class="form-actions">
                <button
                  type="button"
                  class="btn btn-outline"
                  id="cancelApplication">
                  Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                  Submit Application
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/responsive.js"></script>
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

    // Form Submission
    const applicationForm = document.querySelector('.application-form');
    applicationForm.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Application submitted successfully! Our office will review your application and contact you if you are shortlisted.');
      closeModal();
    });

    // Job Card Expansion
    // const jobDescription = document.querySelectorAll('.job-description');
    // jobDescription.forEach(desc => {
    //   desc.addEventListener('click', function() {
    //     this.classList.toggle('expand');
    //     if (this.classList.contains('expand')) {
    //       this.style.maxHeight = 'none';
    //     } else {
    //       this.style.maxHeight = '100px'; 
    //     }
    //   });
    // });

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


</body>

</html>