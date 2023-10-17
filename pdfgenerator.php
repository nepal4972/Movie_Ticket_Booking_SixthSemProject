<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('img/favicons/bluecinepal.png', 140, 8, 50);
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
$pdf->SetAuthor('Your Name');

$pdf->AddPage();

$pdf->SetFont('Arial', '', 14);

$invoiceNumber = 'Invoice No: INV12345';
$pdf->Cell(0, 10, $invoiceNumber, 0, 1, 'L');

$movieName = "Movie: Avengers: Endgame";
$date = "Date: 2023-10-15";
$time = "Time: 19:00";
$seats = "Seats: A-12, A-13, A-14";
$pdf->MultiCell(0, 10, $movieName . "\n" . $date . "\n" . $time . "\n" . $seats, 0, 'L');

$pdf->Ln(20);

$subtotal = "Subtotal: $150";
$tax = "Tax (10%): $15";
$total = "Total: $165";
$pdf->SetFont('Arial', 'B', 18);
$pdf->MultiCell(0, 12, $subtotal . "\n" . $tax . "\n" . $total, 0, 'R');

$pdfFilePath = 'tickets/pdfs/movie_invoice.pdf';

$pdf->Output($pdfFilePath, 'F');

echo "PDF saved as movie_invoice.pdf in the same folder.";
?>
