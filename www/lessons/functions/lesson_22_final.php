<?php
	session_start();
	if (isset($_POST["send"])) {
		$from = $_POST["from"];
		$to = $_POST["to"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];
		$_SESSION["from"] = $from;
		$_SESSION["to"] = $to;
		$_SESSION["subject"] = $subject;
		$_SESSION["message"] = $message;
		
		$error_from = "";
		$error_to = "";
		$error_subject = "";
		$error_message = "";
		$pattern_email = "/^[a-z0-9][a-z0-9\.-_]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
		if (!preg_match($pattern_email, $from)) {
			$error_from = "Некорректный e-mail";
			$error = true;			
		}
		if (!preg_match($pattern_email, $to)) {
			$error_to = "Некорректный e-mail";
			$error = true;			
		}
		if (strlen($subject) == 0) {
			$error_subject = "Не указана тема";
			$error = true;
		}
		if (strlen($message) == 0) {
			$error_message = "Не написано сообщение";
			$error = true;
		}

		if (!$error) {
			$subject = "=?геа-8?B?".base64_encode($subject)."?=";
			$headers = "From: $from\r\nReply-to: $from\r\nContent-type: test/html; charset=windows-1251\r\n";
			mail($to, $subject, $message, $headers);
			header("Location: lessons/success.php?send=1");
			exit;
		}
	}
?>

<html>
	<head>
		<title>Сервис рассылки</title>
		<meta thhp-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="styles/style.css"/>
	</head>
	<body>
		<h1>Отправьте почту</h1>
		<form action="#" method="post">
			<table>
				<tr>
					<td>От кого:</td>
					<td>
						<input type="text" name="from" value="<?php echo $_SESSION["from"]; ?>"/>
					</td>
					<td>
						<span style="color: red;"><?php echo $error_from; ?></span>
					</td>
				</tr>
				<tr>
					<td>Кому:</td>
					<td>
						<input type="text" name="to" value="<?php echo $_SESSION["to"]; ?>"/>
					</td>
					<td>
						<span style="color: red;"><?php echo $error_to; ?></span>
					</td>					
				</tr>
				<tr>
					<td>Тема:</td>
					<td>
						<input type="text" name="subject" value="<?php echo $_SESSION["subject"]; ?>"/>
					</td>
					<td>
						<span style="color: red;"><?php echo $error_subject; ?></span>
					</td>
				</tr>
				<tr>
					<td>Сообщение:</td>
					<td>
						<textarea name="message" id="" cols="20" rows="10"><?php echo $_SESSION["message"]; ?></textarea>
					</td>
					<td>
						<span style="color: red;"><?php echo $error_message; ?></span>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<input type="submit" name="send"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>