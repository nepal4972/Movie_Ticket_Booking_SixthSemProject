
<?php

function verifyAdmin() {
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
        return true;
    }
    return false;
}

if (!verifyAdmin()) {
    header('Location: ../errors/401.php');
    exit;
}
?>
