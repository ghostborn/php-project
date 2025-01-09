<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
$id = intval($_GET['id']);
if (empty($id)) {
	msg(2, '非法操作', 'order.php');
}
// 查找发货id
$query = 'select fahuo_id from tb_shopping where id = ' . $id;
$res = $pdo->prepare($query);
$res->execute();
$fahuo_id = $res->fetchColumn();

// 删除tb_car_log表
$query_log = 'DELETE FROM tb_car_log WHERE fahuo_id = :fahuo_id';
$res_log = $pdo->prepare($query_log);
$res_log->bindParam(':fahuo_id', $fahuo_id);
$res_log->execute();
// 删除tb_shopping表
$query_shopping = 'DELETE FROM tb_shopping WHERE id = :id';
$res_shopping = $pdo->prepare($query_shopping);
$res_shopping->bindParam(':id', $id);
$res_shopping->execute();
if ($res_shopping->rowCount()) {
	msg(1, '操作成功', 'order.php');
} else {
	msg(2, '操作失败', 'order.php');
}
?>