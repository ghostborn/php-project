<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();//启动Session
include "conn/conn.php";//包含数据库连接文件
include "inc/func.php";//包含函数文件
include "inc/chec.php";//包含用户权限文件
$p_type = array("jpg", "jpeg", "bmp", "gif", "png");//定义图片格式数组
$f_type = array("avi", "rm", "rmvb", "wav", "mp3", "mpg", "mp4", "wmv");//定义视频音频格式数组
$audio_path = "upfiles\\audio";//定义音频文件路径
$video_path = "upfiles\\video";//定义视频文件路径
$picture_path = "";//初始化变量
$file_path = "";//初始化变量
/*  判断上传图片类型和文件大小，上传图片 */
if (isset($_FILES['picture']) && $_FILES['picture']['size'] > 0 and $_FILES['picture']['size'] < 700000) {
	if (($postf = f_postfix($p_type, $_FILES['picture']['name'])) != false) {
		$picture_path = time() . "." . $postf;
		if ($_POST['action'] == "a") {
			if ($_FILES['picture']['tmp_name']) {
				move_uploaded_file($_FILES['picture']['tmp_name'], $audio_path . "\\" . $picture_path);
			} else {
				echo "<script>alert('上传图片失败！');history.go(-1);</script>";
				exit();
			}
		} else {
			if ($_POST['action'] == "v") {
				if ($_FILES['picture']['tmp_name']) {
					move_uploaded_file($_FILES['picture']['tmp_name'], $video_path . "\\" . $picture_path);
				} else {
					echo "<script>alert('上传图片失败！');history.go(-1);</script>";
					exit();
				}
			}
		}
	} else {
		echo "<script>alert('上传图片格式错误！');history.go(-1);</script>";
		exit();
	}
} else {
	if (isset($_FILES['picture']) && $_FILES['picture']['size'] > 700000) {
		echo "<script>alert('上传图片大小超出范围！');history.go(-1);</script>";
		exit();
	} else {
		$picture = "";
	}
}
/******************************/
/*  判断上传文件类型与大小，上传文件  */
if (isset($_FILES['address']) && $_FILES['address']['size'] > 0) {
	//如果是视频文件
	if ($_POST['action'] == "v") {
		if ($_FILES['address']['size'] < 300000000) {
			if (($postf = f_postfix($f_type, $_FILES['address']['name'])) != false) {
				$file_path = time() . "." . $postf;
				if ($_FILES['address']['tmp_name']) {
					move_uploaded_file($_FILES['address']['tmp_name'], $video_path . "\\" . $file_path);
				} else {
					echo "<script>alert('上传文件错误！');history.go(-1);</script>";
					exit();
				}
			} else {
				echo "<script>alert('上传文件格式错误！');history.back(-1);</script>";
				exit();
			}
		} else {
			echo "<script>alert('上传文件大小错误！');history.go(-1);</script>";
			exit();
		}
	} //如果是音频文件
	else {
		if ($_POST['action'] == "a") {
			if ($_FILES['address']['size'] < 10000000) {
				if (($postf = f_postfix($f_type, $_FILES['address']['name'])) != false) {
					$file_path = time() . "." . $postf;
					if ($_FILES['address']['tmp_name']) {
						move_uploaded_file($_FILES['address']['tmp_name'], $audio_path . "\\" . $file_path);
					} else {
						echo "<script>alert('上传文件错误！');history.go(-1);</script>";
						exit();
					}
				} else {
					echo "<script>alert('上传文件格式错误！');history.back(-1);</script>";
					exit();
				}
			} else {
				echo "<script>alert('上传文件大小错误！');history.go(-1);</script>";
				exit();
			}
		}
	}
} else {
	echo "<script>alert('没有上传文件或文件大于300M');history.go(-1);</script>";
	exit();
}
/****************/
/*  相同的信息  */
$names = $_POST['names'];                    //为变量赋值
$grade = isset($_POST['grade']) ? $_POST['grade'] : "";                    //为变量赋值
$sizes = $_FILES['address']['size'];//为变量赋值
$publisher = $_POST['publisher'];            //为变量赋值
$actor = $_POST['actor'];//为变量赋值
$language = $_POST['language'];//为变量赋值
$style = $_POST['style'];//为变量赋值
$type = $_POST['type'];//为变量赋值
$froms = $_POST['from'];//为变量赋值
$publishtime = $_POST['publishtime'];//为变量赋值
$news = isset($_POST['news']) ? $_POST['news'] : "";//为变量赋值
$remark = $_POST['remark'];//为变量赋值
$intro = isset($_POST['intro']) ? $_POST['intro'] : "";//为变量赋值

/*****************/
if ($_POST['action'] == "v") {//如果上传的是视频文件
	$director = $_POST['director'];//为变量赋值
	$marker = $_POST['marker'];//为变量赋值
	$a_sqlstr = "insert into tb_video (name,picture,sizes,grade,publisher,actor,director,marker,languages,type,style,froms,publishtime,bool,remark,property,address,username,issueDate,intro)  values('$names','$picture_path','$sizes','$grade','$publisher','$actor','$director','$marker','$language','$type','$style','$froms','$publishtime','$news','$remark','用户','$file_path','" . $_SESSION['name'] . "','" . date("Y-m-d H:i:s") . "','$intro')";//定义插入语句
} else {
	if ($_POST['action'] == "a") {//否则如果上传的是音频文件
		$actortype = $_POST['actortype'];//为变量赋值
		$ci = $_POST['ci'];//为变量赋值
		$qu = $_POST['qu'];//为变量赋值
		$a_sqlstr = "insert into tb_audio (name,picture,actor,ci,qu,actortype,type,style,publisher,froms,sizes,languages,publishTime,remark,property,address,userName,issueDate,bool) values('$names','$picture_path','$actor','$ci','$qu','$actortype','$type','$style','$publisher','$froms','$sizes','$language','$publishtime','$remark','用户','$file_path','" . $_SESSION['name'] . "','" . date("Y-m-d H:i:s") . "','$news')";//定义插入语句
	} else {
		echo "<script>alert('错误');window.close();</script>";//弹出对话框
		exit();//退出程序
	}
}
/*  上传图片和文件 */

/***************************/

if ($pdo->exec($a_sqlstr)) {//如果执行插入语句的结果为真
	$quesql = "select id,counts from tb_account where id = " . $_SESSION['id'];//定义查询语句
	//$querst = $conn->execute($quesql);
	$result = $pdo->prepare($quesql);//准备查询
	$result->execute();//执行查询
	$querst = $result->fetch(PDO::FETCH_NUM);//将查询结果返回到数组
	$count = $querst[1];//为变量赋值
	$count += 1;//变量值自加1
	$addsql = "update tb_account set counts = " . $count . " where id = " . $_SESSION['id'];//定义更新语句
	if ($pdo->exec($addsql)) {//如果执行更新语句的结果为真
		$_SESSION['counts'] += 1;//变量值自加1
		echo "<script>top.opener.location.reload();alert('添加成功');window.close();history.go(-1);</script>";//弹出对话框
		exit();//退出程序
	}
} else {
	echo "<script>alert('添加失败');history.go(-1);</script>";//弹出对话框
	exit();//退出程序
}
?>