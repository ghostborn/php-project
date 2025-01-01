<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
$id=$_GET['id'];
include_once("../conn/conn.php");
if(mysqli_query($conn,"delete from tb_leaveword where id='".$id."'")){
   echo "<script>alert('意见反馈删除成功');history.back();</script>";
}else{
  echo "<script>alert('意见反馈删除失败');history.back();</script>";
}
?>