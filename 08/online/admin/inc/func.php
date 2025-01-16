<?php
	//判断目录名是否重复
	//$f_fields：字段名
	//$tablename：数据表名
	//$f_str：要查找的字段
	function is_chk($f_fields,$tablename,$f_str){
		$is_chk = true;//初始化变量
		include "../conn/conn.php";//包含数据库连接文件
		$is_sqlstr = "select $f_fields from $tablename";//定义查询语句
		$result = $pdo->prepare($is_sqlstr);//准备查询
		$result->execute();//执行查询
		while($is_rst=$result->fetch(PDO::FETCH_NUM)){//循环输出查询结果
			if($f_str == $is_rst[0]){//如果两个值相等
				$is_chk = false;//为变量赋值
				break;//跳出循环
			}
		}
		return $is_chk;//返回变量的值
	}
	//判断文件后缀
	//$f_type：允许文件的后缀类型
	//$f_upfiles：上传文件名
	function f_postfix($f_type,$f_upfiles){
		$is_pass = false;
		$tmp_upfiles = explode(".",$f_upfiles);
		$tmp_num = count($tmp_upfiles);
		for($num = 0; $num < count($f_type);$num++){
			if(strtolower($tmp_upfiles[$tmp_num - 1]) == $f_type[$num]){
				$is_pass = $f_type[$num];
			}
		}
		return $is_pass;
	}
?>