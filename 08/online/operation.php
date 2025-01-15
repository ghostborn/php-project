<?php
session_start();//启动Session
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="css/reg.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<script src="js/chk.js"></script>
<script src="js/createxmlhttp.js"></script>
<script src="js/riq.js"></script>
<script type="text/javascript">
    function chk_download() {
        const name = "<?php echo $_SESSION['name'] ?? "";?>";//为变量赋值
        const grades = "<?php echo $_SESSION['grades'] ?? "";?>";//为变量赋值
        if (name == "" || grades != "高级会员") {//如果变量name的值为空或者变量grades的值不是"高级会员"
            alert('只有高级会员登录后才能下载');//弹出对话框
            return false;//返回false
        } else {
            return true;//返回true
        }
    }
</script>
<body>
<center>
	<?php
	include "top.php";            //banner
	?>
	<?php
	/*  动作类别  */
	switch ($_GET['action']) {
		case "reg":                    //注册
			include "register.php";//包含文件
			break;
		case "s_music":                //查看点歌系统
			include "s_music.php";//包含文件
			break;
		case "mod_vip":                //修改资料
			include "mod_vip.php";    //包含文件
			break;
		case "intro":                //音频介绍
			?>
            <iframe src="intro.php?id=<?php echo $_GET['id']; ?>" width="100%" height="800" scrolling="auto"
                    frameborder="0"></iframe>
			<?php
			break;
		case "v_intro":                //视频介绍
			?>
            <iframe src="v_intro.php?id=<?php echo $_GET['id']; ?>" width="100%" height="800" scrolling="auto"
                    frameborder="0"></iframe>
			<?php
			break;
		case "call":
			include "call.php";//包含文件
			break;
		case "trans":
			include "trans.php";//包含文件
			break;
		case "found":
			include "found_pwd.php";//包含文件
			break;
		case "see":
			echo "<script>location.href='see.php?id=" . $_GET['id'] . "'</script>";
			?>
			<?php
			break;
		case "listen":
			?>
            <iframe src="listen.php?id=<?php echo $_GET['id']; ?>" width="665" height="530" scrolling="no"
                    frameborder="0" align="middle"></iframe>
			<?php
			break;
		case "give":
			?>
            <iframe src="give.php?id=<?php echo $_GET['id']; ?>" width="665" height="530" scrolling="no" frameborder="0"
                    align="middle"></iframe>
			<?php
			break;
		case "dotlisten":
			?>
            <iframe src="dotlisten.php?id=<?php echo $_GET['id']; ?>&name=<?php echo $_GET['name']; ?>" width="665"
                    height="530" scrolling="no" frameborder="0" align="middle"></iframe>
		<?php
		default:
			break;
	}
	/**************/
	?>
</center>
</body>
</html>
