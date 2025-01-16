<?php
	header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
	session_start();//启动Session
	include "conn/conn.php";//包含数据库连接文件
	include "inc/chec.php";//包含判断用户权限文件
	$file_path = "../upfiles/video/";//定义视频文件路径
	$s_sqlstr = "select * from tb_video where id = ".$_GET['id'];//定义查询语句
	$result = $pdo->prepare($s_sqlstr);//准备查询
	$result->execute();//执行查询
	if($s_rst=$result->fetch(PDO::FETCH_NUM)){//将查询结果返回到数组并判断结果是否为真
		if(file_exists($file_path.$s_rst[16])){//如果文件存在
			if(unlink($file_path.$s_rst[16]) and unlink($file_path.$s_rst[2])){//删除文件及相应图片并判断结果是否为真
				$d_sqlstr = "delete from tb_video where id = ".$_GET['id'];//定义删除语句
				if($pdo->exec($d_sqlstr)){//如果执行删除语句结果为真
					echo "<script>alert('删除成功');location='main.php?action=video';</script>";//弹出对话框
					exit();//退出程序
				}else{
					echo "<script>alert('删除失败');history.go(-1);</script>";//弹出对话框
					exit();//退出程序
				}
			}
		}else{
			$d_sqlstr = "delete from tb_video where id = ".$_GET['id'];//定义删除语句
			if($pdo->exec($d_sqlstr)){//如果执行删除语句结果为真
				echo "<script>alert('此文件已删除~');location='main.php?action=video';</script>";//弹出对话框
				exit();//退出程序
			}else{
				echo "<script>alert('删除失败');history.go(-1);</script>";//弹出对话框
				exit();//退出程序
			}
		}
	} else
		echo "<script>alert('删除失败');history.go(-1);</script>";//弹出对话框
?>