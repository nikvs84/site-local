<form <?php echo "action=\"/lessons/redirect/redirect.php\""?>  metdod="get">
	Number 1: <input type="text" name="n1" <?php echo "value=\"".$_POST["n1"].$_GET["n1"]."\""; ?>/>
	Number 2: <input type="text" name="n2" <?php echo "value=\"".$_POST["n2"].$_GET["n2"]."\""; ?>/>
	<input type="submit"/>
</form>

<?php
	if (isset($_GET["result"])) {
		echo "<br/>";
		echo "GET:"."<br/>";
		$n1 = $_GET["n1"];
		$n2 = $_GET["n2"];
		$result = $_GET["result"];
		echo "$n1 + $n2 = $result"."<br/>";
	}
?>

<?php
	if (isset($_POST["result"])) {
		echo "POST:"."<br/>";
		$n1 = $_POST["n1"];
		$n2 = $_POST["n2"];
		$result = $_POST["result"];
		echo "$n1 + $n2 = $result"."<br/>";
	}
?>
