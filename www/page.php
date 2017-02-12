<?php
	require_once 'lib/database_class.php';
	require_once 'lib/user_class.php';
	$db = new DataBase();
/*	echo $db->getCount("menu")."<br/>";
	echo $db->getMaxID("menu")."<br/>";
	echo $db->getMaxValueOfField("menu", "id")."<br/>";
	print_r($db->getValueBetween("menu", "id", 1, 2))."<br/>";
*/	
	// require_once 'lib/article_class.php';
	// $article = new Article($db);
	// $title = $article->get(1, "title");
	// echo $title."<br/>";
	// $title .= "555";
	// $article->set(1, "title", $title);
	// echo $article->get(1, "title")."<br/>";
	// echo $article->get(2, "full_text")."<br/>";
	// $all = $article->getAll();
	// print_r($all);
	$user = new User($db);
	$record = $user->getUserOnLogin("user1");
	// print_r($record);
	echo ""."<br/>";
	unset($db);
	unset($article);
?>