<?php

include '../db/connect.php';
include '../includes/links.php';


$movieTimeID = 1; // The ID of the movie time you want to insert seat data for
$showID = 1; // The ID of the show associated with the movie time

// Retrieve the show time associated with the show ID
$showTimeQuery = "SELECT show_time FROM showtime WHERE showID = $showID";
$showTimeResult = mysqli_query($conn, $showTimeQuery);

if ($showTimeResult) {
    $showTimeRow = mysqli_fetch_assoc($showTimeResult);
    $showTime = $showTimeRow['show_time'];

    // Retrieve the start_date and end_date of the movie time
    $movieTimeQuery = "SELECT start_date, end_date FROM movietime WHERE movietimeID = $movieTimeID";
    $movieTimeResult = mysqli_query($conn, $movieTimeQuery);

    if ($movieTimeResult) {
        $movieTimeRow = mysqli_fetch_assoc($movieTimeResult);
        $startDate = $movieTimeRow['start_date'];
        $endDate = $movieTimeRow['end_date'];

        // Generate an array of dates between the start_date and end_date
        $dates = [];
        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        while ($currentDate <= $endDate) {
            $dates[] = date('Y-m-d', $currentDate);
            $currentDate = strtotime('+1 day', $currentDate);
        }

        // Insert seat data for each date and show time
        foreach ($dates as $date) {
            $insertQuery = "INSERT INTO seats (seat_number, status, movie_id, date, time)
                            SELECT seat_number, 'available', $movieTimeID, '$date', '$showTime'
                            FROM seats
                            WHERE movie_id = $movieTimeID AND date = '0000-00-00' AND time = '00:00:00'";

            mysqli_query($conn, $insertQuery);
        }

        echo "Seat data inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Query for show time failed
    echo "Error: " . mysqli_error($conn);
}

// Close the database conn
mysqli_close($conn);

?>
