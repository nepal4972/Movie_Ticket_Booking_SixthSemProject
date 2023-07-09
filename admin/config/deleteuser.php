<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>
<link rel="stylesheet" href="../../alerts/dist/css/iziToast.min.css">
<?php

if(isset($_GET['id'])) {
    $userID = $_GET['id'];

    $sql5 = "DELETE FROM users WHERE userID = '$userID'";
    $stmt5 = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt5, $sql5);
    mysqli_stmt_execute($stmt5);


    if(mysqli_stmt_affected_rows($stmt5) > 0) {
        header("Location: ../users.php");
        $_SESSION['icons']="../img/alerticons/success.png";  
        $_SESSION['status']="success";
        $_SESSION['status_code']="User Deleted";
        header("Location: ../users.php");
        exit();
    }
    else {
        $_SESSION['icons']="../img/alerticons/error.png";  
        $_SESSION['status']="error";
        $_SESSION['status_code']="Error Deleting User";
        header("Location: ../users.php");
        exit();
    }
}
else {
    $_SESSION['icons']="../img/alerticons/error.png";  
    $_SESSION['status']="error";
    $_SESSION['status_code']="User Id not Assigned";
    header("Location: ../users.php");
    exit();
}
?>