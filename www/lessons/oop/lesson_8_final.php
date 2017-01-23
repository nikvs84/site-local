<?php
	require_once "lib/uploadimage_class.php";
	require_once "lib/uploadtext_class.php";
	if ($_POST["upload"]) {
		// print_r($_FILES);
		$uploadText = new UploadText();
		$uploadImage = new UploadImage();
		$successText = $uploadText->uploadFile($_FILES["text"]);
		$successImage = $uploadImage->uploadFile($_FILES["image"]);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Загрузка файлов</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="styles/style.css"/>
	</head>
	<body>
		<h1>Загрузка файлов</h1>
		<?php
			if ($_POST["upload"]) {
				if ($successText)
					echo "Текстовый файл успешно загружен"."<br/>";
				else
					echo "Ошибка при загрузке текстового файла"."<br/>";
				if ($successImage)
					echo "Изображение успешно загружено"."<br/>";
				else
					echo "Ошибка при загрузке изображения"."<br/>";
			}
		?>
		<form action="index.php" name="myform" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Изображение:</td>
					<td>
						<input type="file" name="image"/>
					</td>
				</tr>
				<tr>
					<td>Текст:</td>
					<td>
						<input type="file" name="text"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="upload" value="Загрузить файлы"/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>