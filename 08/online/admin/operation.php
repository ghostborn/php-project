<?php
	session_start();//启动Session
	include "inc/chec.php";//包含判断用户权限文件
?>
<link href="css/style.css" rel="stylesheet"/>
<script src="js/admin_js.js" language="javascript"></script>
<center>
<table>
	<tr>
		<td width="665" height="164" background="images/ball.jpg">&nbsp;</td>
	</tr>
</table>
<?php
	switch ($_GET['action']){//判断参数action的值
		case "audiolist":					//添加视频目录
			include "audiolist.php";//包含该文件
			break;//跳出switch语句
		case "videolist":					//添加音频目录
			include "videolist.php";//包含该文件
			break;//跳出switch语句
		case "audioadd":					//添加视频
			include "audioadd.php";//包含该文件
			break;//跳出switch语句
		case "videoadd":					//添加音频
			include "videoadd.php";//包含该文件
			break;//跳出switch语句
		case "v_grade":						//会员参数更新
			include "v_grade.php";//包含该文件
			break;//跳出switch语句
		case "v_found":						//会员查询
			include "v_found.php";//包含该文件
			break;//跳出switch语句
		case "freeze":						//冻结帐号
			include "freeze.php";//包含该文件
			break;//跳出switch语句
		case "l_found":						//查询日志
			include "l_found.php";//包含该文件
			break;//跳出switch语句
		case "addmanager":					//添加管理员
			include "addmanager.php";	//包含该文件	 
			break;//跳出switch语句
		case "audio":						//视频介绍
?>
		<iframe src="intro.php?id=<?php echo $_GET['id']; ?>" width="665" height="700" scrolling="no"></iframe>
<?php
		break;//跳出switch语句
	case "video":							//音频介绍
?>
		<iframe src="v_intro.php?id=<?php echo $_GET['id']; ?>" width="665" height="700" scrolling="no"></iframe>
<?php
		break;//跳出switch语句
		case "see"://播放视频文件
?>
			<iframe src="see.php?id=<?php echo $_GET['id']; ?>" width="665" height="530" scrolling="no" frameborder="0" align="middle"></iframe>
<?php
			break;//跳出switch语句
		case "listen"://播放音频文件
?>
			<iframe src="listen.php?id=<?php echo $_GET['id']; ?>" width="665" height="530" scrolling="no" frameborder="0" align="middle"></iframe>
<?php
			break;//跳出switch语句
}
?>
</center>