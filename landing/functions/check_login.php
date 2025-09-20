<?php
session_start();
require __DIR__ . '/../connection/dbcon.php';

define('ROOT', 'http://localhost/CAPSTONE/CAPSTONE-PROJECT/landing');

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    session_unset();
    session_destroy();
    header("Location: ../../landing/login-signup.php?timeout=1");
    exit();
}
$_SESSION['last_activity'] = time();


if (isset($_SESSION['user_id'])) {
    
    return;
}

if (isset($_COOKIE['remember_login'])) {
    $cookie_data = json_decode($_COOKIE['remember_login']);

    
    if ($cookie_data && isset($cookie_data->email, $cookie_data->token)) {
        $email = $cookie_data->email;
        $token = $cookie_data->token;

        $applicant_query = "SELECT * FROM applicant_account WHERE email = ?";
        $employer_query = "SELECT * FROM employer_account WHERE email = ?";

        
        $stmt = mysqli_prepare($conn, $applicant_query);
        if (!$stmt) {
            die('MySQL prepare error (applicant): ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $table = 'applicant_account';
            $id_field = 'applicant_ID';
        } else {
            // Check employer table
            $stmt = mysqli_prepare($conn, $employer_query);
            if (!$stmt) {
                die('MySQL prepare error (employer): ' . mysqli_error($conn));
            }
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $table = 'employer_account';
                $id_field = 'employer_ID';
            }
        }

      
        if (isset($row) && password_verify($token, $row['remember_token'])) {



            if ($row['status'] !== 'verified') {
            setcookie('remember_login', '', time() - 3600, '/');
            header("Location: ../login-signup.php?error=not_verified");
            exit();
        }

            $_SESSION['user_id'] = $row[$id_field];
            $_SESSION['user_type'] = ($table === 'applicant_account') ? 'applicant' : 'employer';
            $_SESSION['email'] = $row['email'];
            $_SESSION['f_name'] = $row['f_name'];
            $_SESSION['l_name'] = $row['l_name'];
            $_SESSION['verified'] = true;
        } else {
            
            setcookie('remember_login', '', time() - 3600, '/');
        }
    } else {
        
        setcookie('remember_login', '', time() - 3600, '/');
    }
}


// echo "Reached end of script.";

exit();

?>
