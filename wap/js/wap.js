document.writeln("<script src='\/js\/ajax.js'><\/script>");

function checkInput(){ 
	var s = document.getElementById("s_key").value ;
	if(s.length < 2 ){ alert("请输入两个或以上中文"); return false; } 
	if(s == "输入书名或作者"){ alert("请输入搜索关键词"); return false; }
}

function showlogin(){//顶部登录框判断是否登录
	doAjax("/ajax.php", "showlogin=1", "showlogin2", "GET", 0);
}
function showlogin2(t){//顶部登录框判断是否登录
	var t = t.replace(/\s/g,'');
	var login_top = document.getElementById("login_top");
	if(t != "nologin"){
		login_top.innerHTML = "<div onclick='show_bookcase()' style='max-width:90px;overflow:hidden;height:50px;padding:0px 10px;' class='c_index_top'>" + t + "<\/div>";
	}
}
function fixwidth(){
	var _52mb_head = document.getElementById("_52mb_head");
	var _52mb_h1 = document.getElementById("_52mb_h1");
	_52mb_h1.style.width = (_52mb_head.scrollWidth-175) + "px";
}
function show_bookcase(){
	var info = document.getElementById("info");
	if(info.style.display == "block"){
		info.style.display = "none";	
	}
	else{
		info.style.display = "block";	
	}
}

function login(){//开启登录
	uname = document.getElementById("username").value;
	upass = document.getElementById("userpass").value;
	_17mb_code = document.getElementById("_17mb_code").value;
	_17mb_login_save = document.getElementById("login_save").checked;
    doAjax("/login_go.php", "chname=" + uname + "&chpass=" + upass + "&_17mb_code=" + _17mb_code + "&_17mb_login_save=" + _17mb_login_save, "go_login", "POST", 0);
}

function go_login(t){
	t = t.replace(/\s/g,'');
	logintips = document.getElementById("logintips");
	if(t == "nocode"){
		logintips.innerHTML = "请输入验证码";
		reloadcode();
	}
	if(t == "err_code"){
		logintips.innerHTML = "验证码错误";
		reloadcode();
	}
	if(t == "nodata" ){
		logintips.innerHTML = "请输入帐号和密码";
		reloadcode();
	}
	if(t == "nologin" ){
		logintips.innerHTML = "帐号或密码错误，登录失败";
		reloadcode();
	}
	if(t == "yeslogin" ){
		doAjax("/ajax.php", "is_login=1", "is_login", "GET", 0);
	}
}

function is_login(t){
	var t = t.replace(/\s/g,'');
	if(t == "right"){
		document.getElementById("logintips").innerHTML = "登录成功！";
		var urlarray= new Array(); //定义一数组
		urlarray = document.URL.split("?url="); //字符分割
		url = urlarray[1]; 
		if(url){
			url = url.replace(/\%2F/g,"/");
			url = url.replace(/\%3A/g,":");
			url = url.replace(/\%23/g,"");
			url = url.replace(/\%3F/g,"?");
			url = url.replace(/\%3D/g,"=");
			url = url.replace(/\%26/g,"&");
			window.location.href = url;	
		}
		else{
			window.location.href = "/";	
		}
	}
	else{
		document.getElementById("logintips").innerHTML = "帐号或密码错误，登录失败！";	
	}
}
//退出登录
function logout(){
	doAjax("/logout.php", "t=1", "logout2", "GET", 0);	
}
function logout2(){
	window.location.href = "/";
}
function register(){
	uname = document.getElementById("regname").value;
	upass = document.getElementById("regpass").value;
	uemail = document.getElementById("regemail").value;
	_17mb_code = document.getElementById("_17mb_code").value;
	doAjax("/register_go.php", "uname=" + uname + "&upass=" + upass + "&uemail=" + uemail + "&_17mb_code=" + _17mb_code, "go_register", "POST", 0);
}
function go_register(t){
	var t = t.replace(/\s/g,'');
	var tips = document.getElementById("logintips");
	if(t == "nocode"){
		tips.innerHTML = "请输入验证码";
	}
	if(t == "err_code"){
		tips.innerHTML = "验证码错误";
	}
	if(t == "nodata"){
		tips.innerHTML = "以上信息都必须输入";	
	}
	if(t == "bigname"){
		tips.innerHTML = "用户名太长！10个中问或者30个英文以内！";	
	}	
	if(t == "bigpass"){
		tips.innerHTML = "密码太长！16位以内！";	
	}	
	if(t == "bigemail"){
		tips.innerHTML = "邮箱太长！";	
	}	
	if(t == "emailerror"){
		tips.innerHTML = "邮箱格式错误！";	
	}
	if(t == "havename"){
		tips.innerHTML = "用户名已被注册！";	
	}
	if(t == "haveemial"){
		tips.innerHTML = "邮箱已被注册！";	
	}
	if(t == "yesregister"){
		tips.innerHTML = "注册成功并已经登录！";
		window.location.href = "/";	
	}		
}

function bookcaseurl(){
	doAjax("/modules/article/wapajax.php", "bookcase=1", "bookcaseurl2", "GET", 0);
}
function bookcaseurl2(t){
	var t = t.replace(/\s/g,'');
	if(t == "nologin"){
		window.location.href = "/login.php";
	}
	else{
		window.location.href = "/mybook.php";	
	}
}
function case_del(aid,uid){
	//alert(aid+"+"+uid);
	doAjax("/ajax.php", "aid=" + aid +"&uid=" + uid, "case_del2", "POST", 0);
	document.getElementById("" + aid).innerHTML = "<tr><td style='height:30px;line-height:30px;'><font color=red>删除中，请稍后...</font></td></tr>";
}
function case_del2(t){
	var t = t.replace(/\s/g,'');
	//alert(t);
	if(t != ""){
		table = document.getElementById("" + t);
		table.style.backgroundColor = "#D3FEDA";
		
		table.innerHTML = "<tr><td style='height:30px;line-height:30px;'><font color=red>已从书架删除！</font></td></tr>";
		
	}
}

function shuqian(aid,cid,urlchapter){
	//alert("shuqian");	
	doAjax("/ajax.php", "addmark=1&urlchapter="+urlchapter+"&aid=" + aid + "&cid=" + cid, "shuqian2", "GET", 0);
}
function shuqian2(t){
	var t = t.replace(/\s/g,'');
	//alert(t);
	var a = t.split("|");
	if(a[0]==1){
		document.getElementById("pt_prev").innerHTML = "<font color=red>已存书签</font>";	
	}
	if(a[0]==0){
		window.location.href = "/login.php?url="+a[1];
	}
}

function shujia(aid,urlinfo){
	//alert("shujia");	
	doAjax("/ajax.php", "addbookcase=1&urlinfo="+urlinfo+"&aid=" + aid, "shujia2", "GET", 0);
}
function shujia2(t){
	var t = t.replace(/\s/g,'');
	var divshujia = document.getElementById("shujia");
	//alert(t);
	var a = t.split("|");
	if(a[0]==1){
		divshujia.innerHTML = "<font color=red>已加入书架！</font>";	
	}
	if(a[0]==0){
		window.location.href = "/login.php?url="+a[1];
	}
}

function show_search(){
	
	var type = document.getElementById("type");
	var searchType = document.getElementById("searchType");
	if(type.innerHTML == "书名"){
		type.innerHTML = "作者";
		searchType.value = "author";
		//alert(searchType.value);
	}
	else{
		type.innerHTML = "书名";
		searchType.value = "articlename";
	}
}

//全部章节并分页
function allchapter(aid,page){
	var chapter_load = document.getElementById("chapter_load");
	
	chapter_load.style.display = "block";
	
	var pagetips = document.getElementById("pagetips");
	if(pagetips){pagetips.style.display = "none";}
	
	
	if(page == "gopage"){
		var pagenum = document.getElementById("pagenum");
		if(pagenum.value != ""){
			if(!isNaN(pagenum.value)){
				doAjax("/modules/article/wapallchapter.php", "aid=" + aid + "&page=" + pagenum.value, "allchapter2", "GET", 0);				
			}
			else{
				chapter_load.style.display = "none";
				pagetips.style.display = "block";
			}
		}
		else{
			chapter_load.style.display = "none";
			pagetips.style.display = "block";
				
		}
	}
	else{
		doAjax("/modules/article/wapallchapter.php", "aid=" + aid + "&page=" + page, "allchapter2", "GET", 0);	
	}	
}

function allchapter2(t){
	document.getElementById("chapter_load").style.display = "none";
	document.getElementById("all_chapter").innerHTML = t ;
}

var checkbg = "#A7A7A7";
//内容页用户设置
function nr_setbg(intype){
	var huyandiv = document.getElementById("huyandiv");
	var light = document.getElementById("lightdiv");
	if(intype == "huyan"){
		if(huyandiv.style.backgroundColor == ""){
			set("light","huyan");
			document.cookie="light=huyan;path=/"; 
		}
		else{
			set("light","no");
			document.cookie="light=no;path=/"; 
		}
	}
	if(intype == "light"){
		if(light.innerHTML == "关灯"){
			set("light","yes");
			document.cookie="light=yes;path=/"; 
		}
		else{
			set("light","no");
			document.cookie="light=no;path=/"; 
		}
	}
	if(intype == "big"){
		set("font","big");
		document.cookie="font=big;path=/"; 
	}
	if(intype == "middle"){
		set("font","middle");
		document.cookie="font=middle;path=/"; 
	}
	if(intype == "small"){
		set("font","small");
		document.cookie="font=small;path=/"; 
	}			
}

//内容页读取设置
function getset(){ 
	var strCookie=document.cookie; 
	var arrCookie=strCookie.split("; ");  
	var light;
	var font;

	for(var i=0;i<arrCookie.length;i++){ 
		var arr=arrCookie[i].split("="); 
		if("light"==arr[0]){ 
			light=arr[1]; 
			break; 
		} 
	} 
	for(var i=0;i<arrCookie.length;i++){ 
		var arr=arrCookie[i].split("="); 
		if("font"==arr[0]){ 
			font=arr[1]; 
			break; 
		} 
	} 
	
	//light
	if(light == "yes"){
		set("light","yes");
	}
	else if(light == "no"){
		set("light","no");
	}
	else if(light == "huyan"){
		set("light","huyan");
	}
	//font
	if(font == "big"){
		set("font","big");
	}
	else if(font == "middle"){
		set("font","middle");
	}
	else if(font == "small"){
		set("font","small");
	}
	else{
		set("","");	
	}
}

//内容页应用设置
function set(intype,p){
	var nr_body = document.getElementById("nr_body");//页面body
	var huyandiv = document.getElementById("huyandiv");//护眼div
	var lightdiv = document.getElementById("lightdiv");//灯光div
	var fontfont = document.getElementById("fontfont");//字体div
	var fontbig = document.getElementById("fontbig");//大字体div
	var fontmiddle = document.getElementById("fontmiddle");//中字体div
	var fontsmall = document.getElementById("fontsmall");//小字体div
	var nr1 =  document.getElementById("nr1");//内容div
	var nr_title =  document.getElementById("nr_title");//文章标题
	var nr_title =  document.getElementById("nr_title");//文章标题
	
	var pt_prev =  document.getElementById("pt_prev");
	var pt_mulu =  document.getElementById("pt_mulu");
	var pt_next =  document.getElementById("pt_next");
	var pb_prev =  document.getElementById("pb_prev");
	var pb_mulu =  document.getElementById("pb_mulu");
	var pb_next =  document.getElementById("pb_next");
	
	//灯光
	if(intype == "light"){
		if(p == "yes"){	
			//关灯
			lightdiv.innerHTML = "开灯";
			nr_body.style.backgroundColor = "#32373B";
			huyandiv.style.backgroundColor = "";
			nr_title.style.color = "#ccc";
			nr1.style.color = "#999";
			var pagebutton = "background-color:#3e4245;color:#ccc;border:1px solid #313538";			
			pt_prev.style.cssText = pagebutton;
			pt_mulu.style.cssText = pagebutton;
			pt_next.style.cssText = pagebutton
			pb_prev.style.cssText = pagebutton;
			pb_mulu.style.cssText = pagebutton;
			pb_next.style.cssText = pagebutton;
		}
		else if(p == "no"){
			//开灯
			lightdiv.innerHTML = "关灯";
			nr_body.style.backgroundColor = "#fbf6ec";
			nr1.style.color = "#000";
			nr_title.style.color = "#000";
			huyandiv.style.backgroundColor = "";
			var pagebutton = "background-color:#f4f0e9;color:green;border:1px solid #ece6da";			
			pt_prev.style.cssText = pagebutton;
			pt_mulu.style.cssText = pagebutton;
			pt_next.style.cssText = pagebutton
			pb_prev.style.cssText = pagebutton;
			pb_mulu.style.cssText = pagebutton;
			pb_next.style.cssText = pagebutton;
		}
		else if(p == "huyan"){
			//护眼
			lightdiv.innerHTML = "关灯";
			huyandiv.style.backgroundColor = checkbg;
			nr_body.style.backgroundColor = "#DCECD2";
			nr1.style.color = "#000";
			var pagebutton = "background-color:#CCE2BF;color:green;border:1px solid #bbd6aa";			
			pt_prev.style.cssText = pagebutton;
			pt_mulu.style.cssText = pagebutton;
			pt_next.style.cssText = pagebutton
			pb_prev.style.cssText = pagebutton;
			pb_mulu.style.cssText = pagebutton;
			pb_next.style.cssText = pagebutton;
		}
	}
	//字体
	if(intype == "font"){
		//alert(p);
		fontbig.style.backgroundColor = "";
		fontmiddle.style.backgroundColor = "";
		fontsmall.style.backgroundColor = "";
		if(p == "big"){
			fontbig.style.backgroundColor = checkbg;
			nr1.style.fontSize = "25px";
		}
		if(p == "middle"){
			fontmiddle.style.backgroundColor = checkbg;
			nr1.style.fontSize = "15px";
		}
		if(p == "small"){
			fontsmall.style.backgroundColor = checkbg;
			nr1.style.fontSize = "12px";
		}
	}
}
function tfanye(){
	var allheight = document.documentElement.clientHeight;
	window.scrollTo(0, document.body.scrollTop-(allheight-30));
}
function bfanye(){
	var allheight = document.documentElement.clientHeight;
	window.scrollTo(0, document.body.scrollTop+(allheight-30));
}

//广告开始
function _17mb_top(){//顶部广告
	document.writeln("");
}

function _17mb_middle(){//中间广告
	document.writeln("");
}

function _17mb_bottom(){//底端广告
	document.writeln("");
}
function _17mb_tj(){//统计代码//不显示图标
	document.writeln("<div style='display:none'>这里放统计代码</div>");
}

