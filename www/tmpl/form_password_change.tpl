<h1>Изменение пароля</h1>
%message%
<div id="reg">
	<form action="functions.php" name="form_password_change" method="post">
		<table>
			<tr>
				<td>Логин:</td>
				<td>
					<span>%login%</span>
				</td>
			</tr>
			<tr>
				<td>Пароль:</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td>Новый пароль:</td>
				<td>
					<input type="password" name="new_password" />
				</td>
			</tr>
			<tr>
				<td>Подтверждение нового пароля:</td>
				<td>
					<input type="password" name="new_password_confirm" />
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
					<input type="submit" name="password_change" value="Изменить пароль" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="login" value="%login%">
				</td>
			</tr>
		</table>
	</form>
</div>
