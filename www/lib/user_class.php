<?php
	class User {
		private $db;
		private static $user = null;

		public function __construct($value='') {
			$this->db = new mysqli("localhost", "root", "", "mybase");
			$this->db->query("SET NAMES 'utf8'");
		}

		public static function getObject() {
			if (self::$user === null)
				self::$user = new User();
			return self::$user;
		}

		public function regUser ($login, $password) {
			if ($login == "" || $password == "")
				return false;
			$password = md5($password);
			return $this->db->query("INSERT INTO `users` (`login`, `password`, `regdate`) VALUES ('$login', '$password', '".time()."')");
		}

		private function checkUser($login, $password) {
			$resultSet = $this->db->query("SELECT `password` FROM `users` WHERE `login`='$login'");
			$user = $resultSet->fetch_assoc();
			$resultSet->close();
			if (!$user)
				return false;
			return ($user["password"] === $password);
		}

		public function isAuth() {
			session_start();
			$login = $_SESSION["login"];
			$password = $_SESSION["password"];
			return $this->checkUser($login, $password);
		}

		public function login($login, $password) {
			$password = md5($password);
			if ($this->checkUser($login, $password)) {
				session_start();
				$_SESSION["login"] = $login;
				$_SESSION["password"] = $password;
				return true;
			} else
				return false;
		}

		public function __dextruct() {
			if ($this->db)
				$this->db->close();
		}
	}
?>