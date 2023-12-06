<?php
include '../db/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['seats'])) {
        $movieId = $_POST['id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $seats = $_POST['seats'];

        if (isset($_POST['esewa'])) {
            $sql = "INSERT INTO your_esewa_table (movie_id, date, time, seats) VALUES (?, ?, ?, ?)";
        } else {
            echo "Invalid request type";
            exit;
        }

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isss", $movieId, $date, $time, $seats);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "Data inserted successfully";
            } else {
                echo "Error inserting data into the database";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the statement";
        }

        mysqli_close($conn);
    } else {
        echo "Incomplete data received";
    }
} else {
    echo "Invalid request method";
}
?>
