<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();//启动Session
include "inc/chec.php";//包含判断用户权限文件
include "conn/conn.php";//包含数据库连接文件
include "inc/func.php";//包含函数文件
if (is_chk("name", "tb_videolist", $_POST['names']) == false) {//判断输入的名称与数据表中的值是否重复
	echo "<script>alert('名称重复');history.go(-1);</script>";//弹出对话框
	exit();//退出程序
}
$father = isset($_POST['father']) ? $_POST['father'] : "";//为变量赋值
$a_sqlstr = "insert into tb_videolist (grade,name,father,userName,issueDate) values('" . $_POST['grade'] . "','" . $_POST['names'] . "','" . $father . "','" . $_SESSION['admin'] . "','" . date("Y-m-d H:i:s") . "')";//定义插入语句
if (!$pdo->exec($a_sqlstr))//如果执行插入语句结果为假
{
	echo "<script>alert('添加失败');history.go(-1);</script>";
}//弹出对话框
else {
	echo "<script>top.opener.location.reload();alert('添加成功');window.close();</script>";
}//弹出对话框

?>