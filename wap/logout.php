<?php
	session_start();
	require 'main.php';
	unset($_SESSION['uid']);
	unset($_SESSION["jieqiUserId"]);
	unset($_SESSION["jieqiUserUname"]);
	unset($_SESSION["jieqiUserName"]);
	unset($_SESSION["jieqiUserGroup"]);
?>
