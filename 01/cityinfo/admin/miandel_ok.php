<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include("../conn/conn.php");
$id = $_GET['id'];
$type = $_GET['type'];
$state = $_GET['state'];
$sql = mysqli_query($conn, "delete from tb_info where id=$id");
if ($sql) {
	echo "<script>alert('该信息已经删除！');window.location.href='find_mianfei.php?type=$type&state=$state';</script>";
} else {
	echo "<script>alert('该信息删除操作失败！');history.back();</script>";
}
