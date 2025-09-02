<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Applicant Dashboard</title>
  <link rel="stylesheet" href="../css/applicant-profile.css" />
  <link rel="stylesheet" href="../css/navs.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div class="profile">
          <label
            class="profile-pic-container"
            id="profilePicContainer"
            for="profilePicInput">
            <img
              src="<?php echo htmlspecialchars($profile_picture_url); ?>"
              alt="Profile Picture"
              class="profile-pic"
              id="profilePicc" />
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
          </label>
        </div>
      </div>
    </div>
  </nav>
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
    <div class="profile-container">
      <form action="../Functions/profile_update.php" method="POST" id="profileForm" enctype="multipart/form-data">
        <div class="section">
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
            <p>Upload a photo below 1mb</p>
          </div>
        </div>
        <button id="editBtn" class="btn btn-outline">Edit</button>
        <button id="saveBtn" class="btn btn-primary">Save</button>
        <!-- Personal Information Section -->
        <div class="section">
          <h2 class="section-title">I. PERSONAL INFORMATION</h2>
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
                placeholder="Jr., Sr., III" name="suffix" />
            </div>
            <div class="form-group">
              <label class="required">Date of Birth</label>
              <input type="date" id="birthDate" name="birthDate" required />
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
              <label class="required">Religion</label>
              <input type="text" id="religion" name="religion" required />
            </div>
            <div class="form-group">
              <label class="required">Civil Status</label>
              <select id="civilStatus" name="civilStatus" required>
                <option value="">Select</option>
                <option>Single</option>
                <option>Married</option>
                <option>Widowed</option>
              </select>
            </div>
            <div class="form-group" style="grid-column: span 4">
              <label class="required">Complete Address</label>
              <input
                type="text"
                id="street"
                placeholder="Street Address"
                name="streetAddress"
                value="<?= htmlspecialchars($saved_street) ?>"
                required
                style="margin-bottom: 10px" />
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <select id="region" name="region" required>
                  <option value="">Select Region</option>
                  <?php foreach ($regions as $reg):
                    $code = getCode($reg); ?>
                    <option value="<?= htmlspecialchars($code) ?>"
                      <?= ($saved_region == $code) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($reg['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <select id="province" name="province" required>
                  <option value="">Select Province</option>
                  <?php foreach ($provinces as $prov):
                    $code = getCode($prov); ?>
                    <option value="<?= htmlspecialchars($code) ?>"
                      <?= ($saved_province == $code) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($prov['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <select id="city" name="cityMunicipality" required>
                  <option value="">Select City/Municipality</option>
                  <?php foreach ($cities as $city):
                    $code = getCode($city); ?>
                    <option value="<?= htmlspecialchars($code) ?>"
                      <?= ($saved_city == $code) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($city['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>

                <select id="barangay" name="barangay" required>
                  <option value="">Select Barangay</option>
                  <?php foreach ($barangays as $brgy):
                    $code = getCode($brgy); ?>
                    <option value="<?= htmlspecialchars($code) ?>"
                      <?= ($saved_barangay == $code) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($brgy['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>

              </div>
              <input type="hidden" name="region_name" id="region_name">
              <input type="hidden" name="province_name" id="province_name">
              <input type="hidden" name="city_name" id="city_name">
              <input type="hidden" name="barangay_name" id="barangay_name">
            </div>
            <div class="form-group" style="grid-column: span 2">
              <label class="required">Height(FT.)</label>
              <input type="text" id="height" name="height" required />
            </div>
            <div class="form-group" style="grid-column: span 2">
              <label class="required">Nationality</label>
              <input
                type="text"
                id="nationality"
                value="Filipino"
                name="nationality" required />
            </div>
            <div class="form-group">
              <label class="required">TIN</label>
              <input type="text" id="tin" name="tin" required />
            </div>
            <div class="form-group" style="grid-column: span 2; padding:0 20px;">
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
            <!-- REMOVE THIS -->
            <div class="form-group" style="display: none;">
              <label>Alternate Contact Number</label>
              <input type="tel" id="alternateMobile" name="alternateContact" />
            </div>
            <!-- NOT THIS -->
            <div class="form-group disabilities">
              <label for="">Disability</label>
              <ul>
                <li>
                  <input type="checkbox"><label for="">Visual</label>
                </li>
                <li>
                  <input type="checkbox"><label for="">Speech</label>
                </li>
                <li>
                  <input type="checkbox"><label for="">Mental</label>
                </li>
                <li>
                  <input type="checkbox"><label for="">Hearing</label>
                </li>
                <li>
                  <input type="checkbox"><label for="">Physical</label>
                </li>
                <li>
                  <input type="checkbox">
                  <label for="">Others:</label>
                  <input type="text" id="others" name="others">
                </li>
              </ul>
            </div>
            <div class="form-group employment-status">
              <label class="required">EMPLOYMENT STATUS/TYPE</label>
              <div class="employment-checkboxes">
                <div class="employed-checkbox checkbox-flex">
                  <input type="checkbox" id="employed" name="employmentStatus" value="Employed">
                  <label for="employed">Employed</label>
                </div>
                <div class="unemployed-checkbox checkbox-flex">
                  <input type="checkbox" id="unemployed" name="employmentStatus" value="Unemployed">
                  <label for="unemployed">Unemployed </label>
                </div>
              </div>
              <div class="employed-checkboxes">
                <div class="wage-employed-checkbox checkbox-flex">
                  <input type="checkbox" id="wage-employed" name="wageEmployed" value="WageEmployed">
                  <label for="wageEmployed">Wage Employed</label>
                </div>
                <div class="self-employed-checkbox checkbox-flex">
                  <input type="checkbox" id="self-employed" name="employmentStatus" value="Self-Employed">
                  <label for="self-employed">Self-Employed (Please Specify)</label>
                </div>
              </div>
              <div class="self-employed-checkboxes">
                <div class="checkbox-flex">
                  <input type="checkbox" id="fisherman" name="selfEmployedType[]" value="Fisherman/Fisherfolk">
                  <label for="fisherman">Fisherman/Fisherfolk</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="vendor" name="selfEmployedType[]" value="Vendor/Trailer"><label for="vendor">Vendor/Trailer</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="homebased" name="selfEmployedType[]" value="Home-based worker">
                  <label for="homebased">Home-based worker</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="transport" name="selfEmployedType[]" value="Transport">
                  <label for="transport">Transport</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="domestic" name="selfEmployedType[]" value="Domestic Worker">
                  <label for="domestic">Domestic Worker</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="freelancer" name="selfEmployedType[]" value="Freelancer">
                  <label for="freelancer">Freelancer</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="artisan" name="selfEmployedType[]" value="Artisan/Craft Worker">
                  <label for="artisan">Artisan/Craft Worker</label>
                </div>
                <div class="checkbox-flex " style="grid-column: span 2;">
                  <input type="checkbox" id="othersSelfEmployed" name="selfEmployedType[]" value="Others">
                  <label for="othersSelfEmployed">Others (Please Specify:)</label>
                  <input type="text" name="selfEmployedOther" placeholder="Please specify" style="margin-left: 5px;">
                </div>
              </div>
              <div class="unemployed-checkboxes">
                <div style="display:flex; width:50%; margin:1rem 0;">
                  <label for="jobSearchDuration">How long have you been looking for work? (months)</label>
                  <input type="number" id="jobSearchDuration" name="jobSearchDuration" min="0">
                </div>
                <label>Unemployment Reason (Select all that apply)</label>
                <div class="checkbox-unemployed-reasons">
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-new" name="unempReason" value="new">
                    <label for="unemp-new">New Entrant/Fresh Graduate</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-finished-contract" name="unempReason" value="finished-contract">
                    <label for="unemp-finished-contract">Finished Contract</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-resigned" name="unempReason" value="resigned">
                    <label for="unemp-resigned">Resigned</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-retired" name="unempReason" value="retired">
                    <label for="unemp-retired">Retired</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-calamity" name="unempReason" value="calamity">
                    <label for="unemp-calamity">Terminated/Laid off due to calamity</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-terminated-local" name="unempReason" value="terminated-local">
                    <label for="unemp-terminated-local">Terminated/Laid off (local)</label>
                  </div>
                  <div class="checkbox-flex" style="grid-column:span 2">
                    <input type="checkbox" id="unemp-terminated-abroad" name="unempReason" value="terminated-abroad">
                    <label for="unemp-terminated-abroad">Terminated/Laid off (abroad)specify:country</label><input type="" text" style="max-width:180px;margin-right: 20px;">
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-other" name="unempReason" value="other">
                    <label for="unemp-other">Others:</label><input type="text">
                  </div>

                </div>
              </div>
            </div>
            <!-- OFW SA FREEZER -->
            <div class="form-group ofw-status">
              <div class="currently-ofw">
                <label>Are you an OFW?</label>
                <div class="checkbox-ofw">
                  <div class="checkbox-flex">
                    <input type="checkbox" id="ofw-yes" name="ofw" value="yes">
                    <label for="ofw-yes">Yes</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="ofw-no" name="ofw" value="no">
                    <label for="ofw-no">No</label>
                  </div>
                </div>
                <div style="display:flex" id="ofw-country-group">
                  <label for="ofwCountry">Specify country</label>
                  <input type="text" id="ofwCountry" name="ofwCountry">
                </div>
              </div>
              <div class="former-ofw">
                <label>Are you a former OFW?</label>
                <div class="checkbox-ofw">
                  <div class="checkbox-flex">
                    <input type="checkbox" id="former-ofw-yes" name="formerOfw" value="yes">
                    <label for="former-ofw-yes">Yes</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="former-ofw-no" name="formerOfw" value="no">
                    <label for="former-ofw-no">No</label>
                  </div>
                </div>
                <div class="checkbox-flex" id="former-ofw-country-group">
                  <label for="formerOfwCountry">Latest country of deployment</label>
                  <input type="text" id="formerOfwCountry" name="formerOfwCountry">
                </div>
                <div class="checkbox-flex" id="return-date-group">
                  <label for="returnDate">Month and year of return to Philippines</label>
                  <input type="month" id="returnDate" name="returnDate">
                </div>
              </div>
            </div>


          </div>
        </div>
        <!-- Job Preference -->
        <div class="section">
          <h2 class="section-title">II. JOB PREFERENCE</h2>
          <div class="form-grid">
            <div class="form-group" style="grid-column: span 3; display: flex; flex-direction: column;padding-left: 20px; ">
              <h3>PREFERRED OCCUPATION</h3>
              <div style="display: flex; gap: 20px; margin-bottom: 10px;  ">
                <di ">
                      <input type=" checkbox" id="partTime" name="jobType[]" value="Part-Time">
                  <label for="partTime">Part-time</label>
              </div>
              <div style="display: flex; justify-content: center; align-items: center;">
                <input type="checkbox" id="fullTime" name="jobType[]" value="Full-Time">
                <label for="fullTime">Full-time</label>
              </div>
            </div>
            <ol style="width: 50%; padding-left: 20px; margin: 0;">
              <li display="width:50% !important">
                <input type="text">
              </li>
              <li display="width:50% !important">
                <input type="text">
              </li>
              <li display="width:50% !important">
                <input type="text">
              </li>
            </ol>
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
                <input type="text" name="position" />
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
          <button type="reset" class="btn btn-danger">Reset</button>
          <button type="submit" class="btn btn-outline" id="updateBtn">
            Update Profile
          </button>
          <button type="submit" class="btn btn-primary" id="saveBtnn">
            Save Profile
          </button>
        </div>
      </form>
    </div>
  </main>

  <script>
    document.getElementById('profilePicInput').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {

        if (!file.type.match('image.*')) {
          alert('Please select an image file');
          return;
        }

        if (file.size > 10 * 1024 * 1024) {
          alert('Image must be less than 10MB');
          return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
          document.getElementById('profilePic').src = event.target.result;
          document.getElementById('profilePicc').src = event.target.result;

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

      if (e.submitter === saveBtnn) {
        const response = await fetch('../Functions/profile_update.php', {
          method: 'POST',
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          alert('Profile saved successfully!');
          window.location.reload();
        } else {
          alert('Error: ' + result.message);
        }
      } else if (e.submitter === updateBtn) {

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
      }
    });
  </script>
  <script src="../js/responsive.js"></script>
  <script>
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const inputs = document.querySelectorAll('#profileForm input');
    const select = document.querySelectorAll('#profileForm select');
    const textAreas = document.querySelectorAll('#profileForm textarea'); // Correctly define textAreas
    const profilePicInput = document.getElementById('profilePicInput');

    window.addEventListener('DOMContentLoaded', () => {
      inputs.forEach(input => input.disabled = true);
      select.forEach(select => select.disabled = true);
      textAreas.forEach(textArea => textArea.disabled = true); // Use textAreas here
      saveBtn.disabled = true;
      editBtn.disabled = false;
      profilePicInput.disabled = true; // Disable the file input
    });

    editBtn.addEventListener('click', () => {
      inputs.forEach(input => input.disabled = false);
      select.forEach(select => select.disabled = false);
      textAreas.forEach(textArea => textArea.disabled = false); // Use textAreas here
      saveBtn.disabled = false;
      editBtn.disabled = true;
      profilePicInput.disabled = false; // Enable the file input
    });

    saveBtn.addEventListener('click', (e) => {
      e.preventDefault();
      inputs.forEach(input => input.disabled = true);
      select.forEach(select => select.disabled = true);
      textAreas.forEach(textArea => textArea.disabled = true); // Use textAreas here
      saveBtn.disabled = true;
      editBtn.disabled = false;
      profilePicInput.disabled = true; // Disable the file input
    });
  </script>
  <script>
    const regionSel = document.getElementById('region');
    const provinceSel = document.getElementById('province');
    const citySel = document.getElementById('city');
    const barangaySel = document.getElementById('barangay');

    function reset(selectEl, placeholder) {
      selectEl.innerHTML = `<option value="">${placeholder}</option>`;
      selectEl.disabled = true;
    }

    /* initial reset */
    reset(provinceSel, 'Select Province');
    reset(citySel, 'Select City/Municipality');
    reset(barangaySel, 'Select Barangay');

    regionSel.addEventListener('change', async () => {
      const regionId = regionSel.value;
      reset(provinceSel, 'Select Province');
      reset(citySel, 'Select City/Municipality');
      reset(barangaySel, 'Select Barangay');
      if (!regionId) return;

      try {
        const res = await fetch(`https://psgc.rootscratch.com/province?id=${encodeURIComponent(regionId)}`);
        if (!res.ok) throw new Error('Network response not ok');
        const provinces = await res.json();
        provinces.forEach(p => {
          const opt = document.createElement('option');
          opt.value = p.psgc_id;
          opt.textContent = p.name;
          provinceSel.appendChild(opt);
        });
        provinceSel.disabled = false;
      } catch (err) {
        console.error('Failed to load provinces', err);
        alert('Unable to load provinces. Check console for details.');
      }
    });

    provinceSel.addEventListener('change', async () => {
      const provId = provinceSel.value;
      reset(citySel, 'Select City/Municipality');
      reset(barangaySel, 'Select Barangay');
      if (!provId) return;

      try {
        const res = await fetch(`https://psgc.rootscratch.com/municipal-city?id=${encodeURIComponent(provId)}`);
        if (!res.ok) throw new Error('Network response not ok');
        const cities = await res.json();
        cities.forEach(c => {
          const opt = document.createElement('option');
          opt.value = c.psgc_id;
          opt.textContent = c.name;
          citySel.appendChild(opt);
        });
        citySel.disabled = false;
      } catch (err) {
        console.error('Failed to load cities', err);
      }
    });

    citySel.addEventListener('change', async () => {
      const cityId = citySel.value;
      reset(barangaySel, 'Select Barangay');
      if (!cityId) return;

      try {
        const res = await fetch(`https://psgc.rootscratch.com/barangay?id=${encodeURIComponent(cityId)}`);
        if (!res.ok) throw new Error('Network response not ok');
        const brgys = await res.json();
        brgys.forEach(b => {
          const opt = document.createElement('option');
          opt.value = b.psgc_id;
          opt.textContent = b.name;
          barangaySel.appendChild(opt);
        });
        barangaySel.disabled = false;
      } catch (err) {
        console.error('Failed to load barangays', err);
      }
    });

    document.getElementById("region").addEventListener("change", function() {
      document.getElementById("region_name").value = this.options[this.selectedIndex].text;
    });
    document.getElementById("province").addEventListener("change", function() {
      document.getElementById("province_name").value = this.options[this.selectedIndex].text;
    });
    document.getElementById("city").addEventListener("change", function() {
      document.getElementById("city_name").value = this.options[this.selectedIndex].text;
    });
    document.getElementById("barangay").addEventListener("change", function() {
      document.getElementById("barangay_name").value = this.options[this.selectedIndex].text;
    });

    window.addEventListener('DOMContentLoaded', async function() {
      const savedRegion = "<?= $saved_region ?>";
      const savedProvince = "<?= $saved_province ?>";
      const savedCity = "<?= $saved_city ?>";
      const savedBarangay = "<?= $saved_barangay ?>";

      async function selectValue(selectEl, value) {
        return new Promise(resolve => {
          const check = setInterval(() => {
            if ([...selectEl.options].some(opt => opt.value == value)) {
              selectEl.value = value;
              selectEl.dispatchEvent(new Event('change'));
              clearInterval(check);
              resolve();
            }
          }, 100);
        });
      }

      if (savedRegion) {
        regionSel.value = savedRegion;
        regionSel.dispatchEvent(new Event('change'));
        await selectValue(provinceSel, savedProvince);
        await selectValue(citySel, savedCity);
        await selectValue(barangaySel, savedBarangay);
      }
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const form = document.querySelector("form");
      const saveBtn = document.getElementById("saveBtnn");
      const updateBtn = document.getElementById("updateBtn");

      function handleAction(button, actionText, confirmText) {
        button.addEventListener("click", function(e) {
          e.preventDefault();

          Swal.fire({
            title: `Are you sure you want to ${actionText}?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: "Cancel",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        });
      }
      handleAction(saveBtn, "save your profile", "Yes, Save it!");
      handleAction(updateBtn, "update your profile", "Yes, Update it!");
    });
  </script>
</body>

</html>