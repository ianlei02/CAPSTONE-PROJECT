<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #ecf0f1;
            --dark: #34495e;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: var(--secondary);
            color: white;
            transition: all 0.3s;
        }
        
        .sidebar-header {
            padding: 20px;
            background-color: var(--dark);
        }
        
        .sidebar-menu {
            padding: 0;
            list-style: none;
        }
        
        .sidebar-menu li {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }
        
        .sidebar-menu li:hover {
            background-color: var(--primary);
            cursor: pointer;
        }
        
        .sidebar-menu li.active {
            background-color: var(--primary);
        }
        
        .sidebar-menu li i {
            margin-right: 10px;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
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
</body>
</html>