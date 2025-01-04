<?php
header("Content-type: text/html; charset=utf8"); //设置文件编码格式
include_once("../conn/conn.php");
$gg_title = $_POST['title'];
$gg_content = $_POST['content'];
date_default_timezone_set("PRC");
$addtime = date("Y-m-j H:i:s");
$query = mysqli_query($conn, "insert into tb_tell(title,content,createtime) values('$gg_title','$gg_content','$addtime')");
if ($query == true) {
    echo "<script>alert('公告添加成功！');history.back();</script>";
} else {
    echo "<script>alert('公告添加失败！');history.back();</script>";
}
?>