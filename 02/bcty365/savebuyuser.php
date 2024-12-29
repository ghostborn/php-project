<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include_once("conn/conn.php");
date_default_timezone_set("PRC");
$ddnumber = substr(date("YmdHis"), 2, 8) . mt_rand(100000, 999999);
$sql = mysqli_query($conn, "select * from tb_city where id='" . $_POST["city"] . "' ");
$info = mysqli_fetch_array($sql);
if ($_POST['shfs'] == "1") { //判断用户选择的送货方式
	$yprice = $info['pt'];
	$shfs = "普通邮递";
} elseif ($_POST['shfs'] == "2") {
	$yprice = $info['kd'];
	$shfs = "邮政特快专递EMS";
}
$array = explode("@", $_SESSION["goodsid"]);//以@来分割session变量中存储的商品ID
$arraynum = explode("@", $_SESSION["goodsnum"]);  //以@来分割session变量中存储的商品数量

for ($i = 0; $i < count($array); $i++) {//循环读取数组中商品的ID
	if ($array[$i] != "") {
		$sqlcart = mysqli_query($conn, "select * from tb_bccd where id='" . $array[$i] . "'");
		$infocart = mysqli_fetch_array($sqlcart);
		$totalprice += $infocart["price"] * $arraynum["$i"];
	}
}
$totalprice = $totalprice + $yprice;//获取汇款金额
//将表单中提交的数据存储到数据库中

if (mysqli_query($conn,
	"insert into tb_dd(ddnumber,recuser,sex,address,yb,qq,email,mtel,gtel,shfs,spc,slc,yprice,totalprice,createtime,cityid) values('" . $ddnumber . "','" . $_POST["recuser"] . "','" . $_POST["sex"] . "','" . $_POST["address"] . "','" . $_POST["yb"] . "','" . $_POST["qq"] . "','" . $_POST["email"] . "','" . $_POST["mtel"] . "','" . $_POST["gtel"] . "','" . $shfs . "','" . $_SESSION["goodsid"] . "','" . $_SESSION["goodsnum"] . "','" . $yprice . "','" . $totalprice . "','" . date("Y-m-d H:i:s") . "','" . $_POST["city"] . "')")) {
	unset($_SESSION["goodsid"]);//注销session变量goodsid
	unset($_SESSION["goodsnum"]);//注销session变量goodsnum
	echo "<script>window.location.href='shopping_dd.php?ddno=" . base64_encode($ddnumber) . "'; </script>";
} else {
	echo "<script>alert('订单信息保存失败，请重试！');</script>";
}


















