<?php
header("Content-type: text/html; charset=utf-8");
include("conn/conn.php");
date_default_timezone_set("PRC");
$type = $_POST['type'];
$title = $_POST['title'];
$content = $_POST['content'];
$linkman = $_POST['linkman'];
$tel = $_POST['tel'];
$edate = date("Y-m-d H:i:s");

$sql = mysqli_query($conn,"insert into tb_info(type,title,content,linkman,tel,checkstate,edate) values('$type','$title','$content','$linkman','$tel',0,'$edate')");
if($sql){
	echo "<script>alert('恭喜您，信息发布成功!');window.location.href='release.php';</script>";
}else{
	echo "<script>alert('对不起，信息发布失败！');history.back();</script>";
}
