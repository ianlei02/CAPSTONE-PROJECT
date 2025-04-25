<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    
    <title>Admin Dashboard</title>
    <style>
        :root {
            /* --primary-blue-color: #4285f4;
            --secondary-blue-color: #5c9eff; */
            --primary-blue-color:#FFCF91;
            --secondary-blue-color: #FFCE91;
            --primary-red-color: #ff4c4c;
            --secondary-red-color: #ff6b6b;
            --dark-clr-700: #000;
            --dark-clr-600: #333;
            --light-clr-700: #fff;
            --light-clr-600: #fafafa;
            --light-clr-500: #f3f3f3;
            --border: #ddd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-clr-500);
            color: var(--dark-clr-600);
        }

        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: var(--light-clr-700);
            border-right: 1px solid var(--border);
            padding: 20px 0;
        }

        .logo {
            padding: 0 20px 20px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 20px;
        }

        .logo h2 {
            color: var(--primary-blue-color);
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-item:hover, .nav-item.active {
            background-color: var(--light-clr-600);
            border-left: 3px solid var(--primary-blue-color);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            padding: 20px;
        }

 
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
 
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .stats-cards {
 
        }

        .header h1 {
            font-size: 24px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-blue-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Stats Cards */
        .stats-container {
 
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
 
        
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        
        .stat-card {
            text-align: center;
        }
        
        .stat-card h3 {
            margin-top: 0;
            color: var(--dark);
        }
        
        .stat-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .stat-card .icon {
            font-size: 2rem;
            padding: 15px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        
        .users { background-color: rgba(52, 152, 219, 0.1); color: var(--primary); }
        .jobs { background-color: rgba(46, 204, 113, 0.1); color: var(--success); }
        .applications { background-color: rgba(243, 156, 18, 0.1); color: var(--warning); }
        .companies { background-color: rgba(231, 76, 60, 0.1); color: var(--danger); }
        
        .recent-activity {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
 

        .stat-card {
            background-color: var(--light-clr-700);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .stat-card h3 {
            font-size: 14px;
            color: var(--dark-clr-600);
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-blue-color);
        }

        /* Tables */
        .table-container {
            background-color: var(--light-clr-700);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 30px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

 
        table {
            width: 100%;
            border-collapse: collapse;
        }
 
        
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        table th {
            background-color: var(--light);
            font-weight: 600;
        }
        
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-approved { background-color: #d4edda; color: #155724; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }
        
        .search-bar {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
 
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background-color: var(--light-clr-600);
            font-weight: 600;
        }

        tr:hover {
            background-color: var(--light-clr-600);
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 5px;
            transition: all 0.3s;
        }

        .btn-approve {
            background-color: var(--primary-blue-color);
            color: white;
        }

        .btn-reject {
            background-color: var(--primary-red-color);
            color: white;
        }

        .btn-view {
            background-color: var(--light-clr-600);
            color: var(--dark-clr-600);
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--border);
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            border-bottom: 2px solid var(--primary-blue-color);
            color: var(--primary-blue-color);
            font-weight: 500;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 500px;
            max-width: 90%;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 18px;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        /* Charts Container */
        .charts-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background-color: var(--light-clr-700);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .chart-card h3 {
            font-size: 16px;
            margin-bottom: 20px;
            color: var(--dark-clr-600);
        }

        .chart {
            height: 250px;
            background-color: var(--light-clr-600);
            border-radius: 4px;
            display: flex;
            align-items: flex-end;
            padding: 10px;
            gap: 10px;
        }
        .bar {
            flex: 1;
            background-color: var(--primary-blue-color);
            border-radius: 4px 4px 0 0;
            position: relative;
            min-width: 30px;
        }

        .bar-label {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
        }

        .bar-value {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            font-weight: bold;
        }

        .pie-chart {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: conic-gradient(
                var(--primary-blue-color) 0% 30%,
                var(--secondary-blue-color) 30% 55%,
                var(--primary-red-color) 55% 75%,
                var(--secondary-red-color) 75% 100%
            );
            margin: 0 auto;
            position: relative;
        }

        .pie-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
 
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>JobConnect Admin</h2>
            </div>
            <ul class="sidebar-menu">
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
                <li><i class="fas fa-users"></i> Job Seekers</li>
                <li><i class="fas fa-building"></i> Employers</li>
                <li><i class="fas fa-briefcase"></i> Job Listings</li>
                <li><i class="fas fa-file-alt"></i> Applications</li>
                <li><i class="fas fa-chart-bar"></i> Analytics</li>
                <li><i class="fas fa-cog"></i> Settings</li>
                <li><i class="fas fa-question-circle"></i> Help & Support</li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Dashboard Overview</h1>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="Admin">
                    <span>Admin User</span>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card stat-card">
                    <div class="icon users"><i class="fas fa-users"></i></div>
                    <h3>Total Job Seekers</h3>
                    <div class="value">4,892</div>
                    <p><span class="text-success">+12%</span> from last month</p>
                </div>
                
                <div class="card stat-card">
                    <div class="icon jobs"><i class="fas fa-briefcase"></i></div>
                    <h3>Active Jobs</h3>
                    <div class="value">1,245</div>
                    <p><span class="text-success">+8%</span> from last month</p>
                </div>
                
                <div class="card stat-card">
                    <div class="icon applications"><i class="fas fa-file-alt"></i></div>
                    <h3>New Applications</h3>
                    <div class="value">568</div>
                    <p><span class="text-success">+23%</span> from last week</p>
                </div>
                
                <div class="card stat-card">
                    <div class="icon companies"><i class="fas fa-building"></i></div>
                    <h3>Registered Companies</h3>
                    <div class="value">324</div>
                    <p><span class="text-success">+5%</span> from last month</p>
                </div>
            </div>
            
            <!-- Recent Activity Section -->
            <div class="recent-activity">
                <div class="card">
                    <h2>Recent Job Applications</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
 
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>PESO</h2>
            </div>
            <ul class="nav-menu">
                <li class="nav-item active">
                    <i>📊</i> Dashboard
                </li>
                <li class="nav-item">
                    <i>👥</i> Applicants
                </li>
                <li class="nav-item">
                    <i>🏢</i> Employers
                </li>
                <li class="nav-item">
                    <i>📋</i> Job Listings
                </li>
                <li class="nav-item">
                    <i>⚙️</i> Settings
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Admin Dashboard</h1>
                <div class="user-info">
                    <div class="user-avatar">AD</div>
                    <span>Admin User</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Applicants</h3>
                    <div class="value">1,245</div>
                </div>
                <div class="stat-card">
                    <h3>Pending Approvals</h3>
                    <div class="value">28</div>
                </div>
                <div class="stat-card">
                    <h3>Active Jobs</h3>
                    <div class="value">156</div>
                </div>
                <div class="stat-card">
                    <h3>Verified Employers</h3>
                    <div class="value">89</div>
                </div>
            </div>
            <div class="charts-container">
                <div class="chart-card">
                    <h3>Monthly Applications</h3>
                    <div class="chart">
                        <div class="bar" style="height: 30%;">
                            <span class="bar-value">120</span>
                            <span class="bar-label">Jan</span>
                        </div>
                        <div class="bar" style="height: 50%;">
                            <span class="bar-value">200</span>
                            <span class="bar-label">Feb</span>
                        </div>
                        <div class="bar" style="height: 70%;">
                            <span class="bar-value">280</span>
                            <span class="bar-label">Mar</span>
                        </div>
                        <div class="bar" style="height: 90%;">
                            <span class="bar-value">360</span>
                            <span class="bar-label">Apr</span>
                        </div>
                        <div class="bar" style="height: 60%;">
                            <span class="bar-value">240</span>
                            <span class="bar-label">May</span>
                        </div>
                        <div class="bar" style="height: 40%;">
                            <span class="bar-value">160</span>
                            <span class="bar-label">Jun</span>
                        </div>
                    </div>
                </div>
                <div class="chart-card">
                    <h3>Application Status Distribution</h3>
                    <div class="pie-chart"></div>
                    <div class="pie-legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--primary-blue-color);"></div>
                            <span>Pending (30%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--secondary-blue-color);"></div>
                            <span>Interview (25%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--primary-red-color);"></div>
                            <span>Referred (20%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--secondary-red-color);"></div>
                            <span>Rejected (25%)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <div class="tab active" data-tab="applications">Applications</div>
                <div class="tab" data-tab="employers">Employer Requests</div>
                <div class="tab" data-tab="jobs">Job Approvals</div>
            </div>

            <!-- Applications Tab -->
            <div class="tab-content active" id="applications">
                <div class="table-container">
                    <div class="table-header">
                        <h3>Recent Applications</h3>
                        <input type="text" placeholder="Search applications...">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Date Applied</th>
                                <th>Status</th>
                                <th>Actions</th>
 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>John Smith</td>
                                <td>Senior Developer</td>
                                <td>TechCorp</td>
                                <td>2023-05-15</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Sarah Johnson</td>
                                <td>Marketing Manager</td>
                                <td>BrandVision</td>
                                <td>2023-05-14</td>
                                <td><span class="status status-approved">Approved</span></td>
                                <td>
                                    <button class="btn btn-primary">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Michael Brown</td>
                                <td>Data Analyst</td>
                                <td>DataInsights</td>
                                <td>2023-05-13</td>
                                <td><span class="status status-rejected">Rejected</span></td>
                                <td>
                                    <button class="btn btn-primary">View</button>
 
                                <td>John Doe</td>
                                <td>Frontend Developer</td>
                                <td>2023-10-15</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-applicant="1">View</button>
                                    <button class="action-btn btn-approve" data-action="interview">Interview</button>
                                    <button class="action-btn btn-approve" data-action="refer">Refer</button>
                                    <button class="action-btn btn-reject">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Marketing Manager</td>
                                <td>2023-10-14</td>
                                <td><span class="status status-approved">Referred</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-applicant="2">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Robert Johnson</td>
                                <td>Data Analyst</td>
                                <td>2023-10-13</td>
                                <td><span class="status status-rejected">Rejected</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-applicant="3">View</button>
 
                                </td>
                            </tr>
                            <tr>
                                <td>Emily Davis</td>
                                <td>UX Designer</td>
 
                                <td>CreativeMinds</td>
                                <td>2023-05-12</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Robert Wilson</td>
                                <td>Project Manager</td>
                                <td>BuildRight</td>
                                <td>2023-05-11</td>
                                <td><span class="status status-approved">Approved</span></td>
                                <td>
                                    <button class="btn btn-primary">View</button>
 
                                <td>2023-10-12</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn btn-view" data-applicant="4">View</button>
                                    <button class="action-btn btn-approve" data-action="interview">Interview</button>
                                    <button class="action-btn btn-approve" data-action="refer">Refer</button>
                                    <button class="action-btn btn-reject">Reject</button>
 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
 
                
                <div class="card">
                    <h2>New Job Postings</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Action</th>
 
            </div>

            <!-- Employer Requests Tab -->
            <div class="tab-content" id="employers">
                <div class="table-container">
                    <div class="table-header">
                        <h3>Employer Verification Requests</h3>
                        <input type="text" placeholder="Search employers...">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Date Submitted</th>
                                <th>Status</th>
                                <th>Actions</th>
 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>Frontend Developer</td>
                                <td>WebSolutions</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary">Approve</button>
                                    <button class="btn btn-danger">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td>HR Manager</td>
                                <td>PeopleFirst</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary">Approve</button>
                                    <button class="btn btn-danger">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td>DevOps Engineer</td>
                                <td>CloudTech</td>
                                <td><span class="status status-approved">Approved</span></td>
                                <td>
                                    <button class="btn btn-danger">Disable</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Content Writer</td>
                                <td>MediaPlus</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary">Approve</button>
                                    <button class="btn btn-danger">Reject</button>

                                <td>Tech Solutions Inc.</td>
                                <td>Michael Brown</td>
                                <td>michael@techsolutions.com</td>
                                <td>2023-10-10</td>
                                <td><span class="status status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                    <button class="action-btn btn-approve">Approve</button>
                                    <button class="action-btn btn-reject">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Design Studio LLC</td>
                                <td>Sarah Wilson</td>
                                <td>sarah@designstudio.com</td>
                                <td>2023-10-09</td>
                                <td><span class="status status-approved">Approved</span></td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Data Insights Co.</td>
                                <td>David Miller</td>
                                <td>david@datainsights.com</td>
                                <td>2023-10-08</td>
                                <td><span class="status status-rejected">Rejected</span></td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Job Approvals Tab -->
            <div class="tab-content" id="jobs">
                <div class="table-container">
                    <div class="table-header">
                        <h3>Job Postings Pending Approval</h3>
                        <input type="text" placeholder="Search jobs...">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Salary</th>
                                <th>Date Posted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Senior Software Engineer</td>
                                <td>Tech Solutions Inc.</td>
                                <td>Remote</td>
                                <td>$120,000</td>
                                <td>2023-10-11</td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                    <button class="action-btn btn-approve">Approve</button>
                                    <button class="action-btn btn-reject">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Product Manager</td>
                                <td>Design Studio LLC</td>
                                <td>New York, NY</td>
                                <td>$110,000</td>
                                <td>2023-10-10</td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                    <button class="action-btn btn-approve">Approve</button>
                                    <button class="action-btn btn-reject">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Data Scientist</td>
                                <td>Data Insights Co.</td>
                                <td>San Francisco, CA</td>
                                <td>$130,000</td>
                                <td>2023-10-09</td>
                                <td>
                                    <button class="action-btn btn-view">View</button>
                                    <button class="action-btn btn-approve">Approve</button>
                                    <button class="action-btn btn-reject">Reject</button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <!-- Additional Sections -->
            <div class="card">
                <h2>Platform Analytics</h2>
                <div style="height: 300px; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center;">
                    [Chart.js or other visualization would go here]
                </div>
            </div>
        </div>
    </div>

        </main>
    </div>

    <!-- Applicant Detail Modal -->
    <div class="modal" id="applicantModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Applicant Details</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>John Doe</h4>
                <p>Applied for: Frontend Developer</p>
                <p>Email: john.doe@example.com</p>
                <p>Phone: (555) 123-4567</p>
                <p>Experience: 5 years</p>
                <p>Education: BS in Computer Science</p>
                <p>Skills: JavaScript, React, HTML, CSS</p>
                <p>Cover Letter:</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris.</p>
            </div>
            <div class="modal-footer">
                <button class="action-btn btn-reject">Reject</button>
                <button class="action-btn btn-approve" data-action="interview">Schedule Interview</button>
                <button class="action-btn btn-approve" data-action="refer">Refer to Employer</button>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Modal functionality
        const modal = document.getElementById('applicantModal');
        const viewButtons = document.querySelectorAll('.btn-view');
        const closeModal = document.querySelector('.close-modal');

        viewButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.style.display = 'flex';
            });
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Action buttons (simulate actions)
        const actionButtons = document.querySelectorAll('[data-action]');
        
        actionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const action = e.target.getAttribute('data-action');
                const applicantName = e.target.closest('tr').querySelector('td').textContent;
                
                if (action === 'interview') {
                    alert(`Interview scheduled for ${applicantName}. An email has been sent.`);
                } else if (action === 'refer') {
                    alert(`${applicantName} has been referred to the employer.`);
                }
                
                // In a real app, you would make an API call here
            });
        });

        // Reject buttons
        const rejectButtons = document.querySelectorAll('.btn-reject:not([data-action])');
        
        rejectButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                const name = row.querySelector('td').textContent;
                
                if (confirm(`Are you sure you want to reject ${name}?`)) {
                    row.querySelector('.status').className = 'status status-rejected';
                    row.querySelector('.status').textContent = 'Rejected';
                    
                    // Remove action buttons after rejection
                    const actionsCell = row.querySelector('td:last-child');
                    actionsCell.innerHTML = '<button class="action-btn btn-view">View</button>';
                    
                    alert(`${name} has been rejected. Notification sent.`);
                }
            });
        });
    </script>
 
</body>
</html>