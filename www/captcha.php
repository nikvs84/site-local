<?php
	require_once 'lib/config_class.php';
	$config = new Config();
	session_start();
	$rand = mt_rand(1000, 9999);
	$option = mt_rand(0, 1);
	switch ($option) {
		case '0':
			$angle = mt_rand(-30, 30);
			$x = 10;
			$y = 50;
			break;
		case '1':
			$angle = mt_rand(150, 210);
			$x = 80;
			$y = 30;
			break;
		default:
				
			break;
	}
	
	$_SESSION["rand"] = $rand;
	$image = imagecreatetruecolor(90, 80);
	$c = imagecolorallocate($image, 255, 255, 255);
	imagettftext($image, 20, $angle, $x, $y, $c, $config->fonts."verdana.ttf", $rand);
	header("Content-type: image/png");
	imagepng($image);
	imagedestroy($image);
?>