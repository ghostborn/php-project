<?php
session_start();//启动Session
header("Content-type:text/html;charset=utf-8"); //设置文件编码格式
if (isset($_SESSION['name'])) {//如果用户已登录
	?>
    <body leftmargin="0" topmargin="0">
    <audio src="upfiles/audio/<?php echo $_GET['id']; ?>" controls="controls" autoplay="autoplay"></audio>
    </body>
	<?php
} else {
	echo "<script>alert('只有会员才能播放歌曲，请登录！');top.location.href='login.php';</script>";//弹出提示信息
}
?>