<?php
/*	$message = "Текст сообщения";
	$to = "myrusakov@mail.ru";
	$from = "myrusakov@mail.ru";
	$subject = "Тема сообщения";
	$subject = "=?utf-8?B?".base64_encode($subject)."?=";
	$headers = "From: $from\r\nReply-to: $from\t\nContent-type: text/plain; charset=utf-8\r\n";
	mail($to, $subject, $message, $headers);
	

	$message = "Сообщение с <b>HTML</b>-<i>кодом</i>";
	$to = "myrusakov@mail.ru";
	$from = "myrusakov@mail.ru";
	$subject = "Тема сообщения";
	$subject = "=?utf-8?B?".base64_encode($subject)."?=";
	$headers = "From: $from\r\nReply-to: $from\t\nContent-type: text/html; charset=utf-8\r\n";
	mail($to, $subject, $message, $headers);
*/
?>

<?php
	function sendMail($to, $from = "", $subject = "", $message = "", $charset = "utf-8", $reply_to = "", $content_type = "text/html") {
		if ($reply_to == "") {
			$reply_to = $from;
		}
		$subject = "=?".$charset."?B?".base64_encode($subject)."?=";
		$headers = "From: $from\r\nReply-to: $reply_to\t\nContent-type: $content_type; charset=$charset\r\n";
		mail($to, $subject, $message, $headers);
	}
?>
