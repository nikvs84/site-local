<?php
	require_once 'global_class.php';

	class User extends GlobalClass {

		public function __construct($db) {
			parent::__construct("users", $db);
		}

		public function addUser($login, $password, $email, $regdate, $confirm) {
			if (!$this->checkValid($login, $password, $email, $regdate))
				return false;
			return $this->add(array("login" => $login, "password" => $password, "email" => $email, "regdate" => $regdate, "confirm" => $confirm));
		}

		public function editUser($id, $login, $password, $email, $regdate) {
			if (!$this->checkValid($login, $password, $email, $regdate))
				return false;
			return $this->edit($id, array("login" => $login, "password" => $password, "email" => $email, "regdate" => $regdate));
		}

		public function confirmByLogin($login) {
			$id = $this->getIDOnLogin($login);
			return $this->setFieldOnId($id, "confirm", "");
		}

		public function getConfirmField($login) {
			return $this->getField("confirm", "login", $login);
		}

		public function isConfirm($login) {
			return ($this->getConfirmField($login) == "");
		}

		public function isExistsUser($login) {
			return $this->isExists("login", $login);
		}

		public function checkUser($login, $password) {
			$user = $this->getUserOnLogin($login);
			if (!$user)
				return false;
			return ($user["password"] === $password);

		}

		public function getIDOnLogin($login) {
			return $id = $this->getField("id", "login", $login);
		}

		public function getUserOnLogin($login) {
			$id = $this->getIdOnLogin($login);
			return $this->get($id);
		}

		private function checkValid($login, $password, $email, $regdate) {
			if (!$this->valid->validLogin($login))
				return false;
			if (!$this->valid->validHash($password))
				return false;
			if (!$this->valid->validEmail($email))
				return false;
			if (!$this->valid->validTimeStamp($regdate))
				return false;
			return true;
		}
	}
?>