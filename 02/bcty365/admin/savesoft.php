<?php
header("Content-type: text/html; charset=utf8"); //设置文件编码格式
include_once("../conn/conn.php");
$softname = $_POST['softname'];
$content = $_POST['content'];
date_default_timezone_set("PRC");
$createtime = date("Y-m-j H:i:s");

if (is_dir("./soft") == false) {
    mkdir("./soft");
}
$link = date("YmjHis");
$path = $link . mt_rand(1000000, 9999999) . strstr($_FILES["address"]["name"], ".");
$address = "./soft/" . $path;
move_uploaded_file($_FILES["address"]["tmp_name"], $address);
$address = "./admin/soft/" . $path;
$query = mysqli_query($conn, "insert into tb_soft(softname,content,addtime,address,click) values('$softname','$content','$createtime','$address','0')");

if ($query) {
    echo "<script>alert('试用软件添加成功！');history.back();</script>";
} else {
    echo "<script>alert('试用软件添加失败！');history.back();</script>";
}
?>