<?php
/*	$image = imagecreatetruecolor(400, 500);
	$white = imagecolorallocate($image, 255, 255, 255);
	$color1 = imagecolorallocate($image, 0, 0, 0);
	imagefilledrectangle($image, 0, 0, imagesx($image), imagesy($image), $white);


	$string1 = "Михаил Русаков";
	$string2 = "MyRusakov.ru";

	imagestring($image, 5, 10, 20, $string2, $color1);
	imagestring($image, 5, 10, 60, $string1, $color1);
	// здесь можно при необходимости менять кодировку символов iconv(string)
	imagettftext($image, 20, 0, 10, 130, $color1, "fonts/verdana.ttf", $string1);

	imagepng($image, "images/image3.png");
	imagedestroy($image);

	// captcha
	$image2 = imagecreatetruecolor(90, 50);
	$rand = mt_rand(1000, 9999);
	$color2 = imagecolorallocate($image2, 255, 255, 255);
	imagettftext($image2, 20, -10, 10, 30, $color2, "fonts/verdana.ttf", $rand);
	
	imagepng($image2, "images/captcha.png");
	imagedestroy($image2);
	*/
?>

<!--<div style="background-color: #000; text-align: center; padding: 5px;">
	<img src="images/image3.png" alt="image3"/>
	<img src="images/captcha.png" alt="captcha"/>
</div>-->

<?php
	if (isset($_POST["message"])) {
		$message = $_POST["message"];
		$message = iconv("CP1251", "UTF-8", $message);
		$image = imagecreatetruecolor(320, 180);
		$white = imagecolorallocate($image, 255, 255, 255);
		$color = imagecolorallocate($image, 0, 0, 255);
		imagefilledrectangle($image, 0, 0, imagesx($image), imagesy($image), $white);
		$font_size = 40;
		imagettftext($image, $font_size, 0, imagesx($image) / 8, imagesy($image) / 8 + $font_size, $color, "fonts/verdana.ttf", $message);
		imagepng($image, "images/image4.png");
		imagedestroy($image);
	}
?>

<form action="#" method="post">
	<textarea name="message" cols="30" rows="10"></textarea>
	<input type="submit"/>
	<div style="background-color: #ccc; padding: 5px; width: 320px;">
		<?php
			if (file_exists("images/image4.png"))
				echo "<img src=\"images/image4.png\" alt=\"image4\"/>";
		?>
	</div>
</form>