<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
$ddnumber = base64_decode($_GET["ddno"]);
include_once("conn/conn.php");
if (mysqli_query($conn, "delete from tb_dd where ddnumber= '" . $ddnumber . "'")) {
	echo "<script>window.location.href='index.php';</script>";
} else {
	echo "<script>alert('订单删除失败,请重试！');history.back();</script>";
}