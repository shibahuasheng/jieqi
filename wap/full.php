<?php 
	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	$url=$_SERVER['REQUEST_URI'];	
	if($_GET['page']){
		$pageid = intval($_GET['page']);
		
		if(is_int($pageid)){
			if($pageid == 0){
				die("pageid0");
			}
		}
		else{
			die("2-".$pageid);	
		}
		$pagecount = 1 ;//共几页
		$pagenum = 20 ;//每页有多少条数据
		$numall = 1;//全部数据条数
		$numbegin = 1;//开始数据
		$numend = 1;//结束数据
		$previd = 1;//上一页页码
		$nextid = 1;//下一页页码
		$numall = $db->get_var("select count(articleid) from ".$_17mb_prev."article_article where fullflag=1");
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
		
		$sqlfull = $db->get_results("select articleid,articlename,sortid,author from ".$_17mb_prev."article_article where fullflag = '1' order by lastupdate desc limit ".$numbegin.",".$numend." ");	
		if($sqlfull){
				$k1 = 0;
				foreach($sqlfull as $v){
					$arr[$k1][articleid] = $v->articleid;
					$arr[$k1][shortid] = intval($v->articleid / 1000);
					$arr[$k1][articlename] = $v->articlename;
					$arr[$k1][author] = $v->author;
					$arr[$k1][sortid] = $v->sortid;
					$arr[$k1][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
					$k1++;
				}
				$tpl->assign('articlerows',$arr);	
				//页码设置//正序
				$shouye = '<a href="/full/1/">首页</a>';
				$prepage = '<a href="/full/'.$previd.'/">上一页</a>';
				$nextpage = '<a href="/full/'.$nextid.'/">下一页</a>';
				$weiye = '<a href="/full/'.$pagecount.'/">尾页</a>';
				//首页尾页处理
				//第一页
				if($pageid == 1 ){ $shouye = '';$prepage = ''; }
				//最后一页
				if($pageid == $pagecount){ $weiye = '';$nextpage = ''; }
				if($pageid == 1 && $pageid == $pagecount){
					$nextpage = '<a href="/full/'.$nextid.'/">下一页</a>';
					$weiye = '<a href="/full/'.$pagecount.'/">尾页</a>';	
				}
				
				
				$pagecontent = '
				<div class="page">'.$shouye.$prepage.$nextpage.$weiye.'</div>
				<div class="page">输入页数<input id="pageinput" size="4" /><input type="button" value="跳转" onclick = "page()" /> <br/>(第'.$pageid.'/'.$pagecount.'页)当前'.$pagenum.'条/页</div>
				';
				$tpl->assign('jumppage',$pagecontent);	
		}
	}
	$tpl->display('full.html',$url);
?>
