<?php
include '../db/connect.php';
include '../includes/links.php';
include './config/verifyadmin.php';
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>

<?php
$userID = $_SESSION['userID'];

$sql1 = "SELECT * FROM bookings";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
?>

<?php

$sql5 = "SELECT b.*, u.*, m.*, p.*
FROM bookings AS b
JOIN users AS u ON b.userID = u.userID
JOIN movies AS m ON b.movieID = m.movieID
JOIN payments AS p ON b.bookingID = p.bookingID
WHERE b.ticket IS NOT NULL ORDER BY booked_date DESC";

$stmt5 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt5, $sql5);
mysqli_stmt_execute($stmt5);
$result5 = mysqli_stmt_get_result($stmt5);
?>

<?php
function fetchSeatNumbers($conn, $bookingID) {
    $seatNumbers = array();
    $sql8 = "SELECT seat_number FROM seats WHERE bookingID = $bookingID";
    $result8 = mysqli_query($conn, $sql8);
    while ($row8 = mysqli_fetch_assoc($result8)) {
        $seatNumbers[] = $row8['seat_number'];
    }
    return implode(', ', $seatNumbers);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Bookings <?php echo $title ?></title>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <?php include './includes/navbar.php'; ?>
    </div>
    <div class="main-content">
        <?php include './includes/header.php'; ?>
        <main>
            <div class="page-header">
                <h1>Bookings</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                    <div class="add">
                        </div>

                        <div class="browse">
                        </div>
                    </div>
                    <div id="section2">
                        <div class="page-header-small">
                            <h1>Booked</h1>
                        </div>
                        <br>
                        <div>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Booked Movie</th>
                                        <th>Booked By</th>
                                        <th>Show Date Time</th>
                                        <th>Booked Seats</th>
                                        <th>Booked Date</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $bookedcount = 1;
                                    while($row5 = mysqli_fetch_assoc($result5)) {
                                    ?>
                                    <tr>
                                        <td>#<?php echo $bookedcount ?></td>
                                        <td><?php echo $row5['movie_name'] ?></td>
                                        <td>
                                            <div class="client">
                                                <img src="<?php echo $base ?><?php echo $row5['profile_img'] ?>" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4><?php echo $row5['fullname'] ?></h4>
                                                    <small><?php echo $row5['email'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                            $date = $row5['show_date'];
                                            $formattedDate = date("F d, Y", strtotime($date));
                                            $time = date("h:i A", strtotime($row5['show_time']));
                                            ?>
                                        <td>
                                            <div class="date-time">
                                                <small><?php echo $time ?></small>
                                                <h4><?php echo $formattedDate ?></h4>
                                            </div>
                                        </td>
                                        <?php
                                        ?>
                                        <td>
                                            <?php $bookingID = $row5['bookingID']?>
                                            <?php $seatNumbers = fetchSeatNumbers($conn, $bookingID);?>
                                            <?php echo $seatNumbers ?>
                                        </td>
                                        <?php
                                        $time5 = $row5['booked_date'];
                                        $formattedtime5 = date("F d, Y", strtotime($time5));
                                        ?>
                                        <td>
                                            <?php echo $formattedtime5 ?>
                                        </td>
                                        <td>Rs. <?php echo number_format($row5['payment_amount'], 0) ?></td>
                                        <td>
                                        <?php echo $row5['payment_status'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $bookedcount++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="./assets/js/script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>