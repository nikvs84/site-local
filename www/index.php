<?php
	mb_internal_encoding("UTF-8");
	require_once 'lib/database_class.php';
	require_once 'lib/frontpagecontent_class.php';
	require_once 'lib/sectioncontent_class.php';
	require_once 'lib/articlecontent_class.php';
	require_once 'lib/regcontent_class.php';
	require_once 'lib/messagecontent_class.php';
	require_once 'lib/confirmcontent_class.php';
	require_once 'lib/manage_class.php';
	require_once 'lib/passwordrestorecontent_class.php';
	require_once 'lib/passwordchangecontent_class.php';
	require_once 'lib/searchcontent_class.php';
	require_once 'lib/notfoundcontent_class.php';
	require_once 'lib/pollcontent_class.php';

	$db = new DataBase();
	$view = $_GET["view"];
	switch ($view) {
		case '':
			$content = new FrontPageContent($db);
			break;
		case 'section':
			$content = new SectionContent($db);
			break;
		case 'article':
			$content = new ArticleContent($db);
			break;
		case 'reg':
			$content = new RegContent($db);
			break;
		case 'message':
			$content = new MessageContent($db);
			break;
		case 'search':
			$content = new SearchContent($db);
			break;
		case 'password_restore':
			$content = new PasswordRestoreContent($db);
			break;
		case 'password_change':
			$content = new PasswordChangeContent($db);
			break;
		case 'confirm':
			header("Location: http://".$_SERVER["HTTP_HOST"]."/functions.php/?login=".$_GET["login"]."&hash=".$_GET["hash"]);
			break;
		case 'poll':
			$content = new PollContent($db);
			break;
		case 'notfound':
			$content = new NotFoundContent($db);
			break;
		default:
			$content = new NotFoundContent($db);
			break;
	}

	echo $content->getContent();
?>
