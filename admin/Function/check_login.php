<?php
session_start();

if (!isset($_SESSION['admin_ID'])) {
    // Not logged in
    header("Location: ../pages/admin-login.php");
    exit;
}
?>
