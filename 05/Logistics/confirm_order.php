<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
$id = intval($_POST['id']);
$fahuo_id = $_POST['fahuo_id'];
if (empty($id)) {
	msg(2, '非法操作', 'order.php');
}
// 清空车辆日志
$query_delete = "delete from tb_car_log where fahuo_id='$fahuo_id'";
$res_delete = $pdo->prepare($query_delete);
$res_delete->execute();

//更改状态
$query = 'update tb_shopping set fahuo_ys = 1 where id = ' . $id;
$res = $pdo->prepare($query);
$res->execute();
if ($res->rowCount()) {
	echo true;
} else {
	echo false;
}