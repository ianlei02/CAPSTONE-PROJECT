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
          <a href="../../landing/index.php">
            <span class="emoji"><img src="../../public-assets/icons/arrow-right-from-bracket-solid.svg" alt="Logout-icon"></span>
            <span class="label">Log Out</span>
          </a>
        </li>
      </ul>
    </aside>

    <main class="main-content">
      <div class="profile-container">

        <div class="section">
          <div class="profile-header">
            <label
              class="profile-pic-container"
              id="profilePicContainer"
              form="profilePicInput">
              <img
                src=""
                alt="Profile Picture"
                class="profile-pic"
                id="profilePic" />
              <div class="upload-icon">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2">
                  ['\\ ']
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="17 8 12 3 7 8"></polyline>
                  <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
              </div>
              <input
                type="file"
                id="profilePicInput"
                class="profile-pic-input"
                accept="image/*" />
            </label>
            <h1>My Profile</h1>
            <p>Complete your profile to increase job opportunities</p>
          </div>

          <div class="profile-content">
            <form action="../Functions/profile_update.php" method="POST" id="profileForm" enctype="multipart/form-data">
              <!-- Personal Information Section -->
              <div class="section">
                <h2 class="section-title">Personal Information</h2>
                <div class="form-grid">
                  <div class="form-group">
                    <label class="required">First Name</label>
                    <input type="text" id="firstName" required />
                  </div>
                  <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" id="middleName" name="middleName" />
                  </div>
                  <div class="form-group">
                    <label class="required">Last Name</label>
                    <input type="text" id="lastName" required />
                  </div>
                  <div class="form-group">
                    <label>Suffix</label>
                    <input
                      type="text"
                      id="suffix"
                      placeholder="Jr., Sr., III" name="suffix"/>
                  </div>
                  <div class="form-group">
                    <label class="required">Gender</label>
                    <select id="gender" name="gender" required>
                      <option value="">Select</option>
                      <option>Male</option>
                      <option>Female</option>
                      <option>Other</option>
                      <option>Prefer not to say</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="required">Date of Birth</label>
                    <input type="date" id="birthDate" name="birthDate" required />
                  </div>
                  <div class="form-group">
                    <label class="required">Civil Status</label>
                    <select id="civilStatus" name="civilStatus" required>
                      <option value="">Select</option>
                      <option>Single</option>
                      <option>Married</option>
                      <option>Separated</option>
                      <option>Widowed</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="required">Nationality</label>
                    <input
                      type="text"
                      id="nationality"
                      value="Filipino"
                      name="nationality" required />
                  </div>
                </div>
              </div>

              <!-- Contact Information Section -->
              <div class="section">
                <h2 class="section-title">Contact Information</h2>
                <div class="form-grid">
                  <div class="form-group">
                    <label class="required">Email Address</label>
                    <input type="email" id="email" required />
                  </div>
                  <div class="form-group">
                    <label class="required">Mobile Number</label>
                    <input
                      type="tel"
                      id="mobile"
                      placeholder="09123456789" name="mobileNumber"
                      required />
                  </div>
                  <div class="form-group">
                    <label>Alternate Contact Number</label>
                    <input type="tel" id="alternateMobile" name="alternateContact" />
                  </div>
                  <div class="form-group" style="grid-column: span 2">
                    <label class="required">Complete Address</label>
                    <input
                      type="text"
                      id="street"
                      placeholder="Street Address" name="streetAddress"
                      required
                      style="margin-bottom: 10px" />
                    <div
                      style="
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 10px;
                      ">
                      <select id="region" name="region" required>
                        <option value="">Select Region</option>
                        <option>NCR</option>
                        <option>Region I</option>
                        <option>Region II</option>
                      </select>
                      <select id="province" name="province" required>
                        <option value="">Select Province</option>
                        <option>Metro Manila</option>
                        <option>Bulacan</option>
                        <option>Cavite</option>
                      </select>
                      <select id="city" name="cityMunicipality" required>
                        <option value="">Select City/Municipality</option>
                        <option>Quezon City</option>
                        <option>Manila</option>
                        <option>Makati</option>
                      </select>
                      <input
                        type="text"
                        id="barangay"
                        placeholder="Barangay" name="barangay"
                        required />
                    </div>
                  </div>
                </div>
              </div>

              <!-- Education Section -->
              <div class="section">
                <h2 class="section-title">Education Background</h2>
                <div id="educationEntries">
                  <div class="form-grid education-entry">
                    <div class="form-group">
                      <label class="required">Education Level</label>
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
                      <label class="required">School Name</label>
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
                <button type="button" class="add-btn" id="addEducation">
                  + Add Education
                </button>
              </div>

              <!-- Work Experience Section -->
              <div class="section">
                <h2 class="section-title">Work Experience</h2>
                <div id="experienceEntries">
                  <div class="form-grid experience-entry">
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" />
                    </div>
                    <div class="form-group">
                      <label>Position</label>
                      <input type="text" />
                    </div>
                    <div class="form-group">
                      <label>Industry</label>
                      <select>
                        <option value="">Select</option>
                        <option>Agriculture</option>
                        <option>Construction</option>
                        <option>Manufacturing</option>
                        <option>Retail</option>
                        <option>IT/BPO</option>
                      </select>
                    </div>
                    <div class="form-group" style="grid-column: span 2">
                      <label>Employment Period</label>
                      <div style="display: flex; gap: 10px">
                        <input
                          type="month"
                          placeholder="From"
                          style="flex: 1" />
                        <input type="month" placeholder="To" style="flex: 1" />
                      </div>
                    </div>
                    <div class="form-group" style="grid-column: span 3">
                      <label>Key Responsibilities</label>
                      <textarea rows="4"></textarea>
                    </div>
                  </div>
                </div>
                <button type="button" class="add-btn" id="addExperience">
                  + Add Work Experience
                </button>
              </div>

              <!-- Skills Section -->
              <div class="section">
                <h2 class="section-title">Skills & Qualifications</h2>
                <div class="form-grid">
                  <div class="form-group">
                    <label class="required">Primary Skills</label>
                    <input id="primarySkills" multiple style="height: auto" name="primarySkills" placeholder="Add skills separated by commas">
                    <!-- <option>Computer Literacy</option>
                      <option>Customer Service</option>
                      <option>Microsoft Office</option>
                      <option>Accounting</option>
                      <option>Graphic Design</option> -->
                    </input>
                    <div class="skills-container" id="selectedSkills">
                      <!-- Selected skills will appear here -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Technical Skills</label>
                    <input
                      type="text"
                      id="techSkills" name="technicalSkills"
                      placeholder="Add skills separated by commas" />
                  </div>
                  <div class="form-group">
                    <label>Language Proficiency</label>
                    <div class="language-entry">
                      <div
                        style="display: flex; gap: 10px; margin-bottom: 10px">
                        <select style="flex: 1" name="language" id="language">
                          <option>English</option>
                          <option>Filipino</option>
                          <option>Other</option>
                        </select>
                        <select style="flex: 1" name="proficiencyLevel" id="proficiencyLevel">
                          <option>Basic</option>
                          <option>Intermediate</option>
                          <option>Advanced</option>
                          <option>Fluent</option>
                        </select>
                      </div>
                    </div>
                    <button
                      type="button"
                      class="add-btn"
                      style="margin-top: 10px">
                      + Add Language
                    </button>
                  </div>
                </div>
              </div>

              <!-- Documents Section -->
              <div class="section">
                <h2 class="section-title">Documents</h2>
                <div class="form-grid">
                  <div class="form-group">
                    <label class="required">Resume/CV</label>
                    <label class="file-upload" id="resumeUpload" for="resumeFile">
                      <p>Drag & drop your file here or click to browse</p>
                      <input type="file" class="file-input" id="resumeFile" name="resumeFile" />
                    </label>
                    <div class="file-preview" id="resumePreview"></div>
                  </div>
                  <div class="form-group">
                    <label>Valid ID (Government Issued)</label>
                    <label class="file-upload" id="idUpload" for="idFile">
                      <p>Upload scanned copy</p>
                      <input type="file" class="file-input" id="idFile" name="idFile" />
                    </label>
                    <div class="file-preview" id="idPreview"></div>
                  </div>
                  <div class="form-group">
                    <label>Other Certifications</label>
                    <label class="file-upload" id="certUpload" for="certFiles">
                      <p>Upload additional documents</p>
                      <input
                        type="file"
                        class="file-input"
                        id="certFiles" name="certFiles[]"
                        multiple />
                    </label>
                    <div class="file-preview" id="certPreview"></div>
                  </div>
                </div>
              </div>

              <div class="form-actions">
                <button type="button" class="btn btn-outline" id="cancelBtn">
                  Cancel
                </button>
                <button type="submit" class="btn btn-primary" id="saveBtn">
                  Save Profile
                </button>
              </div>
            </form>

          </div>
        </div>
    </main>
  </div>

  <script src="../js/responsive.js"></script>
  <!-- <script>
    // Add Education Entry
    document
      .getElementById("addEducation")

      .addEventListener("click", function() {
        const educationEntry = document
          .querySelector(".education-entry")
          .cloneNode(true);
        document

          .getElementById("educationEntries")
          .appendChild(educationEntry);

        // Clear the cloned inputs

        const inputs = educationEntry.querySelectorAll("input, select");
        inputs.forEach((input) => (input.value = ""));
      });


    // Add Work Experience Entry
    document
      .getElementById("addExperience")

      .addEventListener("click", function() {
        const experienceEntry = document
          .querySelector(".experience-entry")
          .cloneNode(true);
        document

          .getElementById("experienceEntries")
          .appendChild(experienceEntry);

        // Clear the cloned inputs

        const inputs = experienceEntry.querySelectorAll(
          "input, select, textarea"
        );
        inputs.forEach((input) => (input.value = ""));
      });


    // Skills Selection
    document
      .getElementById("primarySkills")
      .addEventListener("change", function() {
        const selectedSkills = document.getElementById("selectedSkills");

        selectedSkills.innerHTML = "";

        Array.from(this.selectedOptions).forEach((option) => {
          const skillTag = document.createElement("div");
          skillTag.className = "skill-tag";
          skillTag.innerHTML = `
                    ${option.text}
                    <button type="button">&times;</button>
                `;
          selectedSkills.appendChild(skillTag);


          // Add remove functionality

          skillTag
            .querySelector("button")
            .addEventListener("click", function() {
              option.selected = false;
              skillTag.remove();
            });
        });
      });


    // File Upload Handling
    function setupFileUpload(uploadDivId, fileInputId, previewDivId) {
      const uploadDiv = document.getElementById(uploadDivId);
      const fileInput = document.getElementById(fileInputId);
      const previewDiv = document.getElementById(previewDivId);

      uploadDiv.addEventListener("click", function() {
        fileInput.click();
      });

      fileInput.addEventListener("change", function() {
        if (this.files.length > 0) {

          uploadDiv.querySelector("p").textContent = this.files[0].name;
        }
      });

      uploadDiv.addEventListener("dragover", function(e) {
        e.preventDefault();
        this.style.borderColor = "var(--dole-blue)";
        this.style.backgroundColor = "var(--dole-light-blue)";
      });

      uploadDiv.addEventListener("dragleave", function() {
        this.style.borderColor = "#ccc";

        if (this.files.length > 1) {
          previewDiv.textContent = `${this.files.length} files selected`;
        } else {
          previewDiv.textContent = this.files[0].name;
        }

      });

      // Drag and drop functionality
      uploadDiv.addEventListener("dragover", function(e) {
        e.preventDefault();
        this.style.borderColor = "var(--primary)";
        this.style.backgroundColor = "var(--primary-light)";
      });

      uploadDiv.addEventListener("dragleave", function() {

        this.style.backgroundColor = "transparent";
      });

      uploadDiv.addEventListener("drop", function(e) {
        e.preventDefault();

        this.style.borderColor = "var(--border)";

        this.style.backgroundColor = "transparent";

        if (e.dataTransfer.files.length > 0) {
          fileInput.files = e.dataTransfer.files;

          uploadDiv.querySelector("p").textContent = fileInput.files[0].name;
        }
      });

      document
        .querySelector(".save-btn")
        .addEventListener("click", function() {
          alert("Profile saved successfully!");

          if (fileInput.files.length > 1) {
            previewDiv.textContent = `${fileInput.files.length} files selected`;
          } else {
            previewDiv.textContent = fileInput.files[0].name;
          }

        });


      // Setup file uploads
      setupFileUpload("resumeUpload", "resumeFile", "resumePreview");
      setupFileUpload("idUpload", "idFile", "idPreview");
      setupFileUpload("certUpload", "certFiles", "certPreview");

      // Form Submission
      document
        .getElementById("profileForm")
        .addEventListener("submit", function(e) {
          e.preventDefault();
          alert("Profile saved successfully!");
          // In a real implementation, this would send data to your server
        });

      // Cancel Button
      document.getElementById("cancelBtn").addEventListener("click", function() {
        if (
          confirm(
            "Are you sure you want to cancel? Any unsaved changes will be lost."
          )
        ) {
          // In a real implementation, this might redirect back to dashboard
          alert("Changes discarded");
        }
      });
    }
  </script> -->
</body>
</html>