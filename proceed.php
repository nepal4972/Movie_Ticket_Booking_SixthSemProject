<?php
include './db/connect.php';
include './includes/links.php';
include './includes/loggedin.php';
?>

<?php
$movieid = $_GET['id'];
$date = $_GET['date'];
$time = $_GET['time'];
$seats = $_POST['seats'];
$explodedseats = explode(',', $seats);
$seatcounts = count($explodedseats);
?>

<?php
date_default_timezone_set('Asia/Kathmandu');
$currentdate = date('Y-m-d');

$datestamp = strtotime($date);
$formatteddate = date('F j, Y', $datestamp);

$timestamp = strtotime($time);
$formattedtime = date('h:i A', $timestamp);

$giventime = strtotime($date);
$currenttime = strtotime($currentdate);

$timeDifferenceInDays = floor(($datestamp - strtotime($currentdate)) / (60 * 60 * 24));


if((!empty($_GET['id'])) && (!empty($_GET['date'])) && (!empty($_GET['time'])) && !($currenttime > $giventime) && !($timeDifferenceInDays >= 2)) {

$sql1 = "SELECT * FROM movies WHERE movieID = '$movieid'";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
$row1 = mysqli_fetch_assoc($result1);

$sql2 = "SELECT * FROM settings WHERE settingID = '1'";
$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$row2 = mysqli_fetch_assoc($result2);

$movieprice = $row1['movie_price'];
$seatprice = $row2['seat_price'];

if(empty($row1['movie_price'])) {
    $seatprice;
    $totalprice = $seatcounts * $seatprice;
}
else {
    $movieprice;
    $totalprice = $seatcounts * $movieprice;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="./assets/home/css/proceed.css">
    <title><?php echo $row1['movie_name'] ?> | Proceed <?php echo $title ?></title>
</head>
<body>
    <form action="./config/booking.inc" method="POST">
    <div class="container">
        <div class="left-section">
            <div class="movie-summary">
                <h2>Movie Summary</h2>
                <p><strong>Movie:</strong> <?php echo $row1['movie_name'] ?></p>
                <p><strong>Date:</strong> <?php echo $formatteddate ?></p>
                <p><strong>Time:</strong> <?php echo $formattedtime ?></p>
                <p><strong>Seats:</strong> <?php echo $seats ?></p>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $movieid?>">
        <input type="hidden" name="date" value="<?php echo $date?>">
        <input type="hidden" name="time" value="<?php echo $time?>">
        <input type="hidden" name="seats" value="<?php echo $seats?>">
        <div class="right-section">
            <div class="ticket-details">
                <h2>Ticket Details</h2>
                <div class="ticket-price">
                    <p><strong>No of Seats:</strong> <?php echo $seatcounts ?></p>
                    <p><strong>Sub Total:</strong> Rs. <?php echo $totalprice ?></p>
                    <p><strong>Total Amount:</strong> Rs. <?php echo $totalprice ?></p>
                </div>
                <button type="submit" name="reserve">Reserve Now</button>
            </div>
        </div>
    </div>
    </form>

    <?php
    include './esewa/setting.php';
    ?>
    <form action="<?php echo $api ?>" method="POST">
        <input value="<?php echo $total_amount ?>" name="tAmt" type="hidden">
        <input value="<?php echo $ticket_price ?>" name="amt" type="hidden">
        <input value="<?php echo $tax_price ?>" name="txAmt" type="hidden">
        <input value="<?php echo $srv_charge ?>" name="psc" type="hidden">
        <input value="<?php echo $del_charge ?>" name="pdc" type="hidden">
        <input value="<?php echo $mer_code ?>" name="scd" type="hidden">
        <input value="<?php echo $inv_no ?>" name="pid" type="hidden">
        <input value="<?php echo $base_url ?>esewa/esewa_payment_success?q=su" type="hidden" name="su">
        <input value="<?php echo $base_url ?>esewa/esewa_payment_failed?q=fu" type="hidden" name="fu">

    <div class="middle-container">
        <div class="middle-section">
            <div class="payment-section">
                <h2>Buy Online With:</h2>
                <div class="payment-options">
                    <input class="img" value="Submit" src="./img/favicons/esewa.png" type="image">
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
<?php
} else {
    $_SESSION['icons']="./img/alerticons/warning.png";
    $_SESSION['status']="warning";
    $_SESSION['status_code']="Incomplete Request";
    header("Location: $base");
    exit;
}
?>