<?php
	/**
	* 
	*/
	class Auto {
		protected $x;
		protected $y;

		public function __construct($x = 0, $y = 0) {
			$this->x = $x;
			$this->y = $y;
		}

		public function move($x, $y) {
			$this->strMove($x, $y);
			$this->x = $x;
			$this->y = $y;
		}

		protected function strMove($x, $y, $type = "") {
			if ($type == "")
				echo "Двигаем автомобиль из точки (".$this->x."; ".$this->y.") в точку (".$x."; ".$y.")"."<br/>";
			else 
				echo "Двигаем $type автомобиль из точки (".$this->x."; ".$this->y.") в точку (".$x."; ".$y.")"."<br/>";
		}
	}

	/**
	* 
	*/
	class Car extends Auto {
		
		public function __construct($x = 0, $y = 0) { //конструктор родительского класса вызовется по умолчанию
			parent::__construct($x, $y); 
		}

		public function move($x, $y) {
			$this->strMove($x, $y, "легковой");
		}
	}

	/**
	* 
	*/
	class Truck extends Auto {
		protected $capacity;

		public function __construct($x = 0, $y = 0, $capacity = 5000) {
			parent::__construct($x, $y);
			$this->capacity = $capacity;
		}

		public function move($x, $y) {
			$this->strMove($x, $y, "грузовой");
		}
	}

	$auto = new Auto();
	$car = new Car();
	$truck = new Truck();

	$auto->move(10, 1);
	$car->move(10, 1);
	$truck->move(10, 1);
?>