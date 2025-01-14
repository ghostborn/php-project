<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include "Conn/conn.php";
$query = "select * from tb_tpsc where id=" . $_GET['pic_id'];
$result = mysqli_query($link, $query);
if (!$result) {
	die("error: mysqli query");
}
$num = mysqli_num_rows($result);
if ($num < 1) {
	die("error: no this recorder");
}
$data = mysqli_fetch_array($result);
echo $data['file'];
?>