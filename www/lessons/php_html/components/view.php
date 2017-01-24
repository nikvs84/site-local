<?php require_once "add_comments.php"; ?>
<html>
<head>
	<title>Вставка php</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="styles/style.css"/>
</head>
<body>
	<h1>Статья</h1>
	<p>Текст статьи...</p>
	<h2>Комментарии</h2>
	<?php require_once "comments.php"; ?>
	<? if (count($comments) != 0) {?>
			<table>
			<? for ($i=0; $i < count($comments); $i++) { ?>
				<tr>
				<td><b><?=$comments[$i]["name"]?></b></td>
				<td><?=$comments[$i]["comment"]?></td>
				</tr>
				<tr><td colspan='2'><hr/></td></tr>
			<?	}?>
			</table>
	<?	}?>
	<h3>Добавить комментарий</h3>
	<form action="" name="myform" method="post">
		<table>
			<tr>
				<td>Имя</td>
				<td>
					<input type="text" name="name"/>
				</td>
			</tr>
			<tr>
				<td>Комментарий</td>
				<td>
					<textarea name="comment" cols="21" rows="3"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="addcomment" value="Добавить"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>