<?php
	if (isset($_POST['send'])) {
		$n1 = $_POST['n1'];
		$n2 = $_POST['n2'];
	}
	
?>	<style>
		input {
			text-align: center;
		}
	</style>
	<form name='form1' action='../../lessons/math/lesson_1.php' method='post'>
		Число1: <input type='text' name='n1' value='<?php echo "$n1";?>'/>
		Число2: <input type='text' name='n2' value='<?php echo "$n2";?>'/>
		<input type='submit' name='send'>
	</form>
<?php
	$isNumb = true;
	if (!is_numeric($n1)) {
		echo "$n1 - не число!";
		$isNumb = false;
	}
	if (!is_numeric($n2)) {
		echo "$n2 - не число!";
		$isNumb = false;
	}

	if ($isNumb) {
		echo "Сумма $n1 и $n2 = ".($n1 + $n2);
	}
?>