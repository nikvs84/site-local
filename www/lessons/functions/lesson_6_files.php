<?php
/*	$file = fopen("a.txt", "a+t");
	// fwrite($file, "String\nNext1\nNext2");
	fclose($file);
	$file = fopen("a.txt", "r+t");
	while (!feof($file)) {
		echo fread($file, 1)."<br/>";
		// echo "<br/>";
	}
	echo "--------<br/>";
	fseek($file, 0);
	echo fread($file, 10)."<br/>";
	fclose($file);

	file_put_contents("b.txt", "file file file");
	echo file_get_contents("b.txt")."<br/>";
	echo file_exists("c.txt")."<br/>";
	echo file_exists("a.txt")."<br/>";
	// echo filesize("c.txt")."<br/>";
	echo filesize("a.txt")."<br/>";
	rename("b.txt", "c.txt");
	unlink("c.txt");*/
?>
<?php
	if (isset($_POST["send"])) {
		echo "---<br/>";
		$username = $_POST["username"];
		$comment = $_POST["comment"];
		$file = fopen("../comments.txt", "a+t");
		fwrite($file, $username."<end>");
		fwrite($file, $comment."<end>");
		fclose($file);
	}
?>

<?php
	function readData($file) {
		$data = "";
		$char = fread($file, 1);
		while (!feof($file)) {
			if ($char == "<") {
				$char = $char.fread($file, 4);
				if ($char == "<end>")
					break;
			}
			$data = $data.$char;
			$char = fread($file, 1);
		}
		return $data;
	}
?>

<div id="comments">
	<form action="../lessons/lesson_6_files.php" method="post">
		<div>Username:<input type="text" name="username"/></div>
		<div>Comment:<textarea name="comment" cols="30" rows="10"></textarea></div>

		<input type="submit" name="send"/>
	</form>
</div>
<table border="1" width="auto">
	<tr>
		<td>UserName</td>
		<td>Comment</td>
	</tr>
	<?php
		if (file_exists("../comments.txt")) {
			// echo "<tr><td>user</td><td>comment</td></tr>";
			$file1 = fopen("../comments.txt", "r");
			while (!feof($file1)) {
				$username = readData($file1);
				$comment = readData($file1);
				if (!$username == "" && !$comment == "") {
					echo "<tr>";
						echo "<td>";
							echo $username;
						echo "</td>";
						echo "<td>";
							echo $comment;
						echo "</td>";
					echo "</tr>";
				}

			}
			fclose($file1);
		}
	?>
</table>
<?php
	
?>