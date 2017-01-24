<html>
<head>
	<title>Вставка php</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="styles/style.css"/>
</head>
<body>
	<h1>Статья</h1>
	<p>Текст статьи...</p>
	<h2>Комментарии</h2>
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

		$comments = transformCommentsToArray();
		if (count($comments) != 0) {
			echo "<table>";
			for ($i=0; $i < count($comments); $i++) { 
				echo "<tr>";
				echo "<td><b>".$comments[$i]["name"]."</b></td>";
				echo "<td>".$comments[$i]["comment"]."</td>";
				echo "</tr>";
				echo "<tr><td colspan='2'><hr/></td></tr>";
			}
			echo "</table>";
		}
	?>
</body>
</html>