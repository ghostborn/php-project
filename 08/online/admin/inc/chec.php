<?php
	header("content-type:text/html;charset=utf-8");
	//session_start();
	if(!isset($_SESSION['m_id']) and !isset($_SESSION['type'])){
		echo "<script>alert('非法登录');location.href = 'index.php';</script>";
		exit();
	}
?>