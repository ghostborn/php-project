<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
	session_start();//启动Session
	include "inc/chec.php";//包含判断用户权限文件
	include "conn/conn.php";//包含数据库连接文件
	$father = isset($_POST['father'])?$_POST['father']:"";//为变量赋值
	$sqlstr = "select * from tb_audiolist where name = '".$_POST['names']."'";//定义查询语句 
	$result = $pdo->prepare($sqlstr);//准备查询
	$result->execute();//执行查询
	$rs=$result->fetch(PDO::FETCH_ASSOC);//将查询结果返回到数组中
	if($rs){//如果数组为真
		echo "<script>alert('该目录名已存在');history.go(-1);</script>";//弹出对话框
	}else{
		$a_sqlstr = "insert into tb_audiolist (grade,name,father,userName,issueDate) values('".$_POST['grade']."','".$_POST['names']."','".$father."','".$_SESSION['admin']."','".date("Y-m-d H:i:s")."')";//定义插入语句
		if(!$pdo->exec($a_sqlstr))//如果执行插入语句结果为假
			echo "<script>alert('添加失败');history.go(-1);</script>";//弹出对话框
		else
			echo "<script>top.opener.location.reload();alert('添加成功');window.close();</script>";//弹出对话框
	}
	
?>