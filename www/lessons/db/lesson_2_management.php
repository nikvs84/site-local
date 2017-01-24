<?php
	$mysqli = new mysqli("localhost", "Admin", "123456");
	$mysqli->query("SET NAMES 'utf-8'");
	$mysqli->query("CREATE DATABASE IF NOT EXISTS `temp`");
	$mysqli->query("CREATE TABLE IF NOT EXISTS `temp`.`cities` (`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` VARCHAR(255) character set utf8 collate utf8_general_ci NOT NULL) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci");
	$mysqli->query("ALTER TABLE `temp`.`cities` ADD `utc` TINYINT(2) NOT NULL");
	$mysqli->query("ALTER TABLE `temp`.`cities` DROP `utc`");
	$mysqli->query("DROP TABLE `temp`.`cities`");
	$mysqli->query("DROP DATABASE `temp`");

	$mysqli->close();
?>