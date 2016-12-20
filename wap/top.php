<?php
	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	$url=$_SERVER['REQUEST_URI'];	
	if($_GET[type] && $_GET[page]){//20条数据
		if($_GET['type'] && $_GET['page']){
			$type = $_GET['type'];		
			$pageid = intval($_GET['page']);
			if($type == "dayvisit" ||$type == "weekvisit" ||$type == "monthvisit" ||$type == "allvisit" ||$type == "dayvote" ||$type == "weekvote" ||$type == "monthvote" ||$type == "allvote" ||$type == "goodnum" ||$type == "size" ||$type == "postdate" ||$type == "lastupdate"){
				if(is_int($pageid)){if($pageid == 0){die("pageid0");}}
				else{die("2-".$pageid);}
				$pagecount = 1 ;
				$pagenum = 20 ;
				$numall = 1;
				$numbegin = 1;
				$numend = 1;
				$previd = 1;
				$nextid = 1;
				$nowtime = date("U");//现在时间
				if($type == "dayvisit" )  {
					$typename = "日排行榜";$orderby = "dayvisit";$where = "where lastvisit > ".($nowtime-86400); 
				}
				if($type == "weekvisit" ) { 
					$typename = "周排行榜";$orderby = "weekvisit";$where = "where lastvisit > ".($nowtime-604800);
				}
				if($type == "monthvisit" ){ 
					$typename = "月排行榜";$orderby = "monthvisit";$where = "where lastvisit > ".($nowtime-2592000);
				}
				if($type == "allvisit" )  { 
					$typename = "总排行榜";$orderby = "allvisit";$where = "";
				}
				if($type == "dayvote" )   { 
					$typename = "日推荐榜";$orderby = "dayvote";$where = "where lastvote > ".($nowtime-86400);
				}
				if($type == "weekvote" )  { 
					$typename = "周推荐榜";$orderby = "weekvote";$where = "where lastvote > ".($nowtime-604800);
				}
				if($type == "monthvote" ) { 
					$typename = "月推荐榜";$orderby = "monthvote";$where = "where lastvote > ".($nowtime-2592000);
				}
				if($type == "allvote" )   { 
					$typename = "总推荐榜";$orderby = "allvote";$where = "";
				 }
				if($type == "goodnum" ){
					$typename = "总收藏榜";$orderby = "goodnum";$where = "where goodnum > 0";
				}
				if( $type == "size" ){
					$typename = "字数排行";$orderby = "size";$where = "";
				}
				if( $type == "postdate" ){
					$typename = "最新入库";$orderby = "postdate";$where = "";
				}
				if( $type == "lastupdate") {
					$typename = "最近更新";$orderby = "lastupdate";$where = "";
				}
				$numall =  $db->get_var($sql_type_num.$where); 
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
				$sqltype = $db->get_results("select articleid,articlename,author,sortid from ".$_17mb_prev."article_article ".$where." order by ".$orderby." desc limit ".$numbegin.",".$numend);
				if($sqltype){
					$tpl->assign("type",$type);
					$tpl->assign("typename",$typename);
					$k1 = 0;
					foreach($sqltype as $v){
						$arr[$k1][articleid] = $v->articleid;
						$arr[$k1][shortid] = intval($v->articleid / 1000);
						$arr[$k1][articlename] = $v->articlename;
						$arr[$k1][author] = $v->author;
						$arr[$k1][sortid] = $v->sortid;
						$arr[$k1][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
						$k1++;
					}
					$tpl->assign('articlerows',$arr);
					//页码处理
					$shouye = '<a href="/top/'.$type.'_1/">首页</a>';
					$preview = '<a href="/top/'.$type.'_'.$previd.'/">上页</a>';
					$next = '<a href="/top/'.$type.'_'.$nextid.'/">下页</a>';
					$weiye = '<a href="/top/'.$type.'_'.$pagecount.'/">尾页</a>';
					//第一页
					if($pageid == 1 ){ $shouye = '';$preview = ''; }
					//最后一页
					if($pageid == $pagecount){ $weiye = '';$next = ''; }
					if($pageid == 1 && $pageid == $pagecount){
						$next = '<a href="/top/'.$type.'_'.$nextid.'/">下页</a>';
						$weiye = '<a href="/top/'.$type.'_'.$pagecount.'/">尾页</a>';	
					}
					$pagecontent .='<div class="page">'.$shouye.$preview.$next.$weiye.'</div>
									<div class="page">输入页数<input id="pageinput" size="4" /><input type="button" value="跳转" onclick = "page()" /> <br/>(第'.$pageid.'/'.$pagecount.'页)当前'.$pagenum.'条/页</div>';
					$tpl->assign('jumppage',$pagecontent);
				}
			}
			else{
				die("1-".$type);
			}
		}
		echo $content;
	}
	else{
	}
	$cachedir = str_replace('\\','/',$tpl->cache_dir)."top";
	$tpl->cache_dir = $cachedir;
	$tpl->display('top.html',$url);	
?>