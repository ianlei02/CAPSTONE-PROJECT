<?php
require_once "../../connection/dbcon.php";

if (!isset($_GET['applicant_id'])) {
    echo "No applicant selected.";
    exit;
}

$applicant_id = intval($_GET['applicant_id']);


$account = $conn->query("
    SELECT a.f_name, a.l_name, p.middle_name, p.suffix, a.email, a.date_created
    FROM applicant_account a
    LEFT JOIN applicant_profile p ON a.applicant_id = p.applicant_id
    WHERE a.applicant_id = $applicant_id
")->fetch_assoc();

$fullname = trim(
    $account['f_name'] . " " .
    ($account['middle_name'] && $account['middle_name'] !== "N/A" ? $account['middle_name'] . " " : "") .
    $account['l_name'] .
    ($account['suffix'] && $account['suffix'] !== "N/A" ? ", " . $account['suffix'] : "")
);


$edu = $conn->query("SELECT * FROM applicant_educ WHERE applicant_id = $applicant_id")->fetch_assoc();


$skills = [];
$res = $conn->query("SELECT skill FROM applicant_skills WHERE applicant_id = $applicant_id");
while ($row = $res->fetch_assoc()) {
    $skills[] = $row['skill'];
}
?>
<h3><?= htmlspecialchars($fullname); ?></h3>
<p><strong>Email:</strong> <?= htmlspecialchars($account['email']); ?></p>
<p><strong>Account Created:</strong> <?= $account['date_created']; ?></p>

<h4>Education</h4>
<p>Tertiary: <?= $edu['tertiary_course'] ?? 'N/A'; ?> (<?= $edu['tertiary_year'] ?? ''; ?>)</p>

<h4>Skills</h4>
<p><?= implode(", ", $skills) ?: "No skills listed"; ?></p>
