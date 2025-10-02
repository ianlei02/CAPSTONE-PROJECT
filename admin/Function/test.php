<?php
require "../../connection/dbcon.php";

$id = 4; // change this to any announcement ID you want to test

// 1. Get the old image path from the DB
$stmt = $conn->prepare("SELECT image FROM announcement WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($oldImage);
$stmt->fetch();
$stmt->close();

if ($oldImage) {
    $filePath = __DIR__ . "/../". $oldImage; // adjust path if needed

    // 2. Check if the file exists
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "✅ File deleted: $filePath";
        } else {
            echo "❌ Failed to delete: $filePath";
        }
    } else {
        echo "⚠️ File does not exist: $filePath";
    }
} else {
    echo "⚠️ No image found for announcement ID $id";
}
