<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
$title = $_POST['reply_title'];
$content = $_POST['content1'];
if ($title == "") {
	echo "<script>alert('请输入回复主题！');history.back();</script>";
	exit;
}
if ($content == "") {
	echo "<script>alert('请输入回复内容！');history.back();</script>";
	exit;
}

include_once("conn/conn.php");
date_default_timezone_set("PRC");
$bbsid = $_POST['bbsid'];
$sql0 = mysqli_query($conn, "select id from tb_user where usernc= '" . $_SESSION["unc"] . "'");
$info0 = mysqli_fetch_array($sql0);
$userid = $info0['id'];
$createtime = date("Y-m-j H:i:s");
$link = date("YmjHis");
if ($_FILES['bbs_photo']["name"] == true) {   //上传图片，判断文件是否存在
	$photo_name = strtolower(stristr($_FILES["bbs_photo"]["name"], "."));//获取图片的后缀名,并且将字符转换成小写
	if ($photo_name != ".gif" & $photo_name != ".jpg" & $photo_name != ".jpeg" & $photo_name != ".png") {
		echo "<script>alert('您上传的图片格式不正确!');history.back();</script>";
	} else {
		$path1 = $link . mt_rand(1000000, 9999999) . $photo_name; //创建图片名称
		$photos = "./upfile/" . $path1;     //创建图片的存储路径
		move_uploaded_file($_FILES['bbs_photo']["tmp_name"], $photos);  //将图片存储到指定的文件夹下
		if (mysqli_query($conn,
			"insert into tb_reply(userid,bbsid,title,content,createtime,photo) values ('$userid','$bbsid','$title','$content','$createtime','$photos')")) {
			mysqli_query($conn, "update tb_bbs set lastreplytime='" . $createtime . "' ");
			echo "<script>alert('回复发表成功!');history.back();</script>";
			mysqli_close($conn);
			exit;
		}
	}
} else {
	if (mysqli_query($conn,
		"insert into tb_reply(userid,bbsid,title,content,createtime) values ('$userid','$bbsid','$title','$content','$createtime')")) {
		mysqli_query($conn, "update tb_bbs set lastreplytime='" . $createtime . "' ");
		echo "<script>alert('回复发表成功!');history.back();</script>";
		mysqli_close($conn);
		exit;
	}
}


