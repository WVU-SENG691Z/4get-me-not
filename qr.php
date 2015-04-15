<?php
// include BarcodeQR class 
include "externals/BarcodeQR/BarcodeQR.php"; 

$event_id = $_GET['event_id'] ? $_GET['event_id'] : "test123";

// set BarcodeQR object 
$qr = new BarcodeQR(); 



// create URL QR code 
$qr->url("http://justinbroussard.com/production/handleQRScan.php?event_id=$event_id"); 

// display new QR code image 
$qr->draw();

?>