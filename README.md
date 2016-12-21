# 杰奇小说连载系统1.70免费版(Build 20151010)<br/>
1、环境<br/>
mysql使用5.5.*<br/>
php使用5.2.*<br/>
ZendOptimizer使用3.3.*<br/>
2、文件权限<br/>
文件上传以后，以下几个目录以及目录下所有文件的权限用 FTP 客户端软件设置成 777，即设权限为可读写。<br/>
cache ------ 网页缓存目录，可在后台设置目录名称<br/>
configs ---- 配置文件目录<br/>
compiled --- 编译文件目录<br/>
files ------ 用户上传或者网站程序生成文件保存的目录，可在后台设置目录名称<br/>
3、安装流程<br/>
访问 http://www.domain.com/install/index.php 进行安装<br/>
安装软件会自行创建数据库<br/>
安装完成后请删除 install 目录！<br/>
chown -R nobody:nobody html/jieqi<br/>
chown -R nobody:nobody html/jieqi/*<br/>
chmod -R 777 html/jieqi/cache<br/>
chmod -R 777 html/jieqi/configs<br/>
chmod -R 777 html/jieqi/files<br/>
chmod -R 777 html/jieqi/compiled<br/>
<br/>
<br/>
cd 网站根目录<br/>
git clone https://github.com/max2max/jieqi.git tmp && mv tmp/.git . && rm -rf tmp && git reset --hard<br/>
chmod www:www *
