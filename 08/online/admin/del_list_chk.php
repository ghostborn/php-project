<?php
header("Content-type:text/html;charset=utf-8"); //设置文件编码格式
	session_start();//启动Session
	include "inc/chec.php";//包含判断用户权限文件
	include "conn/conn.php";//包含数据库连接文件
	if($_GET['action'] == "audiolist")//如果参数action的值为audiolist
		$t_name = "tb_audiolist";//为变量赋值
	else if($_GET['action'] == "videolist")//否则如果参数action的值为videolist
		$t_name = "tb_videolist";//为变量赋值
	$sqlstr = "delete from ".$t_name." where id =".$_GET['id'];//定义删除语句
	if(!$pdo->exec($sqlstr)){//如果执行删除语句结果为假
		echo "<script>alert('删除错误！".$sqlstr."');history.go(-1);</script>";//弹出对话框
	}else
		echo "<script>alert('删除成功');location='".$_SERVER['HTTP_REFERER']."';</script>";//弹出对话框
?>