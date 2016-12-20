<?php
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");


	if($_POST[type] && $_POST[s]){
		$s = $_POST[s];
		$tpl->assign("search_key",$s);
		//$s = iconv("utf-8", "gbk", $s);
		if(strlen($s) < 2) die('<meta name="MobileOptimized" content="240"/><meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=1.0" /><div style="border:1px solid #18C2E7;background-color:#D3FEDA;margin:0 auto;width:90%;text-align:center;line-height:30px">Need More 4 Bytes</div>');
		
		if($_POST[type] == "articlename"){
			$where = "articlename like '%".$s."%'";
		}
		if($_POST[type] == "author"){
			$where = "author like '%".$s."%'";
		}
		$article = $db->get_results("select articleid,sortid,articlename,author from ".$_17mb_prev."article_article where ".$where." order by articleid desc");

		$search_num = "";
		if($article){
			$search_num = "1";
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
			$tpl->assign("search_num",$search_num);
		}
		else{
			$tpl->assign("search_num",$search_num);
		}
	}
	$tpl->caching = 0;
	$tpl->display('s.html',$url);
?>

