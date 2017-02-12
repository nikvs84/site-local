<?php
	require_once 'config_class.php';
	require_once 'checkvalid_class.php';

	class DataBase {
		private $config;
		private $mysqli;
		private $valid;

		public function __construct() {
			$this->config = new config();
			$this->valid = new CheckValid();
			$this->mysqli = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
			$this->mysqli->query("SET NAMES 'utf8'");
		}

		private function query($query) {
			return $this->mysqli->query($query);
		}

		private function select($table_name, $fields, $where = "", $order = "", $up = true, $limit = "") {
			for ($i = 0; $i < count($fields); $i++) { 
				if (strpos($fields[$i], "(" === false) && $fields[$i] != "*") {
					$fields[$i] = "`".$fields[$i]."`";
				}
			}
			$fields = implode(", ", $fields);
			$table_name = $this->config->db_prefix.$table_name;

			if (!$order)
				$order = "ORDER BY `id`";
			else {
				if ($order != "RAND()") {
					$order = "ORDER BY `$order`";
					if (!$up) $order .= " DESC";
				} else 
					$order = "ORDER BY $order";
			}

			if ($limit)
				$limit = "LIMIT $limit";
			if ($where)
				$query = "SELECT $fields FROM $table_name WHERE $where $order $limit";
			else
				$query = "SELECT $fields FROM $table_name $order $limit";
			// echo "$query"."<br/>";
			$result_set = $this->query($query);
			if (!$result_set)
				return false;
			$i = 0;
			while ($row = $result_set->fetch_assoc()) {
				$data[$i] = $row;
				// print_r($data[$i]);
				// echo ""."<br/>";
				$i++;
			}
			$result_set->close();
			return $data;
		}

		public function insert($table_name, $new_values) {
			$table_name = $this->config->db_prefix.$table_name;
			$query = "INSERT INTO $table_name (";
			foreach ($new_values as $field => $value)
				$query .= "`".$field."`,";
			$query = substr($query, 0, -1);
			$query .= ") VALUES (";
			foreach ($new_values as $value)
				$query .= "'".addslashes($value)."',";
			$query = substr($query, 0, -1);
			$query .= ")";
			return $this->query($query);
		}

		public function update($table_name, $upd_fields, $where) {
			$table_name = $this->config->db_prefix.$table_name;
			$query = "UPDATE $table_name SET ";
			foreach ($upd_fields as $field => $value)
				$query .= "`$field` = '".addslashes($value)."',";
			$query = substr($query, 0, -1);
			if ($where) {
				$query .= " WHERE $where";
				return $this->query($query);
			} else
				return false;
		}

		public function updateOnID($table_name, $id, $upd_fields) {
			$table_name = $this->config->db_prefix.$table_name;
			$query = "UPDATE $table_name SET ";
			foreach ($upd_fields as $field => $value)
				$query .= "`$field` = '".addslashes($value)."',";
			$query = substr($query, 0, -1);
			$query .= "WHERE id=".$id;
			return $this->query($query);
		}

		public function delete ($table_name, $where = "") {
			$table_name = $this->config->db_prefix.$table_name;
			if ($where) {
				$query = "DELETE FROM $table_name WHERE $where";
				return $this->query($query);
			} else
				return false;
		}

		public function deleteAll($table_name) {
			$table_name = $this->config->db_prefix.$table_name;
			$query = "TRUNCATE TABLE `$table_name`";
			return $this->query($query);
		}

		public function getField($table_name, $field_out, $field_in, $value_in) {
			// echo "value_in = $value_in"."<br/>";
			$data = $this->select($table_name, array($field_out), "`$field_in`='".addslashes($value_in)."'");
			if (count($data) != 1)
				return false;
			return $data[0][$field_out];
		}

		public function getFieldOnID($table_name, $id, $field_out) {
			if (!$this->existsID($table_name, $id))
				return false;
			return $this->getField($table_name, $field_out, "id", $id);
		}

		public function getAll($table_name, $order, $up) {
			return $this->select($table_name, array("*"), "", $order, $up);
		}

		public function getAllOnField($table_name, $field, $value, $order, $up) {
			return $this->select($table_name, array("*"), "`$field`='".addslashes($value)."'", $order, $up);
		}

		public function deleteOnID($table_name, $id) {
			if (!$this->existsID($table_name, $id))
				return false;
			return $this->delete($table_name, "`id`='".addslashes($id)."'");
		}

		public function setField($table_name, $field, $value, $field_in, $value_in) {
			return $this->update($table_name, array($field => $value), "`$field_in`='".addslashes($value_in)."'");
		}

		public function setFieldOnID($table_name, $id, $field, $value) {
			if (!$this->existsID($table_name, $id))
				return false;
			return $this->setField($table_name, $field, $value, "id", $id);
		}

		public function getElementOnID($table_name, $id) {
			if (!$this->existsID($table_name, $id))
				return false;
			$record = $this->select($table_name, array("*"), "`id`='".addslashes($id)."'");
			return $record[0];
		}

		public function getRandomElements($table_name, $count) {
			return $this->select($table_name, array("*"), "", "RAND()", true, $count);
		}

		public function getCount($table_name) {
			$data = $this->select($table_name, array("COUNT(`id`)"));
			// print_r($data)."<br/>";
			return $data[0]["COUNT(`id`)"];
		}

		public function getMaxValueOfField($table_name, $field) {
			$data = $this->select($table_name, array("MAX(`".addslashes($field)."`)"));
			// print_r($data)."<br/>";
			return $data[0]["MAX(`$field`)"];
		}

		public function getMinValueOfField($table_name, $field) {
			$data = $this->select($table_name, array("MIN(`".addslashes($field)."`)"));
			return $data[0][`$field`];
		}

		public function getValueBetween($table_name, $field, $before, $after) {
			return $this->select($table_name, array("*"), "`".addslashes($field)."` BETWEEN '".addslashes($before)."' AND '".addslashes($after)."'");
		}

		public function getMaxID($table_name) {
			return $this->getMaxValueOfField($table_name, "id");
		}

		public function isExists($table_name, $field, $value) {
			$data = $this->select($table_name, array("id"), "`$field`='".addslashes($value)."'");
			if (count($data) === 0)
				return false;
			else
				return true;
		}

		private function existsID($table_name, $id) {
			if (!$this->valid->validID($id))
				return false;
			$data = $this->select($table_name, array("id"), "`id`='".addslashes($id)."'");
			if (count($data) === 0)
				return false;
			return true;
		}

		public function search($table_name, $words, $fields) {		
			$words = mb_strtolower($words);
			$words = trim($words);
			$words = quotemeta($words);
			if ($words == "")
				return false;
			$where = "";
			$arraywords = explode(" ", $words);
			$logic = "OR";

			foreach ($arraywords as $key => $value) {
				if (isset($arraywords[$key - 1])) 
					$where .= $logic;
				for ($i = 0; $i < count($fields); $i++) { 
					$where .= "`".$fields[$i]."` LIKE '%".addslashes($value)."%'";
					if (($i + 1) != count($fields))
						$where .= " ".$logic." ";
				}
			}

			$results = $this->select($table_name, array("*"), $where);
			if (!$results)
				return false;
			
			$k = 0;
			$data = array();
			for ($i = 0; $i < count($results); $i++) { 
				for ($j = 0; $j < count($fields); $j++) { 
					$results[$i][$fields[$j]] = mb_strtolower(strip_tags($results[$i][$fields[$j]]));
				}
				$data[$k] = $results[$i];
				$data[$k]["relevant"] = $this->getRelevantForSearch($results[$i], $fields, $words);
				$data[$k]["preview_start"] = $this->getPreviewByFrequency($data[$k]["full_text"], $arraywords);

/*				echo "title = ".$data[$k]["title"]."<br/>";
				echo "preview_start = ".$data[$k]["preview_start"]."<br/>";
*/				
				$data[$k]["preview_length"] = $this->config->search_preview_length;
				$k++;
			}
			$data = $this->orderResultSearch($data, "relevant");
			
			return $data;
		}

		private function getRelevantForSearch($result, $fields, $words) {
			$relevant = 0;
			$arraywords = explode(" ", $words);
			for ($i = 0; $i < count($fields); $i++) { 
				for ($j = 0; $j < count($arraywords); $j++) { 
					$relevant += substr_count($result[$fields[$i]], $arraywords[$j]);
				}
			}
			return $relevant;
		}

		private function orderResultSearch($data, $order) {
			for ($i = 0; $i < count($data); $i++) { 
				$k = $i;
				for ($j = $i + 1; $j < count($data); $j++) { 
					if ($data[$j][$order] > $data[$k][$order])
						$k = $j;
				}
				$temp = $data[$k];
				$data[$k] = $data[$i];
				$data[$i] = $temp;
			}
			return $data;
		}

		private function getPreviewByFrequency($text, $words) {
			$maxFrequency = 0;
			$start = 0;
			$indent = $this->config->search_preview_indent;
			if (is_numeric($indent))
				$length = $this->config->search_preview_length - $indent;
			else
				$length = $this->config->search_preview_length;

			$positions = $this->getPreviewStarts($text, $words, $length);

/*			echo "positions: ";
			print_r($positions);
			echo ""."<br/>";
*/
			for ($i = 0; $i < count($positions); $i++) {
				$currentFrequency = $this->getFrequencyOfWords($text, $words, $positions[$i], $length);

				// echo "currentFrequency = ".$currentFrequency."<br/>";
				
				if ($currentFrequency > $maxFrequency) {
					$maxFrequency = $currentFrequency;
					$start = $positions[$i];
				}
			}

			// $result = mb_substr($text, $start, $length);
			
			
			if (is_numeric($indent)) {
				$result = ($start - $indent >= 0) ? $start - $indent : 0;
			} else {
				if (mb_strtolower($indent) === "whole_word") {
					$start = $this->getStartOfWord($text, $start);
				}
			}

			$textLength = mb_strlen($text);

			if ($textLength - $start < $length)
				$start = $textLength - $length;

			$result = $start;

			return $result;
		}

		private function getStartOfWord($text, $position) {
			while ($position > 0) {
				if (preg_match("/\w/", $text[$position - 1]))
					$position--;
				else
					break;
			}
			// echo "position = ".$position."<br/>";
			return $position;
		}

		private function getFrequencyOfWords($text, $words, $start, $length) {

/*			echo "--------------------------------------------------"."<br/>";
			echo "getFrequencyOfWords:"."<br/>";
			echo "start = ".$start."<br/>";
			echo "length = ".$length."<br/>";
			echo "length of text = ".mb_strlen($text)."<br/>";
*/
			$rest = mb_strlen($text) - $start;

			$currentLength = ($rest >= $length) ? $length : $rest;
			
			// echo "currentLength = ".$currentLength."<br/>";
			
			$fragment = mb_substr($text, $start, $currentLength);
			$fragment = mb_strtolower($fragment);
			
			// echo "fragment = ".$fragment."<br/>";
			
			$result = 0;
			
			for ($i = 0; $i < count($words); $i++) { 
				$result += mb_substr_count($fragment, $words[$i]);
			}

			// echo "result = ".$result."<br/>";
			
			return $result;
		}

		private function getPreviewStarts($text, $words, $length) {
			$result = array();

			$start = $this->getNextStart($text, $words, 0, $length);
			while ($start > -1) {
				// echo "nextStart = ".$start."<br/>";
				$result[] = $start;
				$start = $this->getNextStart($text, $words, $start + 1, $length);
			}

			return $result;
		}

		private function getNextStart($text, $words, $start, $length) {
			if ($start + $length + 1 > mb_strlen($text))
				return -1;

/*			print_r($words);
			echo ""."<br/>";
			echo "start = ".$start."<br/>";
*/			
			$result = mb_strlen($text);
			// echo "resultBefore = ".$result."<br/>";

			for ($i = 0; $i < count($words); $i++) { 
				$tempStart = mb_stripos($text, $words[$i], $start);
				// echo "tempStart = ".$tempStart."<br/>";
				if ($tempStart === false)
					return -1;
				if ($tempStart < $result)
					$result = $tempStart;
			}

			// echo "resultAfter = ".$result."<br/>";

			if ($result == mb_strlen($text))
				return -1;

			return $result;
		}

		public function __destruct() {
			if ($this->mysqli)
				$this->mysqli->close();
		}	
	}
?>