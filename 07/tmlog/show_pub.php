<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include "conn/conn.php";
$pubsql = "select * from tb_public where id= " . $_GET['id'];
$pubrst = mysqli_query($link, $pubsql);
$pubrow = mysqli_fetch_row($pubrst);
echo $pubrow[2];
?>