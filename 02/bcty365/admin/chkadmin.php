<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
session_start();
$username=$_POST['username'];
$userpwd=md5(trim($_POST['userpwd']));
include_once("../conn/conn.php");
$sql=mysqli_query($conn,"select usernc from tb_user where usernc='".$username."' and pwd='".$userpwd."' and usertype=2");
$info=mysqli_fetch_array($sql);
if($info==false){
  echo "<script>alert('对不起,用户名或密码输入错误!');history.back();</script>";
  exit;
}else{
  //session_register("admin_nc");
  $_SESSION["admin_nc"]=$username; 
  echo "<script>window.location.href='default.php';</script>";
}
?>