<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>找回密码</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<?php
include_once("conn/conn.php");
$nc = $_POST['nc'];
$da = $_POST['da'];
$sql = mysqli_query($conn, "select * from tb_user where usernc='" . $nc . "'");
$info = mysqli_fetch_array($sql);
if ($info['answer'] != $da) {
	echo "<script>alert('提示答案输入错误!');history.back();</script>";
	exit;
} else {
?>
<body topmargin="0" leftmargin="0" bottommargin="0">
<table width="200" height="100" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="25">
            <div align="center"></div>
        </td>
    </tr>
    <tr>
        <td height="25">
            <div align="center"><font color="#FF0000">密码找回成功！</font></div>
        </td>
    </tr>
    <tr>
        <td height="25">
            <div align="center">建议您重新设置密码！</div>
        </td>
    </tr>
    <tr>
        <td height="25">
            <div align="center">
                <a href="javascript:alert('<?php echo "原密码为&nbsp;" . $info['truepwd']; ?>');">显示原密码</a>
                <a href="changepwd.php?userid=<?php echo $info['id']; ?>" class="a1">重设密码</a>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
<?php
}
mysqli_close($conn);
?>

