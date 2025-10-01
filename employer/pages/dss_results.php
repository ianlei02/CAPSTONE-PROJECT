<?php
require_once "../../connection/dbcon.php";
require_once "../Functions/dss.php";

$job_id = $_GET['job_id']; 
$applicants = [];

$sql = "SELECT * FROM job_application WHERE job_id = $job_id";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $applicant_id = $row['applicant_id'];
    $score = calculateApplicantScore($applicant_id, $job_id, $conn);


$profile = $conn->query("
    SELECT a.f_name, a.l_name, p.middle_name, p.suffix
    FROM applicant_account a
    LEFT JOIN applicant_profile p ON a.applicant_id = p.applicant_id
    WHERE a.applicant_id = $applicant_id
")->fetch_assoc();

$fullname = trim(
    $profile['f_name'] . " " .
    ($profile['middle_name'] && $profile['middle_name'] !== "N/A" ? $profile['middle_name'] . " " : "") .
    $profile['l_name'] .
    ($profile['suffix'] && $profile['suffix'] !== "N/A" ? ", " . $profile['suffix'] : "")
);


   $applicants[] = [
    'id' => $applicant_id,
    'name' => $fullname,
    'score' => $score
];

}

usort($applicants, function($a, $b) {
    return $b['score'] - $a['score'];
});
?>

<!DOCTYPE html>
<html>
<head>
    <title>DSS Results</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Decision Support Results</h2>
    <table border="1" cellpadding="10">
    <tr>
        <th>Rank</th>
        <th>Applicant</th>
        <th>Total Score (%)</th>
        <th>Action</th>
    </tr>
    <?php 
    $rank = 1;
    foreach ($applicants as $a): ?>
        <tr>
            <td><?= $rank++; ?></td>
            <td><?= htmlspecialchars($a['name']); ?></td>
            <td><?= $a['score']; ?>%</td>
            <td>
                <button class="view-profile-btn" data-id="<?= $a['id']; ?>" 
                        style="padding:5px 10px; background:#007bff; color:#fff; border:none; border-radius:5px; cursor:pointer;">
                    View Profile
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("profileModal");
    const closeModal = document.getElementById("closeModal");
    const profileContent = document.getElementById("profileContent");

    document.querySelectorAll(".view-profile-btn").forEach(btn => {
        btn.addEventListener("click", function () {
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

    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    exitBtn.addEventListener("click", function () {
        window.location.href = "employer-post.php";
    });
});
</script>
</body>
</html>
