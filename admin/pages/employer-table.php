<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employers</title>
  <script src="../js/load-saved.js"></script>
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
          src="../../public/smb-images/pesosmb.png"
          alt="PESO Logo" />
      </div>
      <h2>PESO</h2>
    </div>
    <ul class="nav-menu">
      <li>
        <a class="nav-item active" href="./dashboard.php">
          <span class="material-symbols-outlined">dashboard</span>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a class="nav-item" href="./employer-table.php">
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
        <button class="nav-item" id="themeToggle" onclick="toggleTheme()">
          <span class="material-symbols-outlined" id="themeIcon">dark_mode</span>
          <span id="themeLabel">Theme toggle</span>
        </button>
      </li>
    </ul>
    <ul class="nav-menu logout">
      <li>
        <a class="nav-item" href="../Function/logout.php">
          <span class="material-symbols-outlined">settings</span>
          <span>Logout</span>
        </a>
      </li>
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
            <span>SUPER ADMIN</span>
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

      <div class="table-section">
        <div class="table-header">
          <span class="material-symbols-outlined">block</span>
          <h2> Revoked Employers</h2>
        </div>
        <table id="revokedTable" class="display">
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
        <span class="material-symbols-outlined">block</span>
        <h2>Rejected Employers</h2>
      </div>
      <table id="rejectedTable" class="display">
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
        <h2><span class="material-symbols-outlined">pending_actions</span>Pending Company Details</h2>
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
              <button class="btn-doc btn-view-doc" id="p-business-license-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="p-business-license-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              Tax Certificate
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="p-tax-certificate-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="p-tax-certificate-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              ID Proof
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="p-id-proof-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="p-id-proof-download">
                <span class="material-symbols-outlined">download</span> Download
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
        <h2><span class="material-symbols-outlined">verified</span>Verified Company Details</h2>
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
              <button class="btn-doc btn-view-doc" id="v-business-license-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="v-business-license-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              Tax Certificate
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="v-tax-certificate-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="v-tax-certificate-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              ID Proof
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="v-id-proof-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="v-id-proof-download">
                <span class="material-symbols-outlined">download</span> Download
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

  <!-- Revoked Employer Modal -->
  <div id="revokedModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2><span class="material-symbols-outlined">block</span>Revoked Company Details</h2>
      <button class="close">&times;</button>
    </div>
    <div class="modal-body">
      <div class="profile-section">
        <h3 class="section-title"><span class="material-symbols-outlined">info</span> Company Profile</h3>
        <div class="profile-details">
          <div class="detail-item">
            <label>Company Name</label>
            <p id="r-modal-company-name">Revoked Company Inc.</p>
          </div>
          <div class="detail-item">
            <label>Address</label>
            <p id="r-modal-address">789 Restricted St, Los Angeles, CA</p>
          </div>
          <div class="detail-item">
            <label>Industry</label>
            <p id="r-modal-industry">Consulting</p>
          </div>
          <div class="detail-item">
            <label>Contact Person</label>
            <p id="r-modal-contact-person">Michael Brown</p>
          </div>
          <div class="detail-item">
            <label>Email</label>
            <p id="r-modal-email">michael@revokedcompany.com</p>
          </div>
          <div class="detail-item">
            <label>Phone</label>
            <p id="r-modal-phone">+1 (555) 987-6543</p>
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
              <button class="btn-doc btn-view-doc" id="r-business-license-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="r-business-license-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              Tax Certificate
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="r-tax-certificate-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="r-tax-certificate-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              ID Proof
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="r-id-proof-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="r-id-proof-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button class="btn btn-restore">
        <span class="material-symbols-outlined">autorenew</span>
        Restore Verification
      </button>
      <button class="btn btn-close">
        <span class="material-symbols-outlined">close</span>
        Close
      </button>
    </div>
  </div>
  </div>

  <!-- Rejected Employer Modal -->
  <div id="rejectedModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2><span class="material-symbols-outlined">block</span>Rejected Company Details</h2>
      <button class="close">&times;</button>
    </div>

    <div class="modal-body">
      <div class="profile-section">
        <h3 class="section-title">
          <span class="material-symbols-outlined">info</span> Company Profile
        </h3>
        <div class="profile-details">
          <div class="detail-item">
            <label>Company Name</label>
            <p id="rej-modal-company-name">Rejected Company Inc.</p>
          </div>
          <div class="detail-item">
            <label>Address</label>
            <p id="rej-modal-address">123 Denied Ave, Seattle, WA</p>
          </div>
          <div class="detail-item">
            <label>Industry</label>
            <p id="rej-modal-industry">Manufacturing</p>
          </div>
          <div class="detail-item">
            <label>Contact Person</label>
            <p id="rej-modal-contact-person">Sarah Lee</p>
          </div>
          <div class="detail-item">
            <label>Email</label>
            <p id="rej-modal-email">sarah@rejectedcompany.com</p>
          </div>
          <div class="detail-item">
            <label>Phone</label>
            <p id="rej-modal-phone">+1 (555) 222-7890</p>
          </div>
        </div>
      </div>

      <div class="documents-section">
        <h3 class="section-title">
          <span class="material-symbols-outlined">description</span> Documents
        </h3>
        <div class="documents-list">
          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              Business License
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="rj-business-license-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="rj-business-license-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              Tax Certificate
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="rj-tax-certificate-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="rj-tax-certificate-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>

          <div class="document-item">
            <div class="document-name">
              <span class="material-symbols-outlined">description</span>
              ID Proof
            </div>
            <div class="document-actions">
              <button class="btn-doc btn-view-doc" id="rj-id-proof-view">
                <span class="material-symbols-outlined">visibility</span> View
              </button>
              <button class="btn-doc btn-download" id="rj-id-proof-download">
                <span class="material-symbols-outlined">download</span> Download
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button class="btn btn-restored">
        <span class="material-symbols-outlined">autorenew</span>
        Restore Employer
      </button>
      <button class="btn btn-close">
        <span class="material-symbols-outlined">close</span>
        Close
      </button>
    </div>
  </div>
  </div>

  <script src="../assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
  <script src="../assets/library/datatable/dataTables.js"></script>
  <script src="../js/table-init.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    fetch("../Function/fetch-employer.php")
      .then(response => response.json())
      .then(data => {
        console.log("fetch result:", data);

        if (!data.success) {
          console.error(data.message || "fetch returned success:false");
          return;
        }

        const pendingTableBody = document.querySelector("#pendingTable tbody");
        const verifiedTableBody = document.querySelector("#verifiedTable tbody");

        if (!pendingTableBody) console.error("Pending table tbody not found");
        if (!verifiedTableBody) console.error("Verified table tbody not found");

        if (Array.isArray(data.pending)) {
          pendingTableBody.innerHTML = data.pending.map(emp => `
            <tr>
              <td>${emp.company_name}</td>
              <td>${emp.contact_person}</td>
              <td>${emp.email}</td>
              <td>${emp.industry}</td>
              <td><span class="status pending">${emp.status}</span></td>
              <td>
                <button class="view-btn" data-type="pending" data-company='${JSON.stringify(emp)}'>
                  <span class="material-symbols-outlined">visibility</span> View
                </button>
              </td>
            </tr>
          `).join("");
        }

        const verifiedData = data.verified || [];
        if (Array.isArray(verifiedData)) {
          verifiedTableBody.innerHTML = verifiedData.map(emp => `
            <tr>
              <td>${emp.company_name}</td>
              <td>${emp.contact_person}</td>
              <td>${emp.email}</td>
              <td>${emp.industry}</td>
              <td><span class="status verified">${emp.status}</span></td>
              <td>
                <button class="view-btn" data-type="verified" data-company='${JSON.stringify(emp)}'>
                  <span class="material-symbols-outlined">visibility</span> View
                </button>
                <button class="revoke-btn" data-email="${emp.email}" style="display: none;">Revoke</button>
              </td>
            </tr>
          `).join("");
        }

        const revokedTableBody = document.querySelector("#revokedTable tbody");
        const revokedData = data.revoked || [];
        if (Array.isArray(revokedData)) {
          revokedTableBody.innerHTML = revokedData.map(emp => `
            <tr>
              <td>${emp.company_name}</td>
              <td>${emp.contact_person}</td>
              <td>${emp.email}</td>
              <td>${emp.industry}</td>
              <td><span class="status revoked">${emp.status}</span></td>
              <td>
                <button class="view-btn" data-type="revoked" data-company='${JSON.stringify(emp)}'>
                  <span class="material-symbols-outlined">visibility</span> View
                </button>
                <button class="restore-btn" data-email="${emp.email}" style="display: none;">
                  <span class="material-symbols-outlined" >autorenew</span> Restore
                </button>
              </td>
            </tr>
          `).join("");
        }

        const rejectedData = data.rejected || [];
        if (Array.isArray(rejectedData)) {
          const rejectedTableBody = document.querySelector("#rejectedTable tbody");
          rejectedTableBody.innerHTML = rejectedData.map(emp => `
            <tr>
              <td>${emp.company_name}</td>
              <td>${emp.contact_person}</td>
              <td>${emp.email}</td>
              <td>${emp.industry}</td>
              <td><span class="status rejected">${emp.status}</span></td>
              <td>
                <button class="view-btn" data-type="rejected" data-company='${JSON.stringify(emp)}'>
                  <span class="material-symbols-outlined">visibility</span> View
                </button>
                <button class="restore-btn" data-email="${emp.email}" style="display: none;">Restore</button>
              </td>
            </tr>
          `).join("");
        }
        
        document.querySelectorAll(".view-btn").forEach(btn => {
        btn.addEventListener("click", function() {
          const emp = JSON.parse(this.dataset.company);
          const type = this.dataset.type;

          if (type === "pending") {
            openPendingModal(emp);
          } else if (type === "verified") {
            openVerifiedModal(emp);
          } else if (type === "revoked") {
            openRevokedModal(emp);
          } else if (type === "rejected") 
            openRejectedModal(emp);
          });
        });

      })
      .catch(error => console.error("Error fetching employer data:", error));

    function openPendingModal(emp) {
      document.getElementById("modal-company-name").textContent = emp.company_name;
      document.getElementById("modal-contact-person").textContent = emp.contact_person;
      document.getElementById("modal-email").textContent = emp.email;
      document.getElementById("modal-address").textContent = emp.address;
      document.getElementById("modal-industry").textContent = emp.industry;
      document.getElementById("modal-phone").textContent = emp.contact_mobile;

      setDocumentButton("p-business-license", emp.business_permit);
      setDocumentButton("p-tax-certificate", emp.bir_certification);
      setDocumentButton("p-id-proof", emp.employer_profile);

      const modal = document.getElementById("pendingModal"); modal.style.display = "flex";
      const content = modal.querySelector(".modal-content");
      if (content) content.classList.add("modal-show");
    }

    function openVerifiedModal(emp) {
      document.getElementById("v-modal-company-name").textContent = emp.company_name;
      document.getElementById("v-modal-contact-person").textContent = emp.contact_person;
      document.getElementById("v-modal-email").textContent = emp.email;
      document.getElementById("v-modal-address").textContent = emp.address;
      document.getElementById("v-modal-industry").textContent = emp.industry;
      document.getElementById("v-modal-phone").textContent = emp.contact_mobile;

      setDocumentButton("v-business-license", emp.business_permit);
      setDocumentButton("v-tax-certificate", emp.bir_certification);
      setDocumentButton("v-id-proof", emp.employer_profile);

      const modal = document.getElementById("verifiedModal"); modal.style.display = "flex";
      const content = modal.querySelector(".modal-content");
      if (content) content.classList.add("modal-show");
    }

    function openRevokedModal(emp) {
      document.getElementById("r-modal-company-name").textContent = emp.company_name;
      document.getElementById("r-modal-contact-person").textContent = emp.contact_person;
      document.getElementById("r-modal-email").textContent = emp.email;
      document.getElementById("r-modal-address").textContent = emp.address;
      document.getElementById("r-modal-industry").textContent = emp.industry;
      document.getElementById("r-modal-phone").textContent = emp.contact_mobile;

      setDocumentButton("r-business-license", emp.business_permit);
      setDocumentButton("r-tax-certificate", emp.bir_certification);
      setDocumentButton("r-id-proof", emp.employer_profile);

      const modal = document.getElementById("revokedModal");
      modal.style.display = "flex";
      const content = modal.querySelector(".modal-content");
      if (content) content.classList.add("modal-show");
    }

    function openRejectedModal(emp) {
      document.getElementById("rej-modal-company-name").textContent = emp.company_name;
      document.getElementById("rej-modal-contact-person").textContent = emp.contact_person;
      document.getElementById("rej-modal-email").textContent = emp.email;
      document.getElementById("rej-modal-address").textContent = emp.address;
      document.getElementById("rej-modal-industry").textContent = emp.industry;
      document.getElementById("rej-modal-phone").textContent = emp.contact_mobile;

      setDocumentButton("rj-business-license", emp.business_permit);
      setDocumentButton("rj-tax-certificate", emp.bir_certification);
      setDocumentButton("rj-id-proof", emp.employer_profile);

      const modal = document.getElementById("rejectedModal");
      modal.style.display = "flex";
      const content = modal.querySelector(".modal-content");
      if (content) content.classList.add("modal-show");
    }

      function setDocumentButton(docType, filePath) {
        const viewBtn = document.querySelector(`#${docType}-view`);
        const downloadBtn = document.querySelector(`#${docType}-download`);

        if (filePath && filePath.trim() !== "") {
          const fullPath = `../../${filePath}`;
          viewBtn.onclick = () => window.open(fullPath, "_blank");
          downloadBtn.onclick = () => {
            const link = document.createElement("a");
            link.href = fullPath;
            link.download = filePath.split("/").pop();
            link.click();
          };
        } else {
          viewBtn.onclick = downloadBtn.onclick = () => {
            alert("No file uploaded for this document.");
          };
        }
      }
    document.querySelectorAll(".modal .close, .btn-close").forEach(btn => {
    btn.addEventListener("click", function() {
      const modal = this.closest(".modal");
      const content = modal.querySelector(".modal-content");
      if (content) content.classList.remove("modal-show");
      modal.style.display = "none";
    });
  });
  });
  </script>


  <script>
    document.addEventListener('DOMContentLoaded', () => {
  
    function updateEmployerStatus(email, status) {
      fetch("../Function/update-employer-status.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ email, status })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          if (status === "verify" || status === "pending") {
            document.querySelector('#pendingModal .modal-content').classList.remove('modal-show');
            setTimeout(() => {
              document.getElementById('pendingModal').style.display = 'none';
            }, 300);
          } else if (status === "revoked") {
            document.querySelector('#verifiedModal .modal-content').classList.remove('modal-show');
            setTimeout(() => {
              document.getElementById('verifiedModal').style.display = 'none';
            }, 300);
          } else if (status === "restore") {
            const modal = document.querySelector('#revokedModal');
            modal.querySelector('.modal-content').classList.remove('modal-show');
            setTimeout(() => { modal.style.display = 'none'; }, 300);
          } else if (status === "rejected") {
            const modal = document.querySelector('#revokedModal');
            modal.querySelector('.modal-content').classList.remove('modal-show');
            setTimeout(() => { modal.style.display = 'none'; }, 300);
          }
          setTimeout(() => location.reload(), 500);
        } else {
          alert("❌ " + data.message);
        }
      })
      .catch(err => console.error("Error:", err));
    }
    document.querySelector('.btn-verify').addEventListener('click', function() {
      const email = document.getElementById("modal-email").textContent;
      updateEmployerStatus(email, "verified");
    });

    document.querySelector('.btn-reject').addEventListener('click', function() {
      const email = document.getElementById("modal-email").textContent;
      updateEmployerStatus(email, "revoked");
    });

    document.querySelector('.btn-revoke').addEventListener('click', function() {
      const email = document.getElementById("v-modal-email").textContent;
      updateEmployerStatus(email, "revoked");
    });

    document.querySelector('.btn-restore')?.addEventListener('click', function() {
    const email = document.getElementById("r-modal-email").textContent;
    updateEmployerStatus(email, "verified");
    });

    document.querySelector('.btn-restored')?.addEventListener('click', function() {
      const email = document.getElementById("rej-modal-email").textContent;
      updateEmployerStatus(email, "pending");
    });

  });
  </script>

</body>

</html>