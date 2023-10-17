<?php
include '../db/connect.php';
include '../includes/links.php';
include '../includes/loggedin.php';
?>

<?php
$userID = $_SESSION['userID'];

function generateBookingID() {
    return uniqid('booking_', true);
}

if(isset($_POST['id']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['seats']) && isset($_POST['reserve'])) {
    $movieid = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $seats = $_POST['seats'];

    $formatted_date = date('F j, Y', strtotime($date));
    $formatted_time = date("h:i A", strtotime($time));

    $sql8 = "SELECT * FROM movies WHERE movieID = $movieid";
    $result8 = $conn->query($sql8);
    $row8 = $result8->fetch_assoc();

    $sql9 = "SELECT * FROM settings WHERE settingID = '1'";
    $result9 = $conn->query($sql9);
    $row9 = $result9->fetch_assoc();

    $explodedseats = explode(',', $seats);
    $seatcounts = count($explodedseats);

    $movieprice = $row8['movie_price'];
    $seatprice = $row9['seat_price'];

    if(empty($row8['movie_price'])) {
        $totalprice = $seatcounts * $seatprice;
    }
    else {
        $totalprice = $seatcounts * $movieprice;
    }

    $datestamp = strtotime($date);
    $formatteddate = date('F j, Y', $datestamp);

    date_default_timezone_set('Asia/Kathmandu');
    $currentdate = date('Y-m-d');

    $giventime = strtotime($date);
    $currenttime = strtotime($currentdate);

    $timeDifferenceInDays = floor(($datestamp - strtotime($currentdate)) / (60 * 60 * 24));

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

    if(($timeDifferenceInDays <= 2) && !($currenttime > $giventime)) {

        $bookingID = generateBookingID();

        $row = substr($seats, 0, 1);
        
        $checkRowSql = "SELECT COUNT(*) as count FROM seats AS s
        INNER JOIN bookings AS b ON b.bookingID = s.bookingID
        WHERE b.movieID = $movieid AND b.show_date = '$date' AND b.show_time = '$time'
        AND s.seat_number = '$row' AND (s.status = 'booked' OR s.status = 'sold')";

        $result = $conn->query($checkRowSql);
        
        if ($result === false) {
            echo 'SQL Error: ' . mysqli_error($conn);
            exit();
        }
        
        $row = $result->fetch_assoc();
        $seatCount = $row['count'];

        $download = 'Ticket_'.$invoiceNo.'.pdf';
        
        if ($seatCount > 0) {

        } else {
            $bookingInsertSql = "INSERT INTO `bookings` (`bookingID`, `userID`, `movieID`, `seats`, `show_date`, `show_time`, `invoice_no`, `ticket`) 
            VALUES ('$bookingID', $userID, $movieid, '$seats', '$date', '$time', '$invoiceNo', '$download')";

            if ($conn->query($bookingInsertSql) === false) {
                $_SESSION['icons']="./img/alerticons/error.png";
                $_SESSION['status']="error";
                $_SESSION['status_code']="Error Inserting Booking Data";
                header('Location: ../');
                exit();
            }
        
            $bookingID = $conn->insert_id;
            $seatNumbers = explode(',', $seats);
            foreach ($seatNumbers as $seatNumber) {
                $seatNumber = trim($seatNumber);
                $seatInsertSql = "INSERT INTO `seats` (`bookingID`, `seat_number`, `status`)
                                VALUES ('$bookingID', '$seatNumber', 'booked')";
                if ($conn->query($seatInsertSql) === false) {
                    $_SESSION['icons']="./img/alerticons/error.png";
                    $_SESSION['status']="error";
                    $_SESSION['status_code']="Error Inserting Seats Data";
                    header('Location: ../');
                    exit();
                }
            }

            require('../fpdf/fpdf.php');

            class PDF extends FPDF {
                function Header() {
                    $this->Image('../img/favicons/bluecinepal.png', 140, 8, 50);
                    $this->SetFont('Arial', 'B', 24);
                    $this->Ln(25);
                    $this->SetLineWidth(0.5);
                    $this->Line(10, $this->GetY(), 200, $this->GetY());
                }

                function Footer() {
                    $this->SetY(-15);
                    $this->SetFont('Arial', 'I', 8);
                    $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
                }
            }

            $pdf = new PDF();

            $pdf->SetTitle('Movie Invoice');
            $pdf->SetAuthor('Saugat Nepal');

            $pdf->AddPage();

            $pdf->SetFont('Arial', '', 14);

            $invoiceNumber = "Invoice No: $invoiceNo";
            $pdf->Cell(0, 10, $invoiceNumber, 0, 1, 'L');

            $movieName = 'Movie: '.$row8['movie_name'];
            $date = 'Date: '.$formatted_date;
            $time = 'Time: '.$formatted_time ;
            $seats = 'Seats: '.$seats;
            $pdf->MultiCell(0, 10, $movieName . "\n" . $date . "\n" . $time . "\n" . $seats, 0, 'L');

            $pdf->Ln(20);

            $subtotal = 'Subtotal: Rs.'.$totalprice;
            $total = 'Total: Rs.'.$totalprice;
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->MultiCell(0, 12, $subtotal . "\n" . $total, 0, 'R');

            $pdfFilePath = '../tickets/pdfs/Ticket_'.$invoiceNo.'.pdf';

            $pdf->Output($pdfFilePath, 'F');

            $_SESSION['icons']="./img/alerticons/success.png";
            $_SESSION['status']="success";
            $_SESSION['status_code']="Selected Seats Booked Successfully";
            header('Location: ../');
            exit;
        }
    } else {
        $_SESSION['icons']="./img/alerticons/warning.png";
        $_SESSION['status']="warning";
        $_SESSION['status_code']="Invalid Date";
        header('Location: ../');
        exit();
    }
    } else {
    $_SESSION['icons']="./img/alerticons/warning.png";
    $_SESSION['status']="warning";
    $_SESSION['status_code']="Incomplete Request";
    header('Location: ../');
    exit();
}
?>