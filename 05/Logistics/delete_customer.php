<?php
include('Conn/config.php');
include('Library/function.php');
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$customer_id = $_GET['id']; // 获取客户id
if (empty($customer_id)) {
	msg(2, '非法操作', 'customer.php');
}

$query = 'delete from tb_customer where customer_id = :id ';
$res = $pdo->prepare($query);
$res->bindParam(':id', $customer_id);
$res->execute();
if ($res->rowCount()) {
	msg(1, '删除成功', 'customer.php');
} else {
	msg(2, '删除失败');
}