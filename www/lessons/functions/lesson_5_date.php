<?php 
/*	$start = microtime(true);
	echo time()."<br/>";
	echo microtime()."<br/>";
	echo microtime(true)."<br/>";
	echo date("Y.m.d H:i:s")."<br/>";
	echo date("Y.m.d H:i:s", 99559955)."<br/>";
	$time = mktime(23, 59, 59, 2, 5, 2012);
	echo date("Y.m.d H:i:s", $time)."<br/>";
	$array = getdate($time);
	print_r($array);
	echo "<br/>";
	echo checkdate(2, 28, 2012)."<br/>";
	echo checkdate(2, 29, 2012)."<br/>";
	echo checkdate(2, 30, 2012)."<br/>";
	echo "Время выполнения скрипта:".(microtime(true) - $start);
	*/
?>

<?php 
// echo "<br/>".mb_detect_encoding($month)."<br/>";
if (isset($_POST["send"])) {
	$day = intval($_POST["day"]);
	$month = intval($_POST["month"]);
	$year = intval($_POST["year"]);	
}
 ?>

<div style="border: 1px solid #00f;">
	<form action="../lessons/lesson_5_date.php" name="frm" method="post">
		Day: <select name="day">
			<?php 
				for ($i = 1; $i <= 31; $i++) { 
					if (isset($day) && $i == intval($day)) {
						echo "<option selected=\"selected\">$i</option>";
					} else
						echo "<option>$i</option>";
				}
			?>	
		</select>
		Month: <select name="month">
			<?php 
				setlocale(LC_TIME, rus_RUS);
				for ($i = 1; $i <= 12; $i++) { 
					// $date = date("m", mktime(11, 11, 11, $i, 1, 2000));
					$m = strftime("%B", mktime(11, 11, 11, $i, 1, 2000));
					// iconv("UTF-8", "windows-1251", $month);
					if ((isset($month)) && $i == ($month))
						echo "<option value=\"$i\" selected=\"selected\">".$m."</option>";
					else
						echo "<option value=\"$i\">".$m."</option>";
				}
			?>
		</select>
		Year: <select name="year">
			<?php
				$y = intval(date("Y"));
				for ($i = 1900; $i <= $y; $i++) { 
					if (isset($year) && $i == $year)
						echo "<option selected=\"selected\">".$i."</option>";
					else
						echo "<option>".$i."</option>";
				 } 
			?>
		</select>
		<input type="submit" name="send"/>
	</form>
</div>

<?php
	$time = mktime(0, 0, 0, $month, $day, $year);
	if (checkdate($month, $day, $year)) {
		$date = date("Y.m.d", $time);
		echo time($date)."<br/>";
		echo $date."<br/>";
	} else
		echo iconv("UTF-8", "windows-1251", "Некорректный ввод!")."<br/>";

?>