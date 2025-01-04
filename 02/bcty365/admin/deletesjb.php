<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
$id = $_GET['id'];//获取变量传递的ID
include_once("../conn/conn.php");//连接数据库
//执行删除操作，将数据表中对应的ID数据删除
if (mysqli_query($conn, "delete from tb_sjxz where id='" . $id . "'")) {
    echo "<script>alert('该升级包删除成功!');history.back();</script>";//如果删除操作成功，则弹出提示
} else {//如果删除操作失败，则弹出提示
    echo "<script>alert('该升级包删除失败!');history.back();</script>";
}
?>