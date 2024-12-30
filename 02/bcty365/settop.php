<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include_once("conn/conn.php");//连接数据库文件
//根据获取的ID值，从数据表中读取到对应的数据
$sql = mysqli_query($conn, "select top from tb_bbs where id='" . $_GET["id"] . "' ");
$info = mysqli_fetch_array($sql);
if ($info['top'] == 1) {  //判断对应数据记录中字段top的值，如果字段top的值为1，则执行下面的内容
	mysqli_query($conn, "update tb_bbs set top=0 where id='" . $_GET["id"] . "' ");//更新字段top的值为0
} elseif ($info['top'] == 0) {
	mysqli_query($conn, "update tb_bbs set top=1 where id= '" . $_GET["id"] . "'");//更新字段top的值为1
}
echo "<script>alert('置顶成功！');history.back();</script>";