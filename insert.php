<?php
include './db/connect.php';

$movieid = 1;
$date = '2023-07-04';
$time = '16:00:00';
$seats = 'E4,C6,D7';

$seatNumbers = explode(',', $seats);
    foreach ($seatNumbers as $seatNumber) {
        $seatNumber = trim($seatNumber);
        $seatInsertSql = "INSERT INTO `seats` (`seat_number`, `bookingID`, `status`) 
                          VALUES ('$seatNumber', 56, 'booked')";
        if ($conn->query($seatInsertSql) === false) {
            echo "Error inserting seat details: " . $conn->error;
            exit();
        }
    }

?>