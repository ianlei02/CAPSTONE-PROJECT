<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../pages/admin-login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESO  Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #e0e7ff;
            --danger: #ef233c;
            --danger-light: #fee2e2;
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --dark: #1f2937;
            --dark-light: #374151;
            --light: #f9fafb;
            --gray: #9ca3af;
            --gray-light: #f3f4f6;
            --sidebar: #1e1b4b;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: var(--gray-light);
            color: var(--dark);
            line-height: 1.5;
        }
        
        /* Layout */
        .dashboard {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            background: var(--sidebar);
            color: white;
            padding: 1.5rem 0;
            position: sticky;
            top: 0;
            height: 100vh;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .logo h2 {
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .logo-icon {
            font-size: 1.5rem;
            color: var(--primary-light);
        }
        
        .nav-menu {
            margin-top: 1.5rem;
            padding: 0 0.75rem;
        }
        
        .nav-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
        }
        
        .nav-item:hover {
            background-color: rgba(79, 70, 229, 0.5);
        }
        
        .nav-item.active {
            background-color: var(--primary);
        }
        
        .nav-item i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        /* Main Content */
        .main-content {
            padding: 1.5rem 2rem;
        }
        
        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-light);
        }
        
        .header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            box-shadow: var(--card-shadow);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .user-profile:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .user-profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-light);
        }
        
        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }
        
        .stat-card.pending::before {
            background-color: var(--warning);
        }
        
        .stat-card.verified::before {
            background-color: var(--success);
        }
        
        .stat-card.rejected::before {
            background-color: var(--danger);
        }
        
        .stat-card h3 {
            font-size: 0.875rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .stat-card p {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .stat-card .stat-icon {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            font-size: 1.5rem;
            opacity: 0.2;
        }
        
        /* Tables */
        .table-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            transition: var(--transition);
        }
        
        .table-container:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .table-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .search-box {
            padding: 0.5rem 1rem;
            border: 1px solid var(--gray-light);
            border-radius: 0.5rem;
            width: 250px;
            font-size: 0.875rem;
            transition: var(--transition);
        }
        
        .search-box:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }
        
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-light);
            font-size: 0.875rem;
        }
        
        th {
            background-color: var(--gray-light);
            font-weight: 600;
            color: var(--dark);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        
        tr:hover {
            background-color: var(--gray-light);
        }
        
        .status {
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .status i {
            font-size: 0.6rem;
        }
        
        .status.pending {
            background-color: var(--warning-light);
            color: var(--warning);
        }
        
        .status.verified {
            background-color: var(--success-light);
            color: var(--success);
        }
        
        .status.rejected {
            background-color: var(--danger-light);
            color: var(--danger);
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition);
            margin-right: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .view-btn {
            background-color: var(--primary);
            color: white;
        }
        
        .approve-btn {
            background-color: var(--success);
            color: white;
        }
        
        .reject-btn {
            background-color: var(--danger);
            color: white;
        }
        
        .refer-btn {
            background-color: var(--warning);
            color: white;
        }
        
        .action-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
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
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.3s ease;
        }
        
        @keyframes slideUp {
            from { 
                transform: translateY(20px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-light);
        }
        
        .modal-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .close-btn {
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
            transition: var(--transition);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        
        .close-btn:hover {
            background-color: var(--gray-light);
            color: var(--danger);
        }
        
        /* Profile Sections */
        .profile-section {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .profile-photo {
            width: 160px;
            height: 160px;
            border-radius: 0.75rem;
            object-fit: cover;
            background-color: var(--gray-light);
            box-shadow: var(--card-shadow);
        }
        
        .company-logo {
            width: 160px;
            height: 160px;
            border-radius: 0.75rem;
            object-fit: contain;
            background-color: white;
            padding: 1rem;
            border: 1px solid var(--gray-light);
            box-shadow: var(--card-shadow);
        }
        
        .profile-info h3 {
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .profile-info p {
            margin-bottom: 0.75rem;
            color: var(--dark-light);
        }
        
        .details-section {
            margin-top: 1.5rem;
        }
        
        .detail-row {
            display: grid;
            grid-template-columns: 140px 1fr;
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
        }
        
        .detail-label {
            font-weight: 500;
            color: var(--dark);
        }
        
        .document-thumbnail {
            width: 120px;
            height: 160px;
            border: 1px solid var(--gray-light);
            margin-right: 1rem;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
            border-radius: 0.5rem;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .document-thumbnail:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow);
            border-color: var(--primary);
        }
        
        .document-thumbnail i {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
        }
        
        .document-thumbnail .fa-file-pdf {
            color: var(--danger);
        }
        
        .document-thumbnail .fa-file-image {
            color: var(--primary);
        }
        
        .document-thumbnail .fa-file-contract {
            color: var(--success);
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--gray-light);
            margin-bottom: 1.5rem;
        }
        
        .tab {
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray);
            transition: var(--transition);
        }
        
        .tab:hover {
            color: var(--dark);
        }
        
        .tab.active {
            border-bottom: 3px solid var(--primary);
            font-weight: 600;
            color: var(--primary);
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Buttons Container */
        .buttons-container {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-light);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #3b50d4;
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background-color: white;
            color: var(--dark);
            border: 1px solid var(--gray-light);
        }
        
        .btn-secondary:hover {
            background-color: var(--gray-light);
            transform: translateY(-1px);
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
            border: none;
        }
        
        .btn-danger:hover {
            background-color: #d91a2e;
            transform: translateY(-1px);
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1.25rem;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .search-box {
                width: 100%;
                margin-top: 1rem;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .company-logo, .profile-photo {
                margin: 0 auto;
            }
            
            .modal-content {
                width: 95%;
                padding: 1.5rem;
            }
        }
    </style>
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
                <div class="stat-card">
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
            document.getElementById('verificationDate').innerHTML = employer.status === 'verified' 
                ? `Verified on: <strong>${employer.verificationDate}</strong>` 
                : `Registered on: <strong>${employer.verificationDate}</strong>`;
            
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
    <script>
    setTimeout(function() {
        location.reload();
    }, 5000);
    </script>
</body>
</html>