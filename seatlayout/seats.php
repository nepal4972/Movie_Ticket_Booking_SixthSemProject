<?php
include '../db/connect.php';
include '../includes/links.php';
include '../includes/loggedin.php';
?>
<script src="../alerts/dist/js/iziToast.min.js"></script>
<?php
$movieid = $_GET['id'];
$date = $_GET['date'];
$time = $_GET['time'];

if(!empty($_GET['id'])) {
// Fetch booked seats from the database for the specific date and time
$bookedSeats = array();
$sql = "SELECT s.seat_number 
        FROM seats AS s
        INNER JOIN bookings AS b ON b.bookingID = s.bookingID
        WHERE b.movieID = $movieid AND b.show_date = '$date' AND b.show_time = '$time' AND s.status = 'booked'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookedSeats[] = $row['seat_number'];
    }
}

// Fetch sold seats from the database for the specific date and time
$soldSeats = array();
$sql = "SELECT s.seat_number 
        FROM seats AS s
        INNER JOIN bookings AS b ON b.bookingID = s.bookingID
        WHERE b.movieID = $movieid AND b.show_date = '$date' AND b.show_time = '$time' AND s.status = 'sold'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $soldSeats[] = $row['seat_number'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="../assets/seats/style.css">
    <title>Seats <?php echo $title ?></title>
</head>

<body>
    <option hidden id="movie" value="10"></option>
    <div class="main">
        <div class="booking-details">
            <h3 class="moviename">Fulbari</h3>
            <span class="booking-date">May 8, 2023&nbsp&nbsp</span><span class="booking-time">12:30 PM</span>
        </div>

        <a onclick="history.back()" id="closeSeats" class="page-close-btn"></a>

        <div class="seat-status">
            <ul>
                <li><span class="available-seat"></span>Available</li>
                <li><span class="booked-seat"></span>Booked</li>
                <li><span class="selected-seat"></span>Selected</li>
                <li><span class="sold-seat"></span>Sold</li>
            </ul>
        </div>

        <div class="all">
            <select hidden id="movie"></select>
            <div class="container">
                <div class="screen">SCREEN</div>
                <div class="row">
                    <?php
                    // Array containing all the seat numbers in your layout
                    $allSeats = [
                        'F1', 'F2', 'F3', 'F4', 'F5', 'F6', 'F7', 'F8',
                        'E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7', 'E8',
                        'D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8',
                        'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8',
                        'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8',
                        'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8',
                    ];

                    $previousRow = null;
                    foreach ($allSeats as $seat) {
                        $row = substr($seat, 0, 1);
                        if ($previousRow !== $row) {
                            if ($previousRow !== null) {
                                echo '</div><div class="row">';
                            }
                            $previousRow = $row;
                        }

                        $seatStatus = '';
                        if (in_array($seat, $bookedSeats)) {
                            $seatStatus = 'booked';
                        } elseif (in_array($seat, $soldSeats)) {
                            $seatStatus = 'sold';
                        }
                        echo '<div class="seat ' . $seatStatus . '" data-value="' . $seat . '">' . $seat . '</div>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="proceed-container">
                <span class="hidden" hidden id="count"></span>
                <div class="total-amount">
                    <h2>Total Rs. <span id="total">0</span></h2>
                </div>
                <h5>
                    <div style="font-size:12px" hidden id="selected-values"></div>
                </h5>
                <button class="proceed-btn" onclick="submitForm()" id="reserver-ticket">Proceed</button>
            </div>
        </div>
        
        <script>
            function submitForm() {
                var divValue = document.getElementById("selected-values").innerHTML;
                var form = document.createElement("form");
                form.setAttribute("method", "POST");
                form.setAttribute("action", "../config/seatprocess.inc?id=<?php echo $movieid ?>&date=<?php echo $date ?>&time=<?php echo $time ?>");
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", "seats");
                hiddenField.setAttribute("value", divValue);
                form.appendChild(hiddenField);
                document.body.appendChild(form);
                form.submit();
            }
        </script>
        <script src="../assets/seats/script.js"></script>
    </div>
</body>
</html>
<?php
} else {
    $_SESSION['icons']="./img/alerticons/warning.png";
    $_SESSION['status']="warning";
    $_SESSION['status_code']="Unauthorized Request";
    header('Location: ../');
    exit;
}
?>