<?php
	require_once 'modules_class.php';
	
	class SearchContent extends Modules {
		private $words;

		public function __construct($db) {
			parent::__construct($db);
			$this->words = $this->data["words"];
		}

		protected function getTitle() {
			return "Результаты поиска: ".$this->words;
		}

		protected function getDescription() {
			return $this->words;
		}

		protected function getKeyWords() {
			return mb_strtolower($this->words);
		}

		protected function getMiddle() {
			$results = $this->article->searchArticles($this->words);

			if (!$results) {
				return $this->getTemplate("search_notfound");
			}

			for ($i = 0; $i < count($results); $i++) { 
				$sr["link"] = $this->config->address."?view=article&amp;id=".$results[$i]["id"];
				$sr["title"] = $results[$i]["title"];
				$sr["preview"] = $this->getPreview($results[$i]["full_text"], $results[$i]["preview_start"], $results[$i]["preview_length"], $this->words);

				$text .= $this->getReplaceTemplate($sr, "search_item");
			}
			$new_sr["search_items"] = $text;
			return $this->getReplaceTemplate($new_sr, "search_result");
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