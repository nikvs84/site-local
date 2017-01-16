<?/*php
	$str = "This is video"."</br>";
	echo "$str";
	echo strlen($str)."</br>";
	echo strpos($str, "is")."</br>";
	echo strpos($str, "is", 3)."</br>";
	if (strpos($str, "T") === false)
		echo "T не найдено"."</br>";
	else
		echo "T найдено"."</br>";
	echo substr($str, 3)."</br>";
	echo substr($str, 3, 6)."</br>";
	echo substr($str, 3, -3)."</br>";
	echo str_replace("video", "course", $str)."</br>";
	$search = array("is", "video");
	$replace = array("ab", "cd");
	echo str_replace($search, $replace, $str)."</br>";
	$str = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>&Заголовок&</h1>
	</body>
	</html>";
	echo "$str"."</br>";
	echo htmlspecialchars($str)."</br>";
	$str = "ThIs is ViDeO";
	echo strtolower($str)."</br>";
	echo strtoupper($str)."</br>";
	echo strcmp("abc", "Abc")."</br>";
	echo strcmp("abc", "abc")."</br>";
	echo strcmp("Abc", "abc")."</br>";
	echo strcasecmp("Abc", "abc")."</br>";
	echo md5 ("password")."</br>";
	echo md5 ("password")."</br>";
	$str = "Строка";
	echo $str."</br>";
	echo iconv("UTF-8", "CP1251", $str)."</br>";
	echo chr(110)."</br>";
	echo ord("n")."</br>";
	$str = "  string      \n d";
	echo trim($str)."</br>";
	$randomString = "";
	for ($i = 0; $i < 5; $i++) { 
		$randomString = $randomString.chr(mt_rand(32, 150));
	}
	echo "$randomString"."</br>";
	*/
?>

<?php
	if (isset($_POST['password'])) {
		$password = $_POST['password'];
	}
?>

<form name='frm' action='../lessons/lesson_3_strings.php' method='post'>
	Пароль: <input type='text' name='password' value='<?php echo "$password";?>'/>
	<input type='submit' name='send'/>
</form>

<?php
	if (isset($password)) {
		echo "$password"."</br>";
		echo md5($password)."</br>";
	}
?>