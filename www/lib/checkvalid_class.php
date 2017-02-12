<?php
	require_once "config_class.php";

	/**
	* 
	*/
	class CheckValid {

		private $config;
		
		function __construct() {
			$this->config = new Config();
		}

		public function validID($id) {
			if (!$this->isIntNumber($id))
				return false;
			return ($id > 0);
		}

		public function validLogin($login) {
			if ($this->isContainQuotes($login))
				return false;
			if (preg_match("/^\d*$/", $login))
				return false;
			return $this->validString($login, $this->config->min_login, $this->config->max_login);
		}

		public function validHash($hash) {
			if (!$this->validString($hash, 32, 32)) 
				return false;
			if (!$this->isOnlyLettersAndDigits($hash))
				return false;
			return true;
		}

		public function validEmail($email) {
			if (strpos($email, "@") !== false)
				return true;
			else
				return false;
		}

		public function validTimeStamp($time) {
			return $this->isNoNegativeInteger($time);
		}

		private function isIntNumber($number) {
			if (!is_int($number) && !is_string($number))
				return false;
			if (preg_match("/^-?[1-9][0-9]*|0$/", $number))
				return true;
			return false;
		}

		private function isNoNegativeInteger($number) {
			if (!$this->isIntNumber($number))
				return false;
			if ($number < 0)
				return false;
			return true;
		}

		private function isOnlyLettersAndDigits($string) {
			return preg_match("/[a-zа-я0-9]*/i", $string);
		}

		private function validString($string, $min_length, $max_length) {
			if (!is_string($string)) 
				return false;
			if (strlen($string) < $min_length)
				return false;
			if (strlen($string) > $max_length)
				return false;
			return true;
		}

		private function isContainQuotes($string) {
			$array = array("\"", "'", "`", "&quot;", "&apos;");
			foreach ($array as $key => $value) {
				if (strpos($string, $value) !== false)
					return true;
				return false;
			}
		}

		public function validVotes($votes) {
			return $this->isNoNegativeInteger($votes);
		}
	}
?>