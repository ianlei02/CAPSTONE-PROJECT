<?php
require_once '../../auth/functions/check_login.php';
require_once '../Functions/getinfo.php';
require_once '../Functions/getName.php';
?>

<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Applicant Dashboard</title>
    <script src="../js/load-saved.js"></script>
    <link rel="stylesheet" href="../css/navs.css">
    <link rel="stylesheet" href="../css/account-settings.css" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <div class="left-pos" style="display: flex; width: auto; height: auto">
                <button class="hamburger">☰</button>
                <h1>Account Settings</h1>
            </div>

            <div class="right-pos">
                <div class="profile">
                    <img
                        src="<?php echo htmlspecialchars($profile_picture_url); ?>"
                        alt="Profile Picture"
                        class="profile-pic"
                        id="profilePicc" style="width: 50px !important;" />
                    <div class="user-name">
                        <h4><?= $fullName ?></h4>
                        <p>Applicant</p>
                    </div>
                </div>

                <div class="dropdown-menu" id="dropdownMenu">
                    <div class="dropdown-arrow"></div>
                    <div class="dropdown-header">
                        <img src="<?php echo htmlspecialchars($profile_picture_url); ?>" alt="Profile Picture">
                        <a class="user-info" href="./applicant-profile.php">
                            <h3><?= $fullName ?></h3>
                            <p>See your profile</p>
                        </a>
                    </div>

                    <div class="dropdown-links">
                        <a href="./account-settings.php" class="dropdown-item">
                            <span class="material-symbols-outlined">settings</span>
                            <span>Account Settings</span>
                        </a>
                        <a onclick="toggleTheme()" class="dropdown-item">
                            <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
                            <span id="themeLabel">Dark Mode</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item logout-item">
                            <span class="material-symbols-outlined icon">logout</span>
                            <span>Log Out</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </nav>
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo">
                <img src="../../public/images/pesosmb.png" alt="" />
                <h3>PESO</h3>
            </div>
            <button class="hamburger"><span class="material-symbols-outlined">dock_to_right</span></button>
        </div>
        <div class="sidebar-options">
            <ul class="sidebar-menu">
                <li>
                    <a href="./applicant-dashboard.php">
                        <span class="material-symbols-outlined icon">dashboard</span>
                        <span class="label">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./applicant-applications.php">
                        <span class="material-symbols-outlined icon">work</span>
                        <span class="label">My Applications</span>
                    </a>
                </li>
                <li>
                    <a href="./applicant-job-search.php">
                        <span class="material-symbols-outlined icon">search</span>
                        <span class="label">Job Search</span>
                    </a>
                </li>
                <li>
                    <a href="./applicant-profile.php">
                        <span class="material-symbols-outlined icon">id_card</span>
                        <span class="label">My Profile</span>
                    </a>
                </li>
                <!-- <li>
          <button onclick="toggleTheme()" class="dark-mode-toggle">
            <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
            <span id="themeLabel">Dark Mode</span>
          </button>
        </li> -->
            </ul>
            <ul>
                <li>
                    <a href="../../auth/functions/logout.php" class="log-out-btn">
                        <span class="material-symbols-outlined icon">logout</span>
                        <span class="label">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content">
        <form action="">
            <div id="password" class="form-content">
                <h2>Change Password</h2>
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <div class="input-group">
                        <input type="password" id="current-password">
                        <span class="password-toggle" data-target="current-password">Show</span>
                    </div>
                    <div class="error-message" id="current-password-error"></div>
                </div>

                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <div class="input-group">
                        <input type="password" id="new-password">
                        <span class="password-toggle" data-target="new-password">Show</span>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar" id="password-strength-bar"></div>
                    </div>
                    <div class="strength-text" id="password-strength-text">Enter a new password</div>
                    <div class="error-message" id="new-password-error"></div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" id="confirm-password">
                        <span class="password-toggle" data-target="confirm-password">Show</span>
                    </div>
                    <div class="password-match" id="password-match"></div>
                </div>

                <div class="requirements">
                    <h4>Password Requirements:</h4>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Contains at least one uppercase letter</li>
                        <li>Contains at least one lowercase letter</li>
                        <li>Contains at least one number</li>
                        <!-- <li>Contains at least one special character</li> -->
                    </ul>
                </div>

                <div class="form-actions">
                    <button class="btn btn-secondary" id="cancel-password">Cancel</button>
                    <button class="btn btn-primary" id="update-password">Update Password</button>
                </div>

                <div class="success-message" id="password-success">
                    <i>✓</i> Your password has been updated successfully!
                </div>
            </div>
        </form>


    </main>
    <!-- <button class="floating-icon">
    <span class="material-symbols-outlined">dark_mode</span>
  </button> -->

    <script src="../js/responsive.js"></script>
    <script src="../js/drop-down.js"></script>
    <script src="../js/dark-mode.js"></script>
    <script>
        const passwordToggles = document.querySelectorAll('.password-toggle');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.textContent = 'Hide';
                } else {
                    passwordInput.type = 'password';
                    this.textContent = 'Show';
                }
            });
        });
        const newPasswordInput = document.getElementById('new-password');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');

        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);

            strengthBar.style.width = strength.percentage + '%';
            strengthBar.style.background = strength.color;
            strengthText.textContent = strength.text;
            strengthText.style.color = strength.color;
        });

        // Password Confirmation Check
        const confirmPasswordInput = document.getElementById('confirm-password');
        const passwordMatch = document.getElementById('password-match');

        confirmPasswordInput.addEventListener('input', function() {
            const newPassword = newPasswordInput.value;
            const confirmPassword = this.value;

            if (confirmPassword === '') {
                passwordMatch.textContent = '';
                passwordMatch.style.color = '';
            } else if (newPassword === confirmPassword) {
                passwordMatch.textContent = '✓ Passwords match';
                passwordMatch.style.color = 'var(--success)';
            } else {
                passwordMatch.textContent = '✗ Passwords do not match';
                passwordMatch.style.color = 'var(--danger)';
            }
        });

        // Utility Functions
        function checkPasswordStrength(password) {
            let score = 0;

            // Length check
            if (password.length >= 8) score++;
            if (password.length >= 12) score++;

            // Character variety checks
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/\d/.test(password)) score++;
            if (/[^a-zA-Z\d]/.test(password)) score++;

            const strengthLevels = [{
                    percentage: 20,
                    color: 'var(--error)',
                    text: 'Very Weak'
                },
                {
                    percentage: 40,
                    color: 'var(--warning)',
                    text: 'Weak'
                },
                {
                    percentage: 60,
                    color: '#ffc107',
                    text: 'Fair'
                },
                {
                    percentage: 80,
                    color: '#8bc34a',
                    text: 'Good'
                },
                {
                    percentage: 100,
                    color: 'var(--success)',
                    text: 'Strong'
                }
            ];

            const level = Math.min(score, strengthLevels.length - 1);
            return strengthLevels[level];
        }

        function isStrongPassword(password) {
            const hasMinLength = password.length >= 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasSpecialChar = /[^a-zA-Z\d]/.test(password);

            return hasMinLength && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChar;
        }
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const updateBtn = document.getElementById("update-password");
        const currentInput = document.getElementById("current-password");
        const newInput = document.getElementById("new-password");
        const confirmInput = document.getElementById("confirm-password");
        const successMsg = document.getElementById("password-success");
        const currentError = document.getElementById("current-password-error");
        const newError = document.getElementById("new-password-error");

        updateBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            currentError.textContent = "";
            newError.textContent = "";
            successMsg.style.display = "none";

            const currentPassword = currentInput.value.trim();
            const newPassword = newInput.value.trim();
            const confirmPassword = confirmInput.value.trim();

            if (!currentPassword || !newPassword || !confirmPassword) {
                newError.textContent = "All fields are required.";
                return;
            }

            if (newPassword !== confirmPassword) {
                newError.textContent = "New passwords do not match.";
                return;
            }

            try {
                const response = await fetch("../Functions/update-pass.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({
                        currentPassword: currentPassword,
                        newPassword: newPassword
                    })
                });

                const result = await response.json();

                if (result.status === "success") {
                    successMsg.style.display = "block";
                    successMsg.textContent = "✓ " + result.message;
                    currentInput.value = "";
                    newInput.value = "";
                    confirmInput.value = "";
                } else {
                    currentError.textContent = result.message;
                }
            } catch (err) {
                newError.textContent = "An error occurred. Please try again.";
                console.error(err);
            }
        });
    });
    </script>

</body>

</html>