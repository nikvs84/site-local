<h1>Восстановление пароля</h1>
%message%
<div id="password_restore">
	<form action="functions.php" name="password_restore_start" method="post">
		<table>
			<tr>
				<td>Логин:</td>
				<td>
					<input type="text" name="login" value="%login%" />
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
					<input type="submit" name="restore_start" value="Восстановить пароль" />
				</td>
			</tr>
		</table>
	</form>
</div>
