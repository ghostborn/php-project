<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();//初始化session变量
$title = $_POST['bbs_title'];//获取帖子的标题
$content = $_POST['content1'];//获取帖子的内容
/*判断提交的帖子主题和帖子内容是否为空*/
if ($title == "") {
	echo "<script>alert('请输入帖子主题！');history.back();</script>";
	exit;
}
if ($content == "") {
	echo "<script>alert('请输入帖子内容！');history.back();</script>";
	exit;
}
include_once("conn/conn.php");//连接数据库
date_default_timezone_set("PRC");
//根据$_SESSION["unc"]的值读取数据库中用户的信息
$sql = mysqli_query($conn, "select * from tb_user where usernc='" . $_SESSION["unc"] . "'");
$info = mysqli_fetch_array($sql);//检索指定条件的数据信息
$userid = $info['id'];//获取用户id
$typeid = $_POST['bbs_type'];//接收版块名称
$title = $_POST['bbs_title'];//接收帖子主题
$content = $_POST['content1'];//接收帖子内容
$head = $_POST['bbs_head'];//接收头像
$createtime = date("Y-m-j H:i:s");//获取系统当前时间
$lastreplytime = $createtime;//将当前时间赋给变量
$readtimes = 0;
$link = date("YmjHis");
if ($_FILES['bbs_photo']["name"] == true) {         //上传图片,判断文件是否存在
	$photo_name = strtolower(stristr($_FILES["bbs_photo"]["name"], "."));                  //获取图片的后缀名,将字符转换成小写
	if ($photo_name != ".gif" && $photo_name != ".jpg" && $photo_name != ".jpeg" && $photo_name != ".png") { //判断图片的格式是否符合要求
		echo "<script>alert('您上传的图片格式不正确!');history.back();</script>";
	} else {
		$paths1 = $link . mt_rand(1000000, 9999999) . $photo_name;                //创建图片的名称
		$photos = "./upfile/" . $paths1;                                    //创建图片的存储路径
		move_uploaded_file($_FILES['bbs_photo']["tmp_name"], $photos);         //将图片存储到指定的文件夹下
		//向数据库添加数据
		if (mysqli_query($conn,
			"insert into tb_bbs(userid,typeid,title,content,createtime,lastreplytime,head,readtimes,top,photo) values ('" . $userid . "','" . $typeid . "','" . $title . "','" . $content . "','" . $createtime . "','" . $lastreplytime . "','" . $head . "','" . $readtimes . "','0','$photos')")) {
			mysqli_query($conn, "update tb_user set pubtimes=pubtimes+1");//更新tb_user中pubtimes字段的值
			echo "<script>alert('新帖发表成功!');history.back();</script>";
			mysqli_close($conn);
		} else {
			echo "<script>alert('新帖发表失败!');history.back();</script>";
			mysqli_close($conn);
		}
	}
} else {//如果没有提交图片，则执行下面的内容
	if (mysqli_query($conn,
		"insert into tb_bbs(userid,typeid,title,content,createtime,lastreplytime,head,readtimes,top) values ('" . $userid . "','" . $typeid . "','" . $title . "','" . $content . "','" . $createtime . "','" . $lastreplytime . "','" . $head . "','" . $readtimes . "','0')")) {
		mysqli_query($conn, "update tb_user set pubtimes=pubtimes+1");
		echo "<script>alert('新帖发表成功!');history.back();</script>";
		mysqli_close($conn);
	} else {
		echo "<script>alert('新帖发表失败!');history.back();</script>";
		mysqli_close($conn);
	}
}
?>

