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
    <div class="content-wrapper">
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
                    data-bs-target="#pendingEmployerModal"
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
                    data-bs-target="#pendingEmployerModal"
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
                    data-bs-target="#pendingEmployerModal"
                    data-id="EMP-1027">
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
                    data-bs-target="#verifiedEmployerModal"
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
                    data-bs-target="#verifiedEmployerModal"
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
                    data-bs-target="#verifiedEmployerModal"
                    data-id="EMP-1003">
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

  <!-- Pending Employer Modal -->
  <div
    class="modal fade"
    id="pendingEmployerModal"
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
  <!-- Verified Employer Modal -->
  <div
    class="modal fade"
    id="verifiedEmployerModal"
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
          <button type="button" class="btn btn-success" id="revokeVerification">
            Revoke Verification
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


  </script>
  <script src="../js/modals.js">
  </script>
</body>

</html>