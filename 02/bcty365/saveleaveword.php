<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();                    //初始化一个session变量
date_default_timezone_set("PRC");

$xym = $_POST['xym'];
if ($xym != $_SESSION["autonum"]) {
	echo "<script>alert('效验码输入错误！');history.back();</script>";
	exit;
}
$title = $_POST["title"];
$content = $_POST["content"];
$type = $_POST["type"];
include_once("conn/conn.php");
$sql = mysqli_query($conn, "select id from tb_user where usernc='" . $_SESSION["unc"] . "'");
$info = mysqli_fetch_array($sql);
$userid = $info["id"];

//向数据库中添加数据
if (mysqli_query($conn,
	"insert into tb_leaveword(userid,type,title,content,createtime) values ('$userid','$type','$title','$content','" . date("Y-m-j H:i:s") . "')")) {
	echo "<script>alert('留言发表成功！');history.back();</script>";
} else {
	echo "<script>alert('留言发表失败！');history.back();</script>";
}
