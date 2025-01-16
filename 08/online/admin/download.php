<?php
include "conn/conn.php";//包含数据库连接文件
$address = $_GET['id'];//为变量赋值
if ($_GET['action'] == "audio") {//如果参数action的值为audio
	$a_sql = "select address,downTime from tb_audio where address = '" . $address . "'";//定义查询语句
	$result = $pdo->prepare($a_sql);//准备查询
	$result->execute();//执行查询
	if ($a_rst = $result->fetch(PDO::FETCH_NUM)) {//将查询结果返回到数组并判断结果是否为真
		$u_sql = "update tb_audio set downTime=" . ($a_rst[1] + 1) . " where address = '" . $address . "'";//定义更新语句
		$pdo->exec($u_sql);//执行语句
		$path = "../upfiles/audio/" . $address;//定义下载音频文件的路径
	}
} else {
	if ($_GET['action'] == "video") {//否则如果参数action的值为video
		$a_sql = "select address,downTime from tb_video where address = '" . $address . "'";//定义查询语句
		$result = $pdo->prepare($a_sql);//准备查询
		$result->execute();//执行查询
		if ($a_rst = $result->fetch(PDO::FETCH_NUM)) {//将查询结果返回到数组并判断结果是否为真
			$u_sql = "update tb_video set downTime=" . ($a_rst[1] + 1) . " where address = '" . $address . "'";//定义更新语句
			$pdo->exec($u_sql);//执行语句
			$path = "../upfiles/video/" . $address;//定义下载视频文件的路径
		}
	}
}
if (file_exists($path) == false)//如果文件不存在
{
	echo "<script>alert('您访问文件已删除，请与管理员联系。');history.back();</script>";//弹出对话框
	exit;//退出程序
}
$filename = preg_replace('/^.+[\\\\\\/]/', '', $path);//获取下载文件名
//对文件进行下载
$file = fopen($path, "r");
header("Content-type:application/octet-stream");
header("Content-ranges:bytes");
header("Content-length:" . filesize($path));
header("Content-Disposition:attachment;filename=" . $filename);
readfile($path);
fclose($file);
exit;
?>