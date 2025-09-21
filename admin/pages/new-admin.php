<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>News Section</title>
    <script src="../js/dark-mode.js"></script>
    <link rel="stylesheet" href="../css/navs.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
                <a class="nav-item active" href="./new-admin.php">
                    <span class="material-symbols-outlined">groups</span>
                    <span>New Admin</span>
                </a>
            </li>
            <li>
                <a class="nav-item " href="./news-upload.php">
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

      
    </div>

</body>

</html>