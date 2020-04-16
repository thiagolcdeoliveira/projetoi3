<?php 

// id=$_GET['id'];
$id = $_GET['id'];
include('../phpqrcode/qrlib.php');
echo 'id';
echo $id;
QRcode::png("http://localhost/chamadosti/upload/scp/tickets.php?id=$id", "QR_code.png");
//("QR_code.png")
// return 'QR_code.png''



//Set the Image source variables
$backgroundSource = "http://www.64bitjungle.com/wp-content/themes/openbook22-en/images/rss-subscribe.jpg";
$feedBurnerStatsSource = "http://feeds2.feedburner.com/~fc/64BitJungle?bg=151515&fg=ffffff&anim=0";
//Create new images
$outputImage = imagecreatefromjpeg($backgroundSource);
$feedBurnerStats = imagecreatefromgif($feedBurnerStatsSource);
//Grab width and height of the FeedBurner image
$feedBurnerStatsX = imagesx($feedBurnerStats);
$feedBurnerStatsY = imagesy($feedBurnerStats);
//Merge the two images
imagecopymerge($outputImage,$feedBurnerStats,156,50,0,0,$feedBurnerStatsX,$feedBurnerStatsY,100);
//Output header
header('Content-type: image/png');
//send new image to browser
imagepng($outputImage);
imagedestroy($outputImage);
?>
<img src="QR_code.png">
