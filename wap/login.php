<?php
	require 'main.php';
	$tpl->assign('_17mb_username',$_COOKIE['_17mb_username']);
	$tpl->assign('_17mb_userpass',$_COOKIE['_17mb_userpass']);
	$url=$_SERVER['REQUEST_URI'];	
	$tpl->display('login.html',$url);	
?>
