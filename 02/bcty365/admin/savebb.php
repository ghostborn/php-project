<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include_once("../conn/conn.php");
$bbname = $_POST['bbname'];
date_default_timezone_set("PRC");
$createtime = date("Y-m-j H:i:s");

$sql = mysqli_query($conn, "select id from tb_bb where bbname='" . $bbname . "'");
$info = mysqli_fetch_array($sql);
if ($info != false) {
    echo "<script>alert('该版本已经添加！');history.back();</script>";
    exit;
}
if (mysqli_query($conn, "insert into tb_bb(bbname,createtime) values('$bbname','$createtime')")) {
    echo "<script>alert('版本添加成功！');history.back();</script>";
} else {
    echo "<script>alert('版本添加失败！');history.back();</script>";
}
?>