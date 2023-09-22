<?php

// Sample show details
$userID = 1;
$movieID = 1;
$date = "2023-07-15";
$time = "15:30";
$randomPart = rand(1000, 9999);
$timestamp = time();

$invoiceNumber = "$movieID$timestamp$randomPart$userID";

echo "Generated Invoice Number: $invoiceNumber";
?>
