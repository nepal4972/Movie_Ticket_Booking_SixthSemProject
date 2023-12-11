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

$userID = $_SESSION['userID'];

$formatted_date = date('F j, Y', strtotime($date));
$formatted_time = date("h:i A", strtotime($time));

$sql8 = "SELECT * FROM movies WHERE movieID = $movieid";
$result8 = $conn->query($sql8);
$row8 = $result8->fetch_assoc();

$sql9 = "SELECT * FROM settings WHERE settingID = '1'";
$result9 = $conn->query($sql9);
$row9 = $result9->fetch_assoc();

$datestamp = strtotime($date);
$formatteddate = date('F j, Y', $datestamp);

date_default_timezone_set('Asia/Kathmandu');
$currentdate = date('Y-m-d');

$giventime = strtotime($date);
$currenttime = strtotime($currentdate);

$timeDifferenceInDays = floor(($datestamp - strtotime($currentdate)) / (60 * 60 * 24));

$movieprice8 = $row8['movie_price'];
$seatprice9 = $row9['seat_price'];

if (empty($movieprice8)) {
    $seatprice9;
    $payment_amount = $seatcounts * $seatprice9;
} else {
    $movieprice8;
    $payment_amount = $seatcounts * $movieprice8;
}
?>

<?php

function generateInvoiceNumber($prefix = '', $uniqueLength = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    $uniquePortion = '';
    for ($i = 0; $i < $uniqueLength; $i++) {
        $uniquePortion .= $characters[rand(0, $charactersLength - 1)];
    }

    $invoiceNumber = $uniquePortion . $prefix;

    return $invoiceNumber;
}


$invoiceNo = generateInvoiceNumber('', 8);


function insertBookingAndSeats($conn, $userID, $movieid, $date, $time, $invoiceNo, $seats, $payment_amount) {
    $bookingInsert = "INSERT INTO `bookings` (`userID`, `movieID`, `show_date`, `show_time`, `invoice_no`) 
                    VALUES ($userID, $movieid, '$date', '$time', '$invoiceNo')";

    if ($conn->query($bookingInsert) === false) {
        $_SESSION['icons'] = "./img/alerticons/error.png";
        $_SESSION['status'] = "error";
        $_SESSION['status_code'] = "Something Error Happened";
        header('Location: ../');
        exit();
    }

    $bookingID = $conn->insert_id;

    $seatNumbers = explode(',', $seats);
    foreach ($seatNumbers as $seatNumber) {
        $seatNumber = trim($seatNumber);
        $seatInsertSql = "INSERT INTO `seats` (`bookingID`, `seat_number`)
                        VALUES ('$bookingID', '$seatNumber')";
        if ($conn->query($seatInsertSql) === false) {
            echo 'Seat Insertion Error: ' . $conn->error;
            exit();
        }
    }
  
    $paymentInsert = "INSERT INTO `payments` (`bookingID`, `payment_amount`)
    VALUES ($bookingID, $payment_amount)";

    if ($conn->query($paymentInsert) === false) {
        echo 'Seat Insertion Error: ' . $conn->error;
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seats'])) {
    if (isset($movieid) && isset($date) && isset($time) && isset($seats)) {
        if (($timeDifferenceInDays <= 2) && !($currenttime > $giventime)) {

            $row = substr($seats, 0, 1);
            
            $checkRowSql = "SELECT COUNT(*) as count FROM seats AS s
            INNER JOIN bookings AS b ON b.bookingID = s.bookingID
            WHERE b.movieID = $movieid AND b.show_date = '$date' AND b.show_time = '$time'
            AND s.status IS NULL";
        
        $checkRowResult = $conn->query($checkRowSql);
        
        if ($checkRowResult) {
            $rowCount = $checkRowResult->fetch_assoc()['count'];
        
            if ($rowCount > 0) {
                $deleteRowsSql = "DELETE FROM seats WHERE bookingID IN (
                    SELECT bookingID FROM bookings
                    WHERE userID = $userID AND movieID = $movieid AND show_date = '$date' AND show_time = '$time'
                )";

                $conn->query($deleteRowsSql);
                
                $deletePaymentSql = "DELETE FROM payments WHERE bookingID IN (
                    SELECT bookingID FROM bookings
                    WHERE userID = $userID AND movieID = $movieid AND show_date = '$date' AND show_time = '$time'
                )";

                $conn->query($deletePaymentSql);

                $deleteBookingSql = "DELETE FROM bookings
                WHERE userID = $userID AND movieID = $movieid AND show_date = '$date' AND show_time = '$time'";

                $conn->query($deleteBookingSql);
                
                insertBookingAndSeats($conn, $userID, $movieid, $date, $time, $invoiceNo, $seats, $payment_amount);
            } else {
                insertBookingAndSeats($conn, $userID, $movieid, $date, $time, $invoiceNo, $seats, $payment_amount);
            }

        }
        
        } else {
            $_SESSION['icons'] = "./img/alerticons/warning.png";
            $_SESSION['status'] = "warning";
            $_SESSION['status_code'] = "Invalid Date";
            header('Location: ./');
            exit();
        }
    } else {
        $_SESSION['icons'] = "./img/alerticons/warning.png";
        $_SESSION['status'] = "warning";
        $_SESSION['status_code'] = "Incomplete Request";
        header('Location: ./');
        exit();
    }
}
?>

<?php

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

if (empty($movieprice)) {
    $seatprice;
    $totalprice = $seatcounts * $seatprice;
} else {
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
                <p><strong>Date:</strong> <?php echo $formatted_date ?></p>
                <p><strong>Time:</strong> <?php echo $formatted_time ?></p>
                <p><strong>Seats:</strong> <?php echo $seats ?></p>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $movieid?>">
        <input type="hidden" name="date" value="<?php echo $date?>">
        <input type="hidden" name="time" value="<?php echo $time?>">
        <input type="hidden" name="seats" value="<?php echo $seats?>">
        <input type="hidden" name="invoice-no" value="<?php echo $invoiceNo?>">
        <div class="right-section">
            <div class="ticket-details">
                <h2>Ticket Details</h2>
                <div class="ticket-price">
                    <p><strong>No of Seats:</strong> <?php echo $seatcounts ?></p>
                    <p><strong>Sub Total:</strong> Rs. <?php echo $totalprice ?></p>
                    <p><strong>Total Amount:</strong> Rs. <?php echo $totalprice ?></p>
                </div>
                <button type="submit" name="reserve">Buy Now</button>
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
        <input value="<?php echo $invoiceNo ?>" name="pid" type="hidden">
        <input value="<?php echo $base_url ?>esewa/esewa_payment_success?q=su" type="hidden" name="su">
        <input value="<?php echo $base_url ?>esewa/esewa_payment_failed?q=fu" type="hidden" name="fu">

    <div class="middle-container">
            <div class="middle-section">
                <div class="payment-section">
                    <h2>Buy Online With:</h2>
                    <div class="payment-options">
                        <input class="img" value="Submit" src="./img/favicons/esewa.png" type="image" id="esewaImage">
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