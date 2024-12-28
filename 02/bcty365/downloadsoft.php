<?php
$id = $_GET['id'];
include_once("conn/conn.php");
$sql = mysqli_query($conn, "select * from tb_soft where id='" . $id . "'");
$info = mysqli_fetch_array($sql);
$path = $info['address'];
if (file_exists($path) == false) {
	echo "<script>alert('对不起，本站暂时停止提供该软件下载!');history.back();</script>";
	exit;
} else {
	mysqli_query($conn, "update tb_soft set click=click+1 where id='" . $id . "'");
	echo mysqli_error();
	$filename = basename($path);
	$file = fopen($path, "r");
	ob_clean();
	header("Content-type:application/octet-stream");
	header("Accept-ranges:bytes");
	header("Accept-length:" . filesize($path));
	header("Content-Disposition:attachment;filename=" . $filename);
	echo fread($file, filesize($path));
	fclose($file);
	exit;
}
?>