<?php
require_once '../../landing/functions/check_login.php';
require_once '../Functions/getDataDisplay.php';


?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Applicant Dashboard</title>
  <script src="../js/load-saved.js"></script>
  <link rel="stylesheet" href="../css/applicant-profile.css" />
  <link rel="stylesheet" href="../css/navs.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
          <img src="../assets/images/peso-logo.png" alt="" />
        </div>
      </div>
      <div class="right-pos">
        <div class="profile">
          <img
            src="<?php echo htmlspecialchars($profile_picture_url); ?>"
            alt="Profile Picture"
            class="profile-pic"
            id="profilePicc" style="width: 50px !important;" />
        </div>
      </div>
    </div>
  </nav>

  <aside class="sidebar">
    <ul class="sidebar-menu">
      <li>
        <a href="./applicant-dashboard.php">
          <span class="material-symbols-outlined icon">dashboard</span>
          <span class="label">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="./applicant-applications.php">
          <span class="material-symbols-outlined icon">work</span>
          <span class="label">My Applications</span>
        </a>
      </li>
      <li>
        <a href="./applicant-job-search.php">
          <span class="material-symbols-outlined icon">search</span>
          <span class="label">Job Search</span>
        </a>
      </li>
      <li>
        <a href="./applicant-profile.php">
          <span class="material-symbols-outlined icon">id_card</span>
          <span class="label">My Profile</span>
        </a>
      </li>
      <li>
        <button onclick="toggleTheme()" class="dark-mode-toggle">
          <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
          <span id="themeLabel">Dark Mode</span>
        </button>
      </li>
    </ul>
    <ul>
      <li>
        <a href="../../landing/functions/logout.php" class="log-out-btn">
          <span class="material-symbols-outlined icon">logout</span>
          <span class="label">Log Out</span>
        </a>
      </li>
    </ul>
  </aside>

  <main class="main-content">
    <div class="profile-container">
      <form action="../Functions/profile_update.php" method="POST" id="profileForm" enctype="multipart/form-data">
        <div class="section"">
          <button class=" btn btn-outline" id="editBtn">Edit</button>
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
        <div class="section form-instructions">
          <strong>INSTRUCTIONS:</strong>
          Please fill out the form accurately and completely. Fields marked with
          <span class="required-mark">*</span> are required. Upload only the following file types:
          <strong>PDF</strong>, <strong>JPG/JPEG</strong>, and <strong>PNG</strong>, with a maximum file size of
          <strong>5 MB</strong> each. Ensure all documents are clear and readable before submission. Double-check your information prior to submitting, as changes may not be allowed once the form has been submitted.
        </div>
        <!-- <button id="saveBtn" class="btn btn-primary">Save</button> -->

        <!--Section I:  Personal Information Section -->
        <div class="section">
          <h2 class=" section-title">I. PERSONAL INFORMATION</h2>
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
                placeholder="House No/Street Address"
                name="streetAddress"
                required />

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
                      <?= htmlspecialchars(getName($prov)) ?>
                    </option>
                  <?php endforeach; ?>
                </select>

                <select id="city" name="cityMunicipality" required>
                  <option value="">Select City/Municipality</option>
                  <?php foreach ($cities as $city):
                    $code = getCode($city); ?>
                    <option value="<?= htmlspecialchars($code) ?>"
                      <?= ($saved_city == $code) ? 'selected' : '' ?>>
                      <?= htmlspecialchars(getName($city)) ?>
                    </option>
                  <?php endforeach; ?>
                </select>

                <input type="text" id="barangay" name="barangay" placeholder="Barangay" required>
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
            <div class="form-group disabilities">
              <label for="">Disability</label>
              <ul>
                <li>
                  <input type="checkbox" name="disability[]" value="Visual"><label for="">Visual</label>
                </li>
                <li>
                  <input type="checkbox" name="disability[]" value="Speech"><label for="">Speech</label>
                </li>
                <li>
                  <input type="checkbox" name="disability[]" value="Mental"><label for="">Mental</label>
                </li>
                <li>
                  <input type="checkbox" name="disability[]" value="Hearing"><label for="">Hearing</label>
                </li>
                <li>
                  <input type="checkbox" name="disability[]" value="Physical"><label for="">Physical</label>
                </li>
                <li>
                  <input type="checkbox" name="disability[]" value="Others">
                  <label for="">Others:</label>
                  <input type="text" id="others" name="others">
                </li>
              </ul>
            </div>
            <div class="form-group employment-status">
              <label class="required">EMPLOYMENT STATUS/TYPE</label>
              <div class="employment-checkboxes ">
                <div class="employed-checkbox checkbox-flex">
                  <input type="checkbox" id="employed" name="employmentStatus" value="Employed">
                  <label for="employed">Employed</label>
                </div>
                <div class="unemployed-checkbox checkbox-flex">
                  <input type="checkbox" id="unemployed" name="employmentStatus" value="Unemployed">
                  <label for="unemployed">Unemployed </label>
                </div>
              </div>
              <div class="employed-checkboxes" style="display: none;">
                <div class="wage-employed-checkbox checkbox-flex">
                  <input type="checkbox" id="wage-employed" name="wageEmployed" value="WageEmployed">
                  <label for="wageEmployed">Wage Employed</label>
                </div>
                <div class="self-employed-checkbox checkbox-flex">
                  <input type="checkbox" id="self-employed" name="employmentStatus" value="Self-Employed">
                  <label for="self-employed">Self-Employed (Please Specify)</label>
                </div>
              </div>
              <div class="self-employed-checkboxes " style="display: none;">
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
              <div class="unemployed-checkboxes " style="display: none;">
                <div style="display:flex; width:50%; margin:1rem 0;">
                  <label for="jobSearchDuration">How long have you been looking for work? (months)</label>
                  <input type="number" id="jobSearchDuration" name="jobSearchDuration" min="0">
                </div>
                <label>Unemployment Reason (Select all that apply)</label>
                <div class="checkbox-unemployed-reasons">
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-new" name="unempReason[]" value="new">
                    <label for="unemp-new">New Entrant/Fresh Graduate</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-finished-contract" name="unempReason[]" value="finished-contract">
                    <label for="unemp-finished-contract">Finished Contract</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-resigned" name="unempReason[]" value="resigned">
                    <label for="unemp-resigned">Resigned</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-retired" name="unempReason[]" value="retired">
                    <label for="unemp-retired">Retired</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-calamity" name="unempReason[]" value="calamity">
                    <label for="unemp-calamity">Terminated/Laid off due to calamity</label>
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-terminated-local" name="unempReason[]" value="terminated-local">
                    <label for="unemp-terminated-local">Terminated/Laid off (local)</label>
                  </div>
                  <div class="checkbox-flex" style="grid-column:span 2">
                    <input type="checkbox" id="unemp-terminated-abroad" name="unempReason[]" value="terminated-abroad">
                    <label for="unemp-terminated-abroad">Terminated/Laid off (abroad)specify:country</label><input type="" text" style="max-width:180px;margin-right: 20px;" name="otherTerm">
                  </div>
                  <div class="checkbox-flex">
                    <input type="checkbox" id="unemp-other" name="unempReason[]" value="other">
                    <label for="unemp-other">Others:</label><input type="text" name="unempReasonOthers">
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
                <div style="display:none" id="ofw-country-group">
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
                <div class="checkbox-flex" id="former-ofw-country-group" style="display:none">
                  <label for="formerOfwCountry">Latest country of deployment</label>
                  <input type="text" id="formerOfwCountry" name="formerOfwCountry">
                </div>
                <div class="checkbox-flex" id="return-date-group" style="display:none">
                  <label for="returnDate">Month and year of return to Philippines</label>
                  <input type="month" id="returnDate" name="returnDate">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Section II: Job Preference -->
        <div class="section ">
          <h2 class="section-title">II. JOB PREFERENCE</h2>
          <div class="form-grid">
            <div class="form-group employment-status">
              <label class="required">EMPLOYMENT TYPE</label>
              <div class="employment-checkboxes">
                <div class="checkbox-flex">
                  <input type="radio" id="pref-parttime" name="prefEmploymentType" value="parttime">
                  <label for="pref-parttime">Part-time</label>
                </div>
                <div class="checkbox-flex">
                  <input type="radio" id="pref-fulltime" name="prefEmploymentType" value="fulltime">
                  <label for="pref-fulltime">Full-time</label>
                </div>
              </div>
              <div class="error" id="prefEmploymentType-error">Please select at least one employment type</div>
            </div>
            <div class="form-group">
              <label class="required">PREFERRED OCCUPATION</label>
              <div class="form-group">
                <input type="text" id="prefOccupation1" name="prefOccupation1" placeholder="1.">
                <div class="error" id="prefOccupation1-error">Please enter your preferred occupation</div>
              </div>
              <div class="form-group">
                <input type="text" id="prefOccupation2" name="prefOccupation2" placeholder="2.">
              </div>
              <div class="form-group">
                <input type="text" id="prefOccupation3" name="prefOccupation3" placeholder="3.">
              </div>
            </div>
            <div class="form-group">
              <label class="required">PREFERRED WORK LOCATION</label>
              <div class="form-group">
                <input type="text" id="prefLocal1" name="prefLocal1" placeholder="Local (specify cities/municipalities): 1.">
              </div>
              <div class="form-group">
                <input type="text" id="prefLocal2" name="prefLocal2" placeholder="2.">
              </div>
              <div class="form-group">
                <input type="text" id="prefLocal3" name="prefLocal3" placeholder="3.">
              </div>
              <div class="form-group">
                <input type="text" id="prefOverseas1" name="prefOverseas1" placeholder="Overseas (specify countries): 1.">
              </div>
              <div class="form-group">
                <input type="text" id="prefOverseas2" name="prefOverseas2" placeholder="2.">
              </div>
              <div class="form-group">
                <input type="text" id="prefOverseas3" name="prefOverseas3" placeholder="3.">
              </div>
            </div>

          </div>
        </div>

        <!-- Section III: Language/Dialect Proficiency -->
        <div class="section ">
          <h2 class=" section-title">III. LANGUAGE / DIALECT PROFICIENCY</h2>
          <div class="form-grid">
            <div class="form-group language-dialect-container">
              <table class="language-table">
                <thead>
                  <tr>
                    <th>LANGUAGE/DIALECT</th>
                    <th>READ</th>
                    <th>WRITE</th>
                    <th>SPEAK</th>
                    <th>UNDERSTAND</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>English</td>
                    <td><input type="checkbox" id="englishRead" name="englishRead"></td>
                    <td><input type="checkbox" id="englishWrite" name="englishWrite"></td>
                    <td><input type="checkbox" id="englishSpeak" name="englishSpeak"></td>
                    <td><input type="checkbox" id="englishUnderstand" name="englishUnderstand"></td>
                  </tr>
                  <tr>
                    <td>Filipino</td>
                    <td><input type="checkbox" id="filipinoRead" name="filipinoRead"></td>
                    <td><input type="checkbox" id="filipinoWrite" name="filipinoWrite"></td>
                    <td><input type="checkbox" id="filipinoSpeak" name="filipinoSpeak"></td>
                    <td><input type="checkbox" id="filipinoUnderstand" name="filipinoUnderstand"></td>
                  </tr>
                  <tr>
                    <td>Mandarin</td>
                    <td><input type="checkbox" id="mandarinRead" name="mandarinRead"></td>
                    <td><input type="checkbox" id="mandarinWrite" name="mandarinWrite"></td>
                    <td><input type="checkbox" id="mandarinSpeak" name="mandarinSpeak"></td>
                    <td><input type="checkbox" id="mandarinUnderstand" name="mandarinUnderstand"></td>
                  </tr>
                  <tr>
                    <td>
                      <input type="text" placeholder="Others:" id="otherLanguage" name="otherLanguage">
                    </td>
                    <td><input type="checkbox" id="otherRead" name="otherRead"></td>
                    <td><input type="checkbox" id="otherWrite" name="otherWrite"></td>
                    <td><input type="checkbox" id="otherSpeak" name="otherSpeak"></td>
                    <td><input type="checkbox" id="otherUnderstand" name="otherUnderstand"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Section IV: Educational Background -->
        <div class="section ">
          <h2 class=" section-title">IV. EDUCATIONAL BACKGROUND</h2>
          <div class="form-grid">
            <div class="form-group">
              <label class="required">Currently in school?</label>
              <div class="checkbox-group">
                <div class="checkbox-flex">
                  <input type="checkbox" id="inSchool-yes" name="inSchool" value="yes" required>
                  <label for="inSchool-yes">Yes</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="inSchool-no" name="inSchool" value="no">
                  <label for="inSchool-no">No</label>
                </div>
              </div>
            </div>
            <div class="form-group" style="grid-column:span 4;">
              <table class="education-table">
                <thead>
                  <tr>
                    <th>LEVEL</th>
                    <th>COURSE</th>
                    <th>YEAR GRADUATED</th>
                    <th colspan="2">IF UNDERGRADUATE</th>
                  </tr>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>LEVEL REACHED</th>
                    <th>YEAR LAST ATTENDED</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Elementary</td>
                    <td><input type="text" name="elementaryCourse"></td>
                    <td><input type="text" name="elementaryYear"></td>
                    <td><input type="text" name="elementaryLevel"></td>
                    <td><input type="text" name="elementaryLastYear"></td>
                  </tr>
                  <tr>
                    <td>
                      <select name="secondaryType">
                        <option value="non-k12">Secondary (Non-K12)</option>
                        <option value="k12">Secondary (K-12)</option>
                      </select>
                    </td>
                    <td><input type="text" name="secondaryCourse"></td>
                    <td><input type="text" name="secondaryYear"></td>
                    <td><input type="text" name="secondaryLevel"></td>
                    <td><input type="text" name="secondaryLastYear"></td>
                  </tr>
                  <tr id="seniorHighStrandRow" style="display: none;">
                    <td colspan="5">
                      <label for="seniorHighStrand">Senior High Strand:</label>
                      <input type="text" id="seniorHighStrand" name="seniorHighStrand">
                    </td>
                  </tr>
                  <tr>
                    <td>Tertiary</td>
                    <td><input type="text" name="tertiaryCourse"></td>
                    <td><input type="text" name="tertiaryYear"></td>
                    <td><input type="text" name="tertiaryLevel"></td>
                    <td><input type="text" name="tertiaryLastYear"></td>
                  </tr>
                  <tr>
                    <td>Graduate Studies / Post-graduate</td>
                    <td><input type="text" name="gradStudiesCourse"></td>
                    <td><input type="text" name="gradStudiesYear"></td>
                    <td><input type="text" name="gradStudiesLevel"></td>
                    <td><input type="text" name="gradStudiesLastYear"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Section V: Technical/Vocational Training -->
        <div class="section ">
          <h2 class="section-title">V. TECHNICAL/VOCATIONAL AND OTHER TRAINING</h2>
          <p style="margin-bottom: 15px; font-style: italic;">
            (include courses taken as part of college education)
          </p>
          <div class="form-grid">
            <div class="form-group">
              <table>
                <thead>
                  <tr>
                    <th>TRAINING/VOCATIONAL COURSE</th>
                    <th>HOURS OF TRAINING</th>
                    <th>TRAINING INSTITUTION</th>
                    <th>SKILLS ACQUIRED</th>
                    <th>CERTIFICATES RECEIVED (NC I, NC II, NC III, NC IV, etc.)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="trainingCourse1"></td>
                    <td><input type="number" min="1" name="trainingHours1"></td>
                    <td><input type="text" name="trainingInstitution1"></td>
                    <td><input type="text" name="trainingSkills1"></td>
                    <td><input type="text" name="trainingCertificates1"></td>
                  </tr>
                  <tr>
                    <td><input type="text" name="trainingCourse2"></td>
                    <td><input type="number" min="1" name="trainingHours2"></td>
                    <td><input type="text" name="trainingInstitution2"></td>
                    <td><input type="text" name="trainingSkills2"></td>
                    <td><input type="text" name="trainingCertificates2"></td>
                  </tr>
                  <tr>
                    <td><input type="text" name="trainingCourse3"></td>
                    <td><input type="number" min="1" name="trainingHours3"></td>
                    <td><input type="text" name="trainingInstitution3"></td>
                    <td><input type="text" name="trainingSkills3"></td>
                    <td><input type="text" name="trainingCertificates3"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Section VI: Eligibility/Professional License -->
        <div class="section ">
          <h2 class="section-title">VI. ELIGIBILITY/ PROFESSIONAL LICENSE</h2>

          <div class="form-grid">
            <div class="form-group">
              <table>
                <thead>
                  <tr>
                    <th>ELIGIBILITY (Civil Service)</th>
                    <th>DATE TAKEN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="eligibility1"></td>
                    <td><input type="date" name="eligibilityDate1"></td>
                  </tr>
                  <tr>
                    <td><input type="text" name="eligibility2"></td>
                    <td><input type="date" name="eligibilityDate2"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="form-group">
              <table>
                <thead>
                  <tr>
                    <th>PROFESSIONAL LICENSE (PRC)</th>
                    <th>VALID UNTIL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="license1"></td>
                    <td><input type="date" name="licenseValid1"></td>
                  </tr>
                  <tr>
                    <td><input type="text" name="license2"></td>
                    <td><input type="date" name="licenseValid2"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Section VII: Work Experience -->
        <div class="section ">
          <h2 class="section-title">VII. WORK EXPERIENCE</h2>
          <p style="margin-bottom: 15px; font-style: italic;">
            (Limit to 10 year period, start with the most recent employment)
          </p>
          <div class="form-grid">
            <div class="form-group">
              <table>
                <thead>
                  <tr>
                    <th>COMPANY NAME</th>
                    <th>ADDRESS (City/Municipality)</th>
                    <th>POSITION</th>
                    <th>NUMBER OF MONTHS</th>
                    <th>STATUS (Permanent, Contractual, Part-time, Probationary)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="company1"></td>
                    <td><input type="text" name="companyAddress1"></td>
                    <td><input type="text" name="position1"></td>
                    <td><input type="number" name="months1"></td>
                    <td>
                      <select name="status1">
                        <option value="">Select Status</option>
                        <option value="permanent">Permanent</option>
                        <option value="contractual">Contractual</option>
                        <option value="part-time">Part-time</option>
                        <option value="probationary">Probationary</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="text" name="company2"></td>
                    <td><input type="text" name="companyAddress2"></td>
                    <td><input type="text" name="position2"></td>
                    <td><input type="number" name="months2"></td>
                    <td>
                      <select name="status2">
                        <option value="">Select Status</option>
                        <option value="permanent">Permanent</option>
                        <option value="contractual">Contractual</option>
                        <option value="part-time">Part-time</option>
                        <option value="probationary">Probationary</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="text" name="company3"></td>
                    <td><input type="text" name="companyAddress3"></td>
                    <td><input type="text" name="position3"></td>
                    <td><input type="number" name="months3"></td>
                    <td>
                      <select name="status3">
                        <option value="">Select Status</option>
                        <option value="permanent">Permanent</option>
                        <option value="contractual">Contractual</option>
                        <option value="part-time">Part-time</option>
                        <option value="probationary">Probationary</option>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Section VIII: Other Skills -->
        <div class="section ">
          <h2 class="section-title">VIII. OTHER SKILLS ACQUIRED WITHOUT CERTIFICATE</h2>
          <div class="form-grid">
            <div class="form-group">
              <div class="checkbox-group" style="display:grid;grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-auto" name="skills[]" value="auto">
                  <label for="skill-auto">AUTO MECHANIC</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-beautician" name="skills[]" value="beautician">
                  <label for="skill-beautician">BEAUTICIAN</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-carpentry" name="skills[]" value="carpentry">
                  <label for="skill-carpentry">CARPENTRY WORK</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-computer" name="skills[]" value="computer">
                  <label for="skill-computer">COMPUTER LITERATE</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-domestic" name="skills[]" value="domestic">
                  <label for="skill-domestic">DOMESTIC CHORES</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-driver" name="skills[]" value="driver">
                  <label for="skill-driver">DRIVER</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-electrician" name="skills[]" value="electrician">
                  <label for="skill-electrician">ELECTRICIAN</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-embroidery" name="skills[]" value="embroidery">
                  <label for="skill-embroidery">EMBROIDERY</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-gardening" name="skills[]" value="gardening">
                  <label for="skill-gardening">GARDENING</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-masonry" name="skills[]" value="masonry">
                  <label for="skill-masonry">MASONRY</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-painter" name="skills[]" value="painter">
                  <label for="skill-painter">PAINTER/ARTIST</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-painting" name="skills[]" value="painting">
                  <label for="skill-painting">PAINTING JOBS</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-photography" name="skills[]" value="photography">
                  <label for="skill-photography">PHOTOGRAPHY</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-plumbing" name="skills[]" value="plumbing">
                  <label for="skill-plumbing">PLUMBING</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-sewing" name="skills[]" value="sewing">
                  <label for="skill-sewing">SEWING DRESSES</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-stenography" name="skills[]" value="stenography">
                  <label for="skill-stenography">STENOGRAPHY</label>
                </div>
                <div class="checkbox-flex">
                  <input type="checkbox" id="skill-tailoring" name="skills[]" value="tailoring">
                  <label for="skill-tailoring">TAILORING</label>
                </div>
                <div class="checkbox-flex" style="grid-column: span 2; display: flex; gap: 5px;">
                  <input type="checkbox" id="skill-others" name="skills[]" value="others" style="width:auto; height:auto;">
                  <label for="skill-others">OTHERS</label>
                  <input type="text" id="skill-other-specify" name="skillOtherSpecify" placeholder="Please specify other skills" style="display:none;">
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Section IX. Documents Section -->
        <div class="section ">
          <h2 class="section-title">IX. Documents</h2>
          <div class="form-grid">
            <div class="form-group">
              <label class="required">Resume/CV</label>
              <label class="file-upload" id="resumeUpload" for="resumeFile">
                <p>Upload your Resume in a PDF format. Below 10mb.</p>
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

        <!-- Section X. Links Section -->
        <div class="section ">
          <h2 class="section-title">X. Links</h2>
          <div class="form-grid">

            <!-- Portfolio Website -->
            <div class="form-group">
              <label>Portfolio Website</label>
              <input
                type="url"
                class="form-input"
                id="portfolioLink"
                name="portfolioLink"
                placeholder="https://yourportfolio.com" />
              <small class="input-note">Optional — link to your personal website, online portfolio, or projects.</small>
            </div>

            <!-- Google Drive Link -->
            <div class="form-group">
              <label>Google Drive Link</label>
              <input
                type="url"
                class="form-input"
                id="gdriveLink"
                name="gdriveLink"
                placeholder="https://drive.google.com/..."
                pattern="https:\/\/drive\.google\.com\/.*" />
              <small class="input-note">Use only shareable view links. Example: https://drive.google.com/file/d/.../view</small>
            </div>

            <!-- Other Relevant Links -->
            <div class="form-group">
              <label>Other Relevant Links</label>
              <input
                type="url"
                class="form-input"
                id="otherLinks"
                name="otherLinks"
                placeholder="https://example.com" />
              <small class="input-note">Optional — links to LinkedIn, GitHub, Behance, or any other professional platform.</small>
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
    const editBtn = document.getElementById('editBtn');
    const inputs = document.querySelectorAll('#profileForm input');
    const select = document.querySelectorAll('#profileForm select');
    const textAreas = document.querySelectorAll('#profileForm textarea');
    const profilePicInput = document.getElementById('profilePicInput');

    window.addEventListener('DOMContentLoaded', () => {
      inputs.forEach(input => input.disabled = true);
      select.forEach(select => select.disabled = true);
      textAreas.forEach(textArea => textArea.disabled = true);
      editBtn.disabled = false;
      profilePicInput.disabled = true;
      const employed = document.getElementById("employed");
      const unemployed = document.getElementById("unemployed");
      const wageEmployed = document.getElementById("wage-employed");
      const selfEmployed = document.getElementById("self-employed");
      const employedBoxes = document.querySelector(".employed-checkboxes:nth-of-type(2)");
      const selfEmployedBoxes = document.querySelector(".self-employed-checkboxes");
      const unemployedBoxes = document.querySelector(".unemployed-checkboxes");
      employed.addEventListener("change", () => {
        employedBoxes.style.display = employed.checked ? "grid" : "none";
        unemployed.checked = false;
        unemployedBoxes.style.display = 'none';
        document.querySelectorAll(".unemployed-checkboxes .checkbox-flex input").forEach(checkbox => checkbox.checked = false);
        if (!employed.checked) {
          selfEmployed.checked = false;
          selfEmployedBoxes.style.display = "none";
        }
      });
      selfEmployed.addEventListener("change", () => {
        selfEmployedBoxes.style.display = selfEmployed.checked ? "grid" : "none";
      });
      unemployed.addEventListener("change", () => {
        employed.checked = false;
        wageEmployed.checked = false;
        selfEmployed.checked = false;
        employedBoxes.style.display = 'none';
        selfEmployedBoxes.style.display = 'none';
        document.querySelectorAll(".self-employed-checkboxes .checkbox-flex input").forEach(checkbox => checkbox.checked = false);
        unemployedBoxes.style.display = unemployed.checked ? "flex" : "none";
      });
      const ofwYes = document.getElementById("ofw-yes");
      const ofwNo = document.getElementById("ofw-no");
      const ofwCountryGroup = document.getElementById("ofw-country-group");
      const ofwCountryInput = document.getElementById("ofwCountry");
      ofwYes.addEventListener("change", () => {
        if (ofwYes.checked) {
          ofwCountryGroup.style.display = "flex";
          ofwNo.checked = false;
        } else {
          ofwCountryGroup.style.display = "none";
          ofwCountryInput.value = "";
        }
      });
      ofwNo.addEventListener("change", () => {
        if (ofwNo.checked) {
          ofwCountryGroup.style.display = "none";
          ofwCountryInput.value = "";
          ofwYes.checked = false;
        }
      });
      const formerOfwYes = document.getElementById("former-ofw-yes");
      const formerOfwNo = document.getElementById("former-ofw-no");
      const formerOfwCountryGroup = document.getElementById("former-ofw-country-group");
      const returnDateGroup = document.getElementById("return-date-group");
      const formerOfwCountryInput = document.getElementById("formerOfwCountry");
      const returnDateInput = document.getElementById("returnDate");
      formerOfwYes.addEventListener("change", () => {
        if (formerOfwYes.checked) {
          formerOfwCountryGroup.style.display = "flex";
          returnDateGroup.style.display = "flex";
          formerOfwNo.checked = false;
        } else {
          formerOfwCountryGroup.style.display = "none";
          returnDateGroup.style.display = "none";
          formerOfwCountryInput.value = "";
          returnDateInput.value = "";
        }
      });
      formerOfwNo.addEventListener("change", () => {
        if (formerOfwNo.checked) {
          formerOfwCountryGroup.style.display = "none";
          returnDateGroup.style.display = "none";
          formerOfwCountryInput.value = "";
          returnDateInput.value = "";
          formerOfwYes.checked = false;
        }
      });
    });
    editBtn.addEventListener('click', () => {
      if (editBtn.textContent === 'Edit') {
        inputs.forEach(input => input.disabled = false);
        select.forEach(select => select.disabled = false);
        textAreas.forEach(textArea => textArea.disabled = false);
        profilePicInput.disabled = false;
        editBtn.textContent = 'Cancel';
      } else {
        inputs.forEach(input => input.disabled = true);
        select.forEach(select => select.disabled = true);
        textAreas.forEach(textArea => textArea.disabled = true);
        profilePicInput.disabled = true;
        editBtn.textContent = 'Edit';
      }
    });
  </script>
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
    const docsData = <?php echo $docsJson; ?>;
    const trainingData = <?php echo $trainingJson; ?>;
    const linkData = <?php echo $docsLinkJson; ?>;
    const employmentData = <?php echo $employmentJson; ?>;
    const joblngData = <?php echo $joblngJson; ?>;

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
        document.getElementById('height').value = profileData.height || '';
        document.getElementById('tin').value = profileData.tin || '';
        document.getElementById('religion').value = profileData.religion || '';
        
      }

      if (employmentData) {
        document.querySelector(".employed-checkboxes").style.display = "none";
        document.querySelector(".self-employed-checkboxes").style.display = "none";
        document.querySelector(".unemployed-checkboxes").style.display = "none";
        
        if (employmentData.employment_status === "Employed") {
          document.getElementById("employed").checked = true;
          document.querySelector(".employed-checkboxes").style.display = "grid";

        } else if (employmentData.employment_status === "Unemployed") {
          document.getElementById("unemployed").checked = true;
          document.querySelector(".unemployed-checkboxes").style.display = "grid";

        } else if (employmentData.employment_status === "Self-Employed") {
          document.getElementById("self-employed").checked = true;
          document.getElementById("employed").checked = true;
          document.querySelector(".employed-checkboxes").style.display = "grid";
          document.querySelector(".self-employed-checkboxes").style.display = "grid";
        }

        if (employmentData.wage_employed == 1) {
          document.getElementById("wage-employed").checked = true;
        }
        if (employmentData.self_employed_type) {
          let types = employmentData.self_employed_type.split(",");
          types.forEach(type => {
            let cleanType = type.trim();
            let el = document.querySelector(`input[name="selfEmployedType[]"][value="${cleanType}"]`);
            if (el) el.checked = true;
          });
        }
        if (employmentData.self_employed_other) {
          document.querySelector("input[name='selfEmployedOther']").value = employmentData.self_employed_other;
        }
        if (employmentData.job_search_duration) {
          document.getElementById("jobSearchDuration").value = employmentData.job_search_duration;
        }
        if (employmentData.unemp_reasons && employmentData.unemp_reasons.trim() !== "") {
          let reasons = employmentData.unemp_reasons.split(",");

          reasons.forEach(reason => {
            reason = reason.trim();

            if (reason.toLowerCase().startsWith("other:")) {
              const othersCheckbox = document.querySelector(`input[name="unempReason[]"][value="other"]`);
              const othersInput = document.querySelector("input[name='unempReasonOthers']");
              const otherValue = reason.split(":")[1]?.trim() || "";

              if (othersCheckbox) othersCheckbox.checked = true;
              if (othersInput) {
                othersInput.style.display = "block";
                othersInput.value = otherValue;
              }
              } else if (reason.toLowerCase().startsWith("terminated-abroad:")) {
                const abroadCheckbox = document.querySelector(`input[name="unempReason[]"][value="terminated-abroad"]`);
              const abroadInput = document.querySelector("input[name='otherTerm']");
              const abroadValue = reason.split(":")[1]?.trim() || "";

              if (abroadCheckbox) abroadCheckbox.checked = true;
              if (abroadInput) {
                abroadInput.style.display = "block";
                abroadInput.value = abroadValue;
              }

            } else {
              let el = document.querySelector(`input[name="unempReason[]"][value="${reason}"]`);
              if (el) el.checked = true;
            }
          });
        }

      if (employmentData.ofw) {
        if (employmentData.ofw === "yes") {
          document.getElementById("ofw-yes").checked = true;
          document.getElementById("ofw-country-group").style.display = "flex";

          if (employmentData.ofw_country) {
            document.getElementById("ofwCountry").value = employmentData.ofw_country;
          }
        } else if (employmentData.ofw === "no") {
          document.getElementById("ofw-no").checked = true;
        }
      }
      if (employmentData.former_ofw) {
        if (employmentData.former_ofw === "yes") {
          document.getElementById("former-ofw-yes").checked = true;
          document.getElementById("former-ofw-country-group").style.display = "flex";
          document.getElementById("return-date-group").style.display = "flex";

          if (employmentData.former_ofw_country) {
            document.getElementById("formerOfwCountry").value = employmentData.former_ofw_country;
          }
          if (employmentData.return_date) {
            const returnDate = employmentData.return_date.substring(0, 7);
            document.getElementById("returnDate").value = returnDate;
          }
        } else if (employmentData.former_ofw === "no") {
          document.getElementById("former-ofw-no").checked = true;
        }
      }
      }
      
      if (joblngData) {
       if (joblngData.pref_employment_types) {
        let employmentTypes = joblngData.pref_employment_types;
        if (typeof employmentTypes === "string") {
            employmentTypes = JSON.parse(employmentTypes);
        }
        const employmentTypeRadio = document.querySelector(`input[name="prefEmploymentType"][value="${employmentTypes[0] || ''}"]`);
        if (employmentTypeRadio) employmentTypeRadio.checked = true;
        }
        function assignArrayValues(inputPrefix, valuesStr) {
            if (!valuesStr) return;
            let values = valuesStr;
            if (typeof valuesStr === "string") values = JSON.parse(valuesStr);
            values.forEach((val, index) => {
                const input = document.getElementById(`${inputPrefix}${index + 1}`);
                if (input) input.value = val;
            });
        }

        assignArrayValues("prefOccupation", joblngData.pref_occupations);
        assignArrayValues("prefLocal", joblngData.pref_local_work_locations);
        assignArrayValues("prefOverseas", joblngData.pref_overseas_work_locations);

      if (!joblngData || !joblngData.language_proficiency) return;

      let langs = joblngData.language_proficiency;
      if (typeof langs === "string") langs = JSON.parse(langs);

      for (const [lang, prof] of Object.entries(langs)) {
          ['read','write','speak','understand'].forEach(skill => {
              const checkbox = document.getElementById(`${lang}${skill.charAt(0).toUpperCase() + skill.slice(1)}`);
              if (checkbox) checkbox.checked = prof[skill] === 1;
          });

          if (lang === 'other' && prof.name) {
              const otherInput = document.getElementById('otherLanguage');
              if (otherInput) otherInput.value = prof.name.trim();
          }
      }
    }

      if (linkData && linkData.length > 0) {
       const links = linkData[0];
        document.getElementById('portfolioLink').value = links.port_link || '';
        document.getElementById('gdriveLink').value = links.drive_link || '';
        document.getElementById('otherLinks').value = links.other_link || '';
      }

      if (profileData.disability) {
      let disabilities = profileData.disability.split(',').map(d => d.trim());

        disabilities.forEach(function(dis, index) {
          if (["Visual", "Speech", "Mental", "Hearing", "Physical"].includes(dis)) {
              const checkbox = document.querySelector('input[name="disability[]"][value="' + dis + '"]');
              if (checkbox) checkbox.checked = true;
          } else if (dis === "Others") {
              const othersCheckbox = document.querySelector('input[name="disability[]"][value="Others"]');
              const othersInput = document.getElementById("others");

              if (othersCheckbox) othersCheckbox.checked = true;
              const othersText = disabilities[index + 1] || "";
              if (othersInput) othersInput.value = othersText.trim();
          }
      });
      }

      if (contactData) {
        document.getElementById('mobile').value = contactData.mobile_number || '';
        document.getElementById('street').value = contactData.street_address || '';
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
      if (trainingData && trainingData.length > 0) {
      trainingData.forEach((training, index) => {
      const i = index + 1;
      if (document.querySelector(`[name="trainingCourse${i}"]`)) {
        document.querySelector(`[name="trainingCourse${i}"]`).value = training.training_course || '';
        document.querySelector(`[name="trainingHours${i}"]`).value = training.training_hours || '';
        document.querySelector(`[name="trainingInstitution${i}"]`).value = training.training_institution || '';
        document.querySelector(`[name="trainingSkills${i}"]`).value = training.training_skills || '';
        document.querySelector(`[name="trainingCertificates${i}"]`).value = training.training_certificates || '';
      }
    });
  }
  });
  
    const savedSkills = <?php echo json_encode($skills); ?>;
    const savedOtherSkill = <?php echo json_encode($otherSkill); ?>;

    document.addEventListener("DOMContentLoaded", () => {
      savedSkills.forEach(skill => {
    const checkbox = document.querySelector('input[name="skills[]"][value="' + skill + '"]');
    if (checkbox) checkbox.checked = true;
    });
      if (savedOtherSkill && savedOtherSkill.trim() !== "") {
      const othersCheckbox = document.querySelector('input[name="skills[]"][value="others"]');
      const othersInput = document.getElementById("skill-other-specify");

      if (othersCheckbox) othersCheckbox.checked = true;
      if (othersInput) {
        othersInput.style.display = "block";
        othersInput.value = savedOtherSkill;
      }
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

    document.getElementById("skill-others").addEventListener("change", function() {
  const otherInput = document.getElementById("skill-other-specify");
  otherInput.style.display = this.checked ? "inline-block" : "none";
  });
  </script>
  <script src="../js/responsive.js"></script>
  <script src="../js/dark-mode.js"></script>
  <script>
    const regionSel = document.getElementById('region');
    const provinceSel = document.getElementById('province');
    const citySel = document.getElementById('city');
    const barangaySel = document.getElementById('barangay');

    // Reset helper
    function reset(selectEl, placeholder) {
      selectEl.innerHTML = `<option value="">${placeholder}</option>`;
      selectEl.disabled = true;
    }

    // Inject PHP JSON arrays into JS
    const regions = <?= json_encode($regions) ?>;
    const provinces = <?= json_encode($provinces) ?>;
    const cities = <?= json_encode($cities) ?>;
    const barangays = <?= json_encode($barangays) ?>;

    /* --- Region Change --- */
    regionSel.addEventListener('change', () => {
      const regionName = regionSel.options[regionSel.selectedIndex].text;

      reset(provinceSel, 'Select Province');
      reset(citySel, 'Select City/Municipality');
      reset(barangaySel, 'Select Barangay');

      if (!regionSel.value) return;

      provinces
        .filter(p => p.region === regionName)
        .forEach(p => {
          const opt = document.createElement('option');
          opt.value = p.code;
          opt.textContent = p.name;
          provinceSel.appendChild(opt);
        });

      provinceSel.disabled = false;
    });

    /* --- Province Change --- */
    provinceSel.addEventListener('change', () => {
      const provName = provinceSel.options[provinceSel.selectedIndex].text;

      reset(citySel, 'Select City/Municipality');
      reset(barangaySel, 'Select Barangay');

      if (!provinceSel.value) return;

      cities
        .filter(c => c.province === provName)
        .forEach(c => {
          const opt = document.createElement('option');
          opt.value = c.code;
          opt.textContent = c.name;
          citySel.appendChild(opt);
        });

      citySel.disabled = false;
    });

    /* --- City Change --- */
    citySel.addEventListener('change', () => {
      const cityName = citySel.options[citySel.selectedIndex].text;

      reset(barangaySel, 'Select Barangay');

      if (!citySel.value) return;

      barangays
        .filter(b => b.city_municipality === cityName)
        .forEach(b => {
          const opt = document.createElement('option');
          opt.value = b.code;
          opt.textContent = b.name;
          barangaySel.appendChild(opt);
        });

      barangaySel.disabled = false;
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