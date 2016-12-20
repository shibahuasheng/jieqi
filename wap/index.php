<?php

	require 'main.php';
	require '17mb/class/sql.php';
	require($_17mb_pcdir."/configs/article/sort.php");
	
//	$list_tj = $db->get_results($sql_tj);
//	$list_tj = object_array($list_tj);
//	$tpl->assign('list_tj',$list_tj);
//

	$allvisit = $db->get_results($sql_allvisit);
	$k1 = 0;
	foreach($allvisit as $v){
		$arr[$k1][articleid] = $v->articleid;
		$arr[$k1][shortid] = intval($v->articleid / 1000);
		$arr[$k1][articlename] = $v->articlename;
		$arr[$k1][intro] = $v->intro;
		$arr[$k1][author] = $v->author;
		$arr[$k1][sortid] = $v->sortid;
		$arr[$k1][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
		$k1++;
	}
	$tpl->assign('allvisit',$arr);
	
	$allvote = $db->get_results($sql_allvote);
	$k1 = 0;
	foreach($allvote as $v){
		$arr[$k1][articleid] = $v->articleid;
		$arr[$k1][shortid] = intval($v->articleid / 1000);
		$arr[$k1][articlename] = $v->articlename;
		$arr[$k1][intro] = $v->intro;
		$arr[$k1][author] = $v->author;
		$arr[$k1][sortid] = $v->sortid;
		$arr[$k1][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
		$k1++;
	}
	$tpl->assign('allvote',$arr);
	
	$goodnum = $db->get_results($sql_goodnum);
	$k1 = 0;
	foreach($goodnum as $v){
		$arr[$k1][articleid] = $v->articleid;
		$arr[$k1][shortid] = intval($v->articleid / 1000);
		$arr[$k1][articlename] = $v->articlename;
		$arr[$k1][intro] = $v->intro;
		$arr[$k1][author] = $v->author;
		$arr[$k1][sortid] = $v->sortid;
		$arr[$k1][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
		$k1++;
	}
	$tpl->assign('goodnum',$arr);
	
	$postdate = $db->get_results($sql_postdate);
	$k1 = 0;
	foreach($postdate as $v){
		$arr[$k1][articleid] = $v->articleid;
		$arr[$k1][shortid] = intval($v->articleid / 1000);
		$arr[$k1][articlename] = $v->articlename;
		$arr[$k1][intro] = $v->intro;
		$arr[$k1][author] = $v->author;
		$arr[$k1][sortid] = $v->sortid;
		$arr[$k1][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
		$k1++;
	}
	$tpl->assign('postdate',$arr);
	
	$lastupdate = $db->get_results($sql_lastupdate);
	$k1 = 0;
	foreach($lastupdate as $v){
		$arr[$k1][articleid] = $v->articleid;
		$arr[$k1][shortid] = intval($v->articleid / 1000);
		$arr[$k1][articlename] = $v->articlename;
		$arr[$k1][intro] = $v->intro;
		$arr[$k1][author] = $v->author;
		$arr[$k1][sortid] = $v->sortid;
		$arr[$k1][sortname] = substr($jieqiSort['article'][$v->sortid]['caption'],0,4);
		$k1++;
	}
	$tpl->assign('lastupdate',$arr);

	
	$tpl->display('index.html');
	
?>