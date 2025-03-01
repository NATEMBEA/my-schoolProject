<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

function isClient() {
    return $_SESSION['role'] === 'client';
}

function isDeveloper() {
    return $_SESSION['role'] === 'developer';
}
?>