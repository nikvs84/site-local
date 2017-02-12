<?php
	require_once 'modules_class.php';
	
	class NotFoundContent extends Modules {

		public function __construct($db) {
			parent::__construct($db);
			header("HTTP/1.1 404 Not Found");
		}

		protected function getTitle() {
			return "Страница не найдена - 404";
		}

		protected function getDescription() {
			return "Запрошенная страница не существует.";
		}

		protected function getKeyWords() {
			return "страница не найдена, страница не существует, 404";
		}

		protected function getMiddle() {
			return $this->getTemplate("notfound");
		}

		private function getPreview($text, $start, $length, $words, $indent = 0) {
			/*if ($start + $length >= mb_strlen($text))
				$length = mb_strlen($text) - 1 - $start;*/

			$result = mb_substr($text, $start, $length);

			return $this->markWords($result, $words);
		}

		private function getWordsArray($words) {
			$words = mb_strtolower($words);
			$words = trim($words);
			$words = quotemeta($words);

			return explode(" ", $words);
		}

		protected function markWords($text, $words, $tag = "span", $attr_name = "class", $attr_value = "marked-words") {
			$arrayWords = $this->getWordsArray($words);

			for ($i = 0; $i < count($arrayWords); $i++) {
				$replacement = "<$tag $attr_name=\"$attr_value\">".$arrayWords[$i]."</$tag>";
				$result .= mb_ereg_replace($arrayWords[$i], $replacement, $text);
			}

			return $result;
		}

	}
?>