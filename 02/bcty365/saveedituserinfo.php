<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
include_once("conn/conn.php");
$usernc = $_POST['usernc'];
$truename = trim($_POST['truename']);
$email = trim($_POST['email']);
$sex = $_POST['sex'];
$tel = trim($_POST['tel']);
$yb = trim($_POST['yb']);
$qq = trim($_POST['qq']);
$address = trim($_POST['address']);
$question = trim($_POST['question']);
$answer = trim($_POST['answer']);
if (mysqli_query($conn,
	"update tb_user set truename='$truename',email='$email',sex='$sex',tel='$tel',yb='$yb',qq='$qq',address='$address',question='$question',answer='$answer' where usernc='" . $usernc . "'")) {
	echo "<script>alert('注册信息更改成功！');history.back();</script>";
} else {
	echo "<script>alert('注册信息更改失败！');history.back();</script>";
}

?>