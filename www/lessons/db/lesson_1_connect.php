<?php
	$mysqli = new mysqli("127.0.0.1", "Admin", 123456, "mysql");
	$mysqli->query("SET NAMES 'utf-8'");


	$mysqli->close();
?>