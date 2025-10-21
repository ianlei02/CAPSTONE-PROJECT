<?php
require_once '../../connection/dbcon.php';
header('Content-Type: application/json');

$sql = "SELECT admin_ID, fullname, username, email, role, status FROM admin_account WHERE admin_ID != 1";
$result = $conn->query($sql);

$admins = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}

echo json_encode($admins);
$conn->close();
?>
