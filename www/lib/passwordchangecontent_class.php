<?php
	require_once 'modules_class.php';

	class PasswordChangeContent extends Modules {

		public function __construct($db) {
			parent::__construct($db);

		}

		protected function getTitle() {
			return "Изменение пароля";
		}

		protected function getDescription() {
			return "Изменение пароля пользователя на сайте.";
		}

		protected function getKeyWords() {
			return "изменение пароль сайт, изменение пароля пользователь сайт";
		}

		protected function getMiddle() {
			$sr["message"] = $this->getMessage();
			$sr["login"] = $_SESSION["login"];
			$password = $_SESSION["password"];

			if (isset($_SESSION["login"]))
				return $this->getReplaceTemplate($sr, "form_password_change");
			else
				// return $this->getReplaceTemplate($sr, "form_password_restore");
				header("Location: ".$this->config->address);
		}
	}
?>
