<?php
include '../db/connect.php';
include './config/verifyadmin.php';
include '../includes/links.php';
include './includes/confirmation.php';

?>
<script src="../alerts/dist/js/iziToast.min.js"></script>
<script src="../assets/home/js/script.js"></script>

<?php
$userID = $_SESSION['userID'];

$sql1 = "SELECT * FROM movies WHERE CURRENT_DATE() BETWEEN release_date AND end_date";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
$row_count1 = mysqli_num_rows($result1);

$sql2 = "SELECT * FROM movies WHERE CURRENT_DATE() < release_date";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$row_count2 = mysqli_num_rows($result2);

$sql3 = "SELECT * FROM bookings WHERE ticket IS NOT NULL";
$stmt3 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt3, $sql3);
mysqli_stmt_execute($stmt3);
$result3 = mysqli_stmt_get_result($stmt3);
$row_count3 = mysqli_num_rows($result3);

$sql4 = "SELECT * FROM users";
$stmt4 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt4, $sql4);
mysqli_stmt_execute($stmt4);
$result4 = mysqli_stmt_get_result($stmt4);
$row_count4 = mysqli_num_rows($result4);

$sql5 = "SELECT b.*, u.*, m.*, p.*
FROM bookings AS b
INNER JOIN users AS u ON b.userID = u.userID
INNER JOIN movies AS m ON b.movieID = m.movieID
LEFT JOIN payments AS p ON b.bookingID = p.bookingID
WHERE (b.show_date < CURDATE() OR (b.show_date = CURDATE() AND b.show_time < CURTIME()))
AND u.userID = $userID AND b.ticket IS NOT NULL ORDER BY booked_date DESC LIMIT 5";

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
    <title>Dashboard <?php echo $title ?></title>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <?php
    include './includes/navbar.php';
    ?>
    </div>
    <div class="main-content">
        <?php
        include './includes/header.php';
        ?>
        <main>
            <div class="page-header">
                <h1>Dashboard</h1>
            </div>
            <div class="page-content">
                <div class="analytics">
                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $row_count4 ?></h2>
                            <ion-icon style="font-size:50px" name="people-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>Total Users</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $row_count1 ?></h2>
                            <ion-icon style="font-size:50px" name="videocam-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>Showing Movies</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $row_count2 ?></h2>
                            <ion-icon style="font-size:50px" name="videocam-off-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>upcoming Movies</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $row_count3 ?></h2>
                            <ion-icon style="font-size:50px" name="bookmarks-outline"></ion-icon>
                        </div>
                        <div class="card-progress">
                            <small>Total Bookings</small>
                        </div>
                    </div>
                </div>

                <div class="page-content">
                    <div class="records table-responsive">
                            <div class="page-header-small">
                                <h1>Recent bookings</h1>
                            </div>
                            <br>
                            <div>
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Booked Movie</th>
                                            <th>Booked By</th>
                                            <th>Booked Seats</th>
                                            <th>Show Time</th>
                                            <th>Booked Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $showingcount = 1;
                                    while($row5 = mysqli_fetch_assoc($result5)) {
                                    ?>
                                        <tr>
                                            <td>#<?php echo $showingcount ?></td>
                                            <td>
                                                <h4><?php echo $row5['movie_name'] ?></h4>
                                            </td>
                                            <td>
                                            <div class="client">
                                                <img src="<?php echo $base?><?php echo $row5['profile_img'] ?>" class="client-img bg-img" alt="">
                                                <div class="client-info">
                                                    <h4><?php echo $row5['fullname'] ?></h4>
                                                    <small><?php echo $row5['email'] ?></small>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                                <?php $bookingID = $row5['bookingID']?>
                                                <?php $seatNumbers = fetchSeatNumbers($conn, $bookingID);?>
                                                <?php echo $seatNumbers ?>
                                            </td>
                                            <?php
                                            $dateObj = new DateTime($row5['show_date']);
                                            $currentDate = new DateTime();
                                            $interval = $currentDate->diff($dateObj);
                                            $daysDifference = $interval->days;
                                            if ($daysDifference == 0) {
                                                $formattedDate = "Today";
                                            } elseif ($daysDifference == 1) {
                                                $formattedDate = "Tomorrow";
                                            } else {
                                                $formattedDate = $dateObj->format("Y-m-d");
                                            }
                                            $time = date("h:i A", strtotime($row5['show_time']));
                                            ?>
                                            <td>
                                                <div class="date-time">
                                                    <h4><?php echo $formattedDate ?></h4>
                                                    <small><?php echo $time ?></small>
                                                </div>
                                            </td>
                                            <?php
                                            $time5 = $row5['booked_date'];
                                            $formattedtime5 = date("F d, Y", strtotime($time5));
                                            ?>
                                            <td>
                                                <?php echo $formattedtime5 ?>
                                            </td>
                                            <td>
                                                <?php echo $row5['payment_status']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    $showingcount++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="./assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>