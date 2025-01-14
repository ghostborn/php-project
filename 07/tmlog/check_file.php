<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include "Conn/conn.php";
date_default_timezone_set("PRC");//设置时区
if (isset($_POST['btn_tj'])) {
	$title = $_POST['txt_title'];
	$author = $_SESSION['username'];
	$content = $_POST['file'];
	$now = date("Y-m-d H:i:s");
	$sql = "Insert Into tb_article (title,content,author,now) Values ('$title','$content','$author','$now')";
	$result = mysqli_query($link, $sql);
	if ($result) {
		echo "<script>alert('恭喜您，你的文章发表成功!!!');window.location.href='file.php';</script>";
	} else {
		echo "<script>alert('对不起，添加操作失败!!!');window.location.href='file.php';</script>";
	}
}
?>
