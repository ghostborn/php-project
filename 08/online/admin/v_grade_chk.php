<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
	session_start();//启动Session
	include "conn/conn.php";//包含数据库连接文件
	include "inc/chec.php";//包含判断用户权限文件
	$v_sqlstr = "update tb_grade set price = '".$_POST['price']."' where id = ".$_POST['name'];//定义更新语句
	if($pdo->exec($v_sqlstr)==1 || $pdo->exec($v_sqlstr)==0)//如果执行更新语句结果为真
		echo "<script>alert('修改成功');top.opener.location.reload();window.close();</script>";//弹出对话框
	else
		echo "<script>alert('修改失败');history.go(-1);</script>";//弹出对话框
?>