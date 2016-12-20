<?php
	header("content-type:text/html; charset=gbk");
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	$url = $_SERVER['REQUEST_URI'];
	$url = urlencode($url);
	
	if($_GET[author]){
		$author = $_GET[author];
		$author1 = rawurldecode($author);
		$author1 = iconv("UTF-8", "GB2312", $author1);
		($author1) ? ($author = $author1) : $author ;
		$tpl->assign("author",$author);
		if(strlen($author) < 2) die('<meta name="MobileOptimized" content="240"/><meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=1.0" /><div style="border:1px solid #18C2E7;background-color:#D3FEDA;margin:0 auto;width:90%;text-align:center;line-height:30px">Need More 4 Bytes</div>');

		$article = $db->get_results("select articleid,sortid,articlename,author from ".$_17mb_prev."article_article where author = '".$author."' order by articleid desc");

		if($article){
			$k = 0;
			foreach($article as $v){
				$arr[$k][articleid] = $v->articleid;
				$arr[$k][shortid] = intval($v->articleid / 1000);
				$arr[$k][articlename] = $v->articlename;
				$arr[$k][intro] = $v->intro;
				$arr[$k][author] = $v->author;
				$arr[$k][sortid] = $v->sortid;
				$arr[$k][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
				$k++;
			}
			$tpl->assign('articlerows',$arr);
		}
		else{
			
		}
	}
	$cachedir = str_replace('\\','/',$tpl->cache_dir).'author';
	$tpl->cache_dir = $cachedir;
	$tpl->display('author.html',$url);
?>