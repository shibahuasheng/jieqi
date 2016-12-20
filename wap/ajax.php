<?php 
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	//header('Content-type: text/html; charset=gbk');
	if($_GET['is_login']!=null){
		if($_SESSION['jieqiUserId']!=null){
			echo "right";	
		}
		else{
			echo "error";	
		}
	}
	if($_GET['showlogin']!=null){
		if($_SESSION['jieqiUserId']!=null){
			if($_SESSION['jieqiUserUname']!=null){
				echo iconv("gbk", "utf-8", $_SESSION['jieqiUserUname']);
			}	
		}
		else{
			echo "nologin";	
		}
	}
	if($_GET['bookcase']!=null){
		if($_SESSION['jieqiUserId']!=null){
			echo $_SESSION['jieqiUserId'];
		}
		else{
			echo "nologin";	
		}
	}
	
	if($_GET['addbookcase'] && $_GET['aid'] && $_GET['urlinfo']){
		$aid = intval($_GET['aid']);
		$urlinfo = $_GET['urlinfo'];
		if($_SESSION['jieqiUserId']){
			$uid = $_SESSION['jieqiUserId'];
			$username = $_SESSION['jieqiUserUname'];
			$article = $db->get_row("select articlename from ".$_17mb_prev."article_article where articleid ='".$aid."' ");
			if($article){
				$articlename = $article->articlename;	
			}
			$case_extsis = $db->get_row("select caseid from ".$_17mb_prev."article_bookcase where articleid = '".$aid."' and userid='".$uid."' ");
			if(!$case_extsis){
				$db->query("insert into ".$_17mb_prev."article_bookcase(articleid,articlename,userid,username,joindate) values('".$aid."','".$articlename."','".$uid."','".$username."','".date("U")."')");
			}
			echo "1|".$urlinfo;
		}
		else{
			echo "0|".$urlinfo;	
		}
	}
	
	if($_GET['addmark'] && $_GET['aid'] && $_GET['cid'] && $_GET['urlchapter']){
		$urlchapter = $_GET['urlchapter'];
		if($_SESSION['jieqiUserId']){
			echo "1|";
			$uid = $_SESSION['jieqiUserId'];
			$username = $_SESSION['jieqiUserUname'];
			$aid = intval($_GET['aid']);
			$cid = intval($_GET['cid']);
			
			$chapter = $db->get_row("select chaptername from ".$_17mb_prev."article_chapter where chapterid ='".$cid."' ");
			
			$case_extsis = $db->get_row("select caseid from ".$_17mb_prev."article_bookcase where articleid = '".$aid."' and userid='".$uid."' ");
			if(!$case_extsis){
				$article = $db->get_row("select articlename from ".$_17mb_prev."article_article where articleid ='".$aid."' ");
				if($article){
					$articlename = $article->articlename;	
				}
				if($chapter){
					$chaptername = $chapter->chaptername;	
					$db->query("insert into ".$_17mb_prev."article_bookcase(articleid,articlename,userid,username,chapterid,chaptername,joindate) values('".$aid."','".$articlename."','".$uid."','".$username."','".$cid."','".$chaptername."','".date("U")."')");
				}
			}
			else{
				if($chapter){
					$chaptername = $chapter->chaptername;
					$db->query("update ".$_17mb_prev."article_bookcase set chapterid='".$cid."',chaptername='".$chaptername."' where articleid = '".$aid."' and userid = '".$uid."'");
				}
			}
		}
		else{
			echo "0|".$urlchapter;	
		}
	}
	
	if($_POST['aid']!=null && $_POST['uid'] !=null){
		$aid = intval($_POST['aid']);
		$uid = $_SESSION['jieqiUserId'];//$_POST['uid'];
		if(intval($aid) && intval($uid)){
			if($_SESSION['jieqiUserId']!=null){
			$db->query("delete from `jieqi_article_bookcase` where articleid = '".$aid."' and userid = '".$uid."'");
			echo $aid;
			}
			else{
				echo "delerror";	
			}		
		}
		else{
			echo "noint";	
		}
	}
?>
