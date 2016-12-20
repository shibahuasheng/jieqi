<?php
	require 'main.php';
	$url=$_SERVER['REQUEST_URI'];	
	$tpl->display('register.html',$url);	
?>
