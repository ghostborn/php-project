<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include_once("../conn/conn.php");
if (mysqli_query($conn, "delete from tb_tell where id='" . $_GET['id'] . "'")) {
    echo "<script>alert('公告删除成功！');history.back();</script>";
} else {
    echo "<script>alert('公告删除失败！');history.back();</script>";
}
?>