<?php
include('Conn/config.php');         // 引入配置文件
include('Library/function.php');    // 引入函数库
// 判断是否登录
if (!checkLogin()) {
	msg(2, ' 请先登录', 'login.php');
}
/** 接收数据 **/
$id = $_POST['id'];
$username = $_POST['username'];
$car_number = $_POST['car_number'];
$user_number = $_POST['user_number'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$car_road = $_POST['car_road'];
$car_content = $_POST['car_content'];

/** 后台验证数据 **/
if (empty($username)) {
	msg(2, '请输入车主！');
}
if (empty($car_number)) {
	msg(2, '请输入车牌号码!');
}
if (empty($user_number)) {
	msg(2, '请输入身份证号码!');
}
if (empty($address)) {
	msg(2, '请输入车主地址!');
}
if (empty($car_road)) {
	msg(2, '请输入输入路线!');
}
$rule = "/^(\d{3}-)(\d{8})$|^(\d{4}-)(\d{7})$|^(\d{4}-)(\d{8})$|^(\d{11})$/";
if (!preg_match($rule, $tel)) {
	msg(2, '车主电话格式错误！');
}
if (empty($car_content)) {
	msg(2, '请输入车辆描述!');
}

/** 新增或编辑情况 **/
if ($id) {
	// 更改tb_car表
	$query = "update tb_car set username='$username',user_number='$user_number',car_number='$car_number',tel='$tel',address='$address',car_road='$car_road',car_content='$car_content'
                      where id='$id' ";
} else {
	// 写入tb_car表
	$query = "insert into tb_car (username,user_number,car_number,tel, address,car_road,car_content)
                            values('$username','$user_number','$car_number','$tel','$address','$car_road','$car_content')";

}
$res = $pdo->prepare($query);
$res->execute();
if ($res->rowCount()) {
	msg(1, '操作成功', 'car.php');
} else {
	msg(2, '操作失败', 'car.php');
}

?>