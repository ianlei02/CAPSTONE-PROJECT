<?php
$employerID = $_SESSION['user_id'] ?? 0;
$stmt = $conn->prepare("SELECT f_name, l_name FROM employer_account WHERE employer_ID = ?");
$stmt->bind_param("i", $employerID);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $fullName = $row['f_name'] . ' ' . $row['l_name'];
} else {
    echo "User not found.";
}

