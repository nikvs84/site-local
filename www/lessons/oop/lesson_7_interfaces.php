<?php
	interface FileIO {
		public function read();
		public function write();
	}

	class Point implements FileIO {
		
		public function read() {
			echo "Читаем из файла"."<br/>";
		}

		public function write () {
			echo "Пишем в файл"."<br/>";
		}
	}

	$point = new Point();
	$point->read();
	$point->write();
?>