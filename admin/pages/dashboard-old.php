<?php
//session_start();

//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
//header("Pragma: no-cache");

//if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  //  header("Location: ../pages/admin-login.php");
    //exit();
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h2>PESO </h2>
            </div>
            <div class="nav-menu">
                <div class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-building"></i>
                    <span>Employers</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-users"></i>
                    <span>Applicants</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </div>
                <div class="nav-item">
                    <i class="fas fa-cog"></i>
                    <a href="../Function/logout.php"><span>Log Out</span></a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h1>Admin Dashboard</h1>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff" alt="Admin User">
                    <span>Admin User</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card pending">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Pending Verifications</h3>
                    <p>8</p>
                </div>
                <div class="stat-card verified">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Verified Employers</h3>
                    <p>32</p>
                </div>
                <div class="stat-card rejected">
                    <div class="stat-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <h3>Rejected Employers</h3>
                    <p>5</p>
                </div>
                <div class="stat-card applicants">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Total Applicants</h3>
                    <p>124</p>
                </div>
            </div>

            <!-- Pending Employers Table -->
            <div class="table-container">
                <div class="table-header">
                    <h2>Pending Employer Verifications</h2>
                    <input type="text" class="search-box" placeholder="Search employers...">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Documents</th>
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=4f46e5&color=fff" width="32" height="32" style="border-radius: 50%;">
                                    Tech Solutions Inc.
                                </div>
                            </td>
                            <td>hr@techsolutions.com</td>
                            <td><button class="action-btn view-btn" onclick="viewDocuments('tech-solutions')"><i class="fas fa-file-alt"></i> View Docs</button></td>
                            <td>2023-10-15</td>
                            <td>
                                <button class="action-btn view-btn" onclick="openEmployerModal('tech-solutions')"><i class="fas fa-eye"></i> View</button>
                                <button class="action-btn approve-btn" onclick="approveEmployer('tech-solutions')"><i class="fas fa-check"></i> Approve</button>
                                <button class="action-btn reject-btn" onclick="rejectEmployer('tech-solutions')"><i class="fas fa-times"></i> Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://ui-avatars.com/api/?name=Green+Energy&background=10b981&color=fff" width="32" height="32" style="border-radius: 50%;">
                                    Green Energy Ltd.
                                </div>
                            </td>
                            <td>careers@greenenergy.com</td>
                            <td><button class="action-btn view-btn" onclick="viewDocuments('green-energy')"><i class="fas fa-file-alt"></i> View Docs</button></td>
                            <td>2023-10-14</td>
                            <td>
                                <button class="action-btn view-btn" onclick="openEmployerModal('green-energy')"><i class="fas fa-eye"></i> View</button>
                                <button class="action-btn approve-btn" onclick="approveEmployer('green-energy')"><i class="fas fa-check"></i> Approve</button>
                                <button class="action-btn reject-btn" onclick="rejectEmployer('green-energy')"><i class="fas fa-times"></i> Reject</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Verified Employers Table -->
            <div class="table-container">
                <div class="table-header">
                    <h2>Verified Employers</h2>
                    <input type="text" class="search-box" placeholder="Search employers...">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Industry</th>
                            <th>Jobs Posted</th>
                            <th>Verified Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://ui-avatars.com/api/?name=Digital+Creations&background=8b5cf6&color=fff" width="32" height="32" style="border-radius: 50%;">
                                    Digital Creations
                                </div>
                            </td>
                            <td>Software</td>
                            <td>12</td>
                            <td>2023-09-28</td>
                            <td>
                                <button class="action-btn view-btn" onclick="openEmployerModal('digital-creations')"><i class="fas fa-eye"></i> View</button>
                                <button class="action-btn reject-btn" onclick="revokeVerification('digital-creations')"><i class="fas fa-user-slash"></i> Revoke</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://ui-avatars.com/api/?name=Urban+Foods&background=f59e0b&color=fff" width="32" height="32" style="border-radius: 50%;">
                                    Urban Foods
                                </div>
                            </td>
                            <td>Restaurant</td>
                            <td>5</td>
                            <td>2023-10-05</td>
                            <td>
                                <button class="action-btn view-btn" onclick="openEmployerModal('urban-foods')"><i class="fas fa-eye"></i> View</button>
                                <button class="action-btn reject-btn" onclick="revokeVerification('urban-foods')"><i class="fas fa-user-slash"></i> Revoke</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Applicants Table -->
            <div class="table-container">
                <div class="table-header">
                    <h2>Recent Applicants</h2>
                    <input type="text" class="search-box" placeholder="Search applicants...">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Applied For</th>
                            <th>Company</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" width="32" height="32" style="border-radius: 50%;">
                                    John Smith
                                </div>
                            </td>
                            <td>Frontend Developer</td>
                            <td>Tech Solutions Inc.</td>
                            <td>2023-10-16</td>
                            <td><span class="status pending"><i class="fas fa-circle"></i> Pending</span></td>
                            <td>
                                <button class="action-btn view-btn" onclick="openApplicantModal()"><i class="fas fa-eye"></i> View</button>
                                <button class="action-btn refer-btn"><i class="fas fa-paper-plane"></i> Refer</button>
                                <button class="action-btn reject-btn"><i class="fas fa-times"></i> Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" width="32" height="32" style="border-radius: 50%;">
                                    Maria Garcia
                                </div>
                            </td>
                            <td>Marketing Manager</td>
                            <td>Green Energy Ltd.</td>
                            <td>2023-10-15</td>
                            <td><span class="status verified"><i class="fas fa-circle"></i> Referred</span></td>
                            <td>
                                <button class="action-btn view-btn" onclick="openApplicantModal()"><i class="fas fa-eye"></i> View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Job Listings -->
            <div class="table-container">
                <div class="table-header">
                    <h2>Job Listings</h2>
                    <input type="text" class="search-box" placeholder="Search jobs...">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Posted Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Frontend Developer</td>
                            <td>Tech Solutions Inc.</td>
                            <td>New York, NY</td>
                            <td>2023-10-10</td>
                            <td><span class="status verified"><i class="fas fa-circle"></i> Active</span></td>
                            <td>
                                <button class="action-btn view-btn"><i class="fas fa-eye"></i> View</button>
                                <button class="action-btn reject-btn"><i class="fas fa-times"></i> Close</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Marketing Manager</td>
                            <td>Green Energy Ltd.</td>
                            <td>Los Angeles, CA</td>
                            <td>2023-10-12</td>
                            <td><span class="status pending"><i class="fas fa-circle"></i> Closed</span></td>
                            <td>
                                <button class="action-btn view-btn"><i class="fas fa-eye"></i> View</button>
                                <button class="action-btn reject-btn"><i class="fas fa-times"></i> Close</button>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

        <!-- Applicant Modal -->
        <div class="modal" id="applicantModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Applicant Profile</h2>
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                </div>
                <div class="profile-section">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Applicant Photo" class="profile-photo">
                    <div class="profile-info">
                        <h3>John Smith</h3>
                        <p>Applied for: <strong>Frontend Developer at Tech Solutions Inc.</strong></p>
                        <p>Applied on: <strong>October 16, 2023</strong></p>
                        <p>Status: <span class="status pending"><i class="fas fa-circle"></i> Pending Review</span></p>

                        <div class="details-section">
                            <div class="detail-row">
                                <span class="detail-label">Email:</span>
                                <span>john.smith@example.com</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Phone:</span>
                                <span>(555) 123-4567</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Location:</span>
                                <span>New York, NY</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Experience:</span>
                                <span>3 years in frontend development</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Education:</span>
                                <span>BS in Computer Science</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Resume:</span>
                                <span><a href="#" style="color: var(--primary); text-decoration: none; font-weight: 500;"><i class="fas fa-download"></i> Download PDF</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons-container">
                    <button class="btn btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-times"></i> Reject Application
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Refer to Employer
                    </button>
                </div>
            </div>
        </div>

        <!-- Employer Modal -->
        <div class="modal" id="employerModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="employerModalTitle">Employer Profile</h2>
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                </div>

                <div class="tabs">
                    <div class="tab active" onclick="switchTab('profile')">Profile</div>
                    <div class="tab" onclick="switchTab('documents')">Documents</div>
                    <div class="tab" onclick="switchTab('jobs')">Job Listings</div>
                </div>

                <div id="profileTab" class="tab-content active">
                    <div class="profile-section">
                        <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=4f46e5&color=fff" alt="Company Logo" class="company-logo" id="employerLogo">
                        <div class="profile-info">
                            <h3 id="companyName">Tech Solutions Inc.</h3>
                            <p id="companyIndustry">Industry: <strong>Software Development</strong></p>
                            <p id="companyStatus">Status: <span class="status verified"><i class="fas fa-circle"></i> Verified</span></p>
                            <p id="verificationDate">Verified on: <strong>October 15, 2023</strong></p>

                            <div class="details-section">
                                <div class="detail-row">
                                    <span class="detail-label">HR Contact:</span>
                                    <span id="hrContact">Sarah Johnson (hr@techsolutions.com)</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Phone:</span>
                                    <span id="companyPhone">(555) 987-6543</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Address:</span>
                                    <span id="companyAddress">123 Tech Park, New York, NY 10001</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Website:</span>
                                    <span><a href="#" id="companyWebsite" style="color: var(--primary); text-decoration: none; font-weight: 500;"><i class="fas fa-external-link-alt"></i> techsolutions.com</a></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Tax ID:</span>
                                    <span id="taxId">12-3456789</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Jobs Posted:</span>
                                    <span id="jobsPosted">8 active jobs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="documentsTab" class="tab-content">
                    <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 600;">Submitted Documents</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                        <div class="document-thumbnail">
                            <i class="fas fa-file-pdf"></i>
                            <div>Business License</div>
                            <a href="#" style="color: var(--primary); font-size: 0.8rem; margin-top: 0.5rem;"><i class="fas fa-search"></i> Preview</a>
                        </div>
                        <div class="document-thumbnail">
                            <i class="fas fa-file-image"></i>
                            <div>Tax Certificate</div>
                            <a href="#" style="color: var(--primary); font-size: 0.8rem; margin-top: 0.5rem;"><i class="fas fa-search"></i> Preview</a>
                        </div>
                        <div class="document-thumbnail">
                            <i class="fas fa-file-contract"></i>
                            <div>HR Authorization</div>
                            <a href="#" style="color: var(--primary); font-size: 0.8rem; margin-top: 0.5rem;"><i class="fas fa-search"></i> Preview</a>
                        </div>
                    </div>
                </div>

                <div id="jobsTab" class="tab-content">
                    <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 600;">Active Job Listings</h3>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Posted Date</th>
                                <th>Applications</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Frontend Developer</td>
                                <td>2023-10-10</td>
                                <td>24</td>
                                <td><span class="status verified"><i class="fas fa-circle"></i> Active</span></td>
                            </tr>
                            <tr>
                                <td>Backend Engineer</td>
                                <td>2023-10-12</td>
                                <td>18</td>
                                <td><span class="status verified"><i class="fas fa-circle"></i> Active</span></td>
                            </tr>
                            <tr>
                                <td>UI/UX Designer</td>
                                <td>2023-10-15</td>
                                <td>9</td>
                                <td><span class="status verified"><i class="fas fa-circle"></i> Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="buttons-container">
                    <button class="btn btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button class="btn btn-danger" id="revokeBtn">
                        <i class="fas fa-user-slash"></i> Revoke Verification
                    </button>
                </div>
            </div>
        </div>

        <!-- Documents Modal -->
        <div class="modal" id="documentsModal">
            <div class="modal-content" style="max-width: 900px;">
                <div class="modal-header">
                    <h2>Company Documents</h2>
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                </div>
                <div style="text-align: center; margin: 2rem 0;">
                    <img src="https://via.placeholder.com/800x1000?text=Business+License" alt="Document" style="max-width: 100%; max-height: 60vh; border: 1px solid var(--gray-light); border-radius: 0.5rem;">
                </div>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                    <button class="btn btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
            </div>
        </div>

        <script>
            // Sample employer data
            const employers = {
                'tech-solutions': {
                    name: 'Tech Solutions Inc.',
                    industry: 'Software Development',
                    status: 'pending',
                    logo: 'https://ui-avatars.com/api/?name=Tech+Solutions&background=4f46e5&color=fff',
                    hrContact: 'Sarah Johnson (hr@techsolutions.com)',
                    phone: '(555) 987-6543',
                    address: '123 Tech Park, New York, NY 10001',
                    website: 'techsolutions.com',
                    taxId: '12-3456789',
                    jobsPosted: '8 active jobs',
                    verificationDate: 'October 15, 2023',
                    documents: ['Business License', 'Tax Certificate', 'HR Authorization']
                },
                'green-energy': {
                    name: 'Green Energy Ltd.',
                    industry: 'Renewable Energy',
                    status: 'pending',
                    logo: 'https://ui-avatars.com/api/?name=Green+Energy&background=10b981&color=fff',
                    hrContact: 'Michael Brown (careers@greenenergy.com)',
                    phone: '(555) 123-7890',
                    address: '456 Eco Tower, San Francisco, CA 94105',
                    website: 'greenenergy.com',
                    taxId: '98-7654321',
                    jobsPosted: '5 active jobs',
                    verificationDate: 'October 14, 2023',
                    documents: ['Business License', 'Tax Certificate']
                },
                'digital-creations': {
                    name: 'Digital Creations',
                    industry: 'Software',
                    status: 'verified',
                    logo: 'https://ui-avatars.com/api/?name=Digital+Creations&background=8b5cf6&color=fff',
                    hrContact: 'Emily Wilson (hr@digitalcreations.com)',
                    phone: '(555) 456-1234',
                    address: '789 Digital Lane, Austin, TX 78701',
                    website: 'digitalcreations.com',
                    taxId: '45-6789123',
                    jobsPosted: '12 active jobs',
                    verificationDate: 'September 28, 2023',
                    documents: ['Business License', 'Tax Certificate', 'HR Authorization', 'Insurance']
                },
                'urban-foods': {
                    name: 'Urban Foods',
                    industry: 'Restaurant',
                    status: 'verified',
                    logo: 'https://ui-avatars.com/api/?name=Urban+Foods&background=f59e0b&color=fff',
                    hrContact: 'David Kim (careers@urbanfoods.com)',
                    phone: '(555) 789-0123',
                    address: '101 Food Plaza, Chicago, IL 60601',
                    website: 'urbanfoods.com',
                    taxId: '67-8901234',
                    jobsPosted: '5 active jobs',
                    verificationDate: 'October 5, 2023',
                    documents: ['Business License', 'Health Certificate']
                }
            };

            // Current viewed employer
            let currentEmployer = null;

            // DOM ready
            document.addEventListener('DOMContentLoaded', function() {
                // Nav menu active state
                const navItems = document.querySelectorAll('.nav-item');
                navItems.forEach(item => {
                    item.addEventListener('click', function() {
                        navItems.forEach(i => i.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
            });

            // Modal functions
            function openApplicantModal() {
                document.getElementById('applicantModal').style.display = 'flex';
            }

            function openEmployerModal(employerId) {
                currentEmployer = employerId;
                const employer = employers[employerId];

                // Update modal content
                document.getElementById('employerModalTitle').textContent = `${employer.name} Profile`;
                document.getElementById('companyName').textContent = employer.name;
                document.getElementById('companyIndustry').innerHTML = `Industry: <strong>${employer.industry}</strong>`;
                document.getElementById('employerLogo').src = employer.logo;
                document.getElementById('hrContact').textContent = employer.hrContact;
                document.getElementById('companyPhone').textContent = employer.phone;
                document.getElementById('companyAddress').textContent = employer.address;
                document.getElementById('companyWebsite').textContent = employer.website;
                document.getElementById('companyWebsite').href = `https://${employer.website}`;
                document.getElementById('taxId').textContent = employer.taxId;
                document.getElementById('jobsPosted').textContent = employer.jobsPosted;
                document.getElementById('verificationDate').innerHTML = employer.status === 'verified' ?
                    `Verified on: <strong>${employer.verificationDate}</strong>` :
                    `Registered on: <strong>${employer.verificationDate}</strong>`;

                // Update status
                const statusElement = document.getElementById('companyStatus');
                statusElement.innerHTML = `Status: <span class="status ${employer.status}"><i class="fas fa-circle"></i> ${employer.status === 'verified' ? 'Verified' : 'Pending'}</span>`;

                // Update revoke button visibility
                document.getElementById('revokeBtn').style.display = employer.status === 'verified' ? 'flex' : 'none';

                // Reset tabs
                switchTab('profile');

                document.getElementById('employerModal').style.display = 'flex';
            }

            function viewDocuments(employerId) {
                currentEmployer = employerId;
                document.getElementById('documentsModal').style.display = 'flex';
            }

            function closeModal() {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.style.display = 'none';
                });
            }

            // Tab switching
            function switchTab(tabId) {
                // Update tabs
                document.querySelectorAll('.tab').forEach(tab => {
                    tab.classList.remove('active');
                });
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });

                // Activate selected tab
                if (tabId === 'profile') {
                    document.querySelector('.tab:nth-child(1)').classList.add('active');
                    document.getElementById('profileTab').classList.add('active');
                } else if (tabId === 'documents') {
                    document.querySelector('.tab:nth-child(2)').classList.add('active');
                    document.getElementById('documentsTab').classList.add('active');
                } else if (tabId === 'jobs') {
                    document.querySelector('.tab:nth-child(3)').classList.add('active');
                    document.getElementById('jobsTab').classList.add('active');
                }
            }

            // Employer actions
            function approveEmployer(employerId) {
                if (confirm(`Approve ${employers[employerId].name}? This will allow them to post jobs.`)) {
                    employers[employerId].status = 'verified';
                    showNotification('success', `Successfully approved ${employers[employerId].name}`);
                    // In a real app, you would update the UI and send to server
                    closeModal();
                    location.reload(); // Simulate UI update
                }
            }

            function rejectEmployer(employerId) {
                const reason = prompt('Enter reason for rejection:');
                if (reason) {
                    employers[employerId].status = 'rejected';
                    showNotification('error', `Rejected ${employers[employerId].name}. Reason: ${reason}`);
                    // In a real app, you would update the UI and send to server
                    closeModal();
                    location.reload(); // Simulate UI update
                }
            }

            function revokeVerification(employerId) {
                if (confirm(`Revoke verification for ${employers[employerId].name}? This will prevent them from posting new jobs.`)) {
                    employers[employerId].status = 'pending';
                    showNotification('warning', `Verification revoked for ${employers[employerId].name}`);
                    // In a real app, you would update the UI and send to server
                    closeModal();
                    location.reload(); // Simulate UI update
                }
            }

            // Close modal when clicking outside
            window.onclick = function(event) {
                if (event.target.classList.contains('modal')) {
                    closeModal();
                }
            }

            // Notification function (for demo purposes)
            function showNotification(type, message) {
                const notification = document.createElement('div');
                notification.style.position = 'fixed';
                notification.style.bottom = '20px';
                notification.style.right = '20px';
                notification.style.padding = '1rem 1.5rem';
                notification.style.borderRadius = '0.5rem';
                notification.style.color = 'white';
                notification.style.fontWeight = '500';
                notification.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
                notification.style.zIndex = '1000';
                notification.style.display = 'flex';
                notification.style.alignItems = 'center';
                notification.style.gap = '0.75rem';
                notification.style.animation = 'slideIn 0.3s ease';

                if (type === 'success') {
                    notification.style.backgroundColor = 'var(--success)';
                } else if (type === 'error') {
                    notification.style.backgroundColor = 'var(--danger)';
                } else {
                    notification.style.backgroundColor = 'var(--warning)';
                }

                notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : 'fa-exclamation-triangle'}"></i>
                ${message}
            `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'fadeOut 0.3s ease';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            }

            // Add CSS for notifications
            const style = document.createElement('style');
            style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes fadeOut {
                from { opacity: 1; }
                to { opacity: 0; }
            }
        `;
            document.head.appendChild(style);
        </script>
        <!-- <script>
            setTimeout(function() {
                location.reload();
            }, 5000);
        </script> -->
</body>

</html>