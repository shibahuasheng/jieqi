<?php
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	$referer = $_SERVER["HTTP_REFERER"];
	if($referer){
		$refererhost = parse_url($referer); 
		$host = strtolower($refererhost['host']);
		if($host == str_replace('http://','',$_17mb_url)){
			if($_POST['_17mb_code']){
				if(strtoupper($_POST['_17mb_code']) == strtoupper($_SESSION['_17mb_code'])){
					if($_POST['chname']!=null && $_POST['chpass']!=null){
						$chname = $_POST['chname'];
						$chpass = $_POST['chpass'];
						$chname1 = rawurldecode($chname);
						$chname1 = iconv("UTF-8", "GB2312", $chname1);
						($chname1) ? ($chname = $chname1) : $chname ;
				
						//
						$chname = str_replace(";","",$chname);
						$chname = str_replace("<","",$chname);
						$chname = str_replace(">","",$chname);
						$chname = str_replace(",","",$chname);
						$chname = str_replace("&","",$chname);
						$chname = str_replace(".","",$chname);
						$chname = str_replace("%","",$chname);
						$chname = str_replace("(","",$chname);
						$chname = str_replace(")","",$chname);
						$chname = str_replace("^","",$chname);
						$chname = str_replace("`","",$chname);
						$chname = str_replace("!","",$chname);
						$chname = str_replace("~","",$chname);
						$chname = str_replace("@","",$chname);
						$chname = str_replace("$","",$chname);
						$chname = str_replace("-","",$chname);
						$chname = str_replace("_","",$chname);
						$chname = str_replace("/","",$chname);
						$chname = str_replace("and","",$chname);
						$chname = str_replace("execute","",$chname);
						$chname = str_replace("update","",$chname);
						$chname = str_replace("count","",$chname);
						$chname = str_replace("chr","",$chname);
						$chname = str_replace("mid","",$chname);
						$chname = str_replace("master","",$chname);
						$chname = str_replace("truncate","",$chname);
						$chname = str_replace("char","",$chname);
						$chname = str_replace("declare","",$chname);
						$chname = str_replace("select","",$chname);
						$chname = str_replace("create","",$chname);
						$chname = str_replace("delete","",$chname);
						$chname = str_replace("insert","",$chname);
						$chname = str_replace("'","",$chname);
						$chname = str_replace("\"","",$chname);
						$chname = str_replace(" ","",$chname);
						$chname = str_replace("or","",$chname);
						$chname = str_replace("=","",$chname);
						$chname = str_replace("%20","",$chname);
						////
						$chpass = str_replace(";","",$chpass);
						$chpass = str_replace("<","",$chpass);
						$chpass = str_replace(">","",$chpass);
						$chpass = str_replace(",","",$chpass);
						$chpass = str_replace("&","",$chpass);
						$chpass = str_replace(".","",$chpass);
						$chpass = str_replace("%","",$chpass);
						$chpass = str_replace("(","",$chpass);
						$chpass = str_replace(")","",$chpass);
						$chpass = str_replace("^","",$chpass);
						$chpass = str_replace("`","",$chpass);
						$chpass = str_replace("!","",$chpass);
						$chpass = str_replace("~","",$chpass);
						$chpass = str_replace("@","",$chpass);
						$chpass = str_replace("$","",$chpass);
						$chpass = str_replace("-","",$chpass);
						$chpass = str_replace("_","",$chpass);
						$chpass = str_replace("/","",$chpass);
						$chpass = str_replace("and","",$chpass);
						$chpass = str_replace("execute","",$chpass);
						$chpass = str_replace("update","",$chpass);
						$chpass = str_replace("count","",$chpass);
						$chpass = str_replace("chr","",$chpass);
						$chpass = str_replace("mid","",$chpass);
						$chpass = str_replace("master","",$chpass);
						$chpass = str_replace("truncate","",$chpass);
						$chpass = str_replace("char","",$chpass);
						$chpass = str_replace("declare","",$chpass);
						$chpass = str_replace("select","",$chpass);
						$chpass = str_replace("create","",$chpass);
						$chpass = str_replace("delete","",$chpass);
						$chpass = str_replace("insert","",$chpass);
						$chpass = str_replace("'","",$chpass);
						$chpass = str_replace("\"","",$chpass);
						$chpass = str_replace(" ","",$chpass);
						$chpass = str_replace("or","",$chpass);
						$chpass = str_replace("=","",$chpass);
						$chpass = str_replace("%20","",$chpass);
						unset($_SESSION['uid']);
						unset($_SESSION["jieqiUserId"]);
						unset($_SESSION["jieqiUserUname"]);
						unset($_SESSION["jieqiUserName"]);
						unset($_SESSION["jieqiUserGroup"]);
						$user = $db->get_row("select * from ".$_17mb_prev."system_users where uname = '".$chname."' and pass = '".md5($chpass)."'");
						if($user){
							if($user->uid){
								$_SESSION["jieqiUserId"] = $user->uid;
								$_SESSION["jieqiUserUname"] = $chname;
								$_SESSION["jieqiUserName"] = $user->name;
								$_SESSION["jieqiUserGroup"] = $user->groupid;
								echo "yeslogin";
								//cookie
								if($_POST['_17mb_login_save'] == 'true'){
									 setcookie('_17mb_username',$chname,time()+3600);
									 setcookie('_17mb_userpass',$chpass,time()+3600);
									 setcookie('_17mb_login_save','1',time()+3600);
								 }else{
									 setcookie('_17mb_username',$name,time()-3600);
									 setcookie('_17mb_userpass',$password,time()-3600);
									 setcookie('_17mb_login_save','1',time()-3600);
								 }
							}
							else{
								echo "nologin";
							}
						}
						else{
							echo "nologin";
							setcookie('_17mb_username',$name,time()-3600);
							setcookie('_17mb_userpass',$password,time()-3600);
							setcookie('_17mb_login_save','1',time()-3600);
						}
					}
					else{
						echo "nodata";
					}
				}
				else{
					echo "err_code";
				}
			}
			else{
				echo "nocode";
			}
		}
	}
?>