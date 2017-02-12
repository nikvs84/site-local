<?php
	require_once 'config_class.php';
	require_once 'article_class.php';
	require_once 'section_class.php';
	require_once 'user_class.php';
	require_once 'menu_class.php';
	require_once 'banner_class.php';
	require_once 'message_class.php';
	require_once 'poll_class.php';
	require_once 'pollvariant_class.php';

	abstract class Modules {
		protected $config;
		protected $article;
		protected $section;
		protected $user;
		protected $menu;
		protected $banner;
		protected $message;
		protected $data;
		protected $user_info;
		protected $poll;
		protected $poll_variant;

		public function __construct($db) {
			session_start();
			$this->config = new Config();
			$this->article = new Article($db);
			$this->section = new Section($db);
			$this->user = new User($db);
			$this->menu = new Menu($db);
			$this->banner = new Banner($db);
			$this->message = new Message();
			$this->data = $this->secureData($_GET);
			$this->user_info = $this->getUser();
			$this->poll = new Poll($db);
			$this->poll_variant = new PollVariant($db);
		}

		function getUser() {
			$login = $_SESSION["login"];
			$password = $_SESSION["password"];
			if ($this->user->checkUser($login, $password))
				return $this->user->getUserOnLogin($login);
			else
				return false;
		}

		public function getContent() {
			$sr["title"] = $this->getTitle();
			$sr["meta_desc"] = $this->getDescription();
			$sr["meta_key"] = $this->getKeyWords();
			$sr["menu"] = $this->getMenu();
			$sr["auth_user"] = $this->getAuthUser();
			$sr["banners"] = $this->getBanners();
			$sr["top"] = $this->getTop();
			$sr["middle"] = $this->getMiddle();
			$sr["bottom"] = $this->getBottom();
			$sr["poll"] = $this->getPoll();
			return $this->getReplaceTemplate($sr, "main");
		}

		abstract protected function getTitle();
		abstract protected function getDescription();
		abstract protected function getKeyWords();
		abstract protected function getMiddle();

		protected function getMenu() {
			$menu = $this->menu->getAll();
			$sr["title"] = "Главная";
			$sr["link"] = "http://".$_SERVER["HTTP_HOST"];
			$text .= $this->getReplaceTemplate($sr, "menu_item");
			for ($i = 0; $i < count($menu); $i++) { 
				$sr["title"] = $menu[$i]["title"];
				$sr["link"] = $menu[$i]["link"];
				$text .= $this->getReplaceTemplate($sr, "menu_item");
			}
			return $text;
		}

		protected function getAuthUser() {
			if ($this->user_info) {
				if ($this->user_info["confirm"]) {
					$sr["message_auth"] = $this->getMessage("ERROR_CONFIRM");
					return $this->getReplaceTemplate($sr, "form_auth");
				}
				$sr["username"] = $this->user_info["login"];
				return $this->getReplaceTemplate($sr, "user_panel");
			}
			if ($_SESSION["error_auth"] == 1) {
				$sr["message_auth"] = $this->getMessage("ERROR_AUTH");
				unset($_SESSION["error_auth"]);
			} else
				$sr["message_auth"] = "";
			return $this->getReplaceTemplate($sr, "form_auth");
		}

		protected function getBanners() {
			$banners = $this->banner->getAll();
			for ($i = 0; $i < count($banners); $i++) { 
				$sr["code"] = $banners[$i]["code"];
				$text .= $this->getReplaceTemplate($sr, "banner");
			}
			return $text;
		}

		protected function getPoll() {
			$poll = $this->poll->getRandomElements(1);
			// echo "getAllOnPollID"."<br/>";
			$variants = $this->poll_variant->getAllOnPollID($poll[0]["id"]);
			$sr["title"] = $poll[0]["title"];
			// print_r($variants);
			// echo "string"."<br/>";

			for ($i = 0; $i < count($variants); $i++) { 
				$new_sr["title"] = $variants[$i]["title"];
				$new_sr["id"] = $variants[$i]["id"];
				$text .= $this->getReplaceTemplate($new_sr, "poll_variant");
			}

			$sr["variants"] = $text;
			// echo $sr["variants"]."<br/>";
			return $this->getReplaceTemplate($sr, "poll");
		}

		protected function getTop() {
			return "";
		}

		protected function getBottom() {
			return "";
		}

		protected function getBlogArticles($articles, $page) {
			$start = ($page - 1) * $this->config->count_blog;
			$end = $start + $this->config->count_blog;
			$end = (count($articles) > $end) ? $end : count($articles) ;
			for ($i = $start; $i < $end; $i++) {
				$sr["title"] = $articles[$i]["title"];
				$sr["intro_text"] = $articles[$i]["intro_text"];
				$sr["date"] = $this->formatDate($articles[$i]["date"]);
				$sr["link_article"] = $this->config->address."?view=article&amp;id=".$articles[$i]["id"];
				$sr["image-address"] = $this->config->images.$articles[$i]["image"];
				$text .= $this->getReplaceTemplate($sr, "article_intro");
			}
			return $text;
		}

		protected function formatDate($time) {
			return date("Y-m-d H:i:s", $time);
		}

		protected function getMessage($message = "") {
			if ($message == "") {
				$message = $_SESSION["message"];
				unset($_SESSION["message"]);
			}
			$sr["message"] = $this->message->getText($message);
			return $this->getReplaceTemplate($sr, "message_string");
		}

		protected function getPagination($count, $count_on_page, $link)  {
			$count_pages = ceil($count / $count_on_page);
			$sr["number"] = 1;
			$sr["link"] = $link;
			$pages = $this->getReplaceTemplate($sr, "number_page");
			$sym = (strpos($link, "?") !== false) ? "&amp;" : "?";
			for ($i = 2; $i <= $count_pages; $i++) { 
				$sr["number"] = $i;
				$sr["link"] = $link.$sym."page=$i";
				$pages .= $this->getReplaceTemplate($sr, "number_page");
			}
			$pagination["number_pages"] = $pages;
			return $this->getReplaceTemplate($pagination, "pagination");
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

		protected function getTemplate($name) {
			$text = file_get_contents($this->config->dir_tmpl.$name.".tpl");
			return str_replace("%address%", $this->config->address, $text);
		}

		protected function getReplaceTemplate($sr, $template) {
			return $this->getReplaceContent($sr, $this->getTemplate($template));
		}

		private function getReplaceContent($sr, $content) {
			$search = array();
			$replace = array();
			$i = 0;
			foreach ($sr as $key => $value) {
				$search[$i] = "%$key%";
				$replace[$i] = $value;
				$i++;
			}
			return str_replace($search, $replace, $content);
		}

		protected function redirect($link) {
			header("Location: $link");
			exit;
		}

		protected function notFound() {
			$this->redirect($this->config->address."?view=notfound");
		}

		protected function isInvalidPageNumber($page, $articles) {
			return ($page <= 0 || $page > ceil(count($articles) / $this->config->count_blog));
		}
	}
?>