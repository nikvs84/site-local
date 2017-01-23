<?php
	echo __FILE__."<br/>";
	echo fileperms(__FILE__)."<br/>";
	chmod(__FILE__, 0777);
	echo fileperms(__FILE__)."<br/>";
	if (! file_exists("testpath")) {
		mkdir("testpath");
		echo "Директория создана"."<br/>";
	} else 
		echo "Директория существует"."<br/>";
	chmod("testpath", 0755);
	$file = fopen("testpath/testfile.txt", "a");
	fwrite($file, "string1\r\n");
	fclose($file);
	chmod("testpath", 0777);
	$file = fopen("testpath/testfile.txt", "a");
	fwrite($file, "string2\r\n");
	fclose($file);
	echo "End"."<br/>";
?>