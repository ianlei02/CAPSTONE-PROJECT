<?php
require "../../connection/dbcon.php";
session_start();

$applicant_id = $_SESSION['user_id'] ?? 0;
if ($applicant_id) {
    $stmt = $conn->prepare("UPDATE notifications SET seen = 1 WHERE applicant_id = ?");
    $stmt->bind_param("i", $applicant_id);
    $stmt->execute();
}