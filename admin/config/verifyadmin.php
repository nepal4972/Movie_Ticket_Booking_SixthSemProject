<?php

function isLoggedIn() {
    return isset($_SESSION['user_type']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['user_type'] === 'admin';
}

if (!isAdmin()) {
    if (isLoggedIn()) {
        header('Location: ../errors/401.php');
        exit;
    } else {
        header('Location: ../login.php');
        exit;
    }
}
?>
