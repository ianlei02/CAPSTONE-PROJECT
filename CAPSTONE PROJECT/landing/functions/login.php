<?php
session_start();
require '../connection/dbcon.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit();
}

$email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$user_type = $_POST['user-type-login'] ?? '';
$remember_me = isset($_POST['remember_me']) ? true : false;

if (empty($email) || empty($password) || empty($user_type)) {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit();
}

$table = ($user_type === 'applicant') ? 'applicant_account' : 'employer_account';
$id_field = ($user_type === 'applicant') ? 'applicant_ID' : 'employer_ID';

$query = "SELECT * FROM $table WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    
    if (password_verify($password, $row['password'])) {
        
        $_SESSION['user_id'] = $row[$id_field];
        $_SESSION['user_type'] = $user_type;
        $_SESSION['email'] = $row['email'];
        $_SESSION['f_name'] = $row['f_name'];
        $_SESSION['l_name'] = $row['l_name'];
        $_SESSION['last_activity'] = time();
        
        if ($remember_me) {
            $token = bin2hex(random_bytes(16)); 
            $cookie_value = json_encode([
                'email' => $email,
                'token' => $token
            ]);
        
            setcookie(
                'remember_login', 
                $cookie_value,
                time() + (30 * 24 * 60 * 60), 
                '/',
                '', 
                true,  
                true   
            );
            
            
            $token_hash = password_hash($token, PASSWORD_DEFAULT);
            $update_query = "UPDATE $table SET remember_token = ? WHERE $id_field = ?";
            $update_stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($update_stmt, "si", $token_hash, $row[$id_field]);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);
        }
        
        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "redirect_url" => ($user_type === 'applicant') 
                ? "../applicant/pages/applicant-dashboard.php" 
                : "../employer/pages/employer-dashboard.php",
            "user_type" => $user_type
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid password"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "$user_type not found with this email"
    ]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();
?>