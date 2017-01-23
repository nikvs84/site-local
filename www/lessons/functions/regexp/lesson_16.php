<?php
	/*Модификаторы*/
	$pattern = "/ab.*c/";
	echo preg_match($pattern, "abcc")."<br/>";
	echo preg_match($pattern, "ABcc")."<br/>";

	$pattern = "/ab.*c/i";
	echo preg_match($pattern, "abcc")."<br/>";
	echo preg_match($pattern, "ABcc")."<br/>";

	echo "-------------------"."<br/>";

	$pattern = "/a b c/";
	echo preg_match($pattern, "a b c")."<br/>";
	echo preg_match($pattern, "abc")."<br/>";

	$pattern = "/a b c/x";
	echo preg_match($pattern, "a b c")."<br/>";
	echo preg_match($pattern, "abc")."<br/>";

	echo "--------------------"."<br/>";

	$pattern = "/^\d/s"; // модификатор s применяется по умолчанию и означает одностроковый поиск соответствия
	echo preg_match($pattern, "string\r\n9")."<br/>";
	$pattern = "/^\d/m";
	echo preg_match($pattern, "string\r\n9")."<br/>";

	echo "--------------------"."<br/>";

	$text = "Всем привет! mysite@site.ru, пишите мне на почту mysite@site.ru";

	function replaseEmail($text) {
		$pattern = "/[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
		return preg_replace($pattern, "<b>тут был email</b>", $text);
	}

	echo replaseEmail($text);
?>