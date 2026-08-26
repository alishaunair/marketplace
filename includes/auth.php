<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function require_login($role = null) {
    if (empty($_SESSION['user'])) {
        header('location: /marketplace/auth/login.php');
        exit;
    }
    if ($role && $_SESSION['user']['role'] !== $role) {
        header('location: /marketplace/');
        exit;
    }
}
