<?php
	session_start();
	if ($_GET["send"] == 1) {
		echo "Ваше сообщение успешно отправлено на ".$_SESSION["to"]."<br/>";
		echo "<a href=\"".$_SERVER["HTTP_REFERER"]."\">Вернуться</a>";
	}
?>