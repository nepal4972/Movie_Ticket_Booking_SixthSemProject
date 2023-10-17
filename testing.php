<?php
include './db/connect.php';
include './includes/links.php';

$userID = $_SESSION['userID'];

$prefix = "TICKET";
$uniqueID = $prefix . " " . time() . "-" . mt_rand(1000, 9999);
echo $ticketSNo = $uniqueID;

if ($_GET['test'] === 'hello') {
    $movieid = 1;
    $date = '2023-07-04';
    $time = '16:00:00';
    $seats = 'E4,C6,D7';

    $row = substr($seats, 0, 1);
    
    $checkRowSql = "SELECT COUNT(*) as count FROM seats AS s
                    INNER JOIN bookings AS b ON b.bookingID = s.bookingID
                    WHERE b.movieID = $movieid AND b.show_date = '$date' AND b.show_time = '$time' 
                    AND s.seat_number LIKE '$row%' AND (s.status = 'booked' OR s.status = 'sold')";
    $result = $conn->query($checkRowSql);
    
    if ($result === false) {
        echo 'SQL Error';
        exit();
    }
    
    $row = $result->fetch_assoc();
    $seatCount = $row['count'];
    
    if ($seatCount > 0) {
        echo "Seats in row $row are already booked or sold for the selected date and time.";
    } else {
        $bookingInsertSql = "INSERT INTO `bookings` (`userID`, `movieID`, `seats`, `show_date`, `show_time`, `booked_date`) 
        VALUES ($userID, $movieid, '$seats', '$date', '$time', NOW())";

        if ($conn->query($bookingInsertSql) === false) {
            echo "Error inserting booking details: " . $conn->error;
            exit();
        }
    
        $bookingID = $conn->insert_id;
        $seatNumbers = explode(',', $seats);
        foreach ($seatNumbers as $seatNumber) {
            $seatNumber = trim($seatNumber);
            $seatInsertSql = "INSERT INTO `seats` (`bookingID`, `seat_number`, `status`)
                              VALUES ('$bookingID', '$seatNumber', 'booked')";
            if ($conn->query($seatInsertSql) === false) {
                echo "Error inserting seat details: " . $conn->error;
                exit();
            }
        }
    
        // Booking is successful, you can display a success message or perform further actions.
        echo "Booking successful!";
    }
}
