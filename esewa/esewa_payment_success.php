<?php
error_reporting(0);
include '../db/connect.php';
include '../includes/links.php';

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
    if($responseCode == 'Success') {
        header("Location: success.php");
    }
    else {
        header("Location: esewa_payment_failed");
    }
}
?>