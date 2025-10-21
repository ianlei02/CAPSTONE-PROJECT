<?php
require_once '../../connection/dbcon.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'] ?? '';

if ($action === 'update_admin') {
    $id = $data['id'];
    $fullname = $data['fullname'];
    $username = $data['username'];
    $email = $data['email'];
    $permissions = $data['permissions'];

    $rolesJson = json_encode(explode(',', $permissions));

    $sql = "UPDATE admin_account 
            SET fullname = ?, username = ?, email = ?, role = ?
            WHERE admin_ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fullname, $username, $email, $rolesJson, $id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Admin information updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No changes made or invalid admin ID."]);
    }

    $stmt->close();
}

elseif ($action === 'update_status') {
    $id = $data['id'];
    $status = $data['status'];

    $sql = "UPDATE admin_account SET status = ? WHERE admin_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Admin status updated to $status!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update status."]);
    }

    $stmt->close();
}

elseif ($action === 'delete') {
    $id = $data['id'];

    $sql = "DELETE FROM admin_account WHERE admin_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Admin deleted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete admin."]);
    }

    $stmt->close();
}

$conn->close();
?>
