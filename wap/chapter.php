<?php 
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	$url=$_SERVER['REQUEST_URI'];
	$urlchapter = $_17mb_url.$url;
	$_17mb_uid = $_SESSION["jieqiUserId"] ? $_SESSION["jieqiUserId"] : "";
	if($_GET['aid'] && $_GET['cid']){
		$aid = intval($_GET['aid']);
		$cid = intval($_GET['cid']);
		
		$article = $db->get_row("select articleid,articlename,sortid,author from ".$_17mb_prev."article_article where articleid = '".$aid."' ");
		if($article){
			$shortid = intval($aid/1000);
			$tpl->assign('articleid',$aid);
			$tpl->assign('chapterid',$cid);
			$tpl->assign('articlename',$article->articlename);
			$tpl->assign('author',$article->author);
			$tpl->assign('sortname',$jieqiSort['article'][$article->sortid]['caption']);
			$tpl->assign('shortid',$shortid);
			$chapter = $db->get_row("select chaptername,chapterorder,attachment from ".$_17mb_prev."article_chapter where chaptertype = '0' and articleid = '".$aid."' and chapterid = '".$cid."' ");
			if($chapter){
				$chapterorder = $chapter->chapterorder;
				$tpl->assign("_17mb_uid",$_17mb_uid);
				$tpl->assign("urlchapter",$urlchapter);
				$tpl->assign('chaptername',$chapter->chaptername);
				if($chapter->attachment){
					$image_code = $chapter->attachment;
					$attachdir = $_17mb_pcdir.'/files/article/attachment/'.$shortid.'/'.$aid.'/'.$cid.'';
					$files=array();
					$dirhandle = @opendir($attachdir);
					while ($file = @readdir($dirhandle)) {
						if($file != '.' && $file != '..'){
							$files[] = $file;
						}
					}
					@closedir($dirhandle);
					foreach($files as $file){
						if (is_file($attachdir.'/'.$file)){
							$_17mb_content_img .= '<img src="'.$_17mb_pcurl.'/files/article/attachment/'.$shortid.'/'.$aid.'/'.$cid.'/'.$file.'" border="0" width="100%" class="imagecontent" />';
						}
					}					
				}
				$txtdir = $_17mb_txtdir.'/'.$shortid.'/'.$aid.'/'.$cid.'.txt';
				if(file_exists($txtdir)){
					$_17mb_content = @file_get_contents($txtdir);
					$_17mb_content = @str_replace("\r\n","<br/>",$_17mb_content);
					$_17mb_content = @str_replace(" ","&nbsp;",$_17mb_content);
				}
				else{
					echo "no txt file";	
				}					
				$tpl->assign("_17mb_content",$_17mb_content.'<br/>'.$_17mb_content_img);
				
				$preview_chapterid = '';
				$next_chapterid = '';
				$pre = $db->get_row("select chapterid from ".$_17mb_prev."article_chapter where articleid = '".$aid."' and chapterorder < '".$chapterorder."' and  chaptertype = '0' order by chapterorder desc limit 0,1");
				if($pre){
					$tpl->assign('preview_chapterid',$pre->chapterid);
				}
				$next = $db->get_row("select chapterid from ".$_17mb_prev."article_chapter where articleid = '".$aid."' and chapterorder > '".$chapterorder."' and chaptertype = '0' order by chapterorder limit 0,1");
				if($next){
					$tpl->assign('next_chapterid',$next->chapterid);
				}				
			}
			else{
				echo "no chapter";	
			}	
		}
	}
	$cachedir = str_replace('\\','/',$tpl->cache_dir).intval($aid/1000)."/".$aid;
	$tpl->cache_dir = $cachedir;
	$tpl->display('chapter.html',$url);
?>