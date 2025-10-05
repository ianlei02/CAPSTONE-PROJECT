<?php   
require "../../connection/dbcon.php";
session_start();

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

$applicant_id = $_SESSION['user_id'] ?? 0;
if (!$applicant_id) {
    echo json_encode(['count' => 0, 'notifications' => []]);
    exit;
}

$stmt = $conn->prepare("
    SELECT id, message, seen, created_at 
    FROM notifications 
    WHERE applicant_id = ? 
    ORDER BY created_at DESC LIMIT 10
");
$stmt->bind_param("i", $applicant_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}
$countStmt = $conn->prepare("SELECT COUNT(*) AS unread_count FROM notifications WHERE applicant_id = ? AND seen = 0");
$countStmt->bind_param("i", $applicant_id);
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$unreadCount = $countResult['unread_count'] ?? 0;

echo json_encode([
    'count' => $unreadCount,
    'notifications' => $notifications
]);