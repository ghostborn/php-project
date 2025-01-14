<?php
header("Content-type: image/png");    //设置输出为图片格式
include "Conn/conn.php";
$query = "select * from tb_tpsc where id=" . $_GET['recid'];
$result = mysqli_query($link, $query);
if (!$result) {
	die("error: mysqli query");
}
$num = mysqli_num_rows($result);
if ($num < 1) {
	die("error: no this recorder");
}
$data = mysqli_fetch_array($result);//返回图片数据
echo $data['file'];    //输出图片
?>