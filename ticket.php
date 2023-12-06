<?php
include './db/connect.php';
include './includes/links.php';
include './includes/loggedin.php';
?>
<script src="./alerts/dist/js/iziToast.min.js"></script>
<?php
$userID = $_SESSION['userID'];
?>
<?php
$sql1 = "SELECT b.*, u.*, m.*, p.*
FROM bookings AS b
INNER JOIN users AS u ON b.userID = u.userID
INNER JOIN movies AS m ON b.movieID = m.movieID
LEFT JOIN payments AS p ON b.bookingID = p.bookingID
WHERE (b.show_date > CURDATE() OR (b.show_date = CURDATE() AND b.show_time > CURTIME()))
AND u.userID = $userID AND b.ticket IS NOT NULL ORDER BY booked_date DESC";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
$row_count = $result1->num_rows;
?>
<?php
$sql2 = "SELECT b.*, u.*, m.*, p.*
FROM bookings AS b
INNER JOIN users AS u ON b.userID = u.userID
INNER JOIN movies AS m ON b.movieID = m.movieID
LEFT JOIN payments AS p ON b.bookingID = p.bookingID
WHERE (b.show_date < CURDATE() OR (b.show_date = CURDATE() AND b.show_time < CURTIME()))
AND u.userID = $userID AND b.ticket IS NOT NULL ORDER BY booked_date DESC";


$stmt2 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$row_count1 = $result2->num_rows;
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
    <link rel="stylesheet" href="./alerts/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="./admin/assets/css/style.css">
    <title>My Tickets <?php echo $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #001242;
        }
        .container {
            background-color: #001242;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #001242;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .page-content {
            background-color: #e9edf2;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .toggle-button {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .toggle-button:hover {
            background-color: #ff595a;
        }
        .records-table {
            width: 100%;
            border-collapse: collapse;
        }

        .records-table th, .records-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .records-table th {
            background-color: #ff595a;
            color: #fff;
        }
        .records-table td img {
            max-width: 100px;
            height: auto;
        }
        .section-title {
            background-color: #0056b3;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 24px;
            color: #fff;
        }
        .button-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: #0056b3;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.button-link:hover {
    background-color: #ff595a;
}

.button-link ion-icon {
    vertical-align: middle;
    margin-left: 5px;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>My Tickets</h1>
        </div>
        <div class="page-content">
            <button id="toggle-section" class="toggle-button">Active / Expired</button>
            <div class="section" id="active-section">
    <h2 class="section-title">Active Tickets <span style="font-size:12px; color:#ff595a;">(Recent Booked Tickets are at Top)</span></h2>
    <?php
    if ($row_count >= 1) {
    ?>
    <table class="records-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Movie Name</th>
                <th>Show Date/time</th>
                <th>Seats</th>
                <th>Booked Date</th>
                <th>Total Amount</th>
                <th>Payment Status</th>
                <th>Download Ticket</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $showingcount = 1;
            while($row1 = mysqli_fetch_assoc($result1)) {
            ?>
            
            <tr>
                <td>#<?php echo $showingcount ?></td>
                <td><?php echo $row1['movie_name'] ?></td>
                <td>
                    <div class="client">
                        <div class="client-info">
                            <h4 style="margin-bottom: 6px;"><?php echo date("F d, Y", strtotime($row1['show_date'])) ?></h4>    
                            <small style="font-size:16px;"><?php echo date("h:i A", strtotime($row1['show_time'])) ?></small>
                        </div>
                    </div>
                    </td>
                <td>
                    <?php $bookingID = $row1['bookingID']?>
                    <?php $seatNumbers = fetchSeatNumbers($conn, $bookingID);?>
                    <?php echo $seatNumbers ?>
                </td>
                <td><?php echo date("F d, Y", strtotime($row1['booked_date'])) ?></td>
                <td>Rs. <?php echo number_format($row1['payment_amount'], 0) ?></td>
                <td><?php echo $row1['payment_status'] ?></td>
                <td>
                <a href="./tickets/pdfs/<?php echo $row1['ticket']?>" class="button-link">
                    Download Ticket
                    <ion-icon name="cloud-download-outline"></ion-icon>
                </a>
                </td>
            </tr>
            <?php
            $showingcount++;
            }
            ?>
        </tbody>
    </table>
    <?php
    } else {
        echo "No active tickets found.";
    }
    ?>
</div>

    <div class="section" id="expired-section" style="display: none;">
        <h2 class="section-title">Expired Tickets</h2>
        <?php
            if ($row_count1 >= 1) {
        ?>
        <table class="records-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Movie Name</th>
                    <th>Show Date/time</th>
                    <th>Seats</th>
                    <th>Booked Date</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                    <th>Download Ticket</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $upcount = 1;
                while($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                <tr>
                    <td>#<?php echo $upcount ?></td>
                    <td><?php echo $row2['movie_name'] ?></td>
                    <td>
                    <div class="client">
                        <div class="client-info">
                            <h4 style="margin-bottom: 6px;"><?php echo date("F d, Y", strtotime($row2['show_date'])) ?></h4>    
                            <small style="font-size:16px;"><?php echo date("h:i A", strtotime($row2['show_time'])) ?></small>
                        </div>
                    </div>
                    </td>
                    <td>
                        <?php $bookingID = $row2['bookingID']?>
                        <?php $seatNumbers = fetchSeatNumbers($conn, $bookingID);?>
                        <?php echo $seatNumbers ?>
                    </td>
                    <td><?php echo date("F d, Y", strtotime($row2['booked_date'])) ?></td>
                    <td>Rs. <?php echo number_format($row2['payment_amount'], 0) ?></td>
                    <td><?php echo $row2['payment_status'] ?></td>
                    <td>
                    <a href="./tickets/pdfs/<?php echo $row2['ticket']?>" class="button-link">
                        Download Ticket
                        <ion-icon name="cloud-download-outline"></ion-icon>
                    </a>
                    </td>
                </tr>
                <?php
                $upcount++;
                }
                ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "No Expired tickets found.";
        }
        ?>
    </div>
    </div>
    </div>
    <script>
        document.getElementById("toggle-section").addEventListener("click", function() {
            const activeSection = document.getElementById("active-section");
            const expiredSection = document.getElementById("expired-section");
            if (activeSection.style.display === "none") {
                activeSection.style.display = "block";
                expiredSection.style.display = "none";
            } else {
                activeSection.style.display = "none";
                expiredSection.style.display = "block";
            }
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
