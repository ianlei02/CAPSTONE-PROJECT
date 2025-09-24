<?php
session_start();
require '../../connection/dbcon.php';

// define('ROOT', 'http://localhost/CAPSTONE-PROJECT/index.php');

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    session_unset();
    session_destroy();
?>
    <div id="sessionExpiredPopup" style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    ">
        <div style="
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            font-family: sans-serif;
        ">
            <h2 style="margin-bottom: 20px;">SESSION EXPIRED</h2>
            <button onclick="redirectLogin()" style="
                padding: 10px 20px;
                background: #465ee5ff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            ">OK</button>
        </div>
    </div>
    <script>
        function redirectLogin() {
            window.location.href = "../../landing/login-signup.php";
        }
    </script>
<?php
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
exit();
?>