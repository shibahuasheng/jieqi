<?php	
	$sql_allvisit = 'select articleid,articlename,author,intro,sortid from '.$_17mb_prev.'article_article order by allvisit desc limit 0,10';
	$sql_allvote = 'select articleid,articlename,author,intro,sortid from '.$_17mb_prev.'article_article order by allvote desc limit 0,10';
	$sql_goodnum = 'select articleid,articlename,author,intro,sortid from '.$_17mb_prev.'article_article order by goodnum desc limit 0,10';
	$sql_postdate = 'select articleid,articlename,author,intro,sortid from '.$_17mb_prev.'article_article order by postdate desc limit 0,10';
	$sql_lastupdate = 'select articleid,articlename,author,intro,sortid from '.$_17mb_prev.'article_article order by lastupdate desc limit 0,10';
	
	//type
	$sql_type_num = 'select count(articleid) from '.$_17mb_prev.'article_article ';
	//$sql_visit = 'select id,title from '.$_17mb_prev.'archives order by click desc limit 0,10';
	
	//$sql_vote = 'select id,title from '.$_17mb_prev.'archives order by scores desc limit 0,10';

/*	function sqltype($typeid){
		global $_17mb_prev;		
		return 'select id,title from '.$_17mb_prev.'archives where typeid = '.$typeid.' limit 0,10';
	}
	function sqlistoptype($typeid){
		global $_17mb_prev;	
		return 'select reid from '.$_17mb_prev.'arctype where id = '.$typeid;
	}
	function sqltypelist($typeid){
		global $_17mb_prev;
		return 'select id,typename from '.$_17mb_prev.'arctype where reid = '.$typeid;
	}
	function sqllist($typeid){
		global $_17mb_prev;	
		//优化//分页...
		return 'select A.id,A.title,B.typename from '.$_17mb_prev.'archives as A,'.$_17mb_prev.'arctype as B where A.typeid = '.$typeid.' and A.typeid = B.id order by A.pubdate limit 0,3000';
	}
	function sqlcontent($aid){
		global $_17mb_prev;
		return 'select A.id,A.title,A.typeid,B.body from '.$_17mb_prev.'archives as A,'.$_17mb_prev.'addonarticle as B where A.id = '.$aid.' and A.id = B.aid';
	}
	function sqlreadtype($typeid){
		global $_17mb_prev;
		return 'select id,typename from '.$_17mb_prev.'arctype where id = '.$typeid;
	}
*/	
?>