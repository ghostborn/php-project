<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
	if(!isset($_SESSION['id']) or !isset($_SESSION['name'])){//如果Session变量id或者Session变量name没有值
		echo "<script>alert('您没有登录或超时');window.close();</script>";//弹出对话框
		exit();//退出程序
	}
?>