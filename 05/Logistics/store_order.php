<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
/** 接收数据 **/
$fahuo_id = $_POST['fahuo_id'];
$car_number = $_POST['car_number'];
$car_tel = $_POST['tel'];
$fahuo_user = $_POST['fahuo_user'];
$fahuo_tel = $_POST['fahuo_tel'];
$fahuo_fk = $_POST['fahuo_fk'];
$fahuo_content = $_POST['fahuo_content'];
$fahuo_address = $_POST['fahuo_address'];
$fahuo_time = date("Y-m-d H:i:s");
$shouhuo_user = $_POST['shouhuo_user'];
$shouhuo_tel = $_POST['shouhuo_tel'];
$shouhuo_address = $_POST['shouhuo_address'];
$car_log = $_POST['car_log'];

/** 后台验证数据 **/
if (empty($fahuo_user)) {
	msg(2, '请输入发货人！');
}
if (empty($fahuo_content)) {
	msg(2, '请输入货物信息!');
}
if (empty($fahuo_address)) {
	msg(2, '请发货地址!');
}
if (empty($shouhuo_user)) {
	msg(2, '请输入收货人!');
}
if (empty($shouhuo_address)) {
	msg(2, '请输入收货地址!');
}
if (empty($car_log)) {
	msg(2, '请输入车辆使用信息!');
}
$rule = "/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$|^(\d{11})$/";
if (!preg_match($rule, $car_tel)) {
	msg(2, '车主电话格式错误！');
}
if (!preg_match($rule, $fahuo_tel)) {
	msg(2, '发货人电话格式错误！');
}
if (!preg_match($rule, $shouhuo_tel)) {
	msg(2, '收货人电话格式错误！');
}

/** 新增或编辑情况 **/
if (isset($_POST['id'])) {
	/** 编辑 **/
	// 更改tb_shopping表
	$id = $_POST['id'];
	$shopping_query = "update tb_shopping set car_number='$car_number',car_tel='$car_tel',fahuo_user='$fahuo_user',fahuo_tel='$fahuo_tel',fahuo_address='$fahuo_address',fahuo_content='$fahuo_content',fahuo_time='$fahuo_time',fahuo_fk='$fahuo_fk',shouhuo_user='$shouhuo_user',shouhuo_address='$shouhuo_address',shouhuo_tel='$shouhuo_tel',car_number='$car_number',car_tel='$car_tel',fahuo_id='$fahuo_id',fahuo_user='$fahuo_user',fahuo_tel='$fahuo_tel',fahuo_address='$fahuo_address',fahuo_content='$fahuo_content',fahuo_time='$fahuo_time',fahuo_fk='$fahuo_fk',shouhuo_user='$shouhuo_user',shouhuo_address='$shouhuo_address',shouhuo_tel='$shouhuo_tel' where id = $id";
	$res = $pdo->prepare($shopping_query);
	if (!$res->execute()) {
		msg(2, '操作失败');
	}
	// 更改tb_car_log表
	$cat_query = "update tb_car_log set car_log='$car_log',car_number='$car_number',log_date='$fahuo_time' where fahuo_id='$fahuo_id' ";
	$res = $pdo->prepare($cat_query);
	if (!$res->execute()) {
		msg(2, '操作失败');
	}
} else {
	/** 新增 **/
	// 写入tb_shopping表
	$shopping_query = "insert into tb_shopping (car_number,car_tel,fahuo_id,fahuo_user, fahuo_tel,fahuo_address,fahuo_content,fahuo_time,fahuo_fk,shouhuo_user,shouhuo_address,shouhuo_tel)
                        values('$car_number','$car_tel','$fahuo_id','$fahuo_user','$fahuo_tel','$fahuo_address','$fahuo_content','$fahuo_time','$fahuo_fk','$shouhuo_user','$shouhuo_address','$shouhuo_tel')";
	$res = $pdo->prepare($shopping_query);
	if (!$res->execute()) {
		msg(2, '操作失败');
	}
	// 写入tb_car_log表
	$cat_query = "insert into tb_car_log(car_log,car_number,log_date,fahuo_id)values('$car_log','$car_number','$fahuo_time','$fahuo_id')";
	$res = $pdo->prepare($cat_query);
	if (!$res->execute()) {
		msg(2, '操作失败');
	}
	// 写入tb_customer表
	$customer_query = "insert into tb_customer (customer_user,customer_tel,customer_address)values('$fahuo_user','$fahuo_tel','$fahuo_address')";
	$res = $pdo->prepare($customer_query);
	$res->execute();
	if (!$res->execute()) {
		msg(2, '操作失败');
	}
}
msg(1, '操作成功', 'order.php');
?>