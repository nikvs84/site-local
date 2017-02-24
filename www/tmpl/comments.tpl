<div class="all-comments">
	<form action="functions.php" method="post">
		<textarea name="comment" cols="30" rows="10">Комментарий...</textarea>
		<input type="submit" name="send_comment" />
		<input type="hidden" name="article_id" value="%article-id%" />
		<input type="hidden" name="login" value="%login%" />
	</form>
	<h3>Комментарии</h3>
	%comments%
</div>