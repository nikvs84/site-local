<?php
	/*Квантификаторы повторений*/
	$pattern = "/ab.*c/"; //>=0 раз
	echo preg_match($pattern, "absomesomec")."<br/>";
	echo preg_match($pattern, "abc")."<br/>";

	$pattern = "/ab.c/"; // >=1 раз
	echo preg_match($pattern, "absomesomec")."<br/>";
	echo preg_match($pattern, "abc")."<br/>";

	$pattern = "/ab.?c/"; //0 или 1 раз
	echo preg_match($pattern, "absomesomec")."<br/>";
	echo preg_match($pattern, "abc")."<br/>";
	echo preg_match($pattern, "abRc")."<br/>";

	echo "--------------"."<br/>";

	$pattern1 = "/ab\d{1,2}/"; //интервал количества повторений
	echo preg_match($pattern1, "ab")."<br/>";
	echo preg_match($pattern1, "ab3")."<br/>";
	echo preg_match($pattern1, "ab34")."<br/>";
	echo preg_match($pattern1, "ab345")."<br/>";

	$pattern1 = "/ab\d{2}/"; //конкретное количество повторений
	echo preg_match($pattern1, "ab")."<br/>";
	echo preg_match($pattern1, "ab3")."<br/>";
	echo preg_match($pattern1, "ab34")."<br/>";
	echo preg_match($pattern1, "ab345")."<br/>";

	$pattern1 = "/ab\d{2,}/"; //от n до бесконечности повторений
	echo preg_match($pattern1, "ab")."<br/>";
	echo preg_match($pattern1, "ab3")."<br/>";
	echo preg_match($pattern1, "ab34")."<br/>";
	echo preg_match($pattern1, "ab345")."<br/>";

	/*Мнимые символы*/
	$pattern2 = "/^ab\d{2}$/"; // ^ - начало строки; $ - конец строки
	echo preg_match($pattern2, "ab3")."<br/>";
	echo preg_match($pattern2, "ab34")."<br/>";
	echo preg_match($pattern2, "ab")."<br/>";
	echo preg_match($pattern2, "ab345")."<br/>";
	echo "----------"."<br/>";

	/*Группы*/
	$pattern3 = "/(\d{2})-(\d{2})-(\d{4})/";
	echo preg_match($pattern3, "01-01-1955")."<br/>";

	$pattern4 = "/(\d{2})(-\d{2}$|-\d{4}$)/";
	echo preg_match($pattern4, "01-01-1955")."<br/>";
	echo preg_match($pattern4, "01-01")."<br/>";
	echo preg_match($pattern4, "01-1955")."<br/>";

	$pattern5 = "/(\d{2})-(\d{2})-(\d{4})/";
	echo preg_match_all($pattern5, "01-01-1955", $matches)."<br/>";
	print_r($matches);
	echo "<br/>";
	// echo preg_match($pattern5, "")."<br/>";
	// echo preg_match($pattern5, "")."<br/>";

	$pattern6 = "/.*?(\d+)\D.*/";
	echo "Возраст: ".preg_replace($pattern6, "$1", "буквы... 99 буквы");
?>