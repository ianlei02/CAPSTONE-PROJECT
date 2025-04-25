<?php
session_start();
require "../connection/dbcon.php";

if(isset($_POST['signupBtn'])) {
    $user_type = mysqli_real_escape_string($conn, $_POST['user-type']); 
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($user_type == 'applicant') {
        $query = "INSERT INTO applicant_account (f_name, l_name, email, password)
                 VALUES ('$f_name', '$l_name', '$email', '$hashed_password')";
                 
    } 
    elseif ($user_type == 'employer') {
        $query = "INSERT INTO employer_account (f_name, l_name, email, password)
                 VALUES ('$f_name', '$l_name', '$email', '$hashed_password')";
                 
    }
    $result = mysqli_query($conn, $query);
    
    
    if($result) {
        
        $_SESSION['message'] = "Registration successful!";
        header("Location: ../login-signup.php");
        exit();
    } else {
        
        $_SESSION['error'] = "Registration failed: " . mysqli_error($conn);
        header("Location: ../login-signup.php");
        exit();
    }
}
?>