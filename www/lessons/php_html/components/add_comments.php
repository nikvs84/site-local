<?php
	if (isset($_POST["name"])) {
		require_once "lessons/php_html/model.php";
		addComment($_POST["name"], $_POST["comment"]);
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}	
?>
