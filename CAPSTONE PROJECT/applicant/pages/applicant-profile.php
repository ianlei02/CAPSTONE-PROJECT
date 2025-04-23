<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Applicant Dashboard</title>
    <link rel="stylesheet" href="../css/applicant-profile.css" />
    <link rel="stylesheet" href="../css/navs.css" />
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
            <a href="./applicant-applications.html">
              <span class="emoji"><img src="../../public-assets/icons/briefcase-solid.svg" alt="Applications-icon"></span>
              <span class="label">My Applications</span>
            </a>
          </li>
          <li>
            <a href="./applicant-job-search.html">
              <span class="emoji"><img src="../../public-assets/icons/magnifying-glass-solid.svg" alt="Job-Search-icon"></span>
              <span class="label">Job Search</span>
            </a>
          </li>
          <li>
            <a href="./applicant-profile.html">
              <span class="emoji"><img src="../../public-assets/icons/user-solid.svg" alt="Profile-icon"></span>
              <span class="label">My Profile</span>
            </a>
          </li>
          <li>
            <a href="../../landing/index.html">
              <span class="emoji"><img src="../../public-assets/icons/arrow-right-from-bracket-solid.svg" alt="Logout-icon"></span>
              <span class="label">Log Out</span>
            </a>
          </li>
        </ul>
      </aside>

      <main class="main-content">
        <div class="profile-container">
          <div class="header">
            <h1>Applicant Profile</h1>
            <button class="save-btn">Save Profile</button>
          </div>

          <!-- Personal Information Section -->
          <div class="section">
            <div class="section-header">Personal Information</div>
            <div class="form-grid">
              <div class="form-group">
                <label class="required">First Name</label>
                <input type="text" required />
              </div>
              <div class="form-group">
                <label>Middle Name</label>
                <input type="text" />
              </div>
              <div class="form-group">
                <label class="required">Last Name</label>
                <input type="text" required />
              </div>
              <div class="form-group">
                <label>Suffix</label>
                <input type="text" placeholder="Jr., Sr., III" />
              </div>
              <div class="form-group">
                <label class="required">Gender</label>
                <select required>
                  <option value="">Select</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label class="required">Date of Birth</label>
                <input type="date" required />
              </div>
              <div class="form-group">
                <label class="required">Civil Status</label>
                <select required>
                  <option value="">Select</option>
                  <option>Single</option>
                  <option>Married</option>
                  <option>Divorced</option>
                  <option>Widowed</option>
                </select>
              </div>
              <div class="form-group">
                <label class="required">Nationality</label>
                <input type="text" value="Filipino" required />
              </div>
              <div class="form-group">
                <label class="required">Contact Number</label>
                <input type="tel" placeholder="09123456789" required />
              </div>
              <div class="form-group">
                <label class="required">Email Address</label>
                <input type="email" required />
              </div>
              <div class="form-group">
                <label class="required">Complete Address</label>
                <select required>
                  <option value="">Select Region</option>
                  <option>NCR</option>
                  <option>Region I</option>
                  <option>Region II</option>
                  <option>Region III</option>
                  <option>Region IV</option>
                  <option>Region V</option>
                  <option>Region VI</option>
                  <option>Region VII</option>
                  <!-- More regions -->
                </select>
                <input type="text" placeholder="Province" style="margin-top: 10px;" required />
                <input
                  type="text"
                  placeholder="City/Municipality"
                  required
                  style="margin-top: 10px"
                />
                <input
                  type="text"
                  placeholder="Barangay and Street"
                  required
                  style="margin-top: 10px"
                />
              </div>
            </div>
          </div>

          <!-- Education Section -->
          <div class="section">
            <div class="section-header">Education & Training</div>
            <div id="education-entries">
              <div class="education-entry form-grid">
                <div class="form-group">
                  <label class="required">Highest Educational Level</label>
                  <select required>
                    <option value="">Select</option>
                    <option>Elementary</option>
                    <option>High School</option>
                    <option>Vocational</option>
                    <option>College</option>
                    <option>Postgraduate</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="required">School/Institution</label>
                  <input type="text" required />
                </div>
                <div class="form-group">
                  <label>Course/Degree</label>
                  <input type="text" />
                </div>
                <div class="form-group">
                  <label>Year Graduated</label>
                  <input type="number" min="1900" max="2099" />
                </div>
              </div>
            </div>
            <button class="add-btn" id="add-education">+ Add Education</button>
          </div>

          <!-- Work Experience Section -->
          <div class="section">
            <div class="section-header">Work Experience</div>
            <div id="experience-entries">
              <div class="experience-entry form-grid">
                <div class="form-group">
                  <label class="required">Company Name</label>
                  <input type="text" required />
                </div>
                <div class="form-group">
                  <label class="required">Position</label>
                  <input type="text" required />
                </div>
                <div class="form-group">
                  <label class="required">Industry</label>
                  <select required>
                    <option value="">Select</option>
                    <option>Agriculture</option>
                    <option>Construction</option>
                    <option>Manufacturing</option>
                    <option>Retail</option>
                    <option>IT/BPO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="required">Employment Period</label>
                  <br>
                  <div style="display: flex; gap: 10px">
                    <label for="from-date" style="margin-top: 8px;">From</label>
                    <input
                    type="month"
                    placeholder="From"
                    id="from-date"
                    required
                    style="flex: 1"
                    />
                    <label for="to-date" style="margin-top: 8px;">To</label>
                    <input
                    id="to-date"
                      type="month"
                      placeholder="To"
                      style="flex: 1"
                      required
                    />
                  </div>
                </div>
                <div class="form-group" style="grid-column: span 3">
                  <label>Key Responsibilities</label>
                  <textarea rows="3" columns="10"></textarea>
                </div>
              </div>
            </div>
            <button class="add-btn" id="add-experience">
              + Add Work Experience
            </button>
          </div>

          <!-- Skills Section -->
          <div class="section">
            <div class="section-header">Skills & Qualifications</div>
            <div class="form-grid">
              <div class="form-group">
                <label class="required">Primary Skills</label>
                <select id="primary-skills" multiple style="height: auto">
                  <option>Computer Literacy</option>
                  <option>Welding</option>
                  <option>Driving</option>
                  <option>Customer Service</option>
                  <option>Bookkeeping</option>
                </select>
                <div class="skills-container" id="selected-skills">
                  <!-- Dito lalabas skills -->
                </div>
              </div>
              <div class="form-group">
                <label>Technical Skills</label>
                <input
                  type="text"
                  id="tech-skill-input"
                  placeholder="Add skills separated by commas"
                />
              </div>
            </div>

            <div class="form-grid" style="margin-top: 20px">
              <div class="form-group">
                <label>Language Proficiency</label>
                <div class="language-entry">
                  <div style="display: flex; gap: 10px; margin-bottom: 10px">
                    <select style="flex: 1">
                      <option>English</option>
                      <option>Filipino</option>
                      <option>Other</option>
                    </select>
                    <select style="flex: 1">
                      <option>Basic</option>
                      <option>Intermediate</option>
                      <option>Advanced</option>
                      <option>Fluent</option>
                    </select>
                  </div>
                  <div class="language-progress">
                    <!-- <div class="progress-bar" style="width: 75%"></div> -->
                  </div>
                </div>
                <button class="add-btn" style="margin-top: 10px">
                  + Add Language
                </button>
              </div>
            </div>
          </div>

          <div class="section">
            <div class="section-header">Government IDs & Documents</div>
            <div class="form-grid">
              <div class="form-group">
                <label class="required">Resume/CV</label>
                <div class="file-upload">
                  <p>Drag & drop your file here or click to browse</p>
                  <input type="file" style="display: none" />
                </div>
              </div>
              <div class="form-group">
                <label>PSA Birth Certificate</label>
                <div class="file-upload">
                  <p>Upload scanned copy</p>
                  <input type="file" style="display: none" />
                </div>
              </div>
              <div class="form-group">
                <label class="required">Valid ID</label>
                <select required>
                  <option value="">Select ID Type</option>
                  <option>UMID</option>
                  <option>Passport</option>
                  <option>Driver's License</option>
                  <option>SSS ID</option>
                </select>
                <div class="file-upload" style="margin-top: 10px">
                  <p>Upload scanned copy</p>
                  <input type="file" style="display: none" />
                </div>
              </div>
              <div class="form-group">
                <label>Diploma/TOR</label>
                <div class="file-upload">
                  <p>Upload scanned copy</p>
                  <input type="file" style="display: none" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- <script>

      document.addEventListener("DOMContentLoaded", function () {
        const hamburger = document.querySelector(".hamburger");
        const sidebar = document.querySelector(".sidebar");

        function isMobile() {
          return window.matchMedia("(max-width: 767px)").matches;
        }
        hamburger.addEventListener("click", function () {
          if (isMobile()) {
            sidebar.classList.toggle("visible");
          } else {
            sidebar.classList.toggle("collapsed");
          }
        });
        function initSidebar() {
          if (isMobile()) {
            sidebar.classList.remove("collapsed");
            sidebar.classList.remove("visible");
          } else {
            sidebar.classList.remove("visible");
          }
        }
        window.addEventListener("resize", initSidebar);
        initSidebar();
      });
    </script> -->
    <script src="../js/responsive.js"></script>
    <script>
      document
        .getElementById("add-education")
        .addEventListener("click", function () {
          const educationEntry = document
            .querySelector(".education-entry")
            .cloneNode(true);
          document
            .getElementById("education-entries")
            .appendChild(educationEntry);

          const inputs = educationEntry.querySelectorAll("input, select");
          inputs.forEach((input) => (input.value = ""));
        });

      document
        .getElementById("add-experience")
        .addEventListener("click", function () {
          const experienceEntry = document
            .querySelector(".experience-entry")
            .cloneNode(true);
          document
            .getElementById("experience-entries")
            .appendChild(experienceEntry);

          const inputs = experienceEntry.querySelectorAll(
            "input, select, textarea"
          );
          inputs.forEach((input) => (input.value = ""));
        });

      document
        .getElementById("primary-skills")
        .addEventListener("change", function () {
          const selectedSkills = document.getElementById("selected-skills");
          selectedSkills.innerHTML = "";

          Array.from(this.selectedOptions).forEach((option) => {
            const skillTag = document.createElement("div");
            skillTag.className = "skill-tag";
            skillTag.innerHTML = `
                    ${option.text}
                    <button type="button">&times;</button>
                `;
            selectedSkills.appendChild(skillTag);

            skillTag
              .querySelector("button")
              .addEventListener("click", function () {
                option.selected = false;
                skillTag.remove();
              });
          });
        });

      document.querySelectorAll(".file-upload").forEach((uploadDiv) => {
        const fileInput = uploadDiv.querySelector('input[type="file"]');

        uploadDiv.addEventListener("click", function () {
          fileInput.click();
        });

        fileInput.addEventListener("change", function () {
          if (this.files.length > 0) {
            uploadDiv.querySelector("p").textContent = this.files[0].name;
          }
        });

        uploadDiv.addEventListener("dragover", function (e) {
          e.preventDefault();
          this.style.borderColor = "var(--dole-blue)";
          this.style.backgroundColor = "var(--dole-light-blue)";
        });

        uploadDiv.addEventListener("dragleave", function () {
          this.style.borderColor = "#ccc";
          this.style.backgroundColor = "transparent";
        });

        uploadDiv.addEventListener("drop", function (e) {
          e.preventDefault();
          this.style.borderColor = "#ccc";
          this.style.backgroundColor = "transparent";

          if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            uploadDiv.querySelector("p").textContent = fileInput.files[0].name;
          }
        });
      });

      document
        .querySelector(".save-btn")
        .addEventListener("click", function () {
          alert("Profile saved successfully!");
        });
    </script>
  </body>
</html>
