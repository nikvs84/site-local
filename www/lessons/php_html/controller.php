<?php
	require_once "lessons/php_html/model.php";
	if (isset($_POST["name"])) {
		addComment($_POST["name"], $_POST["comment"]);
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	$comments = transformCommentsToArray();
	require_once "lessons/php_html/view.html";
?>