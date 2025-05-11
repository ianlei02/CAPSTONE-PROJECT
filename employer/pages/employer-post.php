<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employer Dashboard</title>

  <link rel="stylesheet" href="../css/navs.css">
  <link rel="stylesheet" href="../css/employer-post.css">
  <link rel="stylesheet" href="../../public-assets/library/datatable/dataTables.css">
  <script src="../../public-assets/JS_JQUERY/jquery-3.7.1.min.js" defer></script>
  <script src="../../public-assets/library/datatable/dataTables.js" defer></script>
  <script src="../../public-assets/js/table-init.js" defer></script>
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
            <select class="status-filter">
              <option value="all">All Statuses</option>
              <option value="active">Active</option>
              <option value="closed">Closed</option>
              <option value="draft">Draft</option>
            </select>
          </div>
        </div>

        <div class="table-responsive">
          <table class="jobs-table" id="myTable">
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
      </section>
    </main>
  </div>

  <script src="../js/responsive.js"></script>


</body>

</html>