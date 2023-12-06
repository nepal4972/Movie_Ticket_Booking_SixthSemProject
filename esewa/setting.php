<?php
session_start();

$userid = $_SESSION['userID'];

$api = "https://uat.esewa.com.np/epay/main";
$tax_price = $totalprice * (13/100);
$ticket_price = ($totalprice - $tax_price -$srv_charge - $del_charge);
$srv_charge = 0;
$del_charge = 0;
$total_amount = $totalprice;
$mer_code = 'EPAYTEST';

?>