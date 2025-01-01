<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
$author = $_POST['author'];
$question = $_POST['question'];
$answer = $_POST['answer'];
date_default_timezone_set("PRC");
$createtime = date("Y-m-j H:i:s");
include_once("../conn/conn.php");
if (mysqli_query($conn, "insert into tb_cjwt(author,question,answer,createtime) values('$author','$question','$answer','$createtime')")) {
    echo "<script>alert('常见问题添加成功！');history.back();</script>";
} else {
    echo "<script>alert('常见问题添加失败！');history.back();</script>";
}
?>
