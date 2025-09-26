<?php
require_once "../../connection/dbcon.php";

function calculateApplicantScore($applicant_id, $job_id, $conn) {
    $score = 0;

    // 1. Education
    $edu = $conn->query("SELECT * FROM applicant_educ WHERE applicant_id = $applicant_id")->fetch_assoc();
    if (!empty($edu['grad_studies_course'])) {
        $score += 30;
    } elseif (!empty($edu['tertiary_course'])) {
        $score += 20;
    } elseif (!empty($edu['senior_high_strand'])) {
        $score += 10;
    }

    // 2. Work Experience & Eligibility
    $exp_res = $conn->query("SELECT * FROM applicant_eligibility_exp WHERE applicant_id = $applicant_id");
    while ($row = $exp_res->fetch_assoc()) {
        if (!empty($row['eligibility'])) $score += 10;
        if (!empty($row['license']) && $row['license_valid'] >= date('Y-m-d')) $score += 15;

        if (!empty($row['months_worked'])) {
            $years = intval($row['months_worked'] / 12);
            $score += ($years * 5);
        }
    }

    // 3. Skills vs Job Category/Description
    $job = $conn->query("SELECT category, description FROM job_postings WHERE job_id = $job_id")->fetch_assoc();
    $skills_res = $conn->query("SELECT skill FROM applicant_skills WHERE applicant_id = $applicant_id");
    while ($s = $skills_res->fetch_assoc()) {
        if (stripos($job['category'], $s['skill']) !== false || stripos($job['description'], $s['skill']) !== false) {
            $score += 10;
        }
    }

    // 4. Documents
    $docs_res = $conn->query("SELECT document_type FROM applicant_documents WHERE applicant_id = $applicant_id");
    while ($doc = $docs_res->fetch_assoc()) {
        if (strtolower($doc['document_type']) === "resume" || strtolower($doc['document_type']) === "cv") {
            $score += 15;
        } else {
            $score += 5;
        }
    }

    return $score;
}
?>
