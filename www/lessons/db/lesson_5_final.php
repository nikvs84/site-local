<?php
	require_once "lib/user_class.php";
	$user = User::getObject();
	$auth = $user->isAuth();
	if (isset($_POST["reg"])) {
		$login = $_POST["login"];
		$password = $_POST["password"];
		$regSuccess = $user->regUser($login, $password);
	} elseif (isset($_POST["auth"])) {
		$login = $_POST["login"];
		$password = $_POST["password"];
		$authSuccess = $user->login($login, $password);
		if ($authSuccess) {
			header("Location: index.php");
			exit;
		}
	}
?>
<html>
<head>
	<title>Регистрация пользователя</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="styles/style.css"/>
</head>
<body>
	<?php
		if ($auth)
			echo "Здравствуйте, ".$_SESSION["login"]." "."<a href=\"lessons/db/logout.php\">Выход</a>";
		else {
			if ($_POST["reg"]) {
				if ($regSuccess)
					echo "<span style=\"color: green;\">Регистрация прошла успешно</span>";
				else
					echo "<span style=\"color: red;\">Ошибка при регистрации</span>";
			} elseif ($_POST["auth"]) {
				if (!$authSuccess) {
					echo "<span style=\"color: red;\">Неверные имя пользователя и/или пароль</span>";
				}
			}
			echo '<h1>Регистрация</h1>
			<form name="reg" action="index.php" method="post">
				<table>
					<tr>
						<td>Логин:</td>
						<td>
							<input type="text" name="login"/>
						</td>
					</tr>
					<tr>
						<td>Пароль:</td>
						<td>
							<input type="password" name="password"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="reg" value="Зарегистрироваться"/>
						</td>
					</tr>
				</table>
			</form>
			<h1>Авторизация</h1>
			<form name="reg" action="index.php" method="post">
				<table>
					<tr>
						<td>Логин:</td>
						<td>
							<input type="text" name="login"/>
						</td>
					</tr>
					<tr>
						<td>Пароль:</td>
						<td>
							<input type="password" name="password"/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="auth" value="Войти"/>
						</td>
					</tr>
				</table>
			</form>';
		}
	?>

</body>
</html>


