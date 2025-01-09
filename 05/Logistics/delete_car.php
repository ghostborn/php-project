<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$id = $_GET['id'];  // 获取车辆id
if (empty($id)) {
	msg(2, '非法操作', 'car.php');
}
/** 执行删除操作 **/
$query = 'DELETE FROM tb_car WHERE id = :id';
$res = $pdo->prepare($query);
$res->bindParam(':id', $id);
$res->execute();
if ($res->rowCount()) {
	msg(1, '删除成功', 'car.php');
} else {
	msg(2, '删除失败');
}

