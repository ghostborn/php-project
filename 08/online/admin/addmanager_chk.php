<?php
	header("Content-type:text/html;charset=utf-8"); //设置文件编码格式
	session_start();//启动Session
	include "conn/conn.php";//包含数据库连接文件
	include "inc/chec.php";//包含判断用户权限文件
	$a_sql="select * from tb_manager where name='".$_POST['names']."'";//定义查询语句
	$result = $pdo->prepare($a_sql);//准备查询
	$result->execute();//执行查询
	if($a_rst=$result->fetch(PDO::FETCH_NUM))//将查询结果返回到数组并判断结果是否为真
		echo "<script>alert('该名称的管理员已经存在，请更换名称');history.go(-1);</script>";//弹出对话框
	else{
		$a_sqlstr="insert into tb_manager values('','".$_POST['names']."','".$_POST['password']."','".$_POST['grade']."','".$_POST['realname']."','".date("Y-m-d")."','1')";//定义插入语句
		if($pdo->exec($a_sqlstr)){//如果执行插入语句结果为真
?>
		<script>
			top.opener.location.reload(); 
			alert("管理员添加成功");
			top.window.close();
		</script>
<?php
		}
		else
			echo "<script>alert('添加失败".$a_sqlstr."');history.go(-1);</script>";//弹出对话框
	}
?>	