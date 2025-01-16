<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();//启动Session
include "conn/conn.php";//包含数据库连接文件
if ((trim($_POST['name']) == "") or (trim($_POST['password']) == "")) {//如果用户名或密码的值为空
	echo "<script>alert('帐号或密码错误');history.go(-1);</script>";//弹出对话框
	exit();//退出程序
}
$sqlstr = "select * from tb_account where name = '" . $_POST['name'] . "' and password = '" . $_POST['password'] . "'";//定义查询语句
$result = $pdo->prepare($sqlstr);//准备查询
$result->execute();//执行查询
if ($u_rst = $result->fetch(PDO::FETCH_NUM)) {//将查询结果返回到数组并判断是否为真
	if ($u_rst[13] == "0")//如果查询结果中第18个字段的值为0
	{
		echo "<script>alert('该帐号被冻结，有疑问请拨打电话0431-XXXXXXXX咨询');history.go(-1);</script>";
	}//弹出对话框
	else {
		$result = $pdo->prepare("SELECT * FROM tb_grade");//准备查询
		$result->execute();//执行查询
		$g_rst = $result->fetch(PDO::FETCH_NUM);//将查询结果返回到数组
		if ($u_rst[11] >= (int)$g_rst[2]) {//如果用户上传次数大于指定的数值
			$u_sql = "update tb_account set grade='高级会员' where name = '" . $_POST['name'] . "' and password = '" . $_POST['password'] . "'";//定义更新语句
			$pdo->exec($u_sql);//执行语句
		}
		$_SESSION['name'] = $u_rst[1];//为Session变量赋值
		$_SESSION['id'] = $u_rst[0];//为Session变量赋值
		$_SESSION['grades'] = $u_rst[12];//为Session变量赋值
		$_SESSION['counts'] = $u_rst[11];//为Session变量赋值
		echo "<script>alert('用户登录成功!');window.location.href='index.php';</script>";//弹出对话框
	}
} else {
	echo "<script>alert('用户名或密码错误，请重新登录。');history.go(-1);</script>";//弹出对话框
}
?>