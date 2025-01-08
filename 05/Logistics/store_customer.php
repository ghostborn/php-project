<?php
include('Conn/config.php');
include('Library/function.php');
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
// 接受数据
$customer_id = $_POST['customer_id'];
$customer_user = $_POST['customer_user'];
$customer_tel = $_POST['customer_tel'];
$customer_address = $_POST['customer_address'];
/** 后台验证数据 **/
if (empty($customer_user)) {
	msg(2, '请输入用户姓名！');
}
if (empty($customer_tel)) {
	msg(2, '请输入用户电话！');
}
if (empty($customer_address)) {
	msg(2, '请输入用户地址！');
}
$rule = "/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$|^(\d{11})$/";
if (!preg_match($rule, $customer_tel)) {
	msg(2, '用户电话格式错误！');
}

/** 新增或编辑处理 **/
if ($customer_id) {
	//编辑
	$query = "update tb_customer set customer_user=:user,customer_tel=:tel,customer_address=:address where customer_id=:id";
	$res = $pdo->prepare($query);
	$res->execute(array(
		':user' => $customer_user,
		':tel' => $customer_tel,
		':address' => $customer_address,
		':id' => $customer_id
	));

} else {
	$query = "insert into tb_customer(customer_user,customer_tel,customer_address) values (:user,:tel,:address)";
	$res = $pdo->prepare($query);
	$res->execute(array(':user' => $customer_user, ':tel' => $customer_tel, ':address' => $customer_address));
}
if ($res->rowCount()) {
	msg(1, '操作成功');
} else {
	msg(2, '操作失败');
}