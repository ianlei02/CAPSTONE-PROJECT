<?php
session_start();
require "../connection/dbcon.php"; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/SMTP.php';
require '../../phpmailer/src/PhpMailer.php';

if(isset($_POST['signupBtn'])) {
    $user_type = mysqli_real_escape_string($conn, $_POST['user-type']); 
    $_SESSION['user_type'] = $user_type;
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $_SESSION['email'] = $email;  
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_applicant = mysqli_query($conn, "SELECT email FROM applicant_account WHERE email = '$email'");
    $check_employer = mysqli_query($conn, "SELECT email FROM employer_account WHERE email = '$email'");
    
    if(mysqli_num_rows($check_applicant) > 0 || mysqli_num_rows($check_employer) > 0) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: ../login-signup.php");
        exit();
    }

    if ($user_type == 'applicant') {
        $query = "INSERT INTO applicant_account (f_name, l_name, email, password,otp,status,otp_send_time,ip)
                 VALUES ('$f_name', '$l_name', '$email', '$hashed_password','$otp','pending',NOW(),'$ip_address')";
                 
    } 
    elseif ($user_type == 'employer') {
        $query = "INSERT INTO employer_account (f_name, l_name, email, password,otp,status,otp_send_time,ip)
                 VALUES ('$f_name', '$l_name', '$email', '$hashed_password','$otp','pending',NOW(),'$ip_address')";
              
    }

    if($conn->query($query) === TRUE){
        
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'justincruz9812@gmail.com';
            $mail->Password = 'fvxzodcnxnoxqfrc';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom('justincruz9812@gmail.com','PESO PH');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = mysqli_real_escape_string($conn, $_POST['subject']);
            $mail->Body = "Your Verification code is: " . $otp;

            $mail->send();
            echo "
            
            <script>
            alert('Verification code has been sent to your email.');
            document.location.href='../Verify_OTP.php';
            </script>";
        } catch(Exception $e){
            echo"
            
            <script>
            alert('Error : {$mail->ErrorInfo}');
            document.location.href='../login-signup.php';
            </script>
            ";

        }
    } else{
        echo"
        <script>
        alert('Error inserting data: {$conn->error}');
        document.location.href='../login-signup.php';
        </script>
        ";
    }
}
?>