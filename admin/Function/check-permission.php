<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function hasPermission($permission) {
    if (!isset($_SESSION['admin_roles'])) return false;

    if (in_array('ALL_ACCESS', $_SESSION['admin_roles'])) {
        return true;
    }

    return in_array($permission, $_SESSION['admin_roles']);
}

