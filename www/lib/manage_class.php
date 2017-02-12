<?php
	require_once 'config_class.php';
	require_once 'user_class.php';
	require_once 'email_class.php';
	require_once 'pollvariant_class.php';

	class Manage {
		private $config;
		private $user;
		private $data;
		private $poll_variant;

		function __construct($db) {
			session_start();
			$this->config = new Config();
			$this->user = new User($db);
			$this->poll_variant = new PollVariant($db);
			$this->data = $this->secureData(array_merge($_POST, $_GET));
		}

		private function secureData($data) {
			foreach ($data as $key => $value) {
				if (is_array($value))
					$this->secureData($value);
				else
					$data[$key] = htmlspecialchars($value);
				return $data;
			}
		}

		public function redirect($link) {
			header("Location: $link");
			exit;
		}

		public function regUser() {
			$link_reg = $this->config->address."?view=reg";
			$captcha = $this->data["captcha"];
			if (($_SESSION["rand"] == "") | ($captcha != $_SESSION["rand"])) {
				return $this->returnMessage("ERROR_CAPTCHA", $link_reg);
			}
			$login = $this->data["login"];
			if ($this->user->isExistsUser($login))
				return $this->returnMessage("EXISTS_LOGIN", $link_reg);
			$password = $this->data["password"];
			if ($password == "")
				return $this->unknownError($link_reg);
			$password = $this->hashPassword($password);

			$email = $this->data["email"];
			$hashLogin = $this->hashLogin($login);

			$result = $this->user->addUser($login, $password, $email, time(), $hashLogin);
			if ($result) {
				$mailSender = new Email($mail);
				$emailMessage = "Ваш логин: $login, пароль: ".$this->data["password"].".\r\nДля подтверждения регистрации на сайте пройдите по ссылке: ".$this->getLinkForConfirm($login, $hashLogin);
				$mailSender->sendMail($email, "reg@site.local", "Подтверждение регистрации", $emailMessage);

				return $this->returnPageMessage("SUCCESS_REG", $this->config->address."?view=message");
			}
			else
				return $this->unknownError($link_reg);
		}

		public function checkConfirm($login, $hash) {
			if ($this->user->isConfirm($login))
				return $this->returnPageMessage("CONFIRMED_USER", $this->config->address."?view=message");;
			if ($hash === $this->getUserConfirm($login)) {
				$this->user->confirmByLogin($login);
				return $this->returnPageMessage("CONFIRM_REG", $this->config->address."?view=message");
			}
		}

		public function login() {
			$login = $this->data["login"];
			$password = $this->data["password"];
			$password = $this->hashPassword($password);
			$r = $_SERVER["HTTP_REFERER"];
			if ($this->user->checkUser($login, $password)) {
				$_SESSION["login"] = $login;
				$_SESSION["password"] = $password;
				return $r;
			} else {
				$_SESSION["error_auth"] = 1;
				return $r;
			}
		}

		public function logout() {
			unset($_SESSION["login"]);
			unset($_SESSION["password"]);
			return $_SERVER["HTTP_REFERER"];
		}

		public function restorePasswordStart() {
			$login = $this->data["login"];
			$email = $this->data["email"];
			$user = $this->user->getUserOnLogin($login);
			$emailOfUser = $user["email"];
			if ($this->data["captcha"] == "" | $this->data["captcha"] != $_SESSION["rand"]) {
				return $this->returnMessage("ERROR_CAPTCHA", $_SERVER["HTTP_REFERER"]);
			}
			if ($this->user->isConfirm($login) && $email === $emailOfUser) {
				$email = $this->data["email"];
				$mailSender = new Email($mail);
				$emailMessage = $login.", для восстановления пароля пройдите по ссылке: ".$this->getLinkForRestore($login);
				$mailSender->sendMail($email, "reg@site.local", "Восстановление пароля для пользователя ".$login, $emailMessage);
				return $this->returnMessage("PASSWORD_RESTORE", $this->config->address."?view=password_restore");
			} else {
				return $this->returnPageMessage("ERROR_AUTH", $this->config->address."?view=message");
			}
			
		}

		public function restorePassword() {
			$login = $this->data["login"];
			$secret_key = $this->data["secret_key"];
			$user = $this->user->getUserOnLogin($login);
			if ($secret_key === $this->getSecretKey($login)) {
				if ($this->data["password"] != $this->data["password_confirm"]) {
					return $this->returnMessage("ERROR_PASSWORDCONFIRM", $_SERVER["HTTP_REFERER"]);
				} elseif ($this->data["captcha"] == "" | $this->data["captcha"] != $_SESSION["rand"]) {
					return $this->returnMessage("ERROR_CAPTCHA", $_SERVER["HTTP_REFERER"]);
				} else {
					$password = $this->data["password"];
					if ($this->user->editUser($user["id"], $user["login"], $this->hashPassword($password), $user["email"], $user["regdate"]))
						return $this->returnMessage("PASSWORD_RESTORECOMPLETE", $this->config->address."?view=password_restore");
					else {
						return $this->returnPageMessage("UNKNOWN_ERROR", $this->config->address."?view=message");
					}
				}
				
			}
		}

		private function hashPassword($password) {
			return md5($password.$this->config->secret);
		}

		private function hashLogin($login) {
			return md5($login.$this->config->secret);
		}

		private function getSecretKey($login) {
			return md5($login.$this->config->secret);
		}

		private function unknownError($r) {
			return $this->returnMessage("UNKNOWN_ERROR", $r);
		}

		private function returnMessage($message, $r) {
			$_SESSION["message"] = $message;
			return $r;
		}

		private function returnPageMessage($message, $r) {
			$_SESSION["page_message"] = $message;
			return $r;
		}

		private function getLinkForConfirm($login, $hashLogin) {
			return $_SERVER["HTTP_HOST"]."?view=confirm&login=".$login."&hash=".$hashLogin;
		}

		private function getLinkForRestore($login) {
			return $_SERVER["HTTP_HOST"]."?view=password_restore"."&login=".$login."&secret_key=".$this->getSecretKey($login);
		}

		private function getUserConfirm($login) {
			return $this->user->getConfirmField($login);
		}

		public function poll() {
			$id = $this->data["variant"];
			// echo "id = ".$id."<br/>";
			$variant = $this->poll_variant->get($id);
			// print_r($variant);
			$poll_id = $variant["poll_id"];
			$this->poll_variant->setVotes($id, $variant["votes"] + 1);

			return $this->config->address."?view=poll&id=$poll_id";
		}
	}
?>