<?php
header("Content-type: text/html; charset=utf-8");
include_once("conn/conn.php");
$truepwd = $_POST['userpwd1'];
$pwd = md5($truepwd);
$userid = $_POST['userid'];

if (mysqli_query($conn, "update tb_user set pwd='$pwd',truepwd='$truepwd' where id='$userid'")) {
	echo "<script>alert('密码更改成功!');history.back();</script>";
} else {
	echo "<script>alert('密码更改失败!');history.back();</script>";
}
mysqli_close($conn);