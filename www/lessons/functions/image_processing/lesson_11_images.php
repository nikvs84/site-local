<?php
/*	$info = getimagesize("images/image.jpg");
	// print_r($info);
	// echo "<br/>";
	$im = imageCreateFromJpeg("images/image.jpg");
	// echo "width: ".imagesx($im)."<br/>";
	// echo "height: ".imagesy($im)."<br/>";
	$color = imagecolorat($im, 400, 10);
	// echo "color of pixel: ".$color."<br/>";
	$r = ($color >> 16) & 0xFF;
	$g = ($color >> 8) & 0xFF;
	$b = $color & 0xFF;
	// echo "Color of pixel: rgb($r, $g, $b)"."<br/>";	
	// То же самое, только проще:
	$color = imagecolorsforindex($im, $color);
	// print_r($color);
	// echo "<br/>";
	// Записываем изображение в файл:
	// imagejpeg($im, "images/image new.jpg");
	header("Content-type: image/jpeg;");
	imagejpeg($im);
	imagedestroy($im);
*/
?>

<?php
// echo __FILE__."<br/>";
chdir(dirname(__FILE__));
chdir("../..");
// echo dirname(__FILE__)."<br/>";
	$image = imageCreateFromJpeg("images/image.jpg");
?>

<?php
	if (isset($_GET["x"])) {
		$x = $_GET["x"];
		$y = $_GET["y"];
		$color = imagecolorat($image, $x, $y);
		$rgb = imagecolorsforindex($image, $color);
		// print_r($rgb);
		echo "<br/>";
	}
?>

<form action="../../lessons/image_processing/lesson_11_images.php" method="get">
	X: <select name="x">
		<?php
			for ($i = 0; $i < imagesx($image); $i++) { 
				if (isset($x) && $x == $i)
					echo "<option selected=\"selected\">$i</option>";
				else
					echo "<option>$i</option>";
			}
		?>
	</select>
	Y: <select name="y">
		<?php
			for ($i = 0; $i < imagesy($image); $i++) { 
				if (isset($y) && $y == $i)
					echo "<option selected=\"selected\">$i</option>";
				else
					echo "<option>$i</option>";
			}
		?>
	</select>
	<input type="submit"/>
</form>

<?php
	echo "x = $x"."<br/>";
	echo "y = $y"."<br/>";
	echo "rgb(".$rgb["red"]."; ".$rgb["green"]."; ".$rgb["blue"].")";
	imagedestroy($image);
?>
