<?php
	header("Content-type:text/html;charset=utf-8"); //设置文件编码格式
	session_start();//启动Session
	include "conn/conn.php";//包含数据库连接文件
	include "inc/chec.php";//包含判断用户权限文件
	
	if($_POST['whether'] == "1")//如果传递过来的参数whether的值为1
		$wt = "0";//为变量赋值
	else if($_POST['whether'] == "0")//否则如果传递过来的参数whether的值为0
		$wt = "1";//为变量赋值
	else{
		echo "<script>alert('非法操作!');history.go(-1);</script>";//弹出对话框
		exit();//退出程序
	}
	$o_sqlstr = "update tb_manager set whether = '".$wt."' where id = ".$_POST['id'];//定义更新语句
	if($pdo->exec($o_sqlstr)){//如果执行更新语句的结果为真
		echo "<script>alert('操作成功');location='main.php?action=manager';</script>";//弹出对话框
	}
?>