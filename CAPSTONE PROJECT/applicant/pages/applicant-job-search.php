<?php
require_once '../../landing/functions/check_login.php';

if(!isset($_SESSION['user_id'])) {
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
              <span class="emoji"><img src="../../public-assets/icons/gauge-high-solid.svg" alt="Dashboard-icon"></span>
              <span class="label">Dashboard</span>
            </a>
          </li>
          <li>

            <a href="./applicant-applications.php">
              <span class="emoji"><img src="../../public-assets/icons/briefcase-solid.svg" alt="Applications-icon"></span>
              <span class="label">My Applications</span>
            </a>
          </li>
          <li>

            <a href="./applicant-job-search.php">
              <span class="emoji"><img src="../../public-assets/icons/magnifying-glass-solid.svg" alt="Job-Search-icon"></span>
              <span class="label">Job Search</span>
            </a>
          </li>
          <li>

            <a href="./applicant-profile.php">
              <span class="emoji"><img src="../../public-assets/icons/user-solid.svg" alt="Profile-icon"></span>
              <span class="label">My Profile</span>
            </a>
          </li>
          <li>

            <a href="../../landing/functions/logout.php">
              <span class="emoji"><img src="../../public-assets/icons/arrow-right-from-bracket-solid.svg" alt="Logout-icon"></span>
              <span class="label">Log Out</span>
            </a>
          </li>
        </ul>
      </aside>

      <main class="main-content">

        <div class="job-header">
          <h2>JOB LISTINGS</h2>
        </div>
        <div class="job-listings">
          <div class="job-card">
            <h3>Software Engineer</h3>
            <p>Company: Tech Innovators</p>
            <p>Location: New York, NY</p>
            <p>Salary: $100,000 - $120,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>Data Analyst</h3>
            <p>Company: Data Insights</p>
            <p>Location: San Francisco, CA</p>
            <p>Salary: $80,000 - $95,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>UI/UX Designer</h3>
            <p>Company: Creative Minds</p>
            <p>Location: Austin, TX</p>
            <p>Salary: $70,000 - $85,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>Software Engineer</h3>
            <p>Company: Tech Innovators</p>
            <p>Location: New York, NY</p>
            <p>Salary: $100,000 - $120,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>Data Analyst</h3>
            <p>Company: Data Insights</p>
            <p>Location: San Francisco, CA</p>
            <p>Salary: $80,000 - $95,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>UI/UX Designer</h3>
            <p>Company: Creative Minds</p>
            <p>Location: Austin, TX</p>
            <p>Salary: $70,000 - $85,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>Software Engineer</h3>
            <p>Company: Tech Innovators</p>
            <p>Location: New York, NY</p>
            <p>Salary: $100,000 - $120,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>Data Analyst</h3>
            <p>Company: Data Insights</p>
            <p>Location: San Francisco, CA</p>
            <p>Salary: $80,000 - $95,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>UI/UX Designer</h3>
            <p>Company: Creative Minds</p>
            <p>Location: Austin, TX</p>
            <p>Salary: $70,000 - $85,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>Software Engineer</h3>
            <p>Company: Tech Innovators</p>
            <p>Location: New York, NY</p>
            <p>Salary: $100,000 - $120,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>Data Analyst</h3>
            <p>Company: Data Insights</p>
            <p>Location: San Francisco, CA</p>
            <p>Salary: $80,000 - $95,000</p>
            <button class="apply-button">Apply Now</button>
          </div>
          <div class="job-card">
            <h3>UI/UX Designer</h3>
            <p>Company: Creative Minds</p>
            <p>Location: Austin, TX</p>
            <p>Salary: $70,000 - $85,000</p>
            <button class="apply-button">Apply Now</button>

        <div class="container-job-search">
          <div class="header">
            <h1>Job Listings</h1>
            <div>Showing 24 jobs</div>
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
            <!-- IT Job -->
            <div class="job-card" data-field="IT">
              <div class="job-field">IT/Software</div>
              <div class="job-header">
                <div>
                  <h3 class="job-title">Frontend Developer</h3>
                  <div class="job-company">Tech Solutions Inc.</div>
                </div>
                <div>
                  <span class="job-salary">₱50,000 - ₱70,000/month</span>
                </div>
              </div>
              <div class="job-meta">
                <span><i class="fas fa-briefcase"></i> Full-time</span>
                <span><i class="fas fa-map-marker-alt"></i> Taguig City</span>
              </div>
              <div class="job-description">
                We're looking for a skilled Frontend Developer with 3+ years
                experience in React.js. You'll be responsible for developing
                user interfaces and implementing responsive web design
                principles.
              </div>
              <div class="job-footer">
                <div class="job-posted">Posted: May 18, 2023</div>
                <button class="apply-btn" data-job-id="101">Apply Now</button>
              </div>
            </div>

            <!-- Engineering Job -->
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

            <!-- Medicine Job -->
            <div class="job-card" data-field="Medicine">
              <div class="job-field">Medicine/Healthcare</div>
              <div class="job-header">
                <div>
                  <h3 class="job-title">Staff Nurse</h3>
                  <div class="job-company">Metro Medical Center</div>
                </div>
                <div>
                  <span class="job-salary">₱35,000 - ₱45,000/month</span>
                </div>
              </div>
              <div class="job-meta">
                <span><i class="fas fa-briefcase"></i> Full-time</span>
                <span><i class="fas fa-map-marker-alt"></i> Manila</span>
              </div>
              <div class="job-description">
                Registered nurses needed for hospital wards. Must have valid PRC
                license and at least 2 years hospital experience. Willing to
                work shifting schedule including nights and weekends.
              </div>
              <div class="job-footer">
                <div class="job-posted">Posted: May 16, 2023</div>
                <button class="apply-btn" data-job-id="103">Apply Now</button>
              </div>
            </div>

            <!-- Business Job -->
            <div class="job-card" data-field="Business">
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
              </div>
              <div class="job-description">
                Looking for a CFA with 4+ years experience in investment
                analysis. Responsibilities include financial modeling, market
                research, and preparing investment recommendations.
              </div>
              <div class="job-footer">
                <div class="job-posted">Posted: May 15, 2023</div>
                <button class="apply-btn" data-job-id="104">Apply Now</button>
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
                  <h3
                    style="
                      color: var(--primary-blue-color);
                      margin-bottom: 20px;
                    "
                  >
                    Personal Information
                  </h3>
                  <div class="form-group">
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
                  </div>
                </div>

                <div class="section">
                  <h3
                    style="
                      color: var(--primary-blue-color);
                      margin-bottom: 20px;
                    "
                  >
                    Application Details
                  </h3>
                  <div class="form-group">
                    <label>Cover Letter</label>
                    <textarea
                      placeholder="Tell the employer why you're a good fit for this position..."
                    ></textarea>
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
                    "
                  >
                    <p style="margin: 0; color: var(--dark-clr-600)">
                      <i
                        class="fas fa-info-circle"
                        style="color: var(--primary-blue-color)"
                      ></i>
                      Your resume/CV and other documents from your profile will
                      be automatically included with this application.
                    </p>
                  </div>
                </div>

                <div class="form-actions">
                  <button
                    type="button"
                    class="btn btn-outline"
                    id="cancelApplication"
                  >
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
    </script>

  </body>
</html>
