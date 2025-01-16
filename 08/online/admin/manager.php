<?php
include "inc/chec.php";//包含判断用户权限文件
include "conn/conn.php";//包含数据库连接文件
?>
<table width="380" height="440" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="4" valign="top">
            <table width="380" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="20" colspan="4" align="center" valign="middle">管 理 员 设 置</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="375" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="10" colspan="5" align="right" valign="middle"><a href="#"
                                                                                             onclick="javacript:Wopen=open('operation.php?action=addmanager','添加管理员','height=500,width=655,scrollbars=no');">管理员添加</a>
                                </td>
                            </tr>
                            <tr>
                                <td height="30" align="center" valign="middle">ID</td>
                                <td height="30" align="center" valign="middle">等级</td>
                                <td height="30" align="center" valign="middle">名称</td>
                                <td height="30" align="center" valign="middle">真实姓名</td>
                                <td height="30" align="center" valign="middle">操作</td>
                            </tr>
							<?php
							$m_sqlstr = "SELECT * FROM tb_manager WHERE id<>1 ORDER BY id";//定义查询语句
							$result = $pdo->prepare($m_sqlstr);//准备查询
							$result->execute();//执行查询
							while ($m_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
								?>
                                <tr>
                                    <td height="18" align="center" valign="middle"><?php echo $m_rst[0]; ?></td>
                                    <td height="18" align="center" valign="middle"><?php echo $m_rst[3]; ?></td>
                                    <td height="18" align="center" valign="middle"><?php echo $m_rst[1]; ?></td>
                                    <td height="18" align="center" valign="middle"><?php echo $m_rst[4]; ?></td>
                                    <form name="form1" method="post" action="m_freeze_chk.php">
                                        <td height="18" align="center" valign="middle">
											<?php
											if ($m_rst[6] == "1") //如果查询结果中第7个字段值为1
											{
												$bt = "冻结";
											} //为变量赋值
											else {
												$bt = "解冻";
											} //为变量赋值

											?>
                                            <input type="hidden" name="id" value="<?php echo $m_rst[0]; ?>">
                                            <input type="hidden" name="whether" value="<?php echo $m_rst[6]; ?>">
                                            <input type="submit" name="Submit2" class="submit"
                                                   value="<?php echo $bt; ?>">
                                            <a href="del_mfreeze_chk.php?id=<?php echo $m_rst[0]; ?>"
                                               onClick="return del_chk();">删除</a>
                                        </td>
                                    </form>
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

