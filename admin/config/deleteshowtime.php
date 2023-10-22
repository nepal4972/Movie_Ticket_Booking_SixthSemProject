<link rel="stylesheet" href="../../alerts/dist/css/iziToast.min.css">
<script src="../alerts/dist/js/iziToast.min.js"></script>
<?php
include '../../db/connect.php';

if(isset($_GET['id'])) {
    $showID = $_GET['id'];

    $sql = "DELETE FROM showtime WHERE showID = '$showID'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);

    $_SESSION['icons'] = "../img/alerticons/success.png";
    $_SESSION['status'] = "success";
    $_SESSION['status_code'] = "Show Time Deleted.";
    header("Location: ../showtime.php");
    exit();
} else {
  $_SESSION['icons'] = "../img/alerticons/error.png";
  $_SESSION['status'] = "error";
  $_SESSION['status_code'] = "SQL Error.";
  header("Location: ../showtime.php");
  exit();
}
?>