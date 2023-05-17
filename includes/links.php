<?php
session_start();
$base = $_SERVER['PHP_SELF'];
$page = basename($base, ".php");
?>

<?php
$paramfavicon = $base."img/favicon/favicon.svg";    // Favicon For Custom Page Like Home
$favicon = $base."img/favicons/favicon.svg";
$csspath = $base."assets/css/style.css";
$imglogopath = $base."img/favicons/";
$imgpath = $base."img/"; 
$jspath = $base."assets/js/script.js";
$faviconjspath = $base."assets/js/favicon.js";
$alertcss = $base."alert/style.css";
$alertjs = $base."alert/app.js";
$title = "| Project II";
$includespath = $base."includes";
?>