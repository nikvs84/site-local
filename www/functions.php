<?php
	require_once 'lib/database_class.php';
	require_once 'lib/manage_class.php';

	$db = new DataBase();
	$manage = new Manage($db);
	if ($_GET["login"]) {
		$r = $manage->checkConfirm($_GET["login"], $_GET["hash"]);
	} elseif ($_POST["reg"]) {
		$r = $manage->regUser();
	} elseif ($_POST["auth"]) {
		$r = $manage->login();
	} elseif ($_GET["logout"]) {
		$r = $manage->logout();
	} elseif ($_POST["restore_start"]) {
		$r = $manage->restorePasswordStart();
	} elseif ($_POST["password_restore"]) {
		$r = $manage->restorePassword();
	} elseif ($_POST["poll"]) {
		$r = $manage->poll();
	} elseif ($_GET["change_password_start"]) {
		$r = $manage->changePasswordStart();
	} elseif ($_POST["password_change"]) {
		$r = $manage->changePassword();
	} elseif ($_POST["send_comment"]) {
		$r = $manage->addComment();
	} else {
		exit;
	}
	$manage->redirect($r);

?>

<?php
/*
	function add($x, $y) {
		return ($x + $y);
	}

	function sub($x, $y) {
		return ($x - $y);
	}

	function mult($x, $y) {
		return ($x * $y);
	}

	function div($x, $y) {
		if ($y == 0) {
			return false;
		}
		return ($x / $y);
	}

	function factorial($x) {
		if ($x < 0) {
			return false;
		}
		if (($x == 0) || ($x == 1)) {
			return 1;
		} else {
			return $x * factorial($x - 1);
		}
	}

	function avg($x, $y) {
		return ($x + $y) / 2;
	}

	function sortArray(&$array, $isUpSort) {
		if ($isUpSort) {
			asort($array);
		} else
			arsort($array);
	}
*/
?>
