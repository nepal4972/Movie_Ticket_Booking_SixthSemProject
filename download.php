<?php
$inv = $_GET['inv'];
$ticket = 'Ticket_'.$inv.'.pdf';
$fileUrl = "./tickets/pdfs/$ticket";

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($fileUrl) . '"');
readfile($fileUrl);

header("Location: ./");
?>
