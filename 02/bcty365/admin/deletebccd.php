<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
$id = $_GET['id'];
include("../conn/conn.php");
$sql = mysqli_query($conn, "select * from tb_bccd where id='" . $id . "'");
$info = mysqli_fetch_array($sql);
if (mysqli_query($conn, "delete from tb_bccd where id='" . $id . "'")) {
    @unlink("." . substr($info['imageaddress'], 7, strlen($info['imageaddress']) - 7));
    echo "<script>window.location.href='default.php?htgl=编辑编程词典';</script>";
} else {
    echo "<script>alert('视频删除失败!');history.back();</script>";
}
?>