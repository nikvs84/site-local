<?php
	if (isset($_POST['calc'])) {
		require_once 'lib/functions.php';

		$n1 = $_POST['n1'];
		$n2 = $_POST['n2'];
		$operation = $_POST['operation'];

		switch ($operation) {
			case 'add':
				$result = "$n1 + $n2 = ".add($n1, $n2);
				break;
			case 'sub':
				$result = "$n1 - $n2 = ".sub($n1, $n2);
				break;
			case 'mult':
				$result = "$n1 * $n2 = ".mult($n1, $n2);
				break;
			case 'div': 
				$result = div($n1, $n2);
				if ($result === false) {
					$result = "Деление на 0!";
				} else
					$result = "$n1 / $n2 = ".$result;
				break;
			case 'fact':
				$result = factorial($n1);
				if ($result === false) {
					$result = "Факториала $n1 не существует";
				} else 
					$result = "$n1! = ".$result;
				break;
			case 'avg':
				$result = "Среднее арифметическое $n1 и $n2 = ".avg($n1, $n2);
				break;
			default:
				echo "Неизвестная операция.<br/>";
				break;
		}
	}
	$array = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
	$digits = array(5, 3, 7, -1, 0);
	sortArray($array, true);
	print_r($array);
	echo "<br/>";
	sortArray($array, false);
	print_r($array);
	echo "<br/>";
	sortArray($digits, true);
	print_r($digits);
	echo "<br/>";
	sortArray($digits, false);
	print_r($digits);
	echo "<br/>";
?>
<form name="calculator.php" method="post">
	<p>
		<input type="text" name="n1" value="<?php echo "$n1";?>"/>
		<select name="operation">
			<?php
				$operations = array('add' => '+', 'sub' => '-', 'mult' => '*', 'div' => '/', 'fact' => '!', 'avg' => '~');
				foreach ($operations as $key => $value) {
					if ($operation == $key) {
						echo "<option value='$key' selected='selected'>$value</option>";
					} else
						echo "<option value='$key'>$value</option>";
			}
			?>
		</select>
		<input type="text" name="n2" value="<?php echo $n2;?>"/>
		<input type="submit" name="calc" value="Вычислить"/>
	</p>
</form>

<?php
	if (isset($result)) {
		echo "<p>Результат: $result</p>";
	}
	echo "End";
?>