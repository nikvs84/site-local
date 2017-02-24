<?php
	require_once 'modules_class.php';
	
	class ArticleContent extends Modules {
		private $article_info;
		private $comments_info;

		public function __construct($db) {
			parent::__construct($db);
			$this->article_info = $this->article->get($this->data["id"]);
			$this->comments_info = $this->comments->getCommentsByArticleID($this->article_info["id"]);
			if (!$this->article_info)
				$this->notFound();
		}

		protected function getTitle() {
			return $this->article_info["title"];
		}

		protected function getDescription() {
			return $this->article_info["meta_desc"];
		}

		protected function getKeyWords() {
			return $this->article_info["meta_key"];
		}

		protected function getMiddle() {
			$result = $this->getArticle().$this->getComments();
			return $result;
		}

		private function getArticle() {
			$sr["title"] = $this->article_info["title"];
			$sr["full_text"] = $this->article_info["full_text"];
			$sr["date"] = $this->formatDate($this->article_info["date"]);
			$sr["image-address"] = $this->config->images.$this->article_info["image"];
			return $this->getReplaceTemplate($sr, "article");
		}

		private function getComments() {
			for ($i = 0; $i < count($this->comments_info); $i++) { 
				$sr["user"] = $this->comments_info[$i]["user"];
				$sr["date"] = $this->formatDate($this->comments_info[$i]["date"]);
				$sr["text"] = $this->comments_info[$i]["text"];
				$text .= $this->getReplaceTemplate($sr, "comment");
			}


			$login = ($_SESSION["login"] && $_SESSION["password"]) ? $_SESSION["login"] : $this->config->guestName;
			$new_sr = array("comments" => $text, "article-id" => $this->article_info["id"], "login" => $login);
			return $this->getReplaceTemplate($new_sr, "comments");
		}
	}
?>