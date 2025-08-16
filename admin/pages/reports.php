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
    <link rel="stylesheet" href="../css/reports.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="dashboard">
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
                <a class="nav-item " href="dashboard.php">
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
                <a class="nav-item active" href="reports.php">
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
            <!-- Header -->
            <div class="header">
                <h1>Admin Dashboard</h1>
                <div style="display: flex; align-items: center; gap: 20px;">
                    
                    <div class="user-profile">
                        <img
                            src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff"
                            alt="Admin User" />
                        <span>Admin User</span>
                        <!-- <i class="fas fa-chevron-down"></i> -->
                    </div>
                </div>
            </div>

            <div class="reports-grid">
                <!-- Age Distribution Report -->
                <div class="report-card">
                    <div class="report-header">
                        <h3><i class="fas fa-user-clock"></i> Age Distribution</h3>
                        <select class="report-filter">
                            <option>All Time</option>
                            <option>Last Year</option>
                            <option>Last Quarter</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>

                <!-- Gender Distribution Report -->
                <div class="report-card">
                    <div class="report-header">
                        <h3><i class="fas fa-venus-mars"></i> Gender Ratio</h3>
                        <select class="report-filter">
                            <option>All Time</option>
                            <option>Last Year</option>
                            <option>Last Quarter</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>

                <!-- Monthly Trends Report -->
                <div class="report-card">
                    <div class="report-header">
                        <h3><i class="fas fa-chart-line"></i> Monthly Applicants</h3>
                        <select class="report-filter">
                            <option>2023</option>
                            <option>2022</option>
                            <option>2021</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
 <script>
        // Dark mode toggle
        let darkMode = false;
        // Chart color management
        function getChartColors() {
            return {
                background: darkMode ? '#1f2937' : '#ffffff',
                text: darkMode ? '#f9fafb' : '#1f2937',
                gridLines: darkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                ageColors: ['#3b82f6', '#10b981', '#f59e0b'],
                genderColors: ['#3b82f6', '#ec4899']
            };
        }

        // Initialize charts
        let ageChart, genderChart, monthlyChart;

        document.addEventListener('DOMContentLoaded', function() {
            const colors = getChartColors();
            
            // Age Chart
            ageChart = new Chart(document.getElementById('ageChart'), {
                type: 'doughnut',
                data: {
                    labels: ['18-24', '25-59', '60+'],
                    datasets: [{
                        data: [35, 120, 15],
                        backgroundColor: colors.ageColors
                    }]
                },
                options: getChartOptions('Age Distribution', colors)
            });

            // Gender Chart 
            genderChart = new Chart(document.getElementById('genderChart'), {
                type: 'bar',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        label: 'Applicants',
                        data: [85, 65],
                        backgroundColor: colors.genderColors
                    }]
                },
                options: getChartOptions('Gender Ratio', colors)
            });

            // Monthly Chart
            monthlyChart = new Chart(document.getElementById('monthlyChart'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Applicants',
                        data: [45, 60, 75, 55, 80, 95, 110, 85, 90, 78, 82, 65],
                        borderColor: colors.ageColors[0],
                        tension: 0.3,
                        fill: true,
                        backgroundColor: darkMode ? 'rgba(59, 130, 246, 0.2)' : 'rgba(59, 130, 246, 0.1)'
                    }]
                },
                options: getChartOptions('Monthly Applicants', colors)
            });
        });

        function getChartOptions(title, colors) {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { 
                            color: colors.text,
                            font: { size: 12 }
                        }
                    },
                    title: {
                        display: true,
                        text: title,
                        color: colors.text,
                        font: { size: 16 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: colors.gridLines
                        },
                        ticks: {
                            color: colors.text
                        }
                    },
                    x: {
                        grid: {
                            color: colors.gridLines
                        },
                        ticks: {
                            color: colors.text
                        }
                    }
                }
            };
        }

        function updateChartColors() {
            const colors = getChartColors();
            
            // Age Chart
            ageChart.options.plugins.title.color = colors.text;
            ageChart.options.scales.x.ticks.color = colors.text;
            ageChart.options.scales.y.ticks.color = colors.text;
            ageChart.options.scales.x.grid.color = colors.gridLines;
            ageChart.options.scales.y.grid.color = colors.gridLines;
            ageChart.data.datasets[0].backgroundColor = colors.ageColors;
            ageChart.update();
            
            // Gender Chart
            genderChart.options.plugins.title.color = colors.text;
            genderChart.options.scales.x.ticks.color = colors.text;
            genderChart.options.scales.y.ticks.color = colors.text;
            genderChart.options.scales.x.grid.color = colors.gridLines;
            genderChart.options.scales.y.grid.color = colors.gridLines;
            genderChart.data.datasets[0].backgroundColor = colors.genderColors;
            genderChart.update();
            
            // Monthly Chart
            monthlyChart.options.plugins.title.color = colors.text;
            monthlyChart.options.scales.x.ticks.color = colors.text;
            monthlyChart.options.scales.y.ticks.color = colors.text;
            monthlyChart.options.scales.x.grid.color = colors.gridLines;
            monthlyChart.options.scales.y.grid.color = colors.gridLines;
            monthlyChart.data.datasets[0].borderColor = colors.ageColors[0];
            monthlyChart.data.datasets[0].backgroundColor = darkMode ? 'rgba(59, 130, 246, 0.2)' : 'rgba(59, 130, 246, 0.1)';
            monthlyChart.update();
        }
    </script>
 <!-- <script>
            // Sample data - replace with your actual data
            const ageData = {
                labels: ['18-24', '25-59', '60+'],
                datasets: [{
                    data: [35, 120, 15],
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                    borderWidth: 0
                }]
            };

            const genderData = {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [85, 65],
                    backgroundColor: ['#3b82f6', '#ec4899'],
                    borderWidth: 0
                }]
            };

            const monthlyData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Applicants',
                    data: [45, 60, 75, 55, 80, 95, 110, 85, 90, 78, 82, 65],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                }]
            };

            // Initialize charts
            document.addEventListener('DOMContentLoaded', function() {
                // Age Chart (Doughnut)
                new Chart(
                    document.getElementById('ageChart'), {
                        type: 'doughnut',
                        data: ageData,
                        options: {
                            cutout: '70%',
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const value = context.raw;
                                            const percentage = Math.round((value / total) * 100);
                                            return `${context.label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    }
                );

                // Gender Chart (Bar)
                new Chart(
                    document.getElementById('genderChart'), {
                        type: 'bar',
                        data: genderData,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: false
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const value = context.raw;
                                            const percentage = Math.round((value / total) * 100);
                                            return `${context.label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    }
                );

                // Monthly Chart (Line)
                new Chart(
                    document.getElementById('monthlyChart'), {
                        type: 'line',
                        data: monthlyData,
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: true
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    }
                );

                // Update timestamp
                document.getElementById('updateTime').textContent = new Date().toLocaleString();
            });
        </script> -->

</body>

</html>