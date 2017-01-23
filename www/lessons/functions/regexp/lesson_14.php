<?php
	// $reg = "/th/";
	// $string = "Something string 123 string";
	// echo preg_match($reg, $string)."<br/>";
	// $reg1 = "/S.m/";
	// echo preg_match($reg1, $string)."<br/>";
	// $reg2 = "/S.t/";
	// echo preg_match($reg2, $string)."<br/>";

	// /*Символы классы*/
	// $reg3 = "/\sab\Scd\w\W\d ab \D/";
	// echo preg_match($reg3, "some\nab9cd9/0 ab X some")."<br/>";

	// echo "------------"."<br/>";

	// /**Альтернативы*/
	// $reg4 = "/a[012]b/";
	// echo preg_match($reg4, "a0b")."<br/>";
	// echo preg_match($reg4, "a1b")."<br/>";
	// echo preg_match($reg4, "abb")."<br/>";

	// $reg5 = "/a[a-z]b/";
	// echo preg_match($reg5, "aab")."<br/>";
	// echo preg_match($reg5, "aAb")."<br/>";

	// echo "------------"."<br/>";

	// /*Отрицание*/
	// $reg6 = "/a[^012]b/";
	// echo preg_match($reg6, "a4b")."<br/>";
	// echo preg_match($reg6, "a1b")."<br/>";

	// echo "------------"."<br/>";

	// /*Вывод спецсимволов*/
	// $reg7 = "/a\/b\\\c\./";
	// echo preg_match($reg7, "a/b\\c.")."<br/>";
?>

<?php
	if (isset($_GET["date"])) {
		$date = $_GET["date"];
		$pattern = "/[01]\d\.[0-3]\d\.\d{4}/";
	}
?>

<form action="#" method="get">
	Input date: <input type="text" name="date"/>
	<input type="submit">
</form>

<?php
	if (isset($pattern)) {
		if (preg_match($pattern, $date)) {
			echo "OK :-)"."<br/>";
		} else
			echo "ERROR!"."<br/>";
	}
?>

