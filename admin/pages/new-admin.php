<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Management</title>
    <script src="../js/load-saved.js"></script>
    <script src="../js/dark-mode.js"></script>
    <link rel="stylesheet" href="../css/navs.css">
    <link rel="stylesheet" href="../css/new-admin.css">
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
        <!-- Header -->
        <div class="header">
            <h1>Admin Management</h1>
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
        <!-- Admin Accounts Table -->
        <div class="card">
            <div class="card-header">
                <h2>Admin Accounts</h2>
                <button class="btn btn-primary" id="addAdminBtn">
                    <span class="material-symbols-outlined">add</span> Add Admin
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="adminTable">
                        <thead>
                            <tr>
                                <th>Admin Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Permissions</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="editable-cell">John Smith</td>
                                <td class="editable-cell">john.smith</td>
                                <td class="editable-cell">john.smith@company.com</td>
                                <td class="editable-cell">Employers Management, View Applications</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="btn btn-sm btn-warning">
                                        <span class="material-symbols-outlined">block</span>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="editable-cell">Sarah Johnson</td>
                                <td class="editable-cell">sarah.j</td>
                                <td class="editable-cell">sarah.j@company.com</td>
                                <td class="editable-cell">News Management, Verified Employers</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="btn btn-sm btn-warning">
                                        <span class="material-symbols-outlined">block</span>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="editable-cell">Michael Brown</td>
                                <td class="editable-cell">michael.b</td>
                                <td class="editable-cell">michael.b@company.com</td>
                                <td class="editable-cell">Pending Employers, View Applications</td>
                                <td><span class="badge badge-danger">Disabled</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="btn btn-sm btn-success">
                                        <span class="material-symbols-outlined">check_circle</span>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Add Admin Modal -->
    <div class="modal" id="addAdminModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Admin</h3>
                <button class="close"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div class="modal-body">
                <form id="adminForm">
                    <div class="form-group">
                        <label for="adminName">Full Name</label>
                        <input type="text" id="adminName" class="form-control" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label for="adminUsername">Username</label>
                        <input type="text" id="adminUsername" class="form-control" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="adminEmail">Email</label>
                        <input type="email" id="adminEmail" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="adminPassword">Password</label>
                        <input type="password" id="adminPassword" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label>Permissions</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm1">
                                <label for="perm1">Pending Employers</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm2">
                                <label for="perm2">Verified Employers</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm3">
                                <label for="perm3">View job cards & applicants table</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm4">
                                <label for="perm4">View applicant profile modal</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm5">
                                <label for="perm5">Upload News</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm6">
                                <label for="perm6">Edit News</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm7">
                                <label for="perm7">Delete News</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm8">
                                <label for="perm8">Archive News</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><span class="material-symbols-outlined">save</span> Save Admin</button>
                <button class="btn btn-danger close-btn"><span class="material-symbols-outlined">cancel</span> Cancel</button>
            </div>
        </div>
    </div>
    <script src="../assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
    <script src="../assets/library/datatable/dataTables.js"></script>
    <script src="../js/table-init.js"></script>
    <script>
        // Modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addAdminModal');
            const addBtn = document.getElementById('addAdminBtn');
            const closeBtns = document.querySelectorAll('.close, .close-btn');

            addBtn.addEventListener('click', function() {
                modal.style.display = 'flex';
            });

            closeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Edit/Save functionality for table rows
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const isEditing = row.classList.contains('editing');

                    if (isEditing) {
                        // Save changes
                        saveRowChanges(row);
                        this.innerHTML = '<span class="material-symbols-outlined">edit</span>';
                        row.classList.remove('editing');
                    } else {
                        // Enter edit mode
                        enableRowEditing(row);
                        this.innerHTML = '<span class="material-symbols-outlined">save</span>';
                        row.classList.add('editing');
                    }
                });
            });

            function enableRowEditing(row) {
                const editableCells = row.querySelectorAll('.editable-cell');

                editableCells.forEach(cell => {
                    const currentValue = cell.textContent;
                    cell.innerHTML = `<input type="text" value="${currentValue}">`;
                });
            }

            function saveRowChanges(row) {
                const editableCells = row.querySelectorAll('.editable-cell');

                editableCells.forEach(cell => {
                    const input = cell.querySelector('input');
                    cell.textContent = input.value;
                });
            }
        });
    </script>
</body>

</html>