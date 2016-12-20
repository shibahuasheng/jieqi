<?php
	
	require "waf.php";
	
	/*******************************配置开始*************************************/
	
	/****** WAP网站名 ******/
	$_17mb_sitename = "17模板网";
	
	/****** PC版域名，前面需要加http:// ，后面不要加/ ******/
	$_17mb_pcurl = "http://www.xiaoshuo.com";
	
	/****** WAP域名，前面需要加http:// ，后面不要加/ ******/
	$_17mb_url = "http://m.xiaoshuo.com";
	
	/****** PC程序文件夹，最后不带/ ******/
	$_17mb_pcdir = "D:/www/xiaoshuo";
	
	/****** 杰奇章节TXT存放目录，最后不带/ ******/
	$_17mb_txtdir = "D:/www/xiaoshuo/files/article/txt";
	
	/****** WAP程序文件夹,如果本程序为独立网站请留空,如果本网站是二级目录,请填写"/"+二级目录名,如"/wap" ******/
	$_17mb_dir = "";
	
	/****** 数据库地址，一般不用修改 ******/
	$_17mb_host = "localhost";
	
	/****** 数据库帐号 ******/
	$_17mb_user = "root";
	
	/****** 数据库名 ******/
	$_17mb_name = "db_xiaoshuo";
	
	/****** 数据库密码 ******/
	$_17mb_pass = "123456";
	
	/****** 数据库表前缀，一般不用修改 ******/
	$_17mb_prev = "jieqi_";
	
	/****** 数据库编码 ******/
	//$db_language = 'utf8';
	
	/*******************************配置结束************************************/
	
	define(__SITE_ROOT,str_replace("\\","/",dirname(__FILE__)));
	include "libs/Smarty.class.php";
	$tpl = new Smarty;
	
	$tpl->cache_dir = __SITE_ROOT."/cache_c/cache";
	$tpl->compile_dir = __SITE_ROOT."/cache_c/templates_c";
	$tpl->template_dir= __SITE_ROOT."/17mb/templates";
	$tpl->caching = 0;
	$tpl->cache_lifetime = 3600;
	

	$tpl->assign('_17mb_pcurl',$_17mb_pcurl);
	$tpl->assign('_17mb_url',$_17mb_url);
	$tpl->assign('_17mb_dir',$_17mb_dir);
	$tpl->assign('_17mb_sitename',$_17mb_sitename);
	
	include_once "17mb/class/ez_sql_core.php";
	include_once "17mb/class/ez_sql_mysql.php";
	$db = new ezSQL_mysql($_17mb_user,$_17mb_pass,$_17mb_name,$_17mb_host);
	$db->get_results("SET NAMES 'gbk'");

	require '17mb/class/p_class.php';
	
?>  