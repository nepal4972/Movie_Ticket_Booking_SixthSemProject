<?php
include '../../db/connect.php';
include './verifyadmin.php';
include '../../includes/links.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $movieID = $_POST['movieID'];
    $showtimeID = $_POST['showtime'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Delete existing rows with the matching showtimeID
    $deleteSql = "DELETE FROM movietime WHERE showID = ?";

    $deleteStmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($deleteStmt, $deleteSql)) {
        mysqli_stmt_bind_param($deleteStmt, "i", $showtimeID);
        mysqli_stmt_execute($deleteStmt);
    }

    // Now, insert the new row into movietime
    $insertSql = "INSERT INTO movietime (movieID, showID, start_date, end_date)
                 VALUES (?, ?, ?, ?)";

    $insertStmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($insertStmt, $insertSql)) {
        mysqli_stmt_bind_param($insertStmt, "iiss", $movieID, $showtimeID, $start_date, $end_date);
        mysqli_stmt_execute($insertStmt);
        
        $_SESSION['icons'] = "../img/alerticons/success.png";
        $_SESSION['status'] = "success";
        $_SESSION['status_code'] = "Show Time Assigned.";
        header("Location: ../showtime.php");
        exit();
    } else {
        $_SESSION['icons'] = "../img/alerticons/error.png";
        $_SESSION['status'] = "error";
        $_SESSION['status_code'] = "Error Assigning Showtime.";
        header("Location: ../showtime.php");
        exit();
    }

    mysqli_close($conn);
}

?>
