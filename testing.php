<?php
include './db/connect.php';
include './includes/links.php';

// Function to generate a unique booking ID
function generateBookingID() {
    return uniqid('booking_', true);
}

if ($_GET['test'] === 'hello') {
    $movieid = 1;
    $date = '2023-07-04';
    $time = '16:00:00';
    $seats = 'E4,C6,D7';

    // Generate a unique booking ID
    $bookingID = generateBookingID();

    // Insert the booking details in the bookings table
    $bookingInsertSql = "INSERT INTO `bookings` (`bookingID`, `userID`, `movieID`, `seats`, `show_date`, `show_time`, `booked_date`) 
                         VALUES ('$bookingID', 1, $movieid, '$seats', '$date', '$time', NOW())";
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
}
