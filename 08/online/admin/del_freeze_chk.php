<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
	include "conn/conn.php";//包含数据库连接文件
	include "inc/chec.php";//包含判断用户权限文件
	$d_sqlstr = "delete from tb_account where id = ".$_GET['id'];//定义删除语句
	if($pdo->exec(d_sqlstr))//如果执行删除语句结果为真
		echo "<script>alert('删除成功');location='main.php?action=member';</script>";//弹出对话框
	else
		echo "<script>alert('删除失败');history.go(-1);</script>";//弹出对话框
?>