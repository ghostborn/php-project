<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include "check_login.php";
include "Conn/conn.php";
$sql = "delete from tb_article where id=" . $_GET['file_id'];
$result = mysqli_query($link, $sql);
if ($result) {
	$sql1 = "delete from tb_filecomment where fileid = " . $_GET['file_id'];
	$rst1 = mysqli_query($link, $sql1);
	if ($rst1) {
		echo "<script>alert('博客文章已被删除!');location='myfiles.php';</script>";
	} else {
		echo "<script>alert('删除失败!');history.go(-1);</script>";
	}
} else {
	echo "<script>alert('博客文章删除操作失败!');history.go(-1);</script>";
}
?> 



