<?php
session_start();

$_SESSION = array();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
setcookie('remember_login', '', time() - 3600, '/');

session_destroy();

if (isset($_GET['timeout'])) {
    header("Location: ../login-signup.php?timeout=1");
    exit();
}

header("Location: ../../index.php");
exit();
?>