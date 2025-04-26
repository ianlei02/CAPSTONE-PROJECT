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
    <title>Company Profile</title>
    <link rel="stylesheet" href="../css/navs.css">

    <style>
      :root {
        --primary: #0055a5;
        --primary-light: #e6f0fa;
        --secondary: #4caf50;
        --dark: #333;
        --light: #f5f5f5;
        --border: #ddd;
      }
      .profile-container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
      }

      .profile-header {
        background-color: var(--primary);
        color: white;
        padding: 30px;
        position: relative;
        min-height: 180px;
      }

      .company-logo-container {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: white;
        border: 3px solid white;
        position: absolute;
        bottom: -60px;
        left: 50px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
      }

      .company-logo {
        max-width: 100%;
        max-height: 100%;
        display: block;
      }

      .upload-logo {
        display: none;
      }

      .profile-actions {
        position: absolute;
        right: 30px;
        top: 30px;
      }

      .btn {
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        border: none;
        transition: all 0.3s;
      }

      .btn-outline {
        background: transparent;
        color: white;
        border: 1px solid white;
      }

      .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
      }

      .btn-primary {
        background-color: var(--primary);
        color: white;
      }

      .profile-content {
        padding: 80px 30px 30px;
      }

      .section {
        margin-bottom: 30px;
      }

      .section-title {
        color: var(--primary);
        border-bottom: 2px solid var(--primary-light);
        padding-bottom: 8px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .edit-btn {
        background: none;
        border: none;
        color: var(--primary);
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
      }

      .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
      }

      .info-item {
        margin-bottom: 15px;
      }

      .info-label {
        display: block;
        color: var(--dark);
        margin-bottom: 5px;
        font-weight: 500;
      }

      .info-value {
        padding: 10px;
        border-radius: 4px;
        background-color: var(--light);
        min-height: 40px;
        display: flex;
        align-items: center;
      }

      .editable {
        background-color: white;
        border: 1px solid var(--border);
        cursor: text;
      }

      .editable:focus {
        outline: 2px solid var(--primary-light);
      }

      .document-list {
        list-style: none;
        padding: 0;
      }

      .document-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid var(--border);
        border-radius: 4px;
        margin-bottom: 10px;
      }

      .document-icon {
        margin-right: 15px;
        color: var(--primary);
        font-size: 24px;
      }

      .document-info {
        flex: 1;
      }

      .document-name {
        font-weight: 500;
        margin-bottom: 5px;
      }

      .document-date {
        color: #666;
        font-size: 14px;
      }

      .document-actions a {
        color: var(--primary);
        text-decoration: none;
        margin-left: 10px;
        font-size: 14px;
      }

      .save-cancel-btns {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 20px;
        display: none;
      }

      @media (max-width: 768px) {
        .company-logo-container {
          left: 30px;
          width: 100px;
          height: 100px;
          bottom: -50px;
        }

        .profile-actions {
          position: static;
          margin-bottom: 20px;
        }

        .profile-content {
          padding-top: 60px;
        }
      }
    </style>
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

                <a href="./employer-dashboard.php">

                  <span class="emoji"><img src="../../public-assets/icons/gauge-high-solid.svg" alt=""></span>
                  <span class="label">Dashboard</span>
                </a>
              </li>
              <li>

                <a href="./employer-applications.php">

                  <span class="emoji"><img src="../../public-assets/icons/briefcase-solid.svg" alt=""></span>
                  <span class="label">Job Applications</span>
                </a>
              </li>
              <li>

                <a href="./applicant-job-search.php">

                  <span class="emoji"><img src="../../public-assets/icons/magnifying-glass-solid.svg" alt=""></span>
                  <span class="label">Applicant Search</span>
                </a>
              </li>
              <li>

                <a href="./employer-profile.php">

                  <span class="emoji"><img src="../../public-assets/icons/user-solid.svg" alt=""></span>
                  <span class="label">My Profile</span>
                </a>
              </li>
              <li>

                <a href="../../landing/functions/logout.php">

                  <span class="emoji"><img src="../../public-assets/icons/arrow-right-from-bracket-solid.svg" alt=""></span>
                  <span class="label">Log Out</span>
                </a>
              </li>
            </ul>
          </aside>

      <main class="main-content">
        <div class="profile-container">
          <div class="profile-header">
            <h1 id="companyName">ABC Manufacturing Inc.</h1>
            <p id="companyIndustry">
              Industrial Machinery Manufacturing | Established 2005
            </p>

            <div class="profile-actions">
              <button class="btn btn-outline" id="editProfileBtn">
                Edit Profile
              </button>
            </div>

            <div class="company-logo-container" id="logoContainer">
              <img
                src="https://via.placeholder.com/120"
                alt="Company Logo"
                class="company-logo"
                id="companyLogo"
              />
              <input
                type="file"
                id="uploadLogo"
                class="upload-logo"
                accept="image/*"
              />
            </div>
          </div>

          <div class="profile-content">
            <div class="section">
              <h2 class="section-title">
                Company Information
                <button class="edit-btn" id="editCompanyInfoBtn">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                    ></path>
                    <path
                      d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                    ></path>
                  </svg>
                  Edit
                </button>
              </h2>
              <div class="info-grid">
                <div class="info-item">
                  <span class="info-label">Company Type</span>
                  <div class="info-value" id="companyType">Corporation</div>
                </div>
                <div class="info-item">
                  <span class="info-label">Industry</span>
                  <div class="info-value" id="industry">Manufacturing</div>
                </div>
                <div class="info-item">
                  <span class="info-label">Company Size</span>
                  <div class="info-value" id="companySize">
                    201-500 employees
                  </div>
                </div>
                <div class="info-item">
                  <span class="info-label">Address</span>
                  <div class="info-value" id="companyAddress">
                    123 Industrial Park, Laguna Technopark, Biñan, Laguna
                  </div>
                </div>
                <div class="info-item">
                  <span class="info-label">Contact Number</span>
                  <div class="info-value" id="contactNumber">
                    (049) 511-2233
                  </div>
                </div>
                <div class="info-item">
                  <span class="info-label">Email</span>
                  <div class="info-value" id="companyEmail">hr@abcmfg.com</div>
                </div>
                <div class="info-item">
                  <span class="info-label">Website</span>
                  <div class="info-value" id="companyWebsite">
                    www.abcmfg.com
                  </div>
                </div>
              </div>
              <div class="save-cancel-btns" id="companyInfoBtns">
                <button class="btn btn-primary" id="saveCompanyInfo">
                  Save
                </button>
                <button class="btn btn-outline" id="cancelCompanyInfo">
                  Cancel
                </button>
              </div>
            </div>

            <div class="section">
              <h2 class="section-title">
                Primary Contact
                <button class="edit-btn" id="editContactBtn">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                    ></path>
                    <path
                      d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                    ></path>
                  </svg>
                  Edit
                </button>
              </h2>
              <div class="info-grid">
                <div class="info-item">
                  <span class="info-label">Contact Person</span>
                  <div class="info-value" id="contactPerson">
                    Maria Dela Cruz
                  </div>
                </div>
                <div class="info-item">
                  <span class="info-label">Position</span>
                  <div class="info-value" id="contactPosition">HR Manager</div>
                </div>
                <div class="info-item">
                  <span class="info-label">Mobile Number</span>
                  <div class="info-value" id="contactMobile">0917-123-4567</div>
                </div>
                <div class="info-item">
                  <span class="info-label">Email</span>
                  <div class="info-value" id="contactEmail">
                    maria.delacruz@abcmfg.com
                  </div>
                </div>
              </div>
              <div class="save-cancel-btns" id="contactBtns">
                <button class="btn btn-primary" id="saveContactInfo">
                  Save
                </button>
                <button class="btn btn-outline" id="cancelContactInfo">
                  Cancel
                </button>
              </div>
            </div>

            <div class="section">
              <h2 class="section-title">Company Documents</h2>
              <ul class="document-list">
                <li class="document-item">
                  <div class="document-icon">📄</div>
                  <div class="document-info">
                    <div class="document-name">SEC Registration</div>
                    <div class="document-date">Uploaded: January 15, 2023</div>
                  </div>
                  <div class="document-actions">
                    <a href="#" class="view-doc">View</a>
                    <a href="#" class="update-doc">Update</a>
                  </div>
                </li>
                <li class="document-item">
                  <div class="document-icon">📄</div>
                  <div class="document-info">
                    <div class="document-name">Business Permit</div>
                    <div class="document-date">Uploaded: January 20, 2023</div>
                  </div>
                  <div class="document-actions">
                    <a href="#" class="view-doc">View</a>
                    <a href="#" class="update-doc">Update</a>
                  </div>
                </li>
              </ul>
              <button class="btn btn-outline" style="margin-top: 10px">
                + Add Document
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>

    <script src="../js/responsive.js"></script>
    <script>
      // Edit Mode Toggle
      let editMode = false;
      let originalValues = {};

      // Toggle edit mode for company info
      document
        .getElementById("editCompanyInfoBtn")
        .addEventListener("click", function () {
          toggleEditMode("company");
        });

      // Toggle edit mode for contact info
      document
        .getElementById("editContactBtn")
        .addEventListener("click", function () {
          toggleEditMode("contact");
        });

      // Save company info
      document
        .getElementById("saveCompanyInfo")
        .addEventListener("click", function () {
          saveChanges("company");
        });

      // Cancel company info edit
      document
        .getElementById("cancelCompanyInfo")
        .addEventListener("click", function () {
          cancelEdit("company");
        });

      // Save contact info
      document
        .getElementById("saveContactInfo")
        .addEventListener("click", function () {
          saveChanges("contact");
        });

      // Cancel contact info edit
      document
        .getElementById("cancelContactInfo")
        .addEventListener("click", function () {
          cancelEdit("contact");
        });

      // Logo upload functionality
      document
        .getElementById("logoContainer")
        .addEventListener("click", function () {
          if (editMode) {
            document.getElementById("uploadLogo").click();
          }
        });

      document
        .getElementById("uploadLogo")
        .addEventListener("change", function (e) {
          if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (event) {
              document.getElementById("companyLogo").src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
          }
        });

      // Document actions
      document.querySelectorAll(".view-doc").forEach((link) => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          const docName =
            this.closest(".document-item").querySelector(
              ".document-name"
            ).textContent;
          alert(`Viewing ${docName}`);
        });
      });

      document.querySelectorAll(".update-doc").forEach((link) => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          const docName =
            this.closest(".document-item").querySelector(
              ".document-name"
            ).textContent;
          alert(`Updating ${docName}`);
        });
      });

      // Main edit mode function
      function toggleEditMode(section) {
        editMode = true;
        document.getElementById("editProfileBtn").textContent = "Editing...";

        const fields = {
          company: [
            "companyType",
            "industry",
            "companySize",
            "companyAddress",
            "contactNumber",
            "companyEmail",
            "companyWebsite",
          ],
          contact: [
            "contactPerson",
            "contactPosition",
            "contactMobile",
            "contactEmail",
          ],
        };

        // Store original values
        fields[section].forEach((field) => {
          const element = document.getElementById(field);
          originalValues[field] = element.textContent;

          // Make editable
          element.contentEditable = true;
          element.classList.add("editable");
          element.focus();
        });

        // Show save/cancel buttons
        document.getElementById(`${section}InfoBtns`).style.display = "flex";
      }

      function saveChanges(section) {
        editMode = false;
        document.getElementById("editProfileBtn").textContent = "Edit Profile";

        const fields = {
          company: [
            "companyType",
            "industry",
            "companySize",
            "companyAddress",
            "contactNumber",
            "companyEmail",
            "companyWebsite",
          ],
          contact: [
            "contactPerson",
            "contactPosition",
            "contactMobile",
            "contactEmail",
          ],
        };

        fields[section].forEach((field) => {
          const element = document.getElementById(field);
          element.contentEditable = false;
          element.classList.remove("editable");
        });

        // Hide save/cancel buttons
        document.getElementById(`${section}InfoBtns`).style.display = "none";

        // In a real app, you would save to server here
        alert(
          `${
            section.charAt(0).toUpperCase() + section.slice(1)
          } information updated!`
        );
      }

      function cancelEdit(section) {
        editMode = false;
        document.getElementById("editProfileBtn").textContent = "Edit Profile";

        const fields = {
          company: [
            "companyType",
            "industry",
            "companySize",
            "companyAddress",
            "contactNumber",
            "companyEmail",
            "companyWebsite",
          ],
          contact: [
            "contactPerson",
            "contactPosition",
            "contactMobile",
            "contactEmail",
          ],
        };

        fields[section].forEach((field) => {
          const element = document.getElementById(field);
          element.textContent = originalValues[field];
          element.contentEditable = false;
          element.classList.remove("editable");
        });

        // Hide save/cancel buttons
        document.getElementById(`${section}InfoBtns`).style.display = "none";
      }
    </script>
  </body>
</html>

