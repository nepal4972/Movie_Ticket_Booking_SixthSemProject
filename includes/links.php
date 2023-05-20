<?php
$basetest = $_SERVER['PHP_SELF'];
$base = '/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/';
$page = basename($base, ".php");
?>

<?php
$paramfavicon = $base."img/favicon/favicon.svg";    // Favicon For Custom Page Like Home
$favicon = $base."img/favicons/favicon.svg";
$csspath = $base."assets/loginsignup/css/style.css";
$imglogopath = $base."img/favicons/";
$imgpath = $base."img/"; 
$jspath = $base."assets/loginsignup/js/script.js";
$faviconjspath = $base."assets/js/favicon.js";
$alertcss = $base."alerts/dist/css/alert.min.css";
$alertjs = $base."alerts/dist/js/alert.min.js";
$title = "| Movie Ticket Booking";
$includespath = $base."includes";
$errorsicon = "http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/img/favicons/error.png";
$errorsindex = "http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/index";
?>

<script src="./alerts/dist/js/iziToast.min.js"></script>