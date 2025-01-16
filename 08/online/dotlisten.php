<?php
session_start();//启动Session
include "conn/conn.php";//包含数据库连接文件
?>
<body leftmargin="0" topmargin="0" onUnload="javascript:top.opener.location.reload();">
<center>
	<?php
	if ($_SERVER['HTTP_REFERER'] != "") {//如果上一页面不为空
		$sql = "delete from tb_register where id = " . $_GET['id'];//定义删除语句
		$result = $pdo->exec($sql);//执行语句
		if ($result == 1) {//如果变量值为1
			?>
            <audio src="upfiles/audio/<?php echo $_GET['name']; ?>" controls="controls" autoplay="autoplay"></audio>
			<?php
		} else {
			echo "<script>alert('删除失败');window.close();</script>";//弹出对话框
			exit();//退出程序
		}
	} else {
		echo "<script>alert('不允许从外部输入');window.close();</script>";//弹出对话框
		exit();//退出程序
	}
	?>
</center>
</body>
