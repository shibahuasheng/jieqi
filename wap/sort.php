<?php

	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	$url=$_SERVER['REQUEST_URI'];	

	if($_GET[sortid] && $_GET[page]){ 
		if($_GET['sortid'] && $_GET['page']){
			$sortid = intval($_GET['sortid']);
			$pageid = intval($_GET['page']);
			$sortname = $jieqiSort['article'][$sortid][caption];
			if(is_int($sortid)){if($sortid == 0){die("sortid0");}}
			else{die("1-".$sortid);}
			if(is_int($pageid)){if($pageid == 0){die("pageid0");}}
			else{die("2-".$pageid);}
			$pagecount = 1 ;
			$pagenum = 20 ;
			$numall = 1;
			$numbegin = 1;
			$numend = 1;
			$previd = 1;
			$nextid = 1;
			$numall =  $db->get_var("select count(articleid) from ".$_17mb_prev."article_article where sortid = '".$sortid."' "); 
			$pagecount = ceil( $numall / $pagenum ) ;
			$numbegin = ( $pageid - 1 ) * $pagenum ;
			$numend = $pagenum ;
			//处理上一页和下一页页码
			if($pageid != 1){
				$previd = $pageid - 1;
			}
			if($pageid != $pagecount){
				$nextid = $pageid + 1;
			}
			else{
				$nextid = $pagecount;
			}
			$sqlsort = $db->get_results("select articleid,articlename,author from jieqi_article_article where sortid = '".$sortid."' order by lastupdate desc limit ".$numbegin.",".$numend." ");
			
			if($sqlsort){
				$tpl->assign("type",$type);
				$tpl->assign("sortid",$sortid);
				$tpl->assign("sortname",$sortname);
				$k1 = 0;
				foreach($sqlsort as $v){
					$arr[$k1][articleid] = $v->articleid;
					$arr[$k1][shortid] = intval($v->articleid / 1000);
					$arr[$k1][articlename] = $v->articlename;
					$arr[$k1][author] = $v->author;
					$k1++;
				}
				$tpl->assign('articlerows',$arr);	
				
				//页码处理
				$shouye = '<a href="/sort/'.$sortid.'_1/">首页</a>';
				$preview = '<a href="/sort/'.$sortid.'_'.$previd.'/">上页</a>';
				$next = '<a href="/sort/'.$sortid.'_'.$nextid.'/">下页</a>';
				$weiye = '<a href="/sort/'.$sortid.'_'.$pagecount.'/">尾页</a>';
				//第一页
				if($pageid == 1 ){ $shouye = '';$preview = ''; }
				//最后一页
				if($pageid == $pagecount){ $weiye = '';$next = ''; }
				if($pageid == 1 && $pageid == $pagecount){
					$next = '<a href="/sort/'.$sortid.'_'.$nextid.'/">下页</a>';
					$weiye = '<a href="/sort/'.$sortid.'_'.$pagecount.'/">尾页</a>';	
				}
				$pagecontent .='
		<div class="page">'.$shouye.$preview.$next.$weiye.'</div>
		<div class="page">输入页数<input id="pageinput" size="4" /><input type="button" value="跳转" onclick = "page()" /> <br/>(第'.$pageid.'/'.$pagecount.'页)当前'.$pagenum.'条/页</div>';
				$tpl->assign('jumppage',$pagecontent);	
			}
		}
	}
	else{
	
	}
	$cachedir = str_replace('\\','/',$tpl->cache_dir)."sort";
	$tpl->cache_dir = $cachedir;
	$tpl->display('sort.html',$url);	
?>
