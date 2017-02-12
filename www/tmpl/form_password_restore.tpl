<h1>Восстановление пароля</h1>
%message%
<div id="reg">
	<form action="functions.php" name="password_restore" method="post">
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
				<td>Подтверждение пароля:</td>
				<td>
					<input type="password" name="password_confirm" />
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
					<input type="submit" name="password_restore" value="Восстановить пароль" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="secret_key" value="%secret_key%">
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
