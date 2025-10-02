<?php
require "../../connection/dbcon.php";

$applicantSql = "SELECT sex, COUNT(*) as count FROM applicant_profile GROUP BY sex";
$applicantResult = $conn->query($applicantSql);

$applicants = ["Male" => 0, "Female" => 0];
while ($row = $applicantResult->fetch_assoc()) {
    $applicants[$row['sex']] = (int)$row['count'];
}

$total = [
    "Male" => $applicants["Male"],
    "Female" => $applicants["Female"]
];
header("Content-Type: application/json");
echo json_encode($total);