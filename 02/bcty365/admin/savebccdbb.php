<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
$bccdid = $_POST['bccdid'];//获取表单中提交的数据
$bbid = $_POST['bbid'];//获取编程词典ID
$price = $_POST['price'];//获取编程词典单价
$content = $_POST['content'];//获取编程词典内容
$gn = $_POST['gn'];//获取编程词典功能
$fw = $_POST['fw'];//获取编程词典服务
include_once("../conn/conn.php");//连接数据库文件
//判断提交的编程词典是否已经被添加
$sql = mysqli_query($conn, "select id from tb_bbqb where bccdid='" . $bccdid . "'");
$info = mysqli_fetch_array($sql);//检索指定编程词典的ID
if ($info != false) {//如果检索值为假，则弹出提示
    echo "<script>alert('该版编程词典已经添加！');history.back();</script>";
    exit;
}
$query = mysqli_query($conn, "insert into tb_bbqb(bccdid,bbid,price,content,gn,fw) values('$bccdid','$bbid','$price','$content','$gn','$fw')");//将表单中提交的数据存储到数据库中
//更新编程词典的价格
$querys = mysqli_query($conn, "update tb_bccd set bbid='$bbid',price='$price' where id='" . $bccdid . "'");
echo mysqli_error();
if ($query == true and $querys == true) {//如果添加和更新操作为真，则弹出提示
    echo "<script>alert('版本信息添加成功！');history.back();</script>";
} else {//如果添加和更新操作为假，则弹出提示
    echo "<script>alert('版本信息添加失败！');history.back();</script>";
}
?>