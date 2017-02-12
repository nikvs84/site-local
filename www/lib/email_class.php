<?php
	class Email {
		public $email;

		function __construct($email) {
			$this->email = $email;
		}

		public function sendMail($to, $from = "", $subject = "", $message = "", $charset = "utf-8", $reply_to = "", $content_type = "text/html") {
			if ($reply_to == "") {
				$reply_to = $from;
			}
			$subject = "=?".$charset."?B?".base64_encode($subject)."?=";
			$headers = "From: $from\r\nReply-to: $reply_to\t\nContent-type: $content_type; charset=$charset\r\n";
			mail($to, $subject, $message, $headers);
		}

	}
?>