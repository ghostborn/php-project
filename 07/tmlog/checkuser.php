<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();
include "Conn/conn.php";
$name = $_POST['txt_user'];
$pwd = $_POST['txt_pwd'];
$sql = mysqli_query($link, "select * from tb_user where regname='" . $name . "' and regpwd='" . $pwd . "'");
$result = mysqli_fetch_array($sql);
if ($result != "") {
	$_SESSION['fig'] = $result['fig'];
	$_SESSION['username'] = $name;
	?>
    <script language="javascript">
        alert("登录成功");
        window.location.href = "file.php";
    </script>
	<?php
} else {
	?>
    <script language="javascript">
        alert("对不起，您输入的用户名或密码不正确，请重新输入!");
        window.location.href = "index.php";
    </script>
	<?php
}
?>