<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include_once("conn/conn.php");
date_default_timezone_set("PRC");
$usernc = trim($_POST['usernc']);
$sql = mysqli_query($conn, "select usernc from tb_user where usernc='" . $usernc . "'");
$info = mysqli_fetch_array($sql);
if ($info != false) {
	echo "<script language='javascript'>alert('对不起，该昵称已被其他用户使用!');history.back();</script>";
	exit;
}
$xym = trim($_POST['xym']);
$num = $_POST['num']; //接收变量值
if (strval($xym) != strval($num)) {
	echo "<script>alert('验证码输入错误!');window.location.href='register.php';</script>";
	exit;
}
// 对表单提交的数据进行处理
$truepwd = trim($_POST['pwd1']);
$pwd = md5($truepwd);
$truename = trim($_POST['truename']);
$email = trim($_POST['email']);
$sex = $_POST['sex'];
$tel = trim($_POST['tel']);//获取电话
$yb = trim($_POST['yb']);//获取邮政编码
$qq = trim($_POST['qq']);//获取QQ
$address = trim($_POST['address']);//获取地址
$question = trim($_POST['question']);//获取提示问题
$answer = trim($_POST['answer']);//获取问题答案
$ip = getenv("REMOTE_ADDR");
$logintimes = 1;
$regtime = date("Y-m-j H:i:s");
$lastlogintime = $regtime;
$usertype = 0;//指定用户类型，默认为0
$photo = $_POST["photo"];
if (mysqli_query($conn,
	"insert into tb_user(usernc,truename,pwd,email,sex,tel,qq,address,logintimes,regtime,lastlogintime,ip,usertype,yb,question,answer,truepwd,photo) values('$usernc','$truename','$pwd','$email','$sex','$tel','$qq','$address','$logintimes','$regtime','$lastlogintime','$ip','$usertype','$yb','$question','$answer','$truepwd','$photo')")) {
	$_SESSION["unc"] = $usernc;
	echo "<script>alert('注册成功!');window.location.href='index.php';</script>";
} else {
	echo "<script language='javascript'>alert('对不起,注册失败!');history.back();</script>";
	exit;//退出
}

