<?php
header('Content-Type: application/json');
require_once '../../connection/dbcon.php';
error_reporting(0);

date_default_timezone_set('Asia/Manila');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $sql = "SELECT id, title, start, end, type, description FROM calendar_event";
    $result = $conn->query($sql);
    $events = [];

    while ($row = $result->fetch_assoc()) {
        $events[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $row['start'], 
            'end' => $row['end'],
            'type' => $row['type'],
            'description' => $row['description'] ?? ''
        ];
    }

    echo json_encode($events);
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';

    function toLocalDateTime($datetimeStr) {
        if (!$datetimeStr) return null;
        $dt = new DateTime($datetimeStr);
        // Ensure saved as local Manila time
        $dt->setTimezone(new DateTimeZone('Asia/Manila'));
        return $dt->format('Y-m-d H:i:s');
    }

    if ($action === 'add') {
        $title = $conn->real_escape_string($data['title']);
        $start = toLocalDateTime($data['start']);
        $end = toLocalDateTime($data['end']);
        $type = $conn->real_escape_string($data['type']);
        $description = $conn->real_escape_string($data['description'] ?? '');

        $sql = "INSERT INTO calendar_event (title, start, end, type, description)
                VALUES ('$title', '$start', '$end', '$type', '$description')";

        echo $conn->query($sql)
            ? json_encode(['status' => 'success'])
            : json_encode(['status' => 'error', 'message' => 'DB insert failed']);
        exit;
    }

    if ($action === 'delete') {
        $id = intval($data['id']);
        $sql = "DELETE FROM calendar_event WHERE id = $id";
        echo $conn->query($sql)
            ? json_encode(['status' => 'deleted'])
            : json_encode(['status' => 'error', 'message' => 'DB delete failed']);
        exit;
    }

    if ($action === 'update') {
        $id = intval($data['id']);
        $title = $conn->real_escape_string($data['title']);

        $sql = "UPDATE calendar_event SET title='$title' WHERE id=$id";
        echo $conn->query($sql)
            ? json_encode(['status' => 'updated'])
            : json_encode(['status' => 'error', 'message' => 'DB update failed']);
        exit;
    }

    if ($action === 'updateDescription') {
        $id = intval($data['id']);
        $description = $conn->real_escape_string($data['description'] ?? '');

        $sql = "UPDATE calendar_event SET description='$description' WHERE id=$id";
        echo $conn->query($sql)
            ? json_encode(['status' => 'updated'])
            : json_encode(['status' => 'error', 'message' => 'DB update failed']);
        exit;
    }

    if ($action === 'updateTime') {
        $id = intval($data['id']);
        $start = toLocalDateTime($data['start']);
        $end = toLocalDateTime($data['end']);

        $sql = "UPDATE calendar_event SET start='$start', end='$end' WHERE id=$id";
        echo $conn->query($sql)
            ? json_encode(['status' => 'updated'])
            : json_encode(['status' => 'error', 'message' => 'DB update failed']);
        exit;
    }

    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
exit;
?>
