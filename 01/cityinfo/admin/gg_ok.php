<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include("../conn/conn.php");
$id = $_GET['id'];
$flag = $_GET['flag'];
$sql = mysqli_query($conn, "update tb_advertising set flag=1 where id=$id");
if ($sql) {
	echo "<script>alert('该信息已被推荐！');window.location.href='find_gg.php?flag=$flag';</script>";
} else {
	echo "<script>alert('该信息推荐操作失败！');history.back();</script>";
}
?>
