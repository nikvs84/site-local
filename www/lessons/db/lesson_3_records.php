<?php
	$mysqli = new mysqli("localhost", "Admin", "123456", "mybase");
	$mysqli->query("SET NAMES 'utf-8'");
	$mysqli->query("INSERT INTO `users` (`login`, `password`, `regdate`) VALUES ('User1', '".md5("123")."', '".time()."')");

/*	for ($i = 2; $i < 10; $i++) { 
		$mysqli->query("INSERT INTO `users` (`login`, `password`, `regdate`) VALUES ('User$i', '".md5($i)."', '".time()."')");
	}
*/
	$mysqli->query("UPDATE `users` SET `regdate`='0', `password`='".md5(1)."' WHERE `id`='1'");
	$mysqli->query("DELETE FROM `users` WHERE `id` > 9");

	$mysqli->close();
?>