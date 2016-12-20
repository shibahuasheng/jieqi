<?php 
	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	$url=$_SERVER['REQUEST_URI'];	

	if($_GET['aid'] && $_GET['page']){
		$aid = intval($_GET['aid']);
		$pageid = intval($_GET['page']);
		
		if($_GET[desc]){
			$desc = intval($_GET[desc]);
			if(is_int($desc)){
				$desc = "desc";
			}	
		}
		else{
			$desc = "";	
		}
		
		$pagecount = 1 ;//共几页
		$pagenum = 20 ;//每页有多少条数据
		
		$numall = 1;//全部数据条数
		$numbegin = 1;//开始数据
		$numend = 1;//结束数据
		
		$previd = 1;//上一页页码
		$nextid = 1;//下一页页码
		
		$numall =  $db->get_var("select count(chapterid) from ".$_17mb_prev."article_chapter where chaptertype = '0' and articleid = '".$aid."' ");
		$pagecount = ceil( $numall / $pagenum ) ;
		
		$numbegin = ( $pageid - 1 ) * $pagenum ;
		$numend = $pagenum ;
		
		$article = $db->get_row("select articleid,articlename,sortid,author from ".$_17mb_prev."article_article where articleid = '".$aid."' ");
		$shortid = intval($aid/1000);
		$tpl->assign('articleid',$aid);
		$tpl->assign('articlename',$article->articlename);
		$tpl->assign('author',$article->author);
		$tpl->assign('sortname',$jieqiSort['article'][$article->sortid]['caption']);
		$tpl->assign("desc",$desc);
		$tpl->assign("shortid",$shortid);
		
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
				
		$chapter = $db->get_results("select chapterid,chaptername from ".$_17mb_prev."article_chapter where chaptertype = '0' and articleid = '".$aid."' order by chapterorder ".$desc." limit ".$numbegin.",".$numend." ");	
		if($chapter){
			$k = 0;
			foreach($chapter as $v){
				$arr[$k][chapterid] = $v->chapterid;
				$arr[$k][chaptername] = $v->chaptername;
				$k++;
			}
			$tpl->assign('chapter',$arr);

			if(!$desc){
				//页码设置//正序
				$shouye = '<a href="/'.$shortid.'/'.$aid.'_1/">首页</a>';
				$prepage = '<a href="/'.$shortid.'/'.$aid.'_'.$previd.'/">上一页</a>';
				$nextpage = '<a href="/'.$shortid.'/'.$aid.'_'.$nextid.'/">下一页</a>';
				$weiye = '<a href="/'.$shortid.'/'.$aid.'_'.$pagecount.'/">尾页</a>';
				//首页尾页处理
				//第一页
				if($pageid == 1 ){ $shouye = '';$prepage = ''; }
				//最后一页
				if($pageid == $pagecount){ $weiye = '';$nextpage = ''; }
				if($pageid == 1 && $pageid == $pagecount){
					$nextpage = '<a href="/'.$shortid.'/'.$aid.'_'.$nextid.'/">下一页</a>';
					$weiye = '<a href="/'.$shortid.'/'.$aid.'_'.$pagecount.'/">尾页</a>';	
				}
			}
			else{
				//页码设置//倒序
				$shouye = '<a href="/'.$shortid.'/'.$aid.'_1_1/">首页</a>';
				$prepage = '<a href="/'.$shortid.'/'.$aid.'_'.$previd.'_1/">上一页</a>';
				$nextpage = '<a href="/'.$shortid.'/'.$aid.'_'.$nextid.'_1/">下一页</a>';
				$weiye = '<a href="/'.$shortid.'/'.$aid.'_'.$pagecount.'_1/">尾页</a>';
				//首页尾页处理
				//第一页
				if($pageid == 1 ){ $shouye = '';$prepage = ''; }
				//最后一页
				if($pageid == $pagecount){ $weiye = '';$nextpage = ''; }
				if($pageid == 1 && $pageid == $pagecount){
					$nextpage = '<a href="/'.$shortid.'/'.$aid.'_'.$nextid.'_1/">下一页</a>';
					$weiye = '<a href="/'.$shortid.'/'.$aid.'_'.$pagecount.'_1/">尾页</a>';	
				}
			}
			
			$pagecontent = '
			<div class="page">'.$shouye.$prepage.$nextpage.$weiye.'</div>
			<div class="page">输入页数<input id="pageinput" size="4" /><input type="button" value="跳转" onclick = "page()" /> <br/>(第'.$pageid.'/'.$pagecount.'页)当前'.$pagenum.'条/页</div>';
			$tpl->assign("jumppage",$pagecontent);
		}
		else{
			
		}
		
	}
	$cachedir = str_replace('\\','/',$tpl->cache_dir).intval($aid/1000)."/".$aid;
	$tpl->cache_dir = $cachedir;
	$tpl->display('chapterlist.html',$url);
?>