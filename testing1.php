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
    $paymentAmount = 120.0; // Assuming you have the payment amount

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
                          VALUES ('$bookingID', '$seatNumber', 'sold')";
        if ($conn->query($seatInsertSql) === false) {
            echo "Error inserting seat details: " . $conn->error;
            exit();
        }
    }

    // Insert payment details
    $paymentID = uniqid('payment_', true);
    date_default_timezone_set('Asia/Kathmandu');
    $paymentDate = date('Y-m-d H:i:s');
    $paymentMethod = 'Online Payment';
    $paymentReference = '123456789';

    $paymentInsertSql = "INSERT INTO `payments` (`bookingID`, `payment_amount`, `payment_date`, `payment_method`, `payment_referenceID`)
                         VALUES ('$bookingID', 20, '$paymentDate', '$paymentMethod', '$paymentReference')";
    if ($conn->query($paymentInsertSql) === false) {
        echo "Error inserting payment details: " . $conn->error;
        exit();
    }
}
?>
