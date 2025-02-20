<?php
session_start();
srand((double)microtime() * 1000000);
$im = imagecreate(45, 18);
$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$gray = imagecolorallocate($im, 200, 200, 200);
imagefill($im, 0, 0, $gray);
//session_register("autonum");
$_SESSION["autonum"] = "";
for ($i = 0; $i < 4; $i++) {
	$str = mt_rand(1, 3);
	$size = mt_rand(3, 6);
	$authnum = mt_rand(0, 9);
	$_SESSION["autonum"] .= $authnum;
	imagestring($im, $size, (5 + $i * 10), $str, $authnum,
		imagecolorallocate($im, rand(0, 130), rand(0, 130), rand(0, 130)));
}
for ($i = 0; $i < 200; $i++) {
	$randcolor = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
	imagesetpixel($im, rand() % 70, rand() % 30, $randcolor);
}
imagepng($im);
imagedestroy($im);
?>