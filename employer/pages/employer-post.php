<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employer Dashboard</title>
    <!-- <link rel="stylesheet" href="../css/employer-dashboard.css" /> -->
    <link rel="stylesheet" href="../css/navs.css">
    <style>
         /* Card styling */
    .card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
      padding: 25px;
      margin-bottom: 30px;
      border: 1px solid #e0e6ed;
    }

    /* Job Posting Form */
    .job-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-row {
      display: flex;
      gap: 20px;
    }

    .form-group {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-weight: 600;
      color: #4a5568;
      font-size: 0.9rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 10px 12px;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      font-size: 14px;
      transition: border 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #3182ce;
      box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .form-actions {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
      padding-top: 10px;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.2s;
    }

    .btn-primary {
      background-color: #3182ce;
      color: white;
    }

    .btn-primary:hover {
      background-color: #2c5282;
    }

    .btn-secondary {
      background-color: #edf2f7;
      color: #4a5568;
      border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
      background-color: #e2e8f0;
    }

    /* Job Monitoring Section */
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 15px;
    }

    .search-filter {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    .search-input {
      padding: 8px 15px;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      min-width: 250px;
      font-size: 0.9rem;
    }

    .status-filter {
      padding: 8px 12px;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      font-size: 0.9rem;
      background-color: #fff;
    }

    /* Table Styles */
    .table-responsive {
      overflow-x: auto;
      border-radius: 6px;
      border: 1px solid #e2e8f0;
    }

    .jobs-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.9rem;
    }

    .jobs-table th,
    .jobs-table td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #edf2f7;
    }

    .jobs-table th {
      background-color: #f8fafc;
      font-weight: 600;
      color: #4a5568;
      text-transform: uppercase;
      font-size: 0.8rem;
      letter-spacing: 0.5px;
    }

    .tag {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 4px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .tag-it {
      background-color: #ebf8ff;
      color: #3182ce;
    }

    .tag-business {
      background-color: #fff5f5;
      color: #e53e3e;
    }

    .tag-engineering {
      background-color: #f0fff4;
      color: #38a169;
    }

    .status-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .status-badge.active {
      background-color: #f0fff4;
      color: #38a169;
    }

    .status-badge.closed {
      background-color: #fff5f5;
      color: #e53e3e;
    }

    .status-badge.draft {
      background-color: #ebf8ff;
      color: #3182ce;
    }

    .expiry-date {
      color: #718096;
      font-size: 0.85rem;
    }

    .vacancies {
      font-weight: 600;
      color: #2d3748;
    }

    .action-btn {
      padding: 6px 12px;
      margin-right: 6px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.8rem;
      font-weight: 600;
      transition: all 0.2s;
    }

    .action-btn.view {
      background-color: #ebf8ff;
      color: #3182ce;
    }

    .action-btn.view:hover {
      background-color: #bee3f8;
    }

    .action-btn.edit {
      background-color: #feebc8;
      color: #dd6b20;
    }

    .action-btn.edit:hover {
      background-color: #fbd38d;
    }

    .action-btn.delete {
      background-color: #fed7d7;
      color: #e53e3e;
    }

    .action-btn.delete:hover {
      background-color: #feb2b2;
    }

    /* Table Footer */
    .table-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
      flex-wrap: wrap;
      gap: 15px;
      .pagination {
        display: flex;
        gap: 6px;
      }
  
      .page-btn {
        padding: 8px 14px;
        border: 1px solid #e2e8f0;
        background-color: #fff;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.2s;
      }
  
      .page-btn:hover:not(.active) {
        background-color: #edf2f7;
      }
  
      .page-btn.active {
        background-color: #3182ce;
        color: white;
        border-color: #3182ce;
      }
  
      .page-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
      }
  
      .table-info {
        color: #718096;
        font-size: 0.85rem;
      }
    }


    /* Responsive Adjustments */
    @media (max-width: 992px) {
      .content {
        margin-left: 0;
        padding-top: 80px;
      }
      
      .form-row {
        flex-direction: column;
        gap: 20px;
      }
    }

    @media (max-width: 768px) {
      .section-header {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .search-filter {
        width: 100%;
      }
      
      .search-input {
        flex: 1;
      }
      
      .table-footer {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    @media (max-width: 576px) {
      .card {
        padding: 20px 15px;
      }
      
      .jobs-table th,
      .jobs-table td {
        padding: 10px 12px;
      }
      
      .action-btn {
        margin-bottom: 6px;
        display: block;
        width: 100%;
        margin-right: 0;
      }
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
          <div class="profile">IAN</div>
        </div>
      </div>
    </nav>

    <div class="container">
      <aside class="sidebar">
        <ul class="sidebar-menu">
          <li>

            <a href="./employer-dashboard.php">
              <span class="emoji"><img src="../../public-assets/icons/gauge-high-solid.svg" alt=""></span>
              <span class="label">Dashboard</span>
            </a>
          </li>
          <li>

            <a href="./employer-applications.php">
              <span class="emoji"><img src="../../public-assets/icons/briefcase-solid.svg" alt=""></span>
              <span class="label">Job Applications</span>
            </a>
          </li>
          <li>

            <a href="./applicant-job-search.php">
              <span class="emoji"><img src="../../public-assets/icons/magnifying-glass-solid.svg" alt=""></span>
              <span class="label">Applicant Search</span>
            </a>
          </li>
          <li>
            <a href="./applicant-profile.php">
              <span class="emoji"><img src="../../public-assets/icons/user-solid.svg" alt=""></span>
              <span class="label">My Profile</span>
            </a>
          </li>
          <li>
            <a href="../../landing/functions/logout.php">
              <span class="emoji"><img src="../../public-assets/icons/arrow-right-from-bracket-solid.svg" alt=""></span>
              <span class="label">Log Out</span>
            </a>
          </li>
        </ul>
      </aside>

      <main class="main-content">
        <section class="job-posting-section card">
            <h2>Post a New Job</h2>
            <form id="jobPostForm" class="job-form">
              <div class="form-row">
                <div class="form-group">
                  <label for="jobTitle">Job Title*</label>
                  <input type="text" id="jobTitle" name="jobTitle" required placeholder="e.g., Senior Frontend Developer">
                </div>
                <div class="form-group">
                  <label for="jobType">Job Type*</label>
                  <select id="jobType" name="jobType" required>
                    <option value="">Select Job Type</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                    <option value="Internship">Internship</option>
                    <option value="Temporary">Temporary</option>
                  </select>
                </div>
              </div>
              
              <div class="form-row">
                <div class="form-group">
                  <label for="location">Location*</label>
                  <input type="text" id="location" name="location" required placeholder="e.g., New York, NY or Remote">
                </div>
                <div class="form-group">
                  <label for="category">Category*</label>
                  <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="IT">Information Technology</option>
                    <option value="Business">Business</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Education">Education</option>
                  </select>
                </div>
              </div>
              
              <div class="form-row">
                <div class="form-group">
                  <label for="vacancies">Number of Vacancies*</label>
                  <input type="number" id="vacancies" name="vacancies" required min="1" placeholder="e.g., 2">
                </div>
                <div class="form-group">
                  <label for="expiryDate">Application Deadline</label>
                  <input type="date" id="expiryDate" name="expiryDate">
                </div>
              </div>
              
              <div class="form-row">
                <div class="form-group">
                  <label for="salary">Salary Range</label>
                  <input type="text" id="salary" name="salary" placeholder="e.g., $80,000 - $100,000 per year" style="width: 49%;">
                </div>
               
              </div>
              
              <div class="form-group">
                <label for="description">Job Description and Requirements</label>
                <textarea id="description" name="description" rows="5" required placeholder="Detailed description of the job responsibilities..."></textarea>
              </div>
              
              
              <div class="form-actions">
                <button type="reset" class="btn btn-secondary">Clear Form</button>
                <button type="submit" class="btn btn-primary">Post Job Opening</button>
              </div>
            </form>
          </section>
          
          <!-- Job Monitoring Section -->
          <section class="job-monitoring-section card">
            <div class="section-header">
              <h2>Your Job Postings</h2>
              <div class="search-filter">
                <input type="text" placeholder="Search job titles..." class="search-input">
                <select class="status-filter">
                  <option value="all">All Statuses</option>
                  <option value="active">Active</option>
                  <option value="closed">Closed</option>
                  <option value="draft">Draft</option>
                </select>
              </div>
            </div>
            
            <div class="table-responsive">
              <table class="jobs-table">
                <thead>
                  <tr>
                    <th>Job Title</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Vacancies</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="jobsTableBody">
                  <!-- Sample rows - would be dynamically populated in a real app -->
                  <tr>
                    <td>Senior Frontend Developer (React)</td>
                    <td><span class="tag tag-it">IT</span></td>
                    <td>Full-time</td>
                    <td class="vacancies">2</td>
                    <td class="expiry-date">2023-06-30</td>
                    <td><span class="status-badge active">Active</span></td>
                    <td>
                      <button class="action-btn view">View</button>
                      <button class="action-btn edit">Edit</button>
                      <button class="action-btn delete">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <td>Financial Analyst</td>
                    <td><span class="tag tag-business">Business</span></td>
                    <td>Full-time</td>
                    <td class="vacancies">1</td>
                    <td class="expiry-date">2023-06-15</td>
                    <td><span class="status-badge active">Active</span></td>
                    <td>
                      <button class="action-btn view">View</button>
                      <button class="action-btn edit">Edit</button>
                      <button class="action-btn delete">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <td>Mechanical Engineer</td>
                    <td><span class="tag tag-engineering">Engineering</span></td>
                    <td>Contract</td>
                    <td class="vacancies">3</td>
                    <td class="expiry-date">2023-05-31</td>
                    <td><span class="status-badge closed">Closed</span></td>
                    <td>
                      <button class="action-btn view">View</button>
                      <button class="action-btn edit">Edit</button>
                      <button class="action-btn delete">Delete</button>
                    </td>
                  </tr>
                  <tr>
                    <td>IT Support Specialist</td>
                    <td><span class="tag tag-it">IT</span></td>
                    <td>Part-time</td>
                    <td class="vacancies">2</td>
                    <td class="expiry-date">2023-07-15</td>
                    <td><span class="status-badge draft">Draft</span></td>
                    <td>
                      <button class="action-btn view">View</button>
                      <button class="action-btn edit">Edit</button>
                      <button class="action-btn delete">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <div class="table-footer">
              <div class="pagination">
                <button class="page-btn" disabled>Previous</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">Next</button>
              </div>
              <div class="table-info">
                Showing 1 to 4 of 4 entries
              </div>
            </div>
          </section>
      </main>
    </div>

     <script>
      document.addEventListener("DOMContentLoaded", function () {
        const hamburger = document.querySelector(".hamburger");
        const sidebar = document.querySelector(".sidebar");

        function isMobile() {
          return window.matchMedia("(max-width: 767px)").matches;
        }
        hamburger.addEventListener("click", function () {
          if (isMobile()) {
            sidebar.classList.toggle("visible");
          } else {
            sidebar.classList.toggle("collapsed");
          }
        });
        function initSidebar() {
          if (isMobile()) {
            sidebar.classList.remove("collapsed");
            sidebar.classList.remove("visible");
          } else {
            sidebar.classList.remove("visible");
          }
        }
        window.addEventListener("resize", initSidebar);
        initSidebar();
      });
    </script> 
  </body>
</html>
