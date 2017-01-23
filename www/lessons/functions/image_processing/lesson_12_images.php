<?php
	$image = imageCreateTrueColor(400, 500);
	$color = imageColorAllocate($image, 120, 220, 100);
	
	imageline($image, 0, 0, imagesx($image), imagesy($image), $color);
	imageline($image, 0, imagesy($image), imagesx($image), 0, $color);

	imagefilledrectangle($image, 100, 200, 300, 400, $color);

	$color2 = imageColorAllocate($image, 255, 255, 255);

	imagesetthickness($image, 5); // толщина линии
	imagerectangle($image, 99, 199, 301, 401, $color2);

	$color3 = imageColorAllocate($image, 255, 0, 0);
	imageRectangle($image, 95, 196, 305, 404, $color3);

	imagesetthickness($image, 2);
	imagearc($image, 20, 30, 200, 300, 0, 30, $color3); // дуга

	imagearc($image, 40, 300, 50, 50, 0, 360, $color2);

	$color4 = imageColorAllocate($image, 255, 255, 0);
	imagefill($image, 45, 305, $color4); // заливка цветом

	imagearc($image, 240, 80, 150, 100, 0, 360, $color4);
	$texture = imagecreatefromjpeg("images/texture.jpg");
	imagesettile($image, $texture);// заливка текстурой
	imagefill($image, 245, 85, IMG_COLOR_TILED); // для заливки текстурой нужно установить параметр IMG_COLOR_TILED

	// Многоугольник
	$array = array(10, 20, 30, 40, 59, 39, 10, 70);
	imagefilledpolygon($image, $array, 4, $color4); // с заливкой цветом
	$array2 = array(40, 50, 60, 70, 89, 69, 40, 100);
	imagefilledpolygon($image, $array2, 4, IMG_COLOR_TILED); // с заливкой текстурой

	// точка
	for ($i = 0; $i < 1000; $i++) { 
		$x = mt_rand(0, imagesx($image));
		$y = mt_rand(0, imagesy($image));
		imagesetpixel($image, $x, $y, $color2);
	}
	
	// копировать кусок изображение и вставить в другое
	$new_image = imageCreateTrueColor(100, 200);
	imagecopyresized($new_image, $image, 0, 0, 50, 50, imagesx($new_image), imagesy($new_image), 70, 70);


	// график фугкции y = cos(x), x = [0; 3*PI
	$cosinus = imagecreatetruecolor(700, 200);
	imagefill($cosinus, 0, 0, $color2);
	imageline($cosinus, 20, 100, 680, 100, $color);
	imageline($cosinus, 40, 20, 40, 180, $color);
	for ($i = 40; $i < 680; $i++) { 
		$point = (3 * M_PI - 0) / (680 - 40);
		$arg = $point * ($i - 40);
		$cos = - round(cos($arg) / $point) + 100;
		imagesetpixel($cosinus, $i, $cos, $color3);
	}

	// человечек :-)
		//голова
		imagearc($cosinus, 200, 10, 20, 20, 0, 0, $color3);
		//туловище;
		imageline($cosinus, 191, 16, 160, 45, $color3);
		//ноги
		imageline($cosinus, 160, 45, 105, 55, $color3);
		imageline($cosinus, 160, 45, 150, 100, $color3);
		//руки
		imageline($cosinus, 185, 22, 145, 20, $color3);
		imageline($cosinus, 185, 22, 175, 55, $color3);

	// if (!file_exists("images/image1.png"))
	imagepng($image, "images/image1.png");
	imagepng($new_image, "images/image2.png");
	imagepng($cosinus, "images/cosinus.png");
	imagedestroy($image);
	imagedestroy($texture);
	imagedestroy($new_image);
	imagedestroy($cosinus);
?>

<div>
	<img src="images/image1.png" alt="image1"/>
	<img src="images/image2.png" alt="image1"/>
	<img src="images/cosinus.png" alt="image1"/>
</div>