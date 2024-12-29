<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
session_start();
if(!isset($_SESSION["goodsid"]) && !isset($_SESSION["goodsnum"])){  //判断session变量中的值是否为空
	$_SESSION["goodsid"] = $_GET["id"]."@"; //如果为空，则将商品的id赋给变量
	$_SESSION["goodsnum"] = "1@";   //将商品数量设置为“1@”
}else{
	$array = explode("@",$_SESSION["goodsid"]); //如果不为空，则使用@分割不同的商品ID
	//判断如果获取的ID在session变量中已经存在，则提示该商品已经被放入购物车
	if(in_array($_GET["id"],$array)){
		echo "<script>alert('该编程词典已经被放入购物车！');history.back();</script>";
		exit;
	}
	$_SESSION["goodsid"].=$_GET["id"]."@"; //为session变量赋值
	$_SESSION["goodsnum"].="1@";
}
//将商品放入购物车中，并跳转到购物车页
echo "<script>window.location.href='shopping_cart.php';</script>";