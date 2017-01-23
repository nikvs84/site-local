<?php
	$array1 = parse_ini_file("config.ini", true);
	$array2 = parse_ini_file("config.ini");
	print_r($array1);
	echo "<br/>";
	print_r($array2)."<br/>";
	echo "<br/>";
	echo "Кодировка: ".$array1["Main Settings"]["charset"]."<br/>";
	echo "Кодировка: ".$array2["charset"]."<br/>";
?>
<div style="color: <?php echo $array2["color"]; ?>; font-size: <?php echo $array2["font-size"]; ?>;">
	color: #f0f; font-size: 120%;
</div>