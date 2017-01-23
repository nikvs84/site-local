<?php
	function deleteAllFiles($dir, $bool = "false") {
		$list = glob($dir."/*");
		for ($i = 0; $i < count($list); $i++) { 
			if (is_dir($list[$i])) {
				echo "Удаляем файлы внутри директории \"".$list[$i]."\" <br/>";
				deleteAllFiles($list[$i]);
				if ($bool)
					rmdir($list[$i]);
			}
			else {
				unlink($list[$i]);
				echo "Файл \"".$list[$i]."\" удален"."<br/>";
			}

		}
	}
?>

<?php
	function deleteDir($dir) {
		deleteAllFiles($dir, true);
		rmdir($dir);
	}
?>

<?php
	if (isset($_GET["user"])) {
		$dirName = $_GET["user"];
		echo "Deleting user: \"".$dirName."\"";
		chdir("../users");
		if (file_exists($dirName)) {
			deleteDir($dirName);
		}
	}
?>