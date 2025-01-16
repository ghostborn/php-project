<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include "conn/conn.php";//包含数据库连接文件
if (!isset($_GET['name']) or $_GET['name'] == "") {//判断是否设置了name参数
	echo "<font color='red'>非法用户名!</font>";//输出字符串
	exit();//退出程序
}
$c_sql = "select * from tb_account where name='" . $_GET['name'] . "'";//定义查询语句
$result = $pdo->prepare($c_sql);//准备查询
$result->execute();//执行查询
$rs = $result->fetch(PDO::FETCH_ASSOC);//将查询结果返回到数组
if ($rs['name'] != "") {//如果name字段值不为空
	echo "<font color='red'>用户名被占用!</font>";//输出字符串
	exit();//退出程序
} else {
	echo "<font color='green'>恭喜您：该用户名可用!</font>";//输出字符串
	exit();//退出程序
}
?>
