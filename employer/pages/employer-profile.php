<?php
require_once '../../landing/functions/check_login.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../../landing/login-signup.php");
    exit();
} 

$userId = $_SESSION['user_id'];

$accountStmt = $conn->prepare("SELECT * FROM employer_company_info WHERE employer_ID = ?");
$accountStmt->bind_param("s", $userId);
$accountStmt->execute();
$accountResult = $accountStmt->get_result();
$accountData = $accountResult->fetch_assoc();

$accountJson = json_encode($accountData ?: []);

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
        background-color: white;
        color: var(--primary);
        border: 1px solid  white;
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
      .update-doc{
        font-size: .85rem;
        color: var(--primary);
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
        <form action="../Functions/profile_update.php" method="POST" enctype="multipart/form-data" class="profile-container">
          <div class="profile-header">
            <h1 id="companyName">ABC Manufacturing Inc.</h1>
            <p id="companyIndustry">
              Industrial Machinery Manufacturing | Established 2005
            </p>

            <div class="profile-actions">
              <button class="btn btn-outline" id="editProfileBtn">
                Edit Profile
              </button>
              <button type="submit" class="btn btn-primary" id="saveProfileBtn"> Save Profile</button>
            </div>

            <label class="company-logo-container" id="logoContainer" form="uploadLogo">
              <img
                src="<?php echo $profile_picture_url ?? '../assets/images/profile.png'; ?>"
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
            </label>
          </div>

          <div class="profile-content">
            <div class="section">
              <h2 class="section-title">
                Company Information
              </h2>
              <div class="info-grid">
                <div class="info-item">
                  <span class="info-label">Company Type</span>
                  <input type="text" class="info-value" id="companyType" name="companyType"></input>
                </div>
                <div class="info-item">
                  <span class="info-label">Industry</span>
                  <input type="text" class="info-value" id="industry" name="industry"></input>
                </div>
                <div class="info-item">
                  <span class="info-label">Company Size</span>
                  <input type="text" class="info-value" id="companySize" name="companySize"></input>
                </div>
                <div class="info-item">
                  <span class="info-label">Address</span>
                  <input type="address" class="info-value" id="companyAddress" name="address">
                  </input>
                </div>
                <div class="info-item">
                  <span class="info-label">Contact Number</span>
                  <input type="number" class="info-value" id="contactNumber" name="contactNumber">
                  </input>
                </div>
                <div class="info-item">
                  <span class="info-label">Email</span>
                  <input type="email" class="info-value" id="companyEmail" name="email"></input>
                </div>
                
              </div>
              <div class="save-cancel-btns" id="companyInfoBtns">
                <button type="submit" class="btn btn-primary" id="saveCompanyInfo">
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
              </h2>
              <div class="info-grid">
                <div class="info-item">
                  <span class="info-label">Contact Person</span>
                  <input type="text" class="info-value" id="contactPerson" name="contactPerson">
                  </input>
                </div>
                <div class="info-item">
                  <span class="info-label">Position</span>
                  <input type="text" class="info-value" id="contactPosition" name="position"></input>
                </div>
                <div class="info-item">
                  <span class="info-label">Mobile Number</span>
                  <input type="number" class="info-value" id="contactMobile" name="mobileNumber"></input>
                </div>
                <div class="info-item">
                  <span class="info-label">Email</span>
                  <input type="email" class="info-value" id="contactEmail" name="contactEmail">
                  </input>
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
                    <div class="document-name">BIR Certification</div>
                    <div class="document-date">Uploaded: <span id="bir-upload-date">Not Uploaded</span></div>
                  </div>
                  <div class="document-actions">
                    <a href="#" class="view-doc" id="view-bir">View</a>
                    <label for="upload-bir" class="update-doc">Upload</label>
                    <input type="file" id="upload-bir" name="upload-bir" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                  </div>
                </li>
                <li class="document-item">
                  <div class="document-icon">📄</div>
                  <div class="document-info">
                    <div class="document-name">Business Permit</div>
                    <div class="document-date">Uploaded: <span id="business-permit-upload-date">Not Uploaded</span></div>
                  </div>
                  <div class="document-actions">
                    <a href="#" class="view-doc" id="view-business-permit">View</a>
                    <label for="upload-business-permit" class="update-doc">Upload</label>
                    <input type="file" id="upload-business-permit" name="upload-business-permit" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                  </div>
                </li>
                <li class="document-item">
                  <div class="document-icon">📄</div>
                  <div class="document-info">
                    <div class="document-name">DOLE Certification</div>
                    <div class="document-date">Uploaded: <span id="dole-upload-date">Not Uploaded</span></div>
                  </div>
                  <div class="document-actions">
                    <a href="#" class="view-doc" id="view-dole">View</a>
                    <label for="upload-dole" class="update-doc">Upload</label>
                    <input type="file" id="upload-dole" name="upload-dole" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                  </div>
                </li>
                <li class="document-item">
                  <div class="document-icon">📄</div>
                  <div class="document-info">
                    <div class="document-name">Migrant Certification</div>
                    <div class="document-date">Uploaded: <span id="migrant-upload-date">Not Uploaded</span></div>
                  </div>
                  <div class="document-actions">
                    <a href="#" class="view-doc" id="view-migrant">View</a>
                    <label for="upload-migrant" class="update-doc">Upload</label>
                    <input type="file" id="upload-migrant" name="upload-migrant" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                  </div>
                </li>
                <li class="document-item">
                  <div class="document-icon">📄</div>
                  <div class="document-info">
                    <div class="document-name">PhilJob Certification</div>
                    <div class="document-date">Uploaded: <span id="philjob-upload-date">Not Uploaded</span></div>
                  </div>
                  <div class="document-actions">
                    <a href="#" class="view-doc" id="view-philjob">View</a>
                    <label for="upload-philjob" class="update-doc">Upload</label>
                    <input type="file" id="upload-philjob" name="upload-philjob" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <button type="submit">Submit</button>
        </form>
      </main>
    </div>
    <script>
  
  const accountData = <?php echo $accountJson; ?>;

  
  document.addEventListener('DOMContentLoaded', function() {
    
    if (accountData) {
      document.getElementById('companyType').value = accountData.company_type || '';
      document.getElementById('industry').value = accountData.industry || '';
      document.getElementById('companySize').value = accountData.company_size || '';
      document.getElementById('companyAddress').value = accountData.address || '';
      document.getElementById('contactNumber').value = accountData.contact_number || '';
      document.getElementById('companyEmail').value = accountData.email || '';
      document.getElementById('contactPerson').value = accountData.contact_person || '';
      document.getElementById('contactPosition').value = accountData.contact_position || '';
      document.getElementById('contactMobile').value = accountData.contact_mobile || '';
      document.getElementById('contactEmail').value = accountData.contact_email || '';
    }   
      });
  </script>
  <script>
    
    document.getElementById('uploadLogo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('companyLogo').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
   </script>
    <script src="../js/responsive.js"></script>
    <script>    
      const editBtn = document.getElementById('editProfileBtn');
      const saveBtn = document.getElementById('saveProfileBtn');
      const inputs = document.querySelectorAll('form input');
      const select = document.querySelectorAll('form select');
  
      window.addEventListener('DOMContentLoaded', () => {
      inputs.forEach(input => input.disabled = true);
      });
  
    editBtn.addEventListener('click', () => {
    inputs.forEach(input => input.disabled = false);
    saveBtn.disabled = false;
    editBtn.disabled = true;
  });
  
  saveBtn.addEventListener('click', (e) => {
    e.preventDefault(); 
    inputs.forEach(input => input.disabled = true);
    saveBtn.disabled = true;
    editBtn.disabled = false;
  });

  </script>
  </body>
</html>

