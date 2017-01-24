<?php
	function transformCommentsToArray() {
		$string = file_get_contents("lessons/php_html/comments.txt");
		// echo "$string"."<br/>";
		$array = explode("\n", $string);
		// print_r($array);
		// echo "<br/>";
		$result = array();
		for ($i = 0; $i < count($array); $i++) {
			$record = explode("; ", $array[$i]);
			$result[$i]["name"] = $record[0];
			$result[$i]["comment"] = $record[1];
		}

		return $result;
	}

	function addComment($name, $comment) {
		$string = file_get_contents("lessons/php_html/comments.txt")."\r\n$name; $comment";
		file_put_contents("lessons/php_html/comments.txt", $string);
	}
?>