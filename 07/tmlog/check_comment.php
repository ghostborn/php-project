<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include "Conn/conn.php";
date_default_timezone_set("PRC");
if (!isset($_SESSION['username'])) {
	$user = "匿名";
} else {
	$user = $_SESSION['username'];
}
if ($_POST["submit"] == "提交") {
	$content = $_POST['txt_content'];
	$datetime = date("Y-m-d H:i:s");
	$INS = "insert into tb_filecomment (fileid,username,content,datetime) values (" . $_POST['htxt_fileid'] . ",'$user','$content','$datetime')";
	$info = mysqli_query($link, $INS);
	if ($info) {
		echo "<script> alert('成功发表评论！');</script>";
		echo "<script> window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
	} else {
		echo "<script> alert('评论发表操作失败！');</script>";
		echo "<script> history.go(-1);</script>";
	}
}
?>
