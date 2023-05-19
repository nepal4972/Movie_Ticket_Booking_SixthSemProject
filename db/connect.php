<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'sixthsemproject';

$conn = mysqli_connect($host, $user, $password, $db);

if(!$conn) {
    die("Sorry Failed to Connect To Database: ".mysqli_connect_error());
}

?>