<?php
require_once "../../connection/dbcon.php";
header('Content-Type: application/json');

try {
     $sql = "SELECT date_of_birth FROM applicant_profile WHERE date_of_birth IS NOT NULL";
    $result = $conn->query($sql);

    $ageGroups = [
        "18-24" => 0,
        "25-59" => 0,
        "60+" => 0,
    ];

    $today = new DateTime();

    while ($row = $result->fetch_assoc()) {
        $dob = $row['date_of_birth'];

         if (empty($dob) || $dob === '0000-00-00') continue;

        $birthDate = new DateTime($dob);
        $age = $birthDate->diff($today)->y;

        if ($age >= 18 && $age <= 24) {
            $ageGroups["18-24"]++;
        } elseif ($age >= 25 && $age <= 59) {
            $ageGroups["25-59"]++;
        } elseif ($age >= 60) {
            $ageGroups["60+"]++;
        }
    }

    echo json_encode($ageGroups);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}