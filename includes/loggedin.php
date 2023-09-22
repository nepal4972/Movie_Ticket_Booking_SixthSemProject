<?php
include './db/connect.php';
include './includes/links.php';
?>

<?php
function islogged() {
    if (isset($_SESSION['userID'])) {
        return true;
    }
    else {
        return false;
    }
}

if (!islogged()) {
    $_SESSION['icons']="./img/alerticons/warning.png";
    $_SESSION['status']="warning";
    $_SESSION['status_code']="Please Login First";
    header("Location: $base");
    exit;
}
?>
