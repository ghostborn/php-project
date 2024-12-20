<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include("../conn/conn.php");
date_default_timezone_set("PRC");
$title = $_POST['title'];
$content = $_POST['content'];
$flag = $_POST['flag'] ?? 0;
$fdate = date("Y-m-d H:i:s");
$sql = mysqli_query($conn,
	"insert into tb_advertising(title,content,fdate,flag) values('$title','$content','$fdate','$flag')");
if ($sql) {
	echo "<script>alert('企业广告信息发布成功！');parent.mainFrame.location.href='advertising.php';</script>";
} else {
	echo "<script>alert('企业广告信息发布失败！');history.back();</script>";
}