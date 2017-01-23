<?php
	// setcookie("count", 5, time() + 5);
	// unset($_COOKIE["count"]);
	$count = (isset($_COOKIE["count"])) ? $_COOKIE["count"] : 0;
	$count++;
	setcookie("count", $count, time() + 5);
	echo "count = $count"."<br/>";
?>