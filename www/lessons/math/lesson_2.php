<?php
	echo M_PI."<br/>";
	echo M_E."<br/>";
	$x = -15;
	echo abs($x)."<br/>";
	$x = 59.53921;
	echo round($x)."<br/>";
	echo round($x, 2)."<br/>";
	echo ceil($x)."<br/>";
	echo floor($x)."<br/>";
	echo mt_rand(0, 10)."<br/>";
	echo min(0, 3, -5, -10, 9, 15)."<br/>";
	echo max(0, 3, -5, -10, 9, 15)."<br/>";
	$x = 1;
	echo sin($x)."<br/>";
	echo cos($x)."<br/>";
	echo tan($x)."<br/>";
	echo 1 / tan($x)."<br/>";
	echo asin($x)."<br/>";
	echo acos($x)."<br/>";
	echo atan($x)."<br/>";
	echo M_PI / 2 - atan($x)."<br/>";
	$array = array();
	for ($i = 0; $i < 10; $i++) { 
		$array[] = mt_rand(10, 100);
	}
	print_r($array);
	echo "<br/>";

	for ($i = 0; $i < 10; $i++) { 
		$array[$i] = sin($array[$i]);
	}
	print_r($array);
	echo "<br/>";

	for ($i = 0; $i < 10; $i++) { 
		$array[$i] = round($array[$i], 2);
	}
	print_r($array);
	echo "<br/>";	
?>