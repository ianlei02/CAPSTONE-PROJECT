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
            <th>Score</th>
        </tr>
        <?php 
        $rank = 1;
        foreach ($applicants as $a): ?>
            <tr>
                <td><?= $rank++; ?></td>
                <td><?= htmlspecialchars($a['name']); ?></td>
                <td><?= $a['score']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
