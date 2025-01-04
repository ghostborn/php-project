<?php
header("Content-type: text/html; charset=utf8"); //设置文件编码格式
$name = $_POST['name'];//获取表单提交的数据
$typeid = $_POST['typeid'];//获取表单提交的数据
$content = $_POST['content'];//获取表单提交的数据
date_default_timezone_set("PRC");//设置时区
$addtime = date("Y-m-j H:i:s");//定义时间变量
$bbid = $_POST['bbid'];//获取表单提交的数据
if (is_dir("./sjxz") == false) {//判断指定的文件夹是否存在
    mkdir("./sjxz");//如果指定的文件夹不存在，则创建一个指定的文件夹
}
$link = date("YmjHis");//获取一个时间
$path = $link . mt_rand(1000000, 9999999) . strstr($_FILES["address"]["name"], ".");//重新设置升级包名称
$address = "./sjxz/" . $path;//设置升级包在服务器中存储的指定路径
move_uploaded_file($_FILES["address"]["tmp_name"], $address);//将升级包上传到指定的路径下
$address = "./admin/sjxz/" . $path;//获取升级包在服务器中的存储路径
include_once("../conn/conn.php");//连接数据库文件
//将上传的数据存储到数据库中，这里将升级包在服务器中的路径存储到数据库中
$query = mysqli_query($conn, "insert into tb_sjxz(name,typeid,content,addtime,address,bbid) values('$name','$typeid','$content','$addtime','$address','$bbid')");
if ($query) {//如果添加操作成功，则弹出提示
    echo "<script>alert('升级包添加成功！');history.back();</script>";
} else {//如果添加操作失败，则弹出提示
    echo "<script>alert('升级包添加失败！');history.back();</script>";
}
?>