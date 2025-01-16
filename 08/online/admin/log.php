<?php
	include "inc/chec.php";//包含判断用户权限文件
	include "conn/conn.php";//包含数据库连接文件
?>
<table width="380" height="440" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" valign="top"><table width="380" height="60" border="0" cellpadding="0" cellspacing="0"  >
        <tr>
          <td height="20" colspan="4" align="center" valign="middle">上 传 日 志 管 理</td>
        </tr>
        <tr>
          <td colspan="4"><table width="375" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="10" colspan="5" align="right" valign="middle"><a href="#" onclick="javacript:Wopen=open('operation.php?action=l_found','添加目录','height=500,width=665,scrollbars=no');">日志查询</a></td>
              </tr>
              <tr>
                <td height="30" align="center" valign="middle">ID</td>
                <td height="30" align="center" valign="middle">数据名称</td>
                <td height="30" align="center" valign="middle">用户名</td>
                <td height="30" align="center" valign="middle">上传时间</td>
                <td height="30" align="center" valign="middle">操作</td>
              </tr>
              <?php
			    $years=date("Y");//为变量赋值
				$months=date("m");//为变量赋值
				
			  	switch (isset($_GET['types'])?$_GET['types']:""){	//判断参数types的值
					case "all"://如果参数的值为all
						$q_date = $years."-".$months."-".$_GET['days'];//为变量赋值
						$l_sqlstr="select id,name,userName,issueDate,type,address  from tb_audio where property='用户' and issueDate like '%".$q_date."%' Union select id,name,userName,issueDate,type,address from tb_video where property='用户' and issueDate like '%".$q_date."%'";//定义查询语句
						break;//跳出switch语句
					case "audio"://如果参数的值为audio
						$q_date = $years."-".$months."-".$_GET['days'];//为变量赋值
						$l_sqlstr="select id,name,userName,issueDate,type,address from tb_audio where property='用户' and issueDate like '%".$q_date."%'";//定义查询语句
						break;//跳出switch语句
					case "video"://如果参数的值为video
						$q_date = $years."-".$months."-".$_GET['days'];//为变量赋值
			  			$l_sqlstr="select id,name,userName,issueDate,type,address from tb_video where property='用户' and issueDate like '%".$q_date."%'";//定义查询语句
						break;//跳出switch语句
					default:
			  			$l_sqlstr="select id,name,userName,issueDate,type,address from tb_audio where property='用户' Union select id,name,userName,issueDate,type,address from tb_video where property='用户'";//定义查询语句
						break;//跳出switch语句
				} 
				$result = $pdo->prepare($l_sqlstr);//准备查询
				$result->execute();//执行查询
				while($l_rst=$result->fetch(PDO::FETCH_NUM)){//循环输出查询结果
				?>
              <tr>
                <td height="18" align="center" valign="middle"><?php echo $l_rst[0]; ?></td>
                <td height="18" align="center" valign="middle"><?php echo $l_rst[1]; ?></td>
                <td height="18" align="center" valign="middle"><?php echo $l_rst[2]; ?></td>
                <td height="18" align="center" valign="middle"><?php echo $l_rst[3]; ?></td>
                	<form name="form1" method="post" action=""><td height="18" align="center" valign="middle">
					<input type="button" name="Submit2" class="submit" value="详细" onclick="javascript:Wopen=open('operation.php?action=<?php echo strrchr($l_rst[5],".")==".mp3"?"audio":"video"; ?>&id=<?php echo $l_rst[0]; ?>','','height=700,width=665,scrollbars=no');">                    
					</td></form>
              </tr>
              <?php
					}
			  ?>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>

