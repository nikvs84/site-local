<h1>Регистрация</h1>
%message%
<div id="reg">
	<form action="functions.php" name="reg" method="post">
		<table>
			<tr>
				<td>Логин:</td>
				<td>
					<input type="text" name="login" value="%login%" />
				</td>
			</tr>
			<tr>
				<td>Пароль:</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td>E-Mail:</td>
				<td>
					<input type="text" name="email" />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" valign="middle">
					<img src="captcha.php" alt="captcha" />
				</td>
			</tr>
			<tr>
				<td>Проверочный код:</td>
				<td>
					<input type="text" name="captcha" />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<input type="submit" name="reg" value="Зарегистрироваться" />
				</td>
			</tr>
		</table>
	</form>
</div>
