<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();//启动Session
include "conn/conn.php";//包含数据库连接文件

include "inc/func.php";//包含函数文件
$p_type = array("jpg", "jpeg", "bmp", "gif", "png");//定义图片格式数组
$head_path = "upfiles\\head";//定义上传头像文件路径
$picture_path = "";//初始化变量
$file_path = "";//初始化变量
/*  判断上传图片类型和文件大小，上传图片 */
if (isset($_FILES['head']) && $_FILES['head']['size'] > 0 and $_FILES['head']['size'] < 700000) {
	if (($postf = f_postfix($p_type, $_FILES['head']['name'])) != false) {
		$picture_path = time() . "." . $postf;
		if ($_FILES['head']['tmp_name']) {
			move_uploaded_file($_FILES['head']['tmp_name'], $head_path . "\\" . $picture_path);
			unlink($head_path . "\\" . $_POST['oldhead']);
		} else {
			echo "<script>alert('上传图片失败！');history.go(-1);</script>";
			exit();
		}
	} else {
		echo "<script>alert('上传图片格式错误！');history.go(-1);</script>";
		exit();
	}
} else {
	if (isset($_FILES['head']) && $_FILES['head']['size'] > 700000) {
		echo "<script>alert('上传图片大小超出范围！');history.go(-1);</script>";
		exit();
	} else {
		$picture_path = $_POST['oldhead'];
	}
}


$password = $_POST['password'];//为变量赋值
$sex = $_POST['sex'];//为变量赋值
$age = $_POST['age'];//为变量赋值
$job = $_POST['job'];//为变量赋值
$email = $_POST['email'];//为变量赋值
$address = $_POST['address'];//为变量赋值
$qq = $_POST['qq'];//为变量赋值
$up_sqlstr = "update tb_account set password = '$password',sex='$sex',age=$age,job='$job',email='$email',address='$address',qq='$qq',head='$picture_path' where id = " . $_POST['id'];//定义更新语句
if ($pdo->exec($up_sqlstr) == 1 || $pdo->exec($up_sqlstr) == 0) {//如果执行语句的结果为假
	echo "<script>alert('信息修改成功!');window.close();</script>";//弹出对话框
} else {
	echo "<script>alert('修改错误：" . $pdo->errorInfo() . "');history.go(-1);</script>";//弹出对话框
}
?>