<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_FILES);

    $uploadDir = __DIR__ . '/../uploads/documents/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $file = $_FILES['testfile'];

    $targetPath = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo "File uploaded successfully!";
    } else {
        echo "Failed to upload file.";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="testfile" />
    <button type="submit">Upload</button>
</form>