<?php
	function printResultSet($resultSet) {
		echo "Количество записей: ".$resultSet->num_rows."<br/>";
		while (($row = $resultSet->fetch_assoc()) != false) {
			print_r($row);
			echo "<br/>";
		}
		echo "------------------"."<br/>";
	}
	$mysqli = new mysqli("localhost", "Admin", "123456", "mybase");
	$mysqli->query("SET NAMES 'utf-8'");
	$resultSet = $mysqli->query("SELECT * FROM `users`");
	printResultSet($resultSet);

	$mysqli->close();
?>