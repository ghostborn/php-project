<?php
header("Content-type: text/html; charset=utf8"); //设置文件编码格式
include_once("../conn/conn.php");
$bccdid = $_POST['typeid'];
$bbid = $_POST['bbid'];
$xlh = $_POST['xlh'];
$sql0 = mysqli_query($conn, "select * from tb_xlh where xlh='" . $xlh . "' and bccdid='" . $bccdid . "' and bbid='" . $bbid . "'");
$info0 = mysqli_fetch_array($sql0);
if ($info0 != false) {
    echo "<script>alert('该序列号已经添加！');history.back();</script>";
    exit;
}
$query = mysqli_query($conn, "insert into tb_xlh(bccdid,bbid,xlh) values('$bccdid','$bbid','$xlh')");
if ($query) {
    echo "<script>alert('编程词典序列号添加成功！');history.back();</script>";
} else {
    echo "<script>alert('编程词典序列号添加失败！');history.back();</script>";
}

?>