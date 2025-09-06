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

$employer_id = $_SESSION['user_id'];

$sql = "SELECT 
            bir_certification, business_permit, dole_certification, 
            migrant_certification, philjob_certification
        FROM employer_company_docs
        WHERE employer_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();
$docs = $result->fetch_assoc();

$baseURL = "http://localhost/CAPSTONE/CAPSTONE-PROJECT/";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Company Profile</title>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/employer-profile.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <nav class="navbar">
    <div class="navbar-left">
      <div class="left-pos" style="display: flex; width: auto; height: auto">
        <button class="hamburger">☰</button>
        <div class="logo">
          <img src="../assets/images/peso-logo.png" alt="" />
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
      <form action="../Functions/profile_update.php" method="POST" enctype="multipart/form-data" class="profile-container" id="myForm">
        <div class="profile-header">
          <input type="text" id="companyName" name="companyName" placeholder="Put Your Company Name Here">
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
                  <div class="document-date">Uploaded:<span id="bir-upload-date"><?php echo !empty($docs['bir_certification']) ? "Uploaded":"Not Uploaded"; ?></span></div>
                </div>
                <div class="document-actions">
                  <button class="view-doc" data-doc="<?php echo $baseURL . $docs['bir_certification']; ?>">View</button>
                  <label for="upload-bir" class="update-doc">Upload</label>
                  <input type="file" id="upload-bir" name="upload-bir" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                </div>
              </li>
              <li class="document-item">
                <div class="document-icon">📄</div>
                <div class="document-info">
                  <div class="document-name">Business Permit</div>
                  <div class="document-date">Uploaded:<span id="bir-upload-date"><?php echo !empty($docs['business_permit']) ? "Uploaded":"Not Uploaded"; ?></span></div>
                </div>
                <div class="document-actions">
                  <button class="view-doc" data-doc="<?php echo $baseURL . $docs['business_permit']; ?>">View</button>
                  <label for="upload-business-permit" class="update-doc">Upload</label>
                  <input type="file" id="upload-business-permit" name="upload-business-permit" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                </div>
              </li>
              <li class="document-item">
                <div class="document-icon">📄</div>
                <div class="document-info">
                  <div class="document-name">DOLE Certification</div>
                  <div class="document-date">Uploaded:<span id="bir-upload-date"><?php echo !empty($docs['dole_certification']) ? "Uploaded":"Not Uploaded"; ?></span></div>
                </div>
                <div class="document-actions">
                  <button class="view-doc" data-doc="<?php echo $baseURL . $docs['dole_certification']; ?>">View</button>
                  <label for="upload-dole" class="update-doc">Upload</label>
                  <input type="file" id="upload-dole" name="upload-dole" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                </div>
              </li>
              <li class="document-item">
                <div class="document-icon">📄</div>
                <div class="document-info">
                  <div class="document-name">Migrant Certification</div>
                  <div class="document-date">Uploaded:<span id="bir-upload-date"><?php echo !empty($docs['migrant_certification']) ? "Uploaded":"Not Uploaded"; ?></span></div>
                </div>
                <div class="document-actions">
                  <button class="view-doc" data-doc="<?php echo $baseURL . $docs['migrant_certification']; ?>">View</button>
                  <label for="upload-migrant" class="update-doc">Upload</label>
                  <input type="file" id="upload-migrant" name="upload-migrant" class="upload-input" accept=".pdf,.doc,.docx,.jpg,.png" style="display: none;">
                </div>
              </li>
              <li class="document-item">
                <div class="document-icon">📄</div>
                <div class="document-info">
                  <div class="document-name">PhilJob Certification</div>
                  <div class="document-date">Uploaded:<span id="bir-upload-date"><?php echo !empty($docs['philjob_certification']) ? "Uploaded":"Not Uploaded"; ?></span></div>
                </div>
                <div class="document-actions">
                  <button class="view-doc" data-doc="<?php echo $baseURL . $docs['philjob_certification']; ?>">View</button>
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
  
  <div id="viewModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span id="closeModal">&times;</span>
    <iframe id="docFrame" src="" width="100%" height="500px" style="display:none;"></iframe>
    <img id="docImage" src="" style="max-width:50%; height:auto; display:none;"/>
  </div>
  </div>
  <script>
    const accountData = <?php echo $accountJson; ?>;

    document.addEventListener('DOMContentLoaded', function() {

      if (accountData) {
        document.getElementById('companyType').value = accountData.company_type || '';
        document.getElementById('industry').value = accountData.industry || '';
        document.getElementById('companyName').value = accountData.company_name || '';
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

    document.getElementById("myForm").addEventListener("submit", function(e) {
  e.preventDefault(); 

  let form = this;
  let formData = new FormData(form);

  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to submit this form?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#0055a5",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, submit it!"
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(form.action, {
        method: "POST",
        body: formData
      })
      .then(response => response.text()) // PHP returns text or JSON
      .then(data => {
        Swal.fire({
          icon: "success",
          title: "Success!",
          text: "Form submitted successfully!",
          confirmButtonColor: "#0055a5"
        });
        console.log("Server response:", data);
      })
      .catch(error => {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
          confirmButtonColor: "#0055a5"
        });
        console.error("Error:", error);
      });
    }
  });
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
  <script>
document.querySelectorAll(".view-doc").forEach(btn => {
  btn.addEventListener("click", function(e) {
    e.preventDefault();

    let filePath = this.getAttribute("data-doc");
    let modal = document.getElementById("viewModal");
    let iframe = document.getElementById("docFrame");
    let img = document.getElementById("docImage");

    iframe.style.display = "none";
    img.style.display = "none";

    if (!filePath) {
      alert("No file uploaded yet.");
      return;
    }

    // detect file type by extension
    if (filePath.match(/\.(jpg|jpeg|png|gif)$/i)) {
      img.src = filePath;
      img.style.display = "block";
    } else {
      iframe.src = filePath;
      iframe.style.display = "block";
    }

    modal.style.display = "block";
  });
});

document.getElementById("closeModal").addEventListener("click", function() {
  document.getElementById("viewModal").style.display = "none";
  document.getElementById("docFrame").src = "";
  document.getElementById("docImage").src = "";
});
</script>

</body>

</html>