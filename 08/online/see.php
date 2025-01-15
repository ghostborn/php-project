<?php
header("Content-type:text/html;charset=utf-8"); //设置文件编码格式
session_start();//启动Session
if (isset($_SESSION['name'])) {//如果用户已登录
	?>
    <body leftmargin="0" topmargin="0">
    <video src="upfiles/video/<?php echo $_GET['id']; ?>" width="100%" height="100%" controls="controls"
           autoplay="autoplay"></video>
    </body>
	<?php
} else {
	echo "<script>alert('只有会员才能观看影片，请登录！');location.href='login.php';</script>";//弹出提示信息
}
?>