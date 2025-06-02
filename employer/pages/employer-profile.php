<?php
require_once '../../landing/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
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

$profile_picture_url = '../assets/images/profile.png';

if (isset($_SESSION['user_id'])) {
  $employer_id = $_SESSION['user_id'];
  $query = "SELECT profile_picture FROM employer_company_info WHERE employer_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $employer_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['profile_picture'])) {

      if (file_exists('../' . $row['profile_picture'])) {
        $profile_picture_url = '../' . $row['profile_picture'];
      }
    }
  }
  $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Company Profile</title>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/employer-profile.css" />
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
        <div class="profile" style="width: 40px; aspect-ratio: 1; padding: 0;"><img
                src="<?php echo htmlspecialchars($profile_picture_url); ?>"
                alt="Company Logo"
                class="company-logo"
                id="companyLogoo" style="width: 100%; height: 100%; border-radius: 50%"/></div>
      </div>
    </div>
  </nav>

  <div class="container">
    <aside class="sidebar">
      <ul class="sidebar-menu">
        <li>
          <a href="./employer-dashboard.php">
            <span class="emoji"><img src="../../public-assets/icons/chart-histogram.svg" alt=""></span>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./employer-post.php">
            <span class="emoji"><img src="../../public-assets/icons/download.svg" style="transform:rotate(180deg);"></span>
            <span class="label">Post Job</span>
          </a>
        <li>
          <a href="./employer-applications.php">
            <span class="emoji"><img src="../../public-assets/icons/briefcase.svg" alt=""></span>
            <span class="label">Job Applications</span>
          </a>
        </li>
        <li>

          <a href="./applicant-job-search.php">
            <span class="emoji"><img src="../../public-assets/icons/search.svg" alt=""></span>
            <span class="label">Applicant Search</span>
          </a>
        </li>
        <li>
          <a href="employer-profile.php">
            <span class="emoji"><img src="../../public-assets/icons/user.svg" alt=""></span>
            <span class="label">My Profile</span>
          </a>
        </li>
        <li>
          <a href="../../landing/functions/logout.php">
            <span class="emoji"><img src="../../public-assets/icons/download.svg" style="transform:rotate(90deg);"></span>
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

          <div class="profile-picture-container">
            <label class="company-logo-container" id="logoContainer" form="uploadLogo">
              <img
                src="<?php echo htmlspecialchars($profile_picture_url); ?>"
                alt="Company Logo"
                class="company-logo"
                id="companyLogo" />
              <input
                type="file"
                id="uploadLogo"
                name="profilePicture"
                class="upload-logo"
                accept="image/*" />
            </label>
          </div>
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
          <button type="submit" class="btn btn-primary" style="background-color: #0055a5; color:white; padding: .825rem 3rem; font-size: 1rem; margin-left: 83.5%;">Submit</button>
        </div>
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
          document.getElementById('companyLogoo').src = event.target.result;
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