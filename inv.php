<?php
function generateInvoiceNumber($prefix = '', $uniqueLength = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    $uniquePortion = '';
    for ($i = 0; $i < $uniqueLength; $i++) {
        $uniquePortion .= $characters[rand(0, $charactersLength - 1)];
    }

    $invoiceNumber = $uniquePortion . $prefix;

    return $invoiceNumber;
}

// Example usage:
$invoiceNo = generateInvoiceNumber('', 8);
echo $invoiceNo;


?>