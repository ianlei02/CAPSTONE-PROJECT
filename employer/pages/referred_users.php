<?php
require  '../../auth/functions/check_login.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login-signup.php");
    exit();
}

$employer_id = $_SESSION['user_id'];

$sql = "
    SELECT 
        ja.application_id,
        a.applicant_id,
        ja.job_id,
        CONCAT(a.f_name, ' ', a.l_name) AS applicant_name,
        j.job_title,
        ja.created_at AS date_referred,
        ja.status
    FROM job_application ja
    INNER JOIN applicant_account a ON ja.applicant_id = a.applicant_id
    INNER JOIN job_postings j ON ja.job_id = j.job_id
    WHERE ja.status = 'referred'
      AND j.employer_id = ?
    ORDER BY ja.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employer_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en" data-theme="light" data-state="expanded">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DSS Results</title>
    <script src="../js/load-saved.js"></script>
    <link rel="stylesheet" href="../css/navs.css">
    <link rel="stylesheet" href="../css/dss-results.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <div class="left-pos">
                <h1>
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Referred Applicants</span>
                </h1>
            </div>
            <div class="right-pos">
                <div class="profile">
                    <img
                        src="<?php echo htmlspecialchars($profile_picture_url); ?>"
                        alt="Profile Picture"
                        class="profile-pic"
                        id="profilePicc" style="width: 50px !important;" />
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
                    <a href="./employer-dashboard.php" class="active">
                        <span class="material-symbols-outlined icon">dashboard</span>
                        <span class="label">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./employer-post.php">
                        <span class="material-symbols-outlined icon">work</span>
                        <span class="label">Post Job</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="./employer-applications.php">
                        <span class="material-symbols-outlined icon">people</span>
                        <span class="label">Job Applications</span>
                    </a>
                </li> -->
                <li>
                    <a href="employer-profile.php">
                        <span class="material-symbols-outlined icon">id_card</span>
                        <span class="label">My Profile</span>
                    </a>
                </li>
                <li>
                    <button onclick="toggleTheme()" class="dark-mode-toggle">
                        <span class="material-symbols-outlined icon" id="themeIcon">dark_mode</span>
                        <span id="themeLabel">Dark Mode</span>
                    </button>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="../../auth/functions/logout.php" class='log-out-btn'>
                        <span class="material-symbols-outlined icon">logout</span>
                        <span class="label">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content">
        <h2><span class="material-symbols-outlined">how_to_reg</span> Referred Applicants</h2>
        <div class="table-container">
            
            <table id="referredTable" class="styled-table display">
                <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Job Title</th>
                        <th>Date Referred</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['applicant_name']); ?></td>
                                <td><?= htmlspecialchars($row['job_title']); ?></td>
                                <td><?= date("M d, Y", strtotime($row['date_referred'])); ?></td>
                                <td><span class="badge"><?= ucfirst($row['status']); ?></span></td>
                                <td>
                                    <button class="view-profile-btn" data-id="<?= $row['applicant_id']; ?>"
                                        style="padding:5px 10px; background:#007bff; color:#fff; border:none; border-radius:5px; cursor:pointer;">
                                        View Profile
                                    </button>
                                <!-- </td>
                                <td> -->
                                    <button
                                        type="button"
                                        class="btn btn-outline btn-sm action-btn reject"
                                        data-applicant-id="<?= $row['applicant_id']; ?>"
                                        data-job-id="<?= $row['job_id']; ?>"
                                        data-status="rejected">
                                        Reject
                                    </button>
        
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm action-btn interview"
                                        data-applicant-id="<?= $row['applicant_id']; ?>"
                                        data-job-id="<?= $row['job_id']; ?>"
                                        data-status="interview">
                                        Interview
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No referred applicants yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div id="profileModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
                background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
                <div style="background:#fff; padding:20px; width:600px; border-radius:10px; position:relative;">
                    <span id="closeModal" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">&times;</span>
                    <h2>Applicant Profile</h2>
                    <div id="profileContent">Loading...</div>
                    <div style="margin-top:20px; text-align:right;">
                        <button id="exitBtn"
                            style="padding:8px 15px; background:#dc3545; color:#fff; border:none; border-radius:5px; cursor:pointer;">
                            Exit
                        </button>
                    </div>
                </div>
            </div>
        </div>
       
    </main>

    <script src="../assets/JS_JQUERY/jquery-3.7.1.min.js"></script>
    <script src="../assets/library/datatable/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#referredTable').DataTable();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("profileModal");
            const closeModal = document.getElementById("closeModal");
            const profileContent = document.getElementById("profileContent");

            document.querySelectorAll(".view-profile-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const applicantId = this.getAttribute("data-id");
                    modal.style.display = "flex";
                    profileContent.innerHTML = "Loading...";
                    fetch("../Functions/get_profile.php?applicant_id=" + applicantId)
                        .then(res => res.text())
                        .then(data => {
                            profileContent.innerHTML = data;
                        })
                        .catch(err => {
                            profileContent.innerHTML = "Error loading profile.";
                        });
                });
            });

            closeModal.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            exitBtn.addEventListener("click", function() {
                window.location.href = "employer-post.php";
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".action-btn").forEach(button => {
                button.addEventListener("click", function() {
                    const applicantId = this.dataset.applicantId;
                    const jobId = this.dataset.jobId;
                    const status = this.dataset.status;

                    fetch("../../admin/Function/update-status.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `applicant_id=${applicantId}&job_id=${jobId}&status=${status}`
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                alert(`Applicant successfully ${status === 'interview' ? 'set for interview' : 'rejected'}.`);
                                location.reload();
                            } else {
                                alert("Error: " + (data.error || "Failed to update status"));
                            }
                        })
                        .catch(err => console.error(err));
                });
            });
        });
    </script>
</body>

</html>