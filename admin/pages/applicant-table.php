<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Office Management Dashboard</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>
  <div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <div class="logo-icon">
          <img
            src="../../landing/assets/images/pesosmb.png"
            style="width: 50px; height: 50px; margin-top: 10px"
            alt="PESO Logo" />
        </div>
        <h2 style="font-size: 2.25rem">PESO</h2>
      </div>
      <div class="nav-menu">
        <a class="nav-item active" href="dashboard.php">
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </a>
        <a class="nav-item" href="#pending-employers">
          <i class="fas fa-building"></i>
          <span>Employers</span>
        </a>
        <a class="nav-item" href="#posted-jobs">
          <i class="fas fa-list-alt"></i>
          <span>Posted Jobs</span>
        </a>
        <a class="nav-item" href="#applicants">
          <i class="fas fa-users"></i>
          <span>Applicants</span>
        </a>
        <a class="nav-item " href="reports.php">
          <i class="fas fa-chart-bar"></i>
          <span>Reports</span>
        </a>
        <a class="nav-item" href="news-upload.php">
          <i class="fas fa-newspaper"></i>
          <span>News</span>
        </a>
        <a class="nav-item" href="../Function/logout.php">
          <i class="fas fa-cog"></i>
          <span>Logout</span>
        </a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <div class="header">
        <h1>Admin Dashboard</h1>
        <div style="display: flex; align-items: center; gap: 20px">
          <div class="user-profile">
            <img
              src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff"
              alt="Admin User" />
            <div>
              <p>Ian Lei Castillo</p>
              <span>SUPER IDOL</span>
            </div>
            <!-- <i class="fas fa-chevron-down"></i> -->
          </div>
        </div>
      </div>
      <!-- Content Wrapper -->
      <div class="content-wrapper">
        <!-- Stats Cards -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-header">
              <h3 class="stat-title">Employers</h3>
              <div class="stat-icon bg-primary-light">
                <i class="fas fa-building"></i>
              </div>
            </div>
            <div class="stat-value">128</div>
            <div class="stat-label">24 pending verification</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <h3 class="stat-title">Applicants</h3>
              <div class="stat-icon bg-success-light">
                <i class="fas fa-user-graduate"></i>
              </div>
            </div>
            <div class="stat-value">542</div>
            <div class="stat-label">89 this week</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <h3 class="stat-title">Job Listings</h3>
              <div class="stat-icon bg-warning-light">
                <i class="fas fa-briefcase"></i>
              </div>
            </div>
            <div class="stat-value">76</div>
            <div class="stat-label">15 new listings</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <h3 class="stat-title">Pending Tasks</h3>
              <div class="stat-icon bg-danger-light">
                <i class="fas fa-tasks"></i>
              </div>
            </div>
            <div class="stat-value">18</div>
            <div class="stat-label">7 high priority</div>
          </div>
        </div>

        <!-- Pending Employer Verifications Table -->
        <div class="table-section">
          <div class="section-header">
            <h2 class="section-title">
              <i class="fas fa-clock text-warning"></i>
              Pending Employer Verifications
            </h2>

          </div>
          <div class="table-responsive">
            <table class="table custom-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Company Name</th>
                  <th>Contact Person</th>
                  <th>Email</th>
                  <th>Submitted On</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>EMP-1025</td>
                  <td>TechSolutions Inc.</td>
                  <td>John Smith</td>
                  <td>john@techsolutions.com</td>
                  <td>2023-10-15</td>
                  <td>
                    <span class="status-badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#employerModal"
                      data-id="EMP-1025">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>EMP-1026</td>
                  <td>DataWorks LLC</td>
                  <td>Sarah Johnson</td>
                  <td>sarah@dataworks.com</td>
                  <td>2023-10-16</td>
                  <td>
                    <span class="status-badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#employerModal"
                      data-id="EMP-1026">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>EMP-1027</td>
                  <td>CloudNet Systems</td>
                  <td>Michael Brown</td>
                  <td>michael@cloudnet.com</td>
                  <td>2023-10-17</td>
                  <td>
                    <span class="status-badge badge-pending"><i class="fas fa-clock"></i> Pending</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#employerModal"
                      data-id="EMP-1027">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Job List Table -->
        <div class="table-section">
          <div class="section-header">
            <h2 class="section-title">
              <i class="fas fa-briefcase text-primary"></i>
              Job List
            </h2>

          </div>
          <div class="table-responsive">
            <table class="table custom-table">
              <thead>
                <tr>
                  <th>Job ID</th>
                  <th>Job Title</th>
                  <th>Company</th>
                  <th>Location</th>
                  <th>Posted On</th>
                  <th>Applications</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>J-2056</td>
                  <td>Senior Software Engineer</td>
                  <td>TechSolutions Inc.</td>
                  <td>San Francisco, CA</td>
                  <td>2023-10-10</td>
                  <td>42</td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#jobModal"
                      data-id="J-2056">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>J-2057</td>
                  <td>Data Analyst</td>
                  <td>DataWorks LLC</td>
                  <td>New York, NY</td>
                  <td>2023-10-12</td>
                  <td>35</td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#jobModal"
                      data-id="J-2057">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>J-2058</td>
                  <td>Cloud Architect</td>
                  <td>CloudNet Systems</td>
                  <td>Remote</td>
                  <td>2023-10-14</td>
                  <td>28</td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#jobModal"
                      data-id="J-2058">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Verified Employers Table -->
        <div class="table-section">
          <div class="section-header">
            <h2 class="section-title">
              <i class="fas fa-check-circle text-success"></i>
              Verified Employers
            </h2>

          </div>
          <div class="table-responsive">
            <table class="table custom-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Company Name</th>
                  <th>Industry</th>
                  <th>Contact Email</th>
                  <th>Verified On</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>EMP-1001</td>
                  <td>InnovateTech Ltd.</td>
                  <td>Information Technology</td>
                  <td>contact@innovatetech.com</td>
                  <td>2023-09-15</td>
                  <td>
                    <span class="status-badge badge-verified"><i class="fas fa-check"></i> Verified</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#employerModal"
                      data-id="EMP-1001">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>EMP-1002</td>
                  <td>GreenSolutions Co.</td>
                  <td>Environmental Services</td>
                  <td>info@greensolutions.com</td>
                  <td>2023-09-20</td>
                  <td>
                    <span class="status-badge badge-verified"><i class="fas fa-check"></i> Verified</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#employerModal"
                      data-id="EMP-1002">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>EMP-1003</td>
                  <td>HealthCare Partners</td>
                  <td>Healthcare</td>
                  <td>admin@healthcarepartners.com</td>
                  <td>2023-09-25</td>
                  <td>
                    <span class="status-badge badge-verified"><i class="fas fa-check"></i> Verified</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#employerModal"
                      data-id="EMP-1003">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Recent Applicants Table -->
        <div class="table-section">
          <div class="section-header">
            <h2 class="section-title">
              <i class="fas fa-users text-info"></i>
              Recent Applicants
            </h2>
          </div>
          <div class="table-responsive">
            <table class="table custom-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Position Applied</th>
                  <th>Email</th>
                  <th>Applied On</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>APP-3050</td>
                  <td>Jennifer Wilson</td>
                  <td>Senior Software Engineer</td>
                  <td>jennifer.wilson@example.com</td>
                  <td>2023-10-18</td>
                  <td>
                    <span class="status-badge badge-review"><i class="fas fa-clock"></i> Review</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#applicantModal"
                      data-id="APP-3050">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>APP-3051</td>
                  <td>Robert Davis</td>
                  <td>Data Analyst</td>
                  <td>robert.davis@example.com</td>
                  <td>2023-10-17</td>
                  <td>
                    <span class="status-badge badge-review"><i class="fas fa-clock"></i> Review</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#applicantModal"
                      data-id="APP-3051">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>APP-3052</td>
                  <td>Emily Clark</td>
                  <td>Cloud Architect</td>
                  <td>emily.clark@example.com</td>
                  <td>2023-10-16</td>
                  <td>
                    <span class="status-badge badge-review"><i class="fas fa-clock"></i> Review</span>
                  </td>
                  <td>
                    <button
                      class="btn-view"
                      data-bs-toggle="modal"
                      data-bs-target="#applicantModal"
                      data-id="APP-3052">
                      <i class="fas fa-eye"></i> View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Employer Modal -->
  <div
    class="modal fade"
    id="employerModal"
    tabindex="-1"
    aria-labelledby="employerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="employerModalLabel">
            <i class="fas fa-building"></i> Employer Details
          </h5>
          <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row mb-4">
              <div class="col-md-6">
                <h5>Company Information</h5>
                <p>
                  <strong>Company Name:</strong>
                  <span id="employer-company-name">TechSolutions Inc.</span>
                </p>
                <p>
                  <strong>Contact Person:</strong>
                  <span id="employer-contact">John Smith</span>
                </p>
                <p>
                  <strong>Email:</strong>
                  <span id="employer-email">john@techsolutions.com</span>
                </p>
                <p>
                  <strong>Phone:</strong>
                  <span id="employer-phone">+1 (555) 123-4567</span>
                </p>
              </div>
              <div class="col-md-6">
                <h5>Business Details</h5>
                <p>
                  <strong>Industry:</strong>
                  <span id="employer-industry">Information Technology</span>
                </p>
                <p>
                  <strong>Company Size:</strong>
                  <span id="employer-size">150 employees</span>
                </p>
                <p>
                  <strong>Website:</strong>
                  <span id="employer-website">www.techsolutions.com</span>
                </p>
                <p>
                  <strong>Status:</strong>
                  <span
                    class="status-badge badge-pending"
                    id="employer-status">Pending</span>
                </p>
              </div>
            </div>

            <h5>Uploaded Documents</h5>
            <div class="modal-document">
              <div class="document-info">
                <div class="document-icon text-danger">
                  <i class="fas fa-file-pdf fa-lg"></i>
                </div>
                <div class="document-details">
                  <h6>Business Registration Certificate</h6>
                  <p>PDF Document • 2.4 MB</p>
                </div>
              </div>
              <button class="btn-view">
                <i class="fas fa-download"></i> Download
              </button>
            </div>
            <div class="modal-document">
              <div class="document-info">
                <div class="document-icon text-success">
                  <i class="fas fa-file-image fa-lg"></i>
                </div>
                <div class="document-details">
                  <h6>Tax Identification Document</h6>
                  <p>JPG Image • 1.2 MB</p>
                </div>
              </div>
              <button class="btn-view">
                <i class="fas fa-download"></i> Download
              </button>
            </div>
            <div class="modal-document">
              <div class="document-info">
                <div class="document-icon text-danger">
                  <i class="fas fa-file-pdf fa-lg"></i>
                </div>
                <div class="document-details">
                  <h6>Company Profile</h6>
                  <p>PDF Document • 3.1 MB</p>
                </div>
              </div>
              <button class="btn-view">
                <i class="fas fa-download"></i> Download
              </button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-success" id="verifyEmployer">
            Verify Employer
          </button>
          <button type="button" class="btn btn-danger" id="rejectEmployer">
            Reject
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Applicant Modal -->
  <div
    class="modal fade"
    id="applicantModal"
    tabindex="-1"
    aria-labelledby="applicantModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="applicantModalLabel">
            <i class="fas fa-user"></i> Applicant Profile
          </h5>
          <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row mb-4">
              <div class="col-md-4 text-center">
                <img
                  src="https://via.placeholder.com/150"
                  class="img-fluid rounded-circle mb-3"
                  alt="Applicant Photo" />
                <h5 id="applicant-name">Jennifer Wilson</h5>
                <p class="text-muted" id="applicant-title">
                  Software Developer
                </p>
              </div>
              <div class="col-md-8">
                <h5>Personal Information</h5>
                <div class="row">
                  <div class="col-md-6">
                    <p>
                      <strong>Email:</strong>
                      <span id="applicant-email">jennifer.wilson@example.com</span>
                    </p>
                    <p>
                      <strong>Phone:</strong>
                      <span id="applicant-phone">+1 (555) 987-6543</span>
                    </p>
                    <p>
                      <strong>Location:</strong>
                      <span id="applicant-location">San Francisco, CA</span>
                    </p>
                  </div>
                  <div class="col-md-6">
                    <p>
                      <strong>Applied For:</strong>
                      <span id="applicant-position">Senior Software Engineer</span>
                    </p>
                    <p>
                      <strong>Applied On:</strong>
                      <span id="applicant-date">2023-10-18</span>
                    </p>
                    <p>
                      <strong>Status:</strong>
                      <span
                        class="status-badge badge-pending"
                        id="applicant-status">Review</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <h5>Education & Experience</h5>
            <p id="applicant-education">
              MSc in Computer Science, Stanford University
            </p>
            <p id="applicant-experience">
              5 years of experience in software development with focus on web
              technologies
            </p>

            <h5>Uploaded Documents</h5>
            <div class="modal-document">
              <div class="document-info">
                <div class="document-icon text-danger">
                  <i class="fas fa-file-pdf fa-lg"></i>
                </div>
                <div class="document-details">
                  <h6>Resume</h6>
                  <p>PDF Document • 1.8 MB</p>
                </div>
              </div>
              <button class="btn-view">
                <i class="fas fa-download"></i> Download
              </button>
            </div>
            <div class="modal-document">
              <div class="document-info">
                <div class="document-icon text-danger">
                  <i class="fas fa-file-pdf fa-lg"></i>
                </div>
                <div class="document-details">
                  <h6>Cover Letter</h6>
                  <p>PDF Document • 0.8 MB</p>
                </div>
              </div>
              <button class="btn-view">
                <i class="fas fa-download"></i> Download
              </button>
            </div>
            <div class="modal-document">
              <div class="document-info">
                <div class="document-icon text-success">
                  <i class="fas fa-file-image fa-lg"></i>
                </div>
                <div class="document-details">
                  <h6>Portfolio</h6>
                  <p>JPG Image • 2.5 MB</p>
                </div>
              </div>
              <button class="btn-view">
                <i class="fas fa-download"></i> Download
              </button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-success" id="approveApplicant">
            Approve
          </button>
          <button type="button" class="btn btn-danger" id="rejectApplicant">
            Reject
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Job Modal -->
  <div
    class="modal fade"
    id="jobModal"
    tabindex="-1"
    aria-labelledby="jobModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="jobModalLabel">
            <i class="fas fa-briefcase"></i> Job Details
          </h5>
          <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row mb-4">
              <div class="col-md-8">
                <h4 id="job-title">Senior Software Engineer</h4>
                <p>
                  <strong>Company:</strong>
                  <span id="job-company">TechSolutions Inc.</span>
                </p>
                <p>
                  <strong>Location:</strong>
                  <span id="job-location">San Francisco, CA</span>
                </p>
                <p>
                  <strong>Job Type:</strong>
                  <span id="job-type">Full-time</span>
                </p>
                <p>
                  <strong>Salary Range:</strong>
                  <span id="job-salary">$120,000 - $150,000</span>
                </p>
              </div>
              <div class="col-md-4">
                <div class="card bg-light p-3">
                  <h6>Job Metrics</h6>
                  <p>
                    <strong>Posted On:</strong>
                    <span id="job-posted">2023-10-10</span>
                  </p>
                  <p>
                    <strong>Applications:</strong>
                    <span id="job-applications">42</span>
                  </p>
                  <p>
                    <strong>Status:</strong>
                    <span class="status-badge badge-verified" id="job-status">Active</span>
                  </p>
                </div>
              </div>
            </div>

            <h5>Job Description</h5>
            <p id="job-description">
              We are looking for a skilled Senior Software Engineer to join
              our development team. The ideal candidate will have experience
              in building high-performing, scalable, enterprise-grade
              applications. You will be part of a talented software team that
              works on mission-critical applications.
            </p>

            <h5>Requirements</h5>
            <ul id="job-requirements">
              <li>Bachelor's degree in Computer Science or related field</li>
              <li>5+ years of software development experience</li>
              <li>Proficiency in Java, Python, or JavaScript</li>
              <li>Experience with cloud technologies (AWS, Azure, or GCP)</li>
              <li>Strong problem-solving skills and attention to detail</li>
            </ul>

            <h5>Benefits</h5>
            <ul id="job-benefits">
              <li>Health, dental, and vision insurance</li>
              <li>401(k) matching</li>
              <li>Flexible work hours</li>
              <li>Remote work options</li>
              <li>Professional development allowance</li>
            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary" id="editJob">
            Edit Job
          </button>
          <button type="button" class="btn btn-danger" id="closeJob">
            Close Job
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sample data for modals - in a real application, this would come from PHP
    const employerData = {
      "EMP-1025": {
        companyName: "TechSolutions Inc.",
        contactPerson: "John Smith",
        email: "john@techsolutions.com",
        phone: "+1 (555) 123-4567",
        industry: "Information Technology",
        companySize: "150 employees",
        website: "www.techsolutions.com",
        status: "Pending",
      },
      "EMP-1026": {
        companyName: "DataWorks LLC",
        contactPerson: "Sarah Johnson",
        email: "sarah@dataworks.com",
        phone: "+1 (555) 234-5678",
        industry: "Data Analytics",
        companySize: "80 employees",
        website: "www.dataworks.com",
        status: "Pending",
      },
      "EMP-1027": {
        companyName: "CloudNet Systems",
        contactPerson: "Michael Brown",
        email: "michael@cloudnet.com",
        phone: "+1 (555) 345-6789",
        industry: "Cloud Services",
        companySize: "200 employees",
        website: "www.cloudnet.com",
        status: "Pending",
      },
    };

    const applicantData = {
      "APP-3050": {
        name: "Jennifer Wilson",
        title: "Software Developer",
        email: "jennifer.wilson@example.com",
        phone: "+1 (555) 987-6543",
        location: "San Francisco, CA",
        position: "Senior Software Engineer",
        date: "2023-10-18",
        status: "Review",
        education: "MSc in Computer Science, Stanford University",
        experience: "5 years of experience in software development with focus on web technologies",
      },
      "APP-3051": {
        name: "Robert Davis",
        title: "Data Analyst",
        email: "robert.davis@example.com",
        phone: "+1 (555) 876-5432",
        location: "New York, NY",
        position: "Data Analyst",
        date: "2023-10-17",
        status: "Review",
        education: "BSc in Statistics, NYU",
        experience: "4 years of experience in data analysis and visualization",
      },
      "APP-3052": {
        name: "Emily Clark",
        title: "Cloud Specialist",
        email: "emily.clark@example.com",
        phone: "+1 (555) 765-4321",
        location: "Austin, TX",
        position: "Cloud Architect",
        date: "2023-10-16",
        status: "Review",
        education: "MSc in Cloud Computing, UT Austin",
        experience: "6 years of experience in cloud infrastructure and architecture",
      },
    };

    const jobData = {
      "J-2056": {
        title: "Senior Software Engineer",
        company: "TechSolutions Inc.",
        location: "San Francisco, CA",
        type: "Full-time",
        salary: "$120,000 - $150,000",
        posted: "2023-10-10",
        applications: "42",
        status: "Active",
        description: "We are looking for a skilled Senior Software Engineer to join our development team. The ideal candidate will have experience in building high-performing, scalable, enterprise-grade applications. You will be part of a talented software team that works on mission-critical applications.",
        requirements: [
          "Bachelor's degree in Computer Science or related field",
          "5+ years of software development experience",
          "Proficiency in Java, Python, or JavaScript",
          "Experience with cloud technologies (AWS, Azure, or GCP)",
          "Strong problem-solving skills and attention to detail",
        ],
        benefits: [
          "Health, dental, and vision insurance",
          "401(k) matching",
          "Flexible work hours",
          "Remote work options",
          "Professional development allowance",
        ],
      },
      "J-2057": {
        title: "Data Analyst",
        company: "DataWorks LLC",
        location: "New York, NY",
        type: "Full-time",
        salary: "$90,000 - $110,000",
        posted: "2023-10-12",
        applications: "35",
        status: "Active",
        description: "We are seeking a Data Analyst to help turn data into information, information into insight, and insight into business decisions. The ideal candidate will conduct full lifecycle analysis to include requirements, activities, and design.",
        requirements: [
          "Bachelor's degree in Mathematics, Economics, Computer Science or related field",
          "3+ years of experience in data analysis",
          "Strong knowledge of statistics and experience using statistical packages",
          "Proficiency in SQL and Python",
          "Experience with data visualization tools (Tableau, Power BI)",
        ],
        benefits: [
          "Health insurance",
          "Flexible spending account",
          "Paid time off",
          "Professional development assistance",
          "Work from home flexibility",
        ],
      },
      "J-2058": {
        title: "Cloud Architect",
        company: "CloudNet Systems",
        location: "Remote",
        type: "Full-time",
        salary: "$130,000 - $160,000",
        posted: "2023-10-14",
        applications: "28",
        status: "Active",
        description: "We are looking for a Cloud Architect to join our team and work on implementing cloud architectures for our clients. The ideal candidate will have a strong understanding of cloud computing technology and infrastructure.",
        requirements: [
          "Bachelor's degree in Computer Science or related field",
          "7+ years of experience in IT infrastructure",
          "3+ years of experience in cloud architecture",
          "Certification in AWS, Azure, or GCP",
          "Experience with DevOps practices and tools",
        ],
        benefits: [
          "Comprehensive health benefits",
          "Unlimited PTO",
          "Remote work",
          "Annual tech stipend",
          "Conference attendance budget",
        ],
      },
    };

    // Event listeners for modals
    document.addEventListener("DOMContentLoaded", function() {
      // Employer modal
      const employerModal = document.getElementById("employerModal");
      employerModal.addEventListener("show.bs.modal", function(event) {
        const button = event.relatedTarget;
        const employerId = button.getAttribute("data-id");
        const data = employerData[employerId];

        document.getElementById("employer-company-name").textContent =
          data.companyName;
        document.getElementById("employer-contact").textContent =
          data.contactPerson;
        document.getElementById("employer-email").textContent = data.email;
        document.getElementById("employer-phone").textContent = data.phone;
        document.getElementById("employer-industry").textContent =
          data.industry;
        document.getElementById("employer-size").textContent =
          data.companySize;
        document.getElementById("employer-website").textContent =
          data.website;

        const statusBadge = document.getElementById("employer-status");
        statusBadge.textContent = data.status;
        statusBadge.className = `status-badge ${
            data.status === "Verified" ? "badge-verified" : "badge-pending"
          }`;
      });

      // Applicant modal
      const applicantModal = document.getElementById("applicantModal");
      applicantModal.addEventListener("show.bs.modal", function(event) {
        const button = event.relatedTarget;
        const applicantId = button.getAttribute("data-id");
        const data = applicantData[applicantId];

        document.getElementById("applicant-name").textContent = data.name;
        document.getElementById("applicant-title").textContent = data.title;
        document.getElementById("applicant-email").textContent = data.email;
        document.getElementById("applicant-phone").textContent = data.phone;
        document.getElementById("applicant-location").textContent =
          data.location;
        document.getElementById("applicant-position").textContent =
          data.position;
        document.getElementById("applicant-date").textContent = data.date;
        document.getElementById("applicant-education").textContent =
          data.education;
        document.getElementById("applicant-experience").textContent =
          data.experience;

        const statusBadge = document.getElementById("applicant-status");
        statusBadge.textContent = data.status;
        statusBadge.className = `status-badge ${
            data.status === "Approved" ? "badge-verified" : "badge-pending"
          }`;
      });

      // Job modal
      const jobModal = document.getElementById("jobModal");
      jobModal.addEventListener("show.bs.modal", function(event) {
        const button = event.relatedTarget;
        const jobId = button.getAttribute("data-id");
        const data = jobData[jobId];

        document.getElementById("job-title").textContent = data.title;
        document.getElementById("job-company").textContent = data.company;
        document.getElementById("job-location").textContent = data.location;
        document.getElementById("job-type").textContent = data.type;
        document.getElementById("job-salary").textContent = data.salary;
        document.getElementById("job-posted").textContent = data.posted;
        document.getElementById("job-applications").textContent =
          data.applications;
        document.getElementById("job-description").textContent =
          data.description;

        const statusBadge = document.getElementById("job-status");
        statusBadge.textContent = data.status;
        statusBadge.className = `status-badge ${
            data.status === "Active" ? "badge-verified" : "badge-pending"
          }`;

        // Populate requirements
        const requirementsList = document.getElementById("job-requirements");
        requirementsList.innerHTML = "";
        data.requirements.forEach((req) => {
          const li = document.createElement("li");
          li.textContent = req;
          requirementsList.appendChild(li);
        });

        // Populate benefits
        const benefitsList = document.getElementById("job-benefits");
        benefitsList.innerHTML = "";
        data.benefits.forEach((benefit) => {
          const li = document.createElement("li");
          li.textContent = benefit;
          benefitsList.appendChild(li);
        });
      });

      // Action buttons event listeners
      document
        .getElementById("verifyEmployer")
        .addEventListener("click", function() {
          alert("Employer verification process initiated.");
        });

      document
        .getElementById("rejectEmployer")
        .addEventListener("click", function() {
          alert("Employer rejection process initiated.");
        });

      document
        .getElementById("approveApplicant")
        .addEventListener("click", function() {
          alert("Applicant approval process initiated.");
        });

      document
        .getElementById("rejectApplicant")
        .addEventListener("click", function() {
          alert("Applicant rejection process initiated.");
        });

      document
        .getElementById("editJob")
        .addEventListener("click", function() {
          alert("Job edit screen would open.");
        });

      document
        .getElementById("closeJob")
        .addEventListener("click", function() {
          alert("Job closing process initiated.");
        });
    });
  </script>
</body>

</html>