<?php
include '../db/connect.php';
include '../includes/links.php';
include '../includes/loggedin.php';
?>
<link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
<?php

date_default_timezone_set('Asia/Kathmandu');
$currentdate = date('Y-m-d');

$giventime = strtotime($date);
$currenttime = strtotime($currentdate);

if(isset($_POST['id']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['seats']) && isset($_POST['reserve'])) {
    $movieid = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $seats = $_POST['seats'];

    $seat_numbers_array = explode(', ', $seats);
    $seat_numbers_condition = "'" . implode("', '", $seat_numbers_array) . "'";
    
    $sql = "SELECT COUNT(*) AS seat_count
            FROM seats AS s
            INNER JOIN bookings AS b ON b.bookingID = s.bookingID
            WHERE b.movieID = $movieid AND b.show_date = '$date' AND b.show_time = '$time' AND s.status IN ('booked', 'sold') AND s.seat_number IN ($seat_numbers_condition)";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        $occupied_seat_count = $row['seat_count'];
        
        if (!$occupied_seat_count > 0) {
            echo 'run';
        } else {
            $_SESSION['icons']="./img/alerticons/warning.png";
            $_SESSION['status']="warning";
            $_SESSION['status_code']="Seats Already Booked";
            header('Location: ../');
            exit;
        }
    } else {
        $_SESSION['icons']="./img/alerticons/warning.png";
        $_SESSION['status']="warning";
        $_SESSION['status_code']="Incomplete Request1";
        header('Location: ../');
        exit;
    }
    
} else {
    $_SESSION['icons']="./img/alerticons/warning.png";
    $_SESSION['status']="warning";
    $_SESSION['status_code']="Incomplete Request";
    header('Location: ../');
    exit;
}
?>

<script src="../alerts/dist/js/iziToast.min.js"></script>
<?php
include '../includes/alert.php';
?>