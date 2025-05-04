<?php
require_once '../../landing/functions/check_login.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../login-signup.php");
    exit();


}
$userId = $_SESSION['user_id'];

$accountStmt = $conn->prepare("SELECT * FROM applicant_account WHERE applicant_ID = ?");
$accountStmt->bind_param("i", $userId);
$accountStmt->execute();
$accountResult = $accountStmt->get_result();
$accountData = $accountResult->fetch_assoc();

$profileStmt = $conn->prepare("SELECT * FROM applicant_profile WHERE applicant_id = ?");
$profileStmt->bind_param("i", $userId);
$profileStmt->execute();
$profileResult = $profileStmt->get_result();
$profileData = $profileResult->fetch_assoc();

$contactStmt = $conn->prepare("SELECT * FROM applicant_contact_info WHERE applicant_id = ?");
$contactStmt->bind_param("i", $userId);
$contactStmt->execute();
$contactResult = $contactStmt->get_result();
$contactData = $contactResult->fetch_assoc();

$eduStmt = $conn->prepare("SELECT * FROM applicant_educ WHERE applicant_id = ?");
$eduStmt->bind_param("i", $userId);
$eduStmt->execute();
$eduResult = $eduStmt->get_result();
$educationData = $eduResult->fetch_assoc();

$skillsStmt = $conn->prepare("SELECT * FROM applicant_skills WHERE applicant_id = ?");
$skillsStmt->bind_param("i", $userId);
$skillsStmt->execute();
$skillsResult = $skillsStmt->get_result();
$skillsData = $skillsResult->fetch_assoc();

$workStmt = $conn->prepare("SELECT * FROM applicant_work_exp WHERE applicant_id = ?");
$workStmt->bind_param("s", $userId);
$workStmt->execute();
$workResult = $workStmt->get_result();
$workData = $workResult->fetch_all(MYSQLI_ASSOC);

$docsStmt = $conn->prepare("SELECT * FROM applicant_documents WHERE applicant_id = ?");
$docsStmt->bind_param("i", $userId);
$docsStmt->execute();
$docsResult = $docsStmt->get_result();
$docsData = $docsResult->fetch_all(MYSQLI_ASSOC);

$accountJson = json_encode($accountData ?: []);
$profileJson = json_encode($profileData ?: []);
$contactJson = json_encode($contactData ?: []);
$educationJson = json_encode($educationData ?: []);
$skillsJson = json_encode($skillsData ?: []);
$workJson = json_encode($workData ?: []);
$docsJson = json_encode($docsData ?: []);

$profile_picture_url = '../assets/images/profile.png'; 

if (isset($_SESSION['user_id'])) {
    $applicant_id = $_SESSION['user_id'];
    $query = "SELECT profile_picture FROM applicant_profile WHERE applicant_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $applicant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!empty($row['profile_picture'])) {
            $filename = basename($row['profile_picture']); 
            $absolute_path = __DIR__ . '/../uploads/profile_pictures/' . $filename;
            $web_path = '../uploads/profile_pictures/' . $filename;

            error_log("Checking: " . $absolute_path);

            if (file_exists($absolute_path)) {
                $profile_picture_url = $web_path;
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
  <title>Applicant Dashboard</title>
  <link rel="stylesheet" href="../css/applicant-profile.css" />
  <link rel="stylesheet" href="../css/navs.css" />
  <style>
    .profile-pic-container:hover .profile-pic {
      transform: scale(1.05);
      opacity: 0.8;
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
        <div class="profile" ><label
              class="profile-pic-container"
              id="profilePicContainer"
              for="profilePicInput">
              <img
                src="<?php echo htmlspecialchars($profile_picture_url); ?>"
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
                name="profilePicture"
                class="profile-pic-input"
                accept="image/*" />
            </label>
          </div>
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
      <div class="profile-container">

        <div class="section">
          <form action="../Functions/profile_update.php" method="POST" id="profileForm" enctype="multipart/form-data">
          <div class="profile-header">
            <label
              class="profile-pic-container"
              id="profilePicContainer"
              for="profilePicInput">
              <img
                src="<?php echo htmlspecialchars($profile_picture_url); ?>"
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
                name="profilePicture"
                class="profile-pic-input"
                accept="image/*" />
            </label>
            <h1>My Profile</h1>
            <p>Complete your profile to increase job opportunities</p>
          </div>

          <div class="profile-content">
            
              <!-- Personal Information Section -->
              <div class="section">
                <button id="editBtn" class="btn btn-outline">Edit</button>
                <button id="saveBtn" class="btn btn-primary">Save</button>
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
                <h2 class="section-title">Highest Educational Attainment </h2>
                <div id="educationEntries">
                  <div class="form-grid education-entry">
                    <div class="form-group">
                      <label class="required">Education Level</label>
                      <select name="educationLevel" required>
                        <option value="">Select</option>
                        <option value="Elementary">Elementary</option>
                        <option value="High School">High School</option>
                        <option value="Vocational">Vocational</option>
                        <option value="College">College</option>
                        <option value="Postgraduate">Postgraduate</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="required">School Name</label>
                      <input type="text" name="schoolName" required />
                    </div>
                    <div class="form-group">
                      <label>Course/Degree</label>
                      <input type="text" name="courseDegree" />
                    </div>
                    <div class="form-group">
                      <label>Year Graduated</label>
                      <input type="number" min="1900" max="2099" name="yearGraduated" />
                    </div>
                  </div>
                </div>
                <!-- <button type="button" class="add-btn" id="addEducation">
                  + Add Education
                </button> -->
              </div>

              <!-- Work Experience Section -->
              <div class="section">
                <h2 class="section-title">Work Experience</h2>
                <div id="experienceEntries">
                  <div class="form-grid experience-entry">
                    <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" name="companyName" />
                    </div>
                    <div class="form-group">
                      <label>Position</label>
                      <input type="text" name="position"/>
                    </div>
                    <div class="form-group">
                      <label>Industry</label>
                      <select name="industry">
                        <option value="">Select</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Construction">Construction</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Retail">Retail</option>
                        <option value="IT/BPO">IT/BPO</option>
                      </select>
                    </div>
                    <div class="form-group" style="grid-column: span 2">
                      <label>Employment Period</label>
                      <div style="display: flex; gap: 10px">
                        <input
                          type="date"
                          placeholder="From"
                          style="flex: 1" name="employmentStart" />
                        <input type="date" placeholder="To" style="flex: 1" name="employmentEnd" />
                      </div>
                    </div>
                    <div class="form-group" style="grid-column: span 3">
                      <label>Key Responsibilities</label>
                      <textarea rows="4" name="keyResponsibilities"></textarea>
                    </div>
                  </div>
                </div>
                <!-- <button type="button" class="add-btn" id="addExperience">
                  + Add Work Experience
                </button> -->
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
                    <!-- <button
                      type="button"
                      class="add-btn"
                      style="margin-top: 10px">
                      + Add Language
                    </button> -->
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
               
                <button type="submit" class="btn btn-secondary" id="updateBtn">
                  Update Profile
                <button type="submit" class="btn btn-primary" id="saveBtnn">
                  Save Profile
                </button>
              </div>
            </form>

          </div>
        </div>
    </main>
  </div>
  <script>
    document.getElementById('profilePicInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
       
        if (!file.type.match('image.*')) {
            alert('Please select an image file');
            return;
        }
        
        if (file.size > 2 * 1024 * 1024) {
            alert('Image must be less than 2MB');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('profilePic').src = event.target.result;
            
        };
        reader.readAsDataURL(file);
    }
});
  </script>
  <script>
  
  const accountData = <?php echo $accountJson; ?>;
  const profileData = <?php echo $profileJson; ?>;
  const contactData = <?php echo $contactJson; ?>;
  const educationData = <?php echo $educationJson; ?>;
  const skillsData = <?php echo $skillsJson; ?>;
  const workData = <?php echo $workJson; ?>;
  const docsData = <?php echo $docsJson; ?>;
  
  document.addEventListener('DOMContentLoaded', function() {
    
    if (accountData) {
      document.getElementById('firstName').value = accountData.f_name || '';
      document.getElementById('lastName').value = accountData.l_name || '';
      document.getElementById('email').value = accountData.email || '';
    }
    
    if (profileData) {
      document.getElementById('middleName').value = profileData.middle_name || '';
      document.getElementById('suffix').value = profileData.suffix || '';
      document.getElementById('gender').value = profileData.sex || '';
      document.getElementById('birthDate').value = profileData.date_of_birth || '';
      document.getElementById('civilStatus').value = profileData.civil_status || '';
      document.getElementById('nationality').value = profileData.nationality || 'Filipino';
    }
    
    if (contactData) {
      document.getElementById('mobile').value = contactData.mobile_number || '';
      document.getElementById('alternateMobile').value = contactData.alternate_contact_number || '';
      document.getElementById('street').value = contactData.street_address || '';
      document.getElementById('region').value = contactData.region || '';
      document.getElementById('province').value = contactData.province || '';
      document.getElementById('city').value = contactData.city_municipality || '';
      document.getElementById('barangay').value = contactData.barangay || '';
    }
    
    if (educationData) {
      const eduEntry = document.querySelector('.education-entry');
      eduEntry.querySelector('[name="educationLevel"]').value = educationData.education_level || '';
      eduEntry.querySelector('[name="schoolName"]').value = educationData.school_name || '';
      eduEntry.querySelector('[name="courseDegree"]').value = educationData.course_or_degree || '';
      eduEntry.querySelector('[name="yearGraduated"]').value = educationData.year_graduated || '';
    }
    
   
    if (workData && workData.length > 0) {
    const expEntriesContainer = document.getElementById('experienceEntries');
    const originalEntry = document.querySelector('.experience-entry');
    expEntriesContainer.innerHTML = ''; // Clear the template
    
    workData.forEach((work, index) => {
        const expEntry = originalEntry.cloneNode(true);
        
        expEntry.querySelector('[name="companyName"]').value = work.company_name || '';
        expEntry.querySelector('[name="position"]').value = work.position || '';
        expEntry.querySelector('[name="industry"]').value = work.industry || '';
        
        const startDate = (work.employment_start && work.employment_start !== '0000-00-00') ? 
                         new Date(work.employment_start) : null;
        const endDate = (work.employment_end && work.employment_end !== '0000-00-00') ? 
                       new Date(work.employment_end) : null;
        
        expEntry.querySelector('[name="employmentStart"]').value = 
            startDate ? startDate.toISOString().split('T')[0] : '';
        expEntry.querySelector('[name="employmentEnd"]').value = 
            endDate ? endDate.toISOString().split('T')[0] : '';
        
        expEntry.querySelector('[name="keyResponsibilities"]').value = work.key_responsibilities || '';
        
        if (index > 0) {
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-btn';
            removeBtn.textContent = 'Remove';
            removeBtn.addEventListener('click', () => expEntry.remove());
            expEntry.appendChild(removeBtn);
        }

        expEntriesContainer.appendChild(expEntry);
      });
      }
    
        if (skillsData) {
          document.querySelector('[name="primarySkills"]').value = skillsData.primary_skills || '';
          document.querySelector('[name="technicalSkills"]').value = skillsData.technical_skills || '';
          document.querySelector('[name="language"]').value = skillsData.language || '';
          document.querySelector('[name="proficiencyLevel"]').value = skillsData.proficiency_level || '';
        }
        
        if (docsData && docsData.length > 0) {
          docsData.forEach(doc => {
            if (doc.document_type === 'resume') {
              document.getElementById('resumePreview').textContent = doc.original_filename;
            } else if (doc.document_type === 'valid_id') {
              document.getElementById('idPreview').textContent = doc.original_filename;
            } else if (doc.document_type === 'certification') {
              const certPreview = document.getElementById('certPreview');
              const fileElement = document.createElement('div');
              fileElement.textContent = doc.original_filename;
              certPreview.appendChild(fileElement);
            }
          });
        }
      });
  </script>
  <script> 
    document.getElementById('profileForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const updateBtn = document.getElementById('updateBtn');
    const saveBtnn = document.getElementById('saveBtnn');

    if (e.submitter === updateBtn) {
        
        const response = await fetch('../Functions/update.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            alert('Profile updated successfully!');
            window.location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } else if (e.submitter === saveBtnn) {
     
        const response = await fetch('../Functions/profile_update.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            alert('Profile saved successfully!');
        } else {
            alert('Error: ' + result.message);
        }
    }
  });

  </script>
  <script src="../js/responsive.js"></script>
  <script>
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const inputs = document.querySelectorAll('#profileForm input');
    const select = document.querySelectorAll('#profileForm select');

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