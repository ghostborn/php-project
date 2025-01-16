<?php
include "inc/chec.php";//包含判断用户权限文件
include "conn/conn.php";//包含数据库连接文件
?>
<table width="380" height="440" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="4" valign="top">
            <table width="380" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="20" colspan="4" align="center" valign="middle">会 员 等 级 管 理</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="375" border="0" align="center" cellpadding="2" cellspacing="0">
                            <tr>
                                <td height="10" colspan="3" align="right" valign="middle">
                                    <a href="#" onclick="javacript:Wopen=open('operation.php?action=v_grade','参数更新','height=500,width=665,scrollbars=no');">参数更新</a>
                                </td>
                            </tr>
                            <tr>
                                <td width="47" height="30" align="center" valign="middle">ID</td>
                                <td height="30" align="center" valign="middle">项目名称</td>
                                <td height="30" align="center" valign="middle">项目参数</td>
                            </tr>
							<?php $a_sql = "SELECT * FROM tb_grade";//定义查询语句
							$result = $pdo->prepare($a_sql);//准备查询
							$result->execute();//执行查询
							while ($a_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
								?>
                                <tr>
                                    <td height="20" align="center" valign="middle"><?php echo $a_rst[0]; ?></td>
                                    <td height="20" align="center" valign="middle"><?php echo $a_rst[1]; ?></td>
                                    <td height="20" align="center" valign="middle"><?php echo $a_rst[2]; ?></td>
                                </tr>
								<?php
							}
							?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>