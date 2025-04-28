<?php
session_start();
require '../connection/dbcon.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password) ) {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit();
}

$query = "SELECT admin_ID, username, password FROM admin_account WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    header("Location: ../pages/admin-login.php?error=db_error");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);



if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

if ($password === $user['password']) {
        
        $_SESSION['admin_ID'] = $user['admin_ID'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        
        session_regenerate_id(true);
        
        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "redirect" => "../pages/dashboard.php"
        ]);
    } else {
         echo json_encode([
            "status" => "error",
            "message" => "Invalid username or password"
            ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid username or password"
    ]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>