<?php
require_once '../Function/check_login.php';
require_once '../Function/check-permission.php';
?>
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

            <?php if (hasPermission('Pending Employers') || hasPermission('Verified Employers')): ?>
            <li>
                <a class="nav-item" href="./employer-table.php">
                <span class="material-symbols-outlined">apartment</span>
                <span>Employers</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (hasPermission('View job cards & applicants table')): ?>
            <li>
                <a class="nav-item" href="./job-listings.php">
                <span class="material-symbols-outlined">list_alt</span>
                <span>Job Listings</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (in_array('ALL_ACCESS', $_SESSION['admin_roles'])): ?>
            <li>
                <a class="nav-item" href="./new-admin.php">
                <span class="material-symbols-outlined">groups</span>
                <span>New Admin</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (
            hasPermission('Edit News') ||
            hasPermission('Delete News') ||
            hasPermission('Publish News')
            ): ?>
            <li>
                <a class="nav-item" href="./news-upload.php">
                <span class="material-symbols-outlined">newspaper</span>
                <span>News</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (hasPermission('Set Events') || hasPermission('ALL_ACCESS')): ?>
            <li>
                <a class="nav-item" href="./job-fair.php">
                <span class="material-symbols-outlined">calendar_month</span>
                <span>Job Fair</span>
                </a>
            </li>
            <?php endif; ?>

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
                            <div class="checkbox-item" style="display: none;">
                                <input type="checkbox" id="perm4">
                                <label for="perm4">View applicant profile modal</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="perm5">
                                <label for="perm5">Set Events</label>
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
                                <label for="perm8">Publish News</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-save"><span class="material-symbols-outlined">save</span> Save Admin</button>
                <button class="btn btn-danger close-btn"><span class="material-symbols-outlined">cancel</span> Cancel</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
    <script src="../assets/library/datatable/dataTables.js"></script>
    <script src="../js/table-init.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal elements
        const modal = document.getElementById('addAdminModal');
        const addBtn = document.getElementById('addAdminBtn');
        const closeBtns = document.querySelectorAll('.close, .close-btn');
        const saveBtn = modal.querySelector('.btn-save');
        const form = document.getElementById('adminForm');

        // Open modal
        addBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        // Close modal
        closeBtns.forEach(btn => btn.addEventListener('click', () => modal.style.display = 'none'));
        window.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });

        saveBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            const name = document.getElementById('adminName').value.trim();
            const username = document.getElementById('adminUsername').value.trim();
            const email = document.getElementById('adminEmail').value.trim();
            const password = document.getElementById('adminPassword').value.trim();

            const permissions = [];
            document.querySelectorAll('.checkbox-item input[type="checkbox"]:checked').forEach(cb => {
                permissions.push(cb.nextElementSibling.textContent.trim());
            });

            if (!name || !username || !email || !password) {
                alert("Please fill out all fields.");
                return;
            }

            try {
                const res = await fetch('../Function/add-admin.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, username, email, password, permissions })
                });
                
                const data = await res.json();
                console.log(data);

                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Admin Added!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1800
                    }).then(() => {
                        form.reset();
                        modal.style.display = 'none';
                        location.reload(); 
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: data.message || 'Something went wrong while adding the admin.'
                    });
                }
            } catch (err) {
                console.error('Error:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while saving the admin.'
                });
            }
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.querySelector('#adminTable tbody');

        async function loadAdmins() {
            const res = await fetch('../Function/getAdmins.php');
            const data = await res.json();

            tableBody.innerHTML = '';

            data.forEach(admin => {
                const permissions = JSON.parse(admin.role).join(', '); 

                const statusBadge = admin.status === 'Active'
                    ? `<span class="badge badge-success">Active</span>`
                    : `<span class="badge badge-danger">Disabled</span>`;

                const toggleBtn = admin.status === 'Active'
                    ? `<button class="btn btn-sm btn-warning toggle-status" data-id="${admin.admin_ID}" data-status="Disabled">
                            <span class="material-symbols-outlined">block</span>
                    </button>`
                    : `<button class="btn btn-sm btn-success toggle-status" data-id="${admin.admin_ID}" data-status="Active">
                            <span class="material-symbols-outlined">check_circle</span>
                    </button>`;

                const row = `
                    <tr data-id="${admin.admin_ID}">
                        <td class="editable-cell">${admin.fullname}</td>
                        <td class="editable-cell">${admin.username}</td>
                        <td class="editable-cell">${admin.email}</td>
                        <td class="editable-cell">${permissions}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-btn">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            ${toggleBtn}
                            <button class="btn btn-sm btn-danger delete-btn">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });

            attachRowListeners(); 
        }

        function attachRowListeners() {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const row = this.closest('tr');
                    const id = row.dataset.id;

                    if (row.classList.contains('editing')) {

                        const inputs = row.querySelectorAll('input');
                        const [fullname, username, email, permissions] = [...inputs].map(i => i.value.trim());

                        const res = await fetch('../Function/manage-admin.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ 
                                action: 'update_admin', 
                                id, 
                                fullname, 
                                username, 
                                email, 
                                permissions 
                            })
                        });
                        const data = await res.json();

                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadAdmins();
                        } else {
                            Swal.fire({ icon: 'error', title: 'Failed', text: data.message });
                        }
                    } else {
    
                        const cells = row.querySelectorAll('.editable-cell');
                        cells.forEach(cell => {
                            const val = cell.textContent;
                            cell.innerHTML = `<input type="text" value="${val}" />`;
                        });
                        row.classList.add('editing');
                        this.innerHTML = '<span class="material-symbols-outlined">save</span>';
                    }
                });
            });

            document.querySelectorAll('.toggle-status').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const id = this.dataset.id;
                    const newStatus = this.dataset.status;

                    const res = await fetch('../Function/manage-admin.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action: 'update_status', id, status: newStatus })
                    });
                    const data = await res.json();

                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Changed',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        loadAdmins();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Failed', text: data.message });
                    }
                });
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const id = this.closest('tr').dataset.id;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will permanently delete the admin!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            const res = await fetch('../Function/manage-admin.php', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ action: 'delete', id })
                            });
                            const data = await res.json();

                            if (data.status === 'success') {
                                Swal.fire('Deleted!', data.message, 'success');
                                loadAdmins();
                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }
                        }
                    });
                });
            });
        }

        loadAdmins();
    });
    </script>


</body>

</html>