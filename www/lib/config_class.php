<?php
	class Config {
		var $sitename = "Site.Local";
		var $address = "http://site.local/";
		var $secret = "dig9999";
		var $host = "localhost";
		var $db = "mybase";
		var $db_prefix = "lesson_";
		var $user = "root";
		var $password = "";
		var $admname = "Михаил Русаков";
		var $admemail = "nikvs84@rambler.ru";
		var $images = "http://site.local/images/";
		var $dir_text = "lib/text/";
		var $dir_tmpl = "tmpl/";
		var $count_blog = 2;
		var $fonts = "fonts/";
		var $guestName = "Guest";

		var $min_login = 3;
		var $max_login = 255;

		var $search_preview_length = 255;
		// var $search_preview_indent = 0;
		var $search_preview_indent = "whole_word";
	}
?>