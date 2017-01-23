<?php
	/**
	* 
	*/
	class Point {
		public $x;
		public $y;
		function __construct($x = 0, $y = 0) {
			$this->x = $x;
			$this->y = $y;
		}

		public function __toString() {
			return "point: (".$this->x."; ".$this->y.")";
		}

		// вызывается функцией clone()
		public function __clone() {
			echo "Object Point cloned"."<br/>";
		}
	}
	$point = new Point(5, 7);
	$point1 = $point;
	echo $point."<br/>";
	echo $point1."<br/>";
	$point->x = 10;
	echo $point."<br/>";
	echo $point1."<br/>";
	$point1->y = 10;
	echo $point."<br/>";
	echo $point1."<br/>";

	echo "------------"."<br/>";
	$point1 = clone $point;
	$point->x = 100;
	echo $point."<br/>";
	echo $point1."<br/>";

?>