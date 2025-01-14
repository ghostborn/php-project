<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include "Conn/conn.php";
$sql = "delete from tb_filecomment where id=" . $_GET['comment_id'];
$result = mysqli_query($link, $sql);
if ($result) {
	echo "<script>alert('删除成功!');location='" . $_SERVER['HTTP_REFERER'] . "';</script>";
} else {
	echo "<script>alert('删除操作失败!');history.go(-1);</script>";
}
?> 



