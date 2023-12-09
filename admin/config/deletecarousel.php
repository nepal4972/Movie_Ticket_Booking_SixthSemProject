<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>
<link rel="stylesheet" href="../../alerts/dist/css/iziToast.min.css">
<?php

if(isset($_GET['id'])) {
    $carouselID = $_GET['id'];

    $sql5 = "DELETE FROM carousel WHERE carouselID = '$carouselID'";
    $stmt5 = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt5, $sql5);
    mysqli_stmt_execute($stmt5);

    $_SESSION['icons']="../img/alerticons/success.png";  
    $_SESSION['status']="success";
    $_SESSION['status_code']="Carousel Deleted";
    header("Location: ../carousel.php");
    exit();
}
else {
    $_SESSION['icons']="../img/alerticons/error.png";  
    $_SESSION['status']="error";
    $_SESSION['status_code']="Id not Assigned";
    header("Location: ../carousel.php");
    exit();
}
?>