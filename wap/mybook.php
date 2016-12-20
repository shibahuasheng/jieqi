<?php
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	$tpl->caching = 0;
	
	$showbooks = "";
	if(!$_SESSION["jieqiUserId"]){
		$tpl->assign("tips","<div style='border:1px solid #18C2E7;background-color:#D3FEDA;margin:10px;padding:10px;'>没登录或者登录过期，请重新<a href='/login.php'><font color=red>登录</font></a>！</div>");	
	}
	else{
		$uid = $_SESSION["jieqiUserId"];
		$tpl->assign("uid",$uid);
		
		$article = $db->get_results("select * from ".$_17mb_prev."article_bookcase where userid = '".$uid."'");
		if($article){
			$k = 0;
			foreach($article as $v){
				$aid = $v->articleid;
				$lastchapter = $db->get_row("select lastchapterid,lastchapter from ".$_17mb_prev."article_article where articleid = '".$aid."'");
				$arr[$k][articleid] = $aid;
				$arr[$k][shortid] = intval($v->articleid / 1000);
				$arr[$k][articlename] = $v->articlename;
				$arr[$k][bookmarkid] = $v->chapterid == 0 ? "" : $v->chapterid;
				$arr[$k][bookmark] = $v->chaptername;
				$arr[$k][lastchapter] = $lastchapter->lastchapter;
				$arr[$k][lastchapterid] = $lastchapter->lastchapterid;
				$k++;
			}
			$tpl->assign('num',$k);
			$tpl->assign('articlerows',$arr);
		}
		else{
			$tpl->assign("tips","<div style='border:1px solid #18C2E7;background-color:#D3FEDA;margin:10px;padding:10px;'>-_-&nbsp书架里一本书都没有！</div>");	
		}
	}
	$tpl->display('mybook.html',$url);
?> 
