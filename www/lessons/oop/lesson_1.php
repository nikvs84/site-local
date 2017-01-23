<?php
	class Point {
		
		public $x;
		public $y;

		public function __construct($x = 0, $y = 0) {
			$this->x = $x;
			$this->y = $y;
		}

		public function getX() {
			return $this->x;
		}

		public function getY() {
			return $this->y;
		}

		public function setX($x) {
			$this->x = $x;
		}

		public function setY($y) {
			$this->y = $y;
		}

		public function __toString() {
			return "point: (".$this->x."; ".$this->y.")";
		}

		public function setPoint($point) {
			$this->x = $point->x;
			$this->y = $point->y;
		}

		// автоматически вызывается методом unset()
		public function __destruct() {
			echo "Object deleted.";
		}
	}

	$point = new Point();
	echo $point->x."<br/>";
	echo $point->y."<br/>";
	$point->y = 100;
	echo $point->y."<br/>";
	$point->setX(4);
	echo $point->getX()."<br/>";
	echo $point."<br/>";
	
	$point1 = new Point(15, -7);
	$point->setPoint($point1);
	echo $point."<br/>";

	unset($point);
?>