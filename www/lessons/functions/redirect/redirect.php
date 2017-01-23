<?php
	if (isset($_GET["n1"])) {
		$n1 = $_GET["n1"];
		$n2 = $_GET["n2"];
		$result = $n1 + $n2;
		$option = mt_rand(0, 1);
		$data = "n1=$n1&n2=$n2&result=$result";
		if ($option)
			header("location: ../../index.php"."?".$data);
		else			
			sendPOST($data);
		// sendWithSocket($n1, $n2, $result); //не работает
	}
?>

<?php
	function sendPOST($data) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $_SERVER["HTTP_HOST"]);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_exec($curl);
		curl_close($curl);
	}
?>

<?php
	function sendWithSocket($n1, $n2, $result) {
		$hostname = $_SERVER["HTTP_HOST"];
		$path = 'index.php';
		$content = '';
		// Устанавливаем соединение с сервером $hostname
		$fp = fsockopen($hostname, 80, $errno, $errstr, 30); 
		// Проверяем успешность установки соединения
		if (!$fp) die('<p>'.$errstr.' ('.$errno.')</p>'); 

		// Данные HTTP-запроса
		$data = 'n1='.urlencode($n1).'&n2='.urlencode($n2).'&result='.urlencode($result);
		// Заголовок HTTP-запроса
		$headers = 'POST '.$path." HTTP/1.1\r\n"; 
		$headers .= 'Host: '.$hostname."\r\n"; 
		$headers .= "Content-type: application/x-www-form-urlencoded\r\n";
		$headers .= 'Content-Length: '.strlen($data)."\r\n\r\n";
		// Отправляем HTTP-запрос серверу
		fwrite($fp, $headers.$data); 
		// Получаем ответ
		while ( !feof($fp) ) $content .= fgets($fp, 1024);
		// Закрываем соединение
		fclose($fp);
		// Выводим ответ в браузер  
		echo $content;
	}
?>