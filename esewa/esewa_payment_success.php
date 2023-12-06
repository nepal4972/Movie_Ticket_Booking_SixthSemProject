<?php
include '../db/connect.php';
include '../includes/links.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../mail/Exception.php';
require '../mail/PHPMailer.php';
require '../mail/SMTP.php';



if(isset($_REQUEST['oid']) && isset($_REQUEST['amt']) && isset($_REQUEST['refId'])) {
    $url = "https://uat.esewa.com.np/epay/transrec";
    $data =[
    'amt'=> $_REQUEST['amt'],
    'rid'=> $_REQUEST['refId'],
    'pid'=> $_REQUEST['oid'],
    'scd'=> 'EPAYTEST'
    ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    
    $xmlResponse = '<response><response_code>Success</response_code></response>';
    $xml = simplexml_load_string($xmlResponse);
    $responseCode = (string)$xml->response_code;

    $userID = $_SESSION['userID'];

    $sendingemail = $_SESSION['email'];
    
    $get_amt = $_GET['amt'];
    $amt = intval($get_amt);
    $refID = $_GET['refId'];
    $oid = $_GET['oid'];

    $download = 'Ticket_'.$oid.'.pdf';
    $newStatus = 'sold';
    $pay_method = 'esewa';
    $pay_status = 'paid';


    if($responseCode == 'Success') {

        $updateBookingQuery = "UPDATE bookings SET ticket = '$download' WHERE invoice_no = '$oid'";
        if ($conn->query($updateBookingQuery) === FALSE) {
            $_SESSION['icons']="./img/alerticons/error.png";
            $_SESSION['status']="error";
            $_SESSION['status_code']="Some Thing Went Wrong. Please Try Again"; 
            header('Location: ../');
        }

        $getBookingIDQuery = "SELECT bookingID FROM bookings WHERE invoice_no = '$oid'";
        $bookresult = $conn->query($getBookingIDQuery);
        if ($result9 === FALSE) {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Some Thing Went Wrong. Please Try Again";
            header('Location: ../');
            exit();
        }
        $bookrow = $bookresult->fetch_assoc();
        $bookingID = $bookrow['bookingID'];


        $updateSeatsQuery = "UPDATE seats SET status = '$newStatus' WHERE bookingID = '$bookingID'";
        if ($conn->query($updateSeatsQuery) === False) {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Some Thing Went Wrong. Please Try Again";
            header('Location: ../');
            exit();
        }

        $updatePaymentQuery = "UPDATE payments SET payment_method = '$pay_method', payment_status = '$pay_status', reference_code = '$refID' WHERE bookingID = '$bookingID'";
        if ($conn->query($updatePaymentQuery) === False) {
            $_SESSION['icons'] = "./img/alerticons/error.png";
            $_SESSION['status'] = "error";
            $_SESSION['status_code'] = "Some Thing Went Wrong. Please Try Again";
            header('Location: ../');
            exit();
        }

        function fetchSeatNumbers($conn, $bookingID) {
            $seatNumbers = array();
            $sql8 = "SELECT seat_number FROM seats WHERE bookingID = $bookingID";
            $result8 = mysqli_query($conn, $sql8);
            while ($row8 = mysqli_fetch_assoc($result8)) {
                $seatNumbers[] = $row8['seat_number'];
            }
            return implode(', ', $seatNumbers);
        }

        $seatNumbers = fetchSeatNumbers($conn, $bookingID);

        $sql = "SELECT b.*, p.* FROM bookings AS b
        JOIN seats AS s ON b.bookingID = s.bookingID
        JOIN payments AS p ON b.bookingID = p.bookingID
        WHERE b.bookingID = '$bookingID' GROUP BY b.bookingID";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        $date = $row['show_date'];
        $time = $row['show_time'];
        $seats = $seatNumbers;
        $movieID = $row['movieID'];

        $moviefetch = "SELECT movie_name FROM movies WHERE movieID = '$movieID'";
        $movieresult = $conn->query($moviefetch);
        $movie_row = $movieresult->fetch_assoc();
        $movie_name = $movie_row['movie_name'];

        $formatted_date = date('F j, Y', strtotime($date));
        $formatted_time = date("h:i A", strtotime($time));

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

            $invoiceNumber = "Invoice No: $oid";
            $pdf->Cell(0, 10, $invoiceNumber, 0, 1, 'L');
            $payment = 'Paid(esewa)';

            $movieName = 'Movie: '.$movie_name;
            $date = 'Date: '.$formatted_date;
            $time = 'Time: '.$formatted_time ;
            $seats = 'Seats: '.$seats;
            $pdf->MultiCell(0, 10, $movieName . "\n" . $date . "\n" . $time . "\n" . $seats, 0, 'L');

            $pdf->Ln(20);

            $subtotal = 'Subtotal: Rs.'.$amt;
            $total = 'Total: Rs.'.$amt;
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->MultiCell(0, 12, $subtotal . "\n" . $total, 0, 'R');

            $pdfFilePath = '../tickets/pdfs/Ticket_'.$oid.'.pdf';

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
                                    <p style="padding-bottom: 16px"><a href="http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/tickets/pdfs/Ticket_'.$oid.'.pdf" target="_blank"
                                        style="padding: 12px 24px; border-radius: 4px; color: #FFF; background: #2B52F5;display: inline-block;margin: 0.5rem 0;">Download Your Ticket</a></p>
                                    <p style="padding-bottom: 16px">You can also downloadyour ticket from my ticket page in menu.</p>
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
        header("Location: esewa_payment_failed");
    }
}
?>