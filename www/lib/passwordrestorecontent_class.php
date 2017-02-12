<?php
	require_once 'modules_class.php';
	
	class PasswordRestoreContent extends Modules {

		public function __construct($db) {
			parent::__construct($db);
		}

		protected function getTitle() {
			return "Восстановление пароля";
		}

		protected function getDescription() {
			return "Восстановление пароля пользователя на сайте.";
		}

		protected function getKeyWords() {
			return "регистрация сайт, регистрация пользователь сайт";
		}

		protected function getMiddle() {
			$sr["message"] = $this->getMessage();
			$sr["login"] = $_SESSION["login"];
			if ($sr["login"] == "")
				$sr["login"] = $_GET["login"];
			if ($sr["login"] == "%login%")
				$sr["login"] = "";
			$sr["secret_key"] = $_GET["secret_key"];
			if ($sr["secret_key"] == "")
				return $this->getReplaceTemplate($sr, "form_password_restore_start");
			else
				return $this->getReplaceTemplate($sr, "form_password_restore");
		}
	}
?>