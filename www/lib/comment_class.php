<?php
	require_once 'global_class.php';
	require_once 'user_class.php';

	class Comment extends GlobalClass {
		private $user;

		public function __construct($db) {
			parent::__construct("comments", $db);
			$this->user = new User($db);
		}

/*		public function getAllSortDate() {
			return $this->getAll("date", false);
		}
*/
		public function getCommentsByArticleID($article_id) {
			$result = $this->getAllOnField("article_id", $article_id, "date", false);
			for ($i = 0; $i < count($result); $i++) { 				
				$result[$i]["user"] = $this->getUserName($result[$i]["user_id"]);
			}
			
			// print_r($result);
			// echo "<br/>";
			
			return $result;
		}

		public function addComment($article_id, $user_id, $text) {
			$new_values = array("article_id" => $article_id, "user_id" => $user_id, "date" => time(), "text" => $text);
			
			return $this->add($new_values);
		}

/*		public function get($id, $field_out) {
			return $this->getField($field_out, "id", $id);
		}
*/
/*		public function set($id, $field, $value) {
			return $this->setFieldOnID($id, $field, $value);
		}
*/
		public function searchComments($words) {
			return $this->search($words, array("text"));
		}

		private function getUserName($user_id) {
			$userName = $this->user->getFieldOnID($user_id, "login");
			// echo "userName = ".$userName."<br/>";
			if (!$userName)
				$userName = $this->config->guestName;

			return $userName;
		}
	}
?>