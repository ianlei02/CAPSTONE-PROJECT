<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employers</title>
  <script src="../js/dark-mode.js"></script>
  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/employer-table.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../assets/library/datatable/dataTables.css">
</head>
<body>
  <!-- Sidebar -->
 <div class="sidebar">
    <div class="logo">
      <div class="logo-icon">
        <img
          src="../../landing/assets/images/pesosmb.png"
          alt="PESO Logo" />
      </div>
      <h2 style="font-size: 2.25rem">PESO</h2>
    </div>
    <ul class="nav-menu">
      <li>
        <a class="nav-item" href="./dashboard.php">
          <span class="material-symbols-outlined">dashboard</span>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a class="nav-item active" href="./employer-table.php">
          <span class="material-symbols-outlined">apartment</span>
          <span>Employers</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./job-listings.php">
          <span class="material-symbols-outlined">list_alt</span>
          <span>Job Listings</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./new-admin.php">
          <span class="material-symbols-outlined">groups</span>
          <span>New Admin</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./news-upload.php">
          <span class="material-symbols-outlined">newspaper</span>
          <span>News</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="../Function/logout.php">
          <span class="material-symbols-outlined">settings</span>
          <span>Logout</span>
        </a>
      </li>
      <li></li>
      <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
        <span class="material-symbols-outlined">dark_mode</span>
      </button>
    </ul>

  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="header">
      <h1>Employers</h1>
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
      <div class="table-section">
        <div class="table-header">
          <span class="material-symbols-outlined">pending_actions</span>
          <h2> Pending Employers</h2>
        </div>
        <table id="pendingTable" class="display">
          <thead>
              <th>Company Name</th>
              <th>Contact Person</th>
              <th>Email</th>
              <th>Industry</th>
              <th>Status</th>
              <th>Actions</th>
          </thead>
          <tbody>
            <!-- Data will be populated by JavaScript -->
          </tbody>
        </table>
      </div>

      <div class="table-section">
        <div class="table-header">
          <span class="material-symbols-outlined">verified</span>
          <h2> Verified Employers</h2>
        </div>
        <table id="verifiedTable" class="display">
          <thead>
              <th>Company Name</th>
              <th>Contact Person</th>
              <th>Email</th>
              <th>Industry</th>
              <th>Status</th>
              <th>Actions</th>
          </thead>
          <tbody>
            <!-- Data will be populated by JavaScript -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Pending Employer Modal -->
  <div id="pendingModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2><span class="material-symbols-outlined">business</span> Company Details</h2>
        <button class="close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="profile-section">
          <h3 class="section-title"><span class="material-symbols-outlined">info</span> Company Profile</h3>
          <div class="profile-details">
            <div class="detail-item">
              <label>Company Name</label>
              <p id="modal-company-name">Tech Solutions Inc.</p>
            </div>
            <div class="detail-item">
              <label>Address</label>
              <p id="modal-address">123 Business Ave, New York, NY</p>
            </div>
            <div class="detail-item">
              <label>Industry</label>
              <p id="modal-industry">Information Technology</p>
            </div>
            <div class="detail-item">
              <label>Contact Person</label>
              <p id="modal-contact-person">John Smith</p>
            </div>
            <div class="detail-item">
              <label>Email</label>
              <p id="modal-email">john@techsolutions.com</p>
            </div>
            <div class="detail-item">
              <label>Phone</label>
              <p id="modal-phone">+1 (555) 123-4567</p>
            </div>
          </div>
        </div>

        <div class="documents-section">
          <h3 class="section-title"><span class="material-symbols-outlined">description</span> Documents</h3>
          <div class="documents-list">
            <div class="document-item">
              <div class="document-name">
                <span class="material-symbols-outlined">description</span>
                Business License
              </div>
              <div class="document-actions">
                <button class="btn-doc btn-view-doc">
                  <span class="material-symbols-outlined">visibility</span>
                  View
                </button>
                <button class="btn-doc btn-download">
                  <span class="material-symbols-outlined">download</span>
                  Download
                </button>
              </div>
            </div>
            <div class="document-item">
              <div class="document-name">
                <span class="material-symbols-outlined">description</span>
                Tax Certificate
              </div>
              <div class="document-actions">
                <button class="btn-doc btn-view-doc">
                  <span class="material-symbols-outlined">visibility</span>
                  View
                </button>
                <button class="btn-doc btn-download">
                  <span class="material-symbols-outlined">download</span>
                  Download
                </button>
              </div>
            </div>
            <div class="document-item">
              <div class="document-name">
                <span class="material-symbols-outlined">description</span>
                ID Proof
              </div>
              <div class="document-actions">
                <button class="btn-doc btn-view-doc">
                  <span class="material-symbols-outlined">visibility</span>
                  View
                </button>
                <button class="btn-doc btn-download">
                  <span class="material-symbols-outlined">download</span>
                  Download
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-verify">
          <span class="material-symbols-outlined">check_circle</span>
          Verify
        </button>
        <button class="btn btn-reject">
          <span class="material-symbols-outlined">cancel</span>
          Reject
        </button>
        <button class="btn btn-close">
          <span class="material-symbols-outlined">close</span>
          Close
        </button>
      </div>
    </div>
  </div>

  <!-- Verified Employer Modal -->
  <div id="verifiedModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2><span class="material-symbols-outlined">business</span> Company Details</h2>
        <button class="close">&times;</button>
      </div>
      <div class="modal-body">
        <div class="profile-section">
          <h3 class="section-title"><span class="material-symbols-outlined">info</span> Company Profile</h3>
          <div class="profile-details">
            <div class="detail-item">
              <label>Company Name</label>
              <p id="v-modal-company-name">Global Services Ltd.</p>
            </div>
            <div class="detail-item">
              <label>Address</label>
              <p id="v-modal-address">456 Corporate Blvd, London, UK</p>
            </div>
            <div class="detail-item">
              <label>Industry</label>
              <p id="v-modal-industry">Financial Services</p>
            </div>
            <div class="detail-item">
              <label>Contact Person</label>
              <p id="v-modal-contact-person">Emma Johnson</p>
            </div>
            <div class="detail-item">
              <label>Email</label>
              <p id="v-modal-email">emma@globalservices.com</p>
            </div>
            <div class="detail-item">
              <label>Phone</label>
              <p id="v-modal-phone">+44 20 1234 5678</p>
            </div>
          </div>
        </div>

        <div class="documents-section">
          <h3 class="section-title"><span class="material-symbols-outlined">description</span> Documents</h3>
          <div class="documents-list">
            <div class="document-item">
              <div class="document-name">
                <span class="material-symbols-outlined">description</span>
                Business License
              </div>
              <div class="document-actions">
                <button class="btn-doc btn-view-doc">
                  <span class="material-symbols-outlined">visibility</span>
                  View
                </button>
                <button class="btn-doc btn-download">
                  <span class="material-symbols-outlined">download</span>
                  Download
                </button>
              </div>
            </div>
            <div class="document-item">
              <div class="document-name">
                <span class="material-symbols-outlined">description</span>
                Tax Certificate
              </div>
              <div class="document-actions">
                <button class="btn-doc btn-view-doc">
                  <span class="material-symbols-outlined">visibility</span>
                  View
                </button>
                <button class="btn-doc btn-download">
                  <span class="material-symbols-outlined">download</span>
                  Download
                </button>
              </div>
            </div>
            <div class="document-item">
              <div class="document-name">
                <span class="material-symbols-outlined">description</span>
                ID Proof
              </div>
              <div class="document-actions">
                <button class="btn-doc btn-view-doc">
                  <span class="material-symbols-outlined">visibility</span>
                  View
                </button>
                <button class="btn-doc btn-download">
                  <span class="material-symbols-outlined">download</span>
                  Download
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-revoke">
          <span class="material-symbols-outlined">block</span>
          Revoke Verification
        </button>
        <button class="btn btn-close">
          <span class="material-symbols-outlined">close</span>
          Close
        </button>
      </div>
    </div>
  </div>



  <script>
    // Sample data for employers
    const pendingEmployers = [{
        id: 1,
        company: "Tech Solutions Inc.",
        contact: "John Smith",
        email: "john@techsolutions.com",
        industry: "Information Technology",
        status: "Pending"
      },
      {
        id: 2,
        company: "MediCare Providers",
        contact: "Sarah Johnson",
        email: "sarah@medicare.com",
        industry: "Healthcare",
        status: "Pending"
      },
      {
        id: 3,
        company: "EcoBuild Constructions",
        contact: "Michael Brown",
        email: "michael@ecobuild.com",
        industry: "Construction",
        status: "Pending"
      },
      {
        id: 4,
        company: "FoodExpress Delivery",
        contact: "Jessica Lee",
        email: "jessica@foodexpress.com",
        industry: "Logistics",
        status: "Pending"
      },
      {
        id: 5,
        company: "EduTech Innovations",
        contact: "Robert Wilson",
        email: "robert@edutech.com",
        industry: "Education",
        status: "Pending"
      },
      {
        id: 6,
        company: "GreenEnergy Solutions",
        contact: "Emily Davis",
        email: "emily@greenenergy.com",
        industry: "Energy",
        status: "Pending"
      },
      {
        id: 7,
        company: "FinSecure Advisors",
        contact: "David Miller",
        email: "david@finsecure.com",
        industry: "Finance",
        status: "Pending"
      },
      {
        id: 8,
        company: "RetailPlus Stores",
        contact: "Amanda Taylor",
        email: "amanda@retailplus.com",
        industry: "Retail",
        status: "Pending"
      },
      {
        id: 9,
        company: "AutoMech Repairs",
        contact: "Christopher Moore",
        email: "chris@automech.com",
        industry: "Automotive",
        status: "Pending"
      },
      {
        id: 10,
        company: "TravelWorld Agency",
        contact: "Jennifer Anderson",
        email: "jennifer@travelworld.com",
        industry: "Tourism",
        status: "Pending"
      },
      {
        id: 21,
        company: "CloudTech Innovations",
        contact: "Alex Turner",
        email: "alex@cloudtech.com",
        industry: "Cloud Computing",
        status: "Pending"
      },
      {
        id: 22,
        company: "DataSphere Analytics",
        contact: "Megan Clark",
        email: "megan@datasphere.com",
        industry: "Data Analytics",
        status: "Pending"
      },
      {
        id: 23,
        company: "SecureNet Systems",
        contact: "Brian Wilson",
        email: "brian@securenet.com",
        industry: "Cybersecurity",
        status: "Pending"
      },
      {
        id: 24,
        company: "NextGen Robotics",
        contact: "Olivia Martinez",
        email: "olivia@nextgen.com",
        industry: "Robotics",
        status: "Pending"
      },
      {
        id: 25,
        company: "BioPharm Solutions",
        contact: "Kevin Harris",
        email: "kevin@biopharm.com",
        industry: "Pharmaceuticals",
        status: "Pending"
      }
    ];
    const verifiedEmployers = [{
        id: 11,
        company: "Global Services Ltd.",
        contact: "Emma Johnson",
        email: "emma@globalservices.com",
        industry: "Financial Services",
        status: "Verified"
      },
      {
        id: 12,
        company: "SoftWorks Development",
        contact: "Daniel Martin",
        email: "daniel@softworks.com",
        industry: "Software",
        status: "Verified"
      },
      {
        id: 13,
        company: "HealthFirst Clinics",
        contact: "Sophia Williams",
        email: "sophia@healthfirst.com",
        industry: "Healthcare",
        status: "Verified"
      },
      {
        id: 14,
        company: "BuildRight Contractors",
        contact: "James Thompson",
        email: "james@buildright.com",
        industry: "Construction",
        status: "Verified"
      },
      {
        id: 15,
        company: "QuickShip Logistics",
        contact: "Olivia Garcia",
        email: "olivia@quickship.com",
        industry: "Logistics",
        status: "Verified"
      },
      {
        id: 16,
        company: "LearnSmart Academy",
        contact: "William Clark",
        email: "william@learnsmart.com",
        industry: "Education",
        status: "Verified"
      },
      {
        id: 17,
        company: "PowerGrid Utilities",
        contact: "Isabella Lewis",
        email: "isabella@powergrid.com",
        industry: "Energy",
        status: "Verified"
      },
      {
        id: 18,
        company: "WealthManage Bank",
        contact: "Ethan Robinson",
        email: "ethan@wealthmanage.com",
        industry: "Banking",
        status: "Verified"
      },
      {
        id: 19,
        company: "StyleTrend Boutique",
        contact: "Mia Walker",
        email: "mia@styletrend.com",
        industry: "Fashion",
        status: "Verified"
      },
      {
        id: 20,
        company: "CarCare Center",
        contact: "Noah Hall",
        email: "noah@carcare.com",
        industry: "Automotive",
        status: "Verified"
      },
      {
        id: 26,
        company: "SmartHome Technologies",
        contact: "Rachel Green",
        email: "rachel@smarthome.com",
        industry: "IoT",
        status: "Verified"
      },
      {
        id: 27,
        company: "EcoEnergy Solutions",
        contact: "Thomas Reed",
        email: "thomas@ecoenergy.com",
        industry: "Renewable Energy",
        status: "Verified"
      },
      {
        id: 28,
        company: "FinTech Innovations",
        contact: "Laura King",
        email: "laura@fintech.com",
        industry: "Financial Technology",
        status: "Verified"
      },
      {
        id: 29,
        company: "MedTech Solutions",
        contact: "Ryan Scott",
        email: "ryan@medtech.com",
        industry: "Medical Technology",
        status: "Verified"
      },
      {
        id: 30,
        company: "AgriGrowth Farms",
        contact: "Emma Watson",
        email: "emma@agrigrowth.com",
        industry: "Agriculture",
        status: "Verified"
      }
    ];

    // Initialize DataTables
    let pendingTable, verifiedTable;

    // Populate tables with data
    function populateTables() {
      const pendingTableBody = document.querySelector('#pendingTable tbody');
      const verifiedTableBody = document.querySelector('#verifiedTable tbody');

      // Clear existing rows
      pendingTableBody.innerHTML = '';
      verifiedTableBody.innerHTML = '';

      // Add pending employers
      pendingEmployers.forEach(employer => {
        const row = document.createElement('tr');
        row.innerHTML = `
                    <td>${employer.company}</td>
                    <td>${employer.contact}</td>
                    <td>${employer.email}</td>
                    <td>${employer.industry}</td>
                    <td><span class="status status-pending"><span class="material-symbols-outlined">pending</span> ${employer.status}</span></td>
                    <td><button class="btn btn-view" data-id="${employer.id}" data-status="pending"><span class="material-symbols-outlined">visibility</span> View</button></td>
                `;
        pendingTableBody.appendChild(row);
      });
      // Add verified employers
      verifiedEmployers.forEach(employer => {
        const row = document.createElement('tr');
        row.innerHTML = `
                    <td>${employer.company}</td>
                    <td>${employer.contact}</td>
                    <td>${employer.email}</td>
                    <td>${employer.industry}</td>
                    <td><span class="status status-verified"><span class="material-symbols-outlined">check_circle</span> ${employer.status}</span></td>
                    <td><button class="btn btn-view" data-id="${employer.id}" data-status="verified"><span class="material-symbols-outlined">visibility</span> View</button></td>
                `;
        verifiedTableBody.appendChild(row);
      });

      // Initialize DataTables
      if ($.fn.DataTable.isDataTable('#pendingTable')) {
        pendingTable.destroy();
      }

      if ($.fn.DataTable.isDataTable('#verifiedTable')) {
        verifiedTable.destroy();
      }


      // Add event listeners to View buttons
      document.querySelectorAll('.btn-view').forEach(button => {
        button.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          const status = this.getAttribute('data-status');
          showModal(id, status);
        });
      });
    }

    // Show modal with employer details
    function showModal(id, status) {
      const employer = status === 'pending' ?
        pendingEmployers.find(e => e.id === parseInt(id)) :
        verifiedEmployers.find(e => e.id === parseInt(id));

      if (status === 'pending') {
        // Set modal content for pending employer
        document.getElementById('modal-company-name').textContent = employer.company;
        document.getElementById('modal-address').textContent = "123 Business Ave, New York, NY";
        document.getElementById('modal-industry').textContent = employer.industry;
        document.getElementById('modal-contact-person').textContent = employer.contact;
        document.getElementById('modal-email').textContent = employer.email;
        document.getElementById('modal-phone').textContent = "+1 (555) 123-4567";

        // Show the pending modal
        const modal = document.getElementById('pendingModal');
        modal.style.display = 'flex';
        setTimeout(() => {
          modal.querySelector('.modal-content').classList.add('modal-show');
        }, 10);
      } else {
        // Set modal content for verified employer
        document.getElementById('v-modal-company-name').textContent = employer.company;
        document.getElementById('v-modal-address').textContent = "456 Corporate Blvd, London, UK";
        document.getElementById('v-modal-industry').textContent = employer.industry;
        document.getElementById('v-modal-contact-person').textContent = employer.contact;
        document.getElementById('v-modal-email').textContent = employer.email;
        document.getElementById('v-modal-phone').textContent = "+44 20 1234 5678";

        // Show the verified modal
        const modal = document.getElementById('verifiedModal');
        modal.style.display = 'flex';
        setTimeout(() => {
          modal.querySelector('.modal-content').classList.add('modal-show');
        }, 10);
      }
    }

    // Close modals
    function setupModalClose() {
      document.querySelectorAll('.close, .btn-close').forEach(button => {
        button.addEventListener('click', function() {
          document.querySelectorAll('.modal').forEach(modal => {
            modal.querySelector('.modal-content').classList.remove('modal-show');
            setTimeout(() => {
              modal.style.display = 'none';
            }, 300);
          });
        });
      });

      // Close modal when clicking outside
      window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
          document.querySelectorAll('.modal').forEach(modal => {
            modal.querySelector('.modal-content').classList.remove('modal-show');
            setTimeout(() => {
              modal.style.display = 'none';
            }, 300);
          });
        }
      });
    }

    // Document actions
    function setupDocumentActions() {
      document.querySelectorAll('.btn-view-doc').forEach(button => {
        button.addEventListener('click', function() {
          alert('Viewing document in new tab...');
        });
      });

      document.querySelectorAll('.btn-download').forEach(button => {
        button.addEventListener('click', function() {
          alert('Downloading document...');
        });
      });
    }
  </script>
  <script src="../assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
  <script src="../assets/library/datatable/dataTables.js"></script>
  <script src="../js/table-init.js"></script>

  <script>
    // Run initialization when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
      populateTables();
      setupModalClose();
      setupDocumentActions();

      // Add event listeners to modal action buttons
      document.querySelector('.btn-verify').addEventListener('click', function() {
        alert('Employer verified successfully!');
        document.querySelector('#pendingModal .modal-content').classList.remove('modal-show');
        setTimeout(() => {
          document.getElementById('pendingModal').style.display = 'none';
        }, 300);
      });

      document.querySelector('.btn-reject').addEventListener('click', function() {
        alert('Employer rejected.');
        document.querySelector('#pendingModal .modal-content').classList.remove('modal-show');
        setTimeout(() => {
          document.getElementById('pendingModal').style.display = 'none';
        }, 300);
      });

      document.querySelector('.btn-revoke').addEventListener('click', function() {
        alert('Verification revoked.');
        document.querySelector('#verifiedModal .modal-content').classList.remove('modal-show');
        setTimeout(() => {
          document.getElementById('verifiedModal').style.display = 'none';
        }, 300);
      });

    });
  </script>

</body>

</html>