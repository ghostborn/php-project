<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();//启动Session
include "conn/conn.php";//包含数据库连接文件
$a_sqlstr = "select * from tb_manager where name= '" . $_POST['manager'] . "'";//定义查询语句
$result = $pdo->prepare($a_sqlstr);//准备查询
$result->execute();//执行查询
if ($a_rst = $result->fetch(PDO::FETCH_NUM)) {//将查询结果返回到数组并判断结果是否为真
	if ($a_rst[2] != $_POST['pwd']) {//如果查询结果中的密码和用户输入的密码不相等
		echo "<script>alert('用户名或密码输入错误');history.go(-1);</script>";//弹出对话框
		exit();//退出程序
	}
	if ($a_rst[6] == "0") {//如果第7个字段值为0
		echo "<script>alert('您所登录的用户被冻结，如果有疑问请拨打电话0431-1234****咨询详细信息');history.go(-1)</script>";//弹出对话框
		exit();//退出程序
	}
	$_SESSION['admin'] = $a_rst[1];//为Session变量赋值
	$_SESSION['type'] = $a_rst[3];//为Session变量赋值
	$_SESSION['m_id'] = $a_rst[0];//为Session变量赋值
	echo "<script>alert('登录成功');location='main.php';</script>";//弹出对话框
} else {
	echo "<script>alert('用户名或密码输入错误');history.go(-1);</script>";//弹出对话框
}
?>