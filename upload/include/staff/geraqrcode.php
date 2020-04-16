<?php 
id=$_GET['id'];
include('phpqrcode/qrlib.php');
QRcode::png("http://www.botecodigital.info", "QR_code.png");
$ch = curl_init($url);

	$fp = fopen('QR_code.png', 'wb');

	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
?>