<?php
	$list = array(10, 5, -10, 12);
	echo count($list)."<br/>";
	sort($list)."<br/>";
	print_r($list);
	echo "<br/>";
	rsort($list);
	print_r($list);
	echo "<br/>";
	$array = array(10, 5, -10, 12);
	asort($array);
	print_r($array);
	echo "<br/>";
	arsort($array);
	print_r($array);
	echo "<br/>";
	$array = array('b' => 1, 'a' => 12, 'c' => -10);
	ksort($array);
	print_r($array);
	echo "<br/>";
	krsort($array);
	print_r($array);
	echo "<br/>";
	shuffle($array);
	shuffle($list);
	print_r($array);
	echo "<br/>";
	print_r($list);
	echo "<br/>";
	echo in_array(10, $list)."<br/>";
	echo in_array(1, $list)."<br/>";
	$array1 = array(1, 10);
	$array2 = array(15, 10, 5);
	$array3 = $array1 + $array2;
	print_r($array3);
	echo "<br/>";
	$array3 = array_merge($array1, $array2);
	print_r($array3);
	echo "<br/>";
	$array4 = array(1, 2, 3, 4, 5);
	print_r(array_slice($array4, 1, 3));
	echo "<br/>";
	print_r(array_slice($array4, 1));
	echo "<br/>";
	print_r(array_slice($array4, 0, -2));
	echo "<br/>";
	$array5 = array(3, 4, 3, 3, 10, 5, 7, 8, 7);
	$array6 = array_unique($array5);
	print_r($array6);
	echo "<br/>";
?>
<br/>
<div style="border-top: 3px dotted #00f;"></div>
<br/>
<?php 
	$lenght1 = round(mt_rand(3, 7));
	$lenght2 = round(mt_rand(3, 7));
	$array1 = array();
	$array2 = array();
	for ($i = 0; $i < $lenght1; $i++) { 
		$array1[] = round(mt_rand(10, 20));
	}
	for ($i = 0; $i < $lenght2; $i++) { 
		$array2[] = round(mt_rand(10, 20));
	}
	print_r($array1);
	echo "<br/>";
	print_r($array2);
	echo "<br/>Соединенные массивы:"."<br/>";
	$array3 = array_merge($array1, $array2);
	print_r($array3);
	echo "<br/>Без повторяющихся элементов:"."<br/>";
	$array3 = array_unique($array3);
	print_r($array3);
	echo "<br/>Отсортированный массив:"."<br/>";
	sort($array3);
	print_r($array3);
?>