<?php
require '../../connection/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['newsTitle'] ?? '';
    $date = $_POST['newsDate'] ?? '';
    $excerpt = $_POST['newsExcerpt'] ?? '';
    $content = $_POST['newsContent'] ?? '';
    $action = $_POST['action'] ?? 'create' ;


      $imagePath = '';
    if (!empty($_FILES['newsImage']['name'])) {
        $targetDir = "../uploads/news/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES["newsImage"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["newsImage"]["tmp_name"], $targetFilePath)) {
            $imagePath = "uploads/news/" . $fileName;
        }
    }

    if ($action === "create") {
        $stmt = $conn->prepare("INSERT INTO announcement (title, publish_date, image, content, excerpt) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $date, $imagePath, $content, $excerpt);
        $stmt->execute();
        $stmt->close();
    }
    elseif ($action === "edit") {
        $id = $_POST['id'];

        $sql = "SELECT image FROM announcement WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $old = $result->fetch_assoc();
        $stmt->close();

        $imagePath = "";

        if (!empty($_FILES['newsImage']['name'])) {
            if (!empty($old['image'])) {
            $oldPath = "../" . $old['image'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $targetDir = "../uploads/news/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES["newsImage"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["newsImage"]["tmp_name"], $targetFilePath)) {
            $imagePath = "uploads/news/" . $fileName;
        
        $stmt = $conn->prepare("UPDATE announcement SET title=?, publish_date=?, image=?, content=?, excerpt=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $date, $imagePath, $content, $excerpt, $id);
        } else {
        $stmt = $conn->prepare("UPDATE announcement SET title=?, publish_date=?, content=?, excerpt=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $date, $content, $excerpt, $id);
        }
        $stmt->execute();
        $stmt->close();
    }
    }
    header("Location: ../pages/news-upload.php?success=1");
    exit();
    
}
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = intval($_GET['id']);

    $sql = "SELECT image FROM announcement WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row && !empty($row['image'])) {
        $oldPath = "../../" . $row['image'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }
    
    $stmt = $conn->prepare("DELETE FROM announcement WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../pages/news-upload.php?deleted=1");
    exit();
}