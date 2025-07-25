<?php
// session_start();

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// header("Pragma: no-cache");

// if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
//     header("Location: ../pages/admin-login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Office Admin Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <!-- <i class="fas fa-briefcase"></i> -->
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
                <a class="nav-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
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
                <div class="user-profile">
                    <img
                        src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff"
                        alt="Admin User" />
                    <span>Admin User</span>
                    <!-- <i class="fas fa-chevron-down"></i> -->
                </div>
            </div>

            <!-- Reports Section -->
            <section class="reports-section" id="reports">
                <h2 style="margin-bottom: 1.5rem;">Reports Overview</h2>
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <h3>Total Applicants</h3>
                        <p>1,234</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-building"></i></div>
                        <h3>Total Employers</h3>
                        <p>456</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-list-alt"></i></div>
                        <h3>Jobs Posted</h3>
                        <p>789</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                        <h3>Hires</h3>
                        <p>312</p>
                    </div>
                </div>

                <div style="margin: 2rem 0; background: #fff; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 2rem;">
                    <h3 style="margin-bottom: 1rem;">Monthly Overview (Bar Chart)</h3>
                    <canvas id="barChart" height="80"></canvas>
                </div>

                <div style="margin: 2rem 0; background: #fff; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 2rem; display: flex; flex-direction: column; align-items: center; width: 100%; height: 60vh;">
                    <h3 style="margin-bottom: 1rem;">Applicants Distribution (Pie Chart)</h3>
                    <canvas id="pieChart" width="80" height="80" style="max-width: 50%;"></canvas>
                </div>

                <div style="margin: 2rem 0; background: #fff; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 2rem;">
                    <h3 style="margin-bottom: 1rem;">Applicants Growth (Line Chart)</h3>
                    <canvas id="lineChart" height="80"></canvas>
                </div>

                <div class="table-container" style="margin-top: 2rem;">
                    <div class="table-header">
                        <h2>Downloadable Reports</h2>
                        <div class="table-actions">
                            <input type="text" placeholder="Search reports..." />
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Report Name</th>
                                <th>Type</th>
                                <th>Date Generated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Monthly Applicants Report</td>
                                <td>Applicants</td>
                                <td>July 2025</td>
                                <td><button class="btn btn-primary"><i class="fas fa-download"></i> Download</button></td>
                            </tr>
                            <tr>
                                <td>Employer Activity Report</td>
                                <td>Employers</td>
                                <td>July 2025</td>
                                <td><button class="btn btn-primary"><i class="fas fa-download"></i> Download</button></td>
                            </tr>
                            <tr>
                                <td>Job Listings Summary</td>
                                <td>Jobs</td>
                                <td>July 2025</td>
                                <td><button class="btn btn-primary"><i class="fas fa-download"></i> Download</button></td>
                            </tr>
                            <tr>
                                <td>Hiring Statistics</td>
                                <td>Hires</td>
                                <td>July 2025</td>
                                <td><button class="btn btn-primary"><i class="fas fa-download"></i> Download</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Applicants', 'Employers', 'Jobs Posted', 'Hires'],
            datasets: [{
                label: 'July 2025',
                data: [1234, 456, 789, 312],
                backgroundColor: [
                    'rgba(99, 102, 241, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(59, 130, 246, 0.7)'
                ],
                borderRadius: 8,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 200
                    }
                }
            }
        }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['IT', 'Engineering', 'Healthcare', 'Finance', 'Education'],
            datasets: [{
                label: 'Applicants Distribution',
                data: [320, 210, 180, 150, 374],
                backgroundColor: [
                    'rgba(99, 102, 241, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(239, 68, 68, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Applicants Growth',
                data: [400, 520, 610, 700, 900, 1100, 1234],
                fill: false,
                borderColor: 'rgba(99, 102, 241, 1)',
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(99, 102, 241, 1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>