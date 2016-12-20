<?php
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	$url=$_SERVER['REQUEST_URI'];
	$urlinfo = $_17mb_url.$url;
	$_17mb_uid = $_SESSION["jieqiUserId"] ? $_SESSION["jieqiUserId"] : "";
	
	if($_GET[aid]){ 
		$aid = intval($_GET['aid']);
		$article = $db->get_row("select articlename,author,intro,sortid,fullflag,lastupdate,lastchapterid,lastchapter from ".$_17mb_prev."article_article where articleid = '".$aid."'");	
		if($article){	
			$tpl->assign("articleid",$aid);
			$tpl->assign("shortid",intval($aid/1000));
			$tpl->assign("articlename",$article->articlename);
			$tpl->assign("author",$article->author);
			$tpl->assign("intro",$article->intro);
			$tpl->assign("sortid",$article->sortid);
			$tpl->assign("sortname",$jieqiSort['article'][$article->sortid]['caption']);
			$tpl->assign("fullflag",($article->fullflag == 1 ) ? "已完结" : "连载中");
			$tpl->assign("lastupdate",$article->lastupdate);
			$tpl->assign("lastchapterid",$article->lastchapterid);
			$tpl->assign("lastchapter",$article->lastchapter);
			$first = $db->get_row("select chapterid from ".$_17mb_prev."article_chapter where articleid = '".$aid."' and chaptertype =0 order by chapterid asc limit 0,1");		
			$tpl->assign("firstid",$first->chapterid);
			
			$chapter = $db->get_results("select chapterid,chaptername from ".$_17mb_prev."article_chapter where articleid = '".$aid."' and chaptertype != 1 order by chapterid desc limit 0,5");
			$k = 0;
			foreach($chapter as $v){
				$arr[$k]["chapterid"] = $v->chapterid;
				$arr[$k]["chaptername"] = $v->chaptername;
				$k++;
			}
			$tpl->assign("chapter",$arr);
			$tpl->assign("_17mb_uid",$_17mb_uid);
			$tpl->assign("urlinfo",$urlinfo);
		}
		else{
			
		}
	}
	else{
	
	}
	$cachedir = str_replace('\\','/',$tpl->cache_dir).intval($aid/1000)."/".$aid;
	$tpl->cache_dir = $cachedir;
	$tpl->display('info.html',$url);
?>
