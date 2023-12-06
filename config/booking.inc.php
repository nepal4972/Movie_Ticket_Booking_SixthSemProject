<?php
include '../db/connect.php';
include '../includes/links.php';
include '../includes/loggedin.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../mail/Exception.php';
require '../mail/PHPMailer.php';
require '../mail/SMTP.php';
?>

<?php
$userID = $_SESSION['userID'];
$sendingemail = $_SESSION['email'];

$movieid = $_POST['id'];
$date = $_POST['date'];
$time = $_POST['time'];
$seats = $_POST['seats'];
$invoiceNo = $_POST['invoice-no'];

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


if(isset($_POST['id']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['seats']) && isset($_POST['reserve'])) {
    
    $download = 'Ticket_'.$invoiceNo.'.pdf';
    $newStatus = 'booked';

    $updateBookingQuery = "UPDATE bookings SET ticket = '$download' WHERE invoice_no = '$invoiceNo'";
    if ($conn->query($updateBookingQuery) === FALSE) {
        $_SESSION['icons']="./img/alerticons/error.png";
        $_SESSION['status']="error";
        $_SESSION['status_code']="Some Thing Went Wrong. Please Try Again";
        header('Location: ../');
    }

    $getBookingIDQuery = "SELECT bookingID FROM bookings WHERE invoice_no = '$invoiceNo'";
    $bookresult = $conn->query($getBookingIDQuery);

    if ($result9 === FALSE) {
        $_SESSION['icons'] = "./img/alerticons/error.png";
        $_SESSION['status'] = "error";
        $_SESSION['status_code'] = "Some Thing Went Wrong. Please Try Again";
        header('Location: ../');
        exit();
    }

    $bookrow = $bookresult->fetch_assoc();
    $bookingID1 = $bookrow['bookingID'];

    $updateSeatsQuery = "UPDATE seats SET status = '$newStatus' WHERE bookingID = '$bookingID1'";

    if ($conn->query($updateSeatsQuery) === False) {
        $_SESSION['icons'] = "./img/alerticons/error.png";
        $_SESSION['status'] = "error";
        $_SESSION['status_code'] = "Some Thing Went Wrong. Please Try Again";
        header('Location: ../');
        exit();
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
            $payment = 'UnPaid';

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

            
            try {
                $mail = new PHPMailer(true);
        
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'nepal4972@gmail.com'; // Replace with your email
                $mail->Password = 'rcobdwyowrcrhxwe'; // Replace with your email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                $mail->SMTPDebug = 0;
        
                // Recipients
                $mail->setFrom('nepal4972@gmail.com', 'mail@cinepal'); // Replace with your name and email
                $mail->addAddress($sendingemail); // Replace with the recipient's email
        
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Booking Successfull';
                $mail->Body = '<head>
                <title>Movie Booking Successfull</title>
                <!--[if mso]><style type="text/css">body, table, td, a { font-family: Arial, Helvetica, sans-serif !important; }</style><![endif]>
              </head>  
              <body style="font-family: Helvetica, Arial, sans-serif; margin: 0px; padding: 0px; background-color: #ffffff;">
                <table role="presentation"
                  style="width: 100%; border-collapse: collapse; border: 0px; border-spacing: 0px; font-family: Arial, Helvetica, sans-serif; background-color: rgb(239, 239, 239);">
                  <tbody>
                    <tr>
                      <td align="center" style="padding: 1rem 2rem; vertical-align: top; width: 100%;">
                        <table role="presentation" style="max-width: 600px; border-collapse: collapse; border: 0px; border-spacing: 0px; text-align: left;">
                          <tbody>
                            <tr>
                              <td style="padding: 40px 0px 0px;">
                                <div style="text-align: center;">
                                  <div style="padding-bottom: 20px;"><img src="https://saugat-nepal.com.np/assets/img/image-2.png" alt="Company" style="width: 180px;"></div>
                                </div>
                                <div style="padding: 20px; background-color: rgb(255, 255, 255);">
                                  <div style="color: rgb(0, 0, 0); text-align: left;">
                                    <h1 style="margin: 1rem 0">Download Your Ticket.</h1>
                                    <p style="padding-bottom: 16px">We have received a movie booking request and your booking has done.</p>
                                    <p style="padding-bottom: 16px"><a href="http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/tickets/pdfs/Ticket_'.$invoiceNo.'.pdf" target="_blank"
                                        style="padding: 12px 24px; border-radius: 4px; color: #FFF; background: #2B52F5;display: inline-block;margin: 0.5rem 0;">Download Your Ticket</a></p>
                                    <p style="padding-bottom: 16px">You can also download your ticket from my ticket page in menu.</p>
                                    <p style="padding-bottom: 16px">Thanks,<br>The Cinepal Team</p>
                                  </div>
                                </div>
                                <div style="padding-top: 20px; color: rgb(153, 153, 153); text-align: center;">
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </body></html>';
        
                $mail->send();
                echo 'Email has been sent successfully';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


            header("Location: ../success.php");
            exit();
        
    }
    else {
    $_SESSION['icons']="./img/alerticons/warning.png";
    $_SESSION['status']="warning";
    $_SESSION['status_code']="Incomplete Request";
    header('Location: ../');
    exit();
}
?>