<?php
include_once('Conn/config.php');
include_once('Library/function.php');

//表单进行了提交处理
if (!empty($_POST['admin_user'])) {
	$admin_user = trim($_POST['admin_user']);
	$admin_pass = trim($_POST['admin_pass']);

	if (!$admin_user) {
		echo '用户名不能为空';
	}
	if (!$admin_pass) {
		echo '密码不能为空';
	}

	/** 判断账户密码是否正确 **/
	$query = "select * from tb_admin where admin_user = :user and admin_pass = :password";
	$res = $pdo->prepare($query);
	$res->execute(array(':user' => $admin_user, ':password' => md5($admin_pass)));
	$admin = $res->fetch(PDO::FETCH_ASSOC);
	if (is_array($admin) && !empty($admin)) {
		session_start();
		$_SESSION['user'] = $admin;
		echo true;
	} else {
		echo false;
	}
}