<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
<?php
include '../db/connect.php';
include '../includes/links.php';
include '../includes/loggedin.php';

$userID = $_SESSION['userID'];
$movieID = $_POST['id'];

if(isset($_POST['notify'])) {
    $checkdata = mysqli_query($conn, "SELECT * FROM notify WHERE userID = '$userID' AND movieID = '$movieID'") or die ("Query Failed");
    if(mysqli_num_rows($checkdata) > 0) {
        $_SESSION['icons'] = "./img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "You Will be Notified Through Email When Movie Releases.";
        header("Location: ../");
        exit();
    } else {

        $sql = "INSERT INTO notify (userID, movieID) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $userID, $movieID);
        mysqli_stmt_execute($stmt);

        $_SESSION['icons'] = "./img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "You Will be Notified Through Email When Movie Releases.";
        header("Location: ../");
        exit();
    }
} else {
    $_SESSION['icons'] = "./img/alerticons/error.png";
    $_SESSION['status'] = "error";
    $_SESSION['status_code'] = "SQL Error";
    header("Location: ../");
    exit();
}

?>
<script src="../alerts/dist/js/iziToast.min.js"></script>
