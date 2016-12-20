<?php
	header('Content-type: text/html; charset=gbk');
	session_start();
	require 'main.php';
	require '17mb/class/sql.php';
	if($_POST['_17mb_code']){
		if(strtoupper($_POST['_17mb_code']) == strtoupper($_SESSION['_17mb_code'])){
			if($_POST['uname']!=null && $_POST['upass']!=null && $_POST['uemail']!=null){
				$regname = $_POST['uname'];
				$regpass = $_POST['upass'];
				$regemail = $_POST['uemail'];
				
				//
				if(strlen($regname) >30){
					die("bigname");	
				}
				if(strlen($regpass) >32){
					die("bigpass");	
				}
				if(strlen($regemail) >60){
					die("bigemail");	
				}
				if(preg_match("/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i",$regemail)){ 
					
				}
				else{
					die("emailerror"); 
				} 
				//
				$regname = str_replace(";","",$regname);
				$regname = str_replace("<","",$regname);
				$regname = str_replace(">","",$regname);
				$regname = str_replace(",","",$regname);
				$regname = str_replace("&","",$regname);
				$regname = str_replace(".","",$regname);
				$regname = str_replace("%","",$regname);
				$regname = str_replace("(","",$regname);
				$regname = str_replace(")","",$regname);
				$regname = str_replace("^","",$regname);
				$regname = str_replace("`","",$regname);
				$regname = str_replace("!","",$regname);
				$regname = str_replace("~","",$regname);
				$regname = str_replace("@","",$regname);
				$regname = str_replace("$","",$regname);
				$regname = str_replace("-","",$regname);
				$regname = str_replace("_","",$regname);
				$regname = str_replace("/","",$regname);
				$regname = str_replace("and","",$regname);
				$regname = str_replace("execute","",$regname);
				$regname = str_replace("update","",$regname);
				$regname = str_replace("count","",$regname);
				$regname = str_replace("chr","",$regname);
				$regname = str_replace("mid","",$regname);
				$regname = str_replace("master","",$regname);
				$regname = str_replace("truncate","",$regname);
				$regname = str_replace("char","",$regname);
				$regname = str_replace("declare","",$regname);
				$regname = str_replace("select","",$regname);
				$regname = str_replace("create","",$regname);
				$regname = str_replace("delete","",$regname);
				$regname = str_replace("insert","",$regname);
				$regname = str_replace("'","",$regname);
				$regname = str_replace("\"","",$regname);
				$regname = str_replace(" ","",$regname);
				$regname = str_replace("or","",$regname);
				$regname = str_replace("=","",$regname);
				$regname = str_replace("%20","",$regname);
				////
				$regpass = str_replace(";","",$regpass);
				$regpass = str_replace("<","",$regpass);
				$regpass = str_replace(">","",$regpass);
				$regpass = str_replace(",","",$regpass);
				$regpass = str_replace("&","",$regpass);
				$regpass = str_replace(".","",$regpass);
				$regpass = str_replace("%","",$regpass);
				$regpass = str_replace("(","",$regpass);
				$regpass = str_replace(")","",$regpass);
				$regpass = str_replace("^","",$regpass);
				$regpass = str_replace("`","",$regpass);
				$regpass = str_replace("!","",$regpass);
				$regpass = str_replace("~","",$regpass);
				$regpass = str_replace("@","",$regpass);
				$regpass = str_replace("$","",$regpass);
				$regpass = str_replace("-","",$regpass);
				$regpass = str_replace("_","",$regpass);
				$regpass = str_replace("/","",$regpass);
				$regpass = str_replace("and","",$regpass);
				$regpass = str_replace("execute","",$regpass);
				$regpass = str_replace("update","",$regpass);
				$regpass = str_replace("count","",$regpass);
				$regpass = str_replace("chr","",$regpass);
				$regpass = str_replace("mid","",$regpass);
				$regpass = str_replace("master","",$regpass);
				$regpass = str_replace("truncate","",$regpass);
				$regpass = str_replace("char","",$regpass);
				$regpass = str_replace("declare","",$regpass);
				$regpass = str_replace("select","",$regpass);
				$regpass = str_replace("create","",$regpass);
				$regpass = str_replace("delete","",$regpass);
				$regpass = str_replace("insert","",$regpass);
				$regpass = str_replace("'","",$regpass);
				$regpass = str_replace("\"","",$regpass);
				$regpass = str_replace(" ","",$regpass);
				$regpass = str_replace("or","",$regpass);
				$regpass = str_replace("=","",$regpass);
				$regpass = str_replace("%20","",$regpass);
				//
				$regemail = str_replace(";","",$regemail);
				$regemail = str_replace("<","",$regemail);
				$regemail = str_replace(">","",$regemail);
				$regemail = str_replace(",","",$regemail);
				$regemail = str_replace("&","",$regemail);
				//$regemail = str_replace(".","",$regemail);
				$regemail = str_replace("%","",$regemail);
				$regemail = str_replace("(","",$regemail);
				$regemail = str_replace(")","",$regemail);
				$regemail = str_replace("^","",$regemail);
				$regemail = str_replace("`","",$regemail);
				$regemail = str_replace("!","",$regemail);
				$regemail = str_replace("~","",$regemail);
				//$regemail = str_replace("@","",$regemail);
				$regemail = str_replace("$","",$regemail);
				$regemail = str_replace("-","",$regemail);
				$regemail = str_replace("_","",$regemail);
				$regemail = str_replace("/","",$regemail);
				$regemail = str_replace("and","",$regemail);
				$regemail = str_replace("execute","",$regemail);
				$regemail = str_replace("update","",$regemail);
				$regemail = str_replace("count","",$regemail);
				$regemail = str_replace("chr","",$regemail);
				$regemail = str_replace("mid","",$regemail);
				$regemail = str_replace("master","",$regemail);
				$regemail = str_replace("truncate","",$regemail);
				$regemail = str_replace("char","",$regemail);
				$regemail = str_replace("declare","",$regemail);
				$regemail = str_replace("select","",$regemail);
				$regemail = str_replace("create","",$regemail);
				$regemail = str_replace("delete","",$regemail);
				$regemail = str_replace("insert","",$regemail);
				$regemail = str_replace("'","",$regemail);
				$regemail = str_replace("\"","",$regemail);
				$regemail = str_replace(" ","",$regemail);
				$regemail = str_replace("or","",$regemail);
				$regemail = str_replace("=","",$regemail);
				$regemail = str_replace("%20","",$regemail);
				require($_17mb_pcdir."/configs/define.php");
				@mysql_connect(constant("JIEQI_DB_HOST"), constant("JIEQI_DB_USER"),constant("JIEQI_DB_PASS"))or die("Error_1");  
				mysql_query("SET NAMES 'UTF8'");
				@mysql_select_db(constant("JIEQI_DB_NAME"))or die("Error_2"); 
				
				//判断是否重复uid
				$query1 = @mysql_query("select * from `jieqi_system_users` where uname = '".$regname."'") or die(mysql_error()."Error_3");
				if($num1 = mysql_num_rows($query1)){
					die("havename");
				}
				//判断是否重复emai
				$query2 = @mysql_query("select * from `jieqi_system_users` where email = '".$regemail."'") or die(mysql_error()."Error_4");
				if($num2 = mysql_num_rows($query2)){
					die("haveemial");
				}
				else{
					//开始注册
					if($query3 = @mysql_query("insert into `jieqi_system_users` (uname,pass,groupid,regdate,email,sign,intro,setting,badges) values('".$regname."','".md5($regpass)."','3','".date("U")."','".$regemail."','0','0','0','0')") or die(mysql_error()."Error_5")){
						echo "yesregister";//注册成功
						//注册成功，登录
						$query4 = @mysql_query("select * from `jieqi_system_users` where `uname` = '".$regname."'") or die(mysql_error()."Error_6");
						if($num4 = mysql_num_rows($query4)){
							while($row4 = mysql_fetch_array($query4)){
								$_SESSION["jieqiUserId"] = $row4["uid"];
								$_SESSION["jieqiUserUname"] = $newcontent = iconv("utf-8", "gbk", $row4["uname"]);;
								$_SESSION["jieqiUserName"] = $row4["uname"];
								$_SESSION["jieqiUserGroup"] = "3";
							}
							//echo "yeslogin";
						}
						else{
							//echo "nologin";	
						}
					}
					else{
						echo "noregister";//注册失败
					}
					
				}
				
			}
			else {
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
?>
