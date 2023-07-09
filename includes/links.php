<?php
error_reporting(0);
include '../db/connect.php';
$basetest = $_SERVER['PHP_SELF'];
$base = '/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/';
$page = basename($base, ".php");
?>

<?php
$sql3 = "SELECT * FROM settings";
$stmt3 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt3, $sql3);
mysqli_stmt_execute($stmt3);
$result3 = mysqli_stmt_get_result($stmt3);
$row3 = mysqli_fetch_assoc($result3);
$sitetitle = $row3['site_title'];
$sitelogo = $row3['site_logo'];
$sitefavicon = $row3['site_favicon'];
?>

<?php
$paramfavicon = $base."img/favicon/favicon.svg";    // Favicon For Custom Page Like Home
$favicon = $base.$sitefavicon;
$csspath = $base."assets/loginsignup/css/style.css";
$profilecss = $base."assets/loginsignup/css/profile.css";
$carouselcss = $base."assets/carousel/css/style.css";
$homecss = $base."assets/home/css/style.css";
$imglogopath = $base."img/favicons/";
$bannerpath = $base."img/banners/";
$jspath = $base."assets/loginsignup/js/script.js";
$homejs = $base."assets/home/js/script.js";
$faviconjspath = $base."assets/js/favicon.js";
$alertcss = $base."alerts/dist/css/alert.min.css";
$alertjs = $base."alerts/dist/js/alert.min.js";
$title = "| $sitetitle";
$includespath = $base."includes";
$errorsicon = "http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/img/favicons/error.png";
$errorsindex = "http://localhost/phpcode/test-projects/Movie_Ticket_Booking_SixthSemProject/index";
?>
