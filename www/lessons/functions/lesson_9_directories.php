<?php
/*	
	if (!file_exists("tempdir"))
		mkdir("tempdir");
	
	chdir("tempdir");
	file_put_contents("a.txt", "String");
	file_put_contents("b.txt", "String");

	if (!file_exists("newdir"))
		mkdir("newdir");
	chdir("newdir");
	file_put_contents("c.txt", "String");
	chdir("..");
	file_put_contents("d.txt", "String");

	function printAllFiles($dir) {
		$list = glob($dir."/*");
		// print_r($list);
		for ($i = 0; $i < count($list); $i++) { 
			if (is_dir($list[$i]))
				printAllFiles($list[$i]);
			else
				echo $list[$i]."<br/>";
		}
	}

	printAllFiles(".");
	rmdir("tempdir"); //Удаляет только пустую директорию!
	chdir("..");
	function deleteAllFiles($dir) {
		$list = glob($dir."/*");
		for ($i = 0; $i < count($list); $i++) { 
			if (is_dir($list[$i])) {
				echo "Удаляем файлы внутри директории \"".$list[$i]."\" <br/>";
				deleteAllFiles($list[$i]);
			}
			else {
				unlink($list[$i]);
				echo "Файл \"".$list[$i]."\" удален"."<br/>";
			}

		}
	}
	echo "Удаляем папку \"tempdir\""."<br/>";
	deleteAllFiles("tempdir");
	*/
?>

<?php
	if (isset($_POST["login"])) {
		chdir("..");
		$login = $_POST["login"];
		echo "login = $login"."<br/>";
		if (!file_exists("users"))
			mkdir("users");
		chdir("users");
		if (!file_exists($login)) {
			mkdir($login);
			mkdir($login."/video");
			mkdir($login."/music");
			mkdir($login."/photo");
		}
		else
			echo "<b>Error!</b> This user already exists!"."<br/>";
		chdir("..");
	}
?>

<form action="../lessons/lesson_9_directories.php" method="post">
	<div>
		Login: <input type="text" name="login"/>
		Password: <input type="password" name="password"/>
		<input type="submit" name="createUser" value="Create user"/>
	</div>
</form>
<form action="../lessons/delete.php" method="get">
	<select name="user">
		<?php
			chdir("users");
			$list = glob("*");
			print_r($list);
			echo "<br/>";
			for ($i = 0; $i < count($list); $i++) {
				if (is_dir($list[$i]))
					echo "<option>".$list[$i]."</option>";
			}
		?>
	</select>
	<input type="submit" name="deleteUser" value="DELETE"/>
</form>