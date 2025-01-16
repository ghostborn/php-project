<?php
include "conn/conn.php";//包含数据库连接文件
include "inc/chec.php";//包含判断用户权限文件
?>
<table width="380" height="440" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="4" valign="top">
            <table width="380" height="60" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="20" colspan="4" align="center" valign="middle">会 员 数 据 管 理</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="375" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="10" colspan="5" align="right" valign="middle"><a href="#"
                                                                                             onClick="javacript:Wopen=open('operation.php?action=v_found','参数更新','height=500,width=665,scrollbars=no');">会员信息查询</a>
                                </td>
                            </tr>
                            <tr>
                                <td width="40" height="30" align="center" valign="middle">ID</td>
                                <td width="54" height="30" align="center" valign="middle">等级</td>
                                <td width="76" height="30" align="center" valign="middle">用户名</td>
                                <td width="78" height="30" align="center" valign="middle">上传次数</td>
                                <td width="95" align="center" valign="middle">操作</td>
                            </tr>
							<?php
							if (!isset($_GET['types']))//如果参数types的值为空
							{
								$v_sqlstr = "SELECT * FROM tb_account";
							}//定义查询语句
							else {
								switch ($_GET['types']) {//判断参数types的值
									case "name"://如果参数值为name
										$other = "name like '%" . $_GET['key'] . "%'";//定义字符串
										break;//跳出switch语句
									case "realname"://如果参数值为realname
										$other = "realname like '%" . $_GET['key'] . "%'";//定义字符串
										break;//跳出switch语句
									case "grade"://如果参数值为grade
										$other = "grade='" . $_GET['key'] . "'";//定义字符串
										break;//跳出switch语句
									case "counts"://如果参数值为counts
										$other = "counts<='" . $_GET['key'] . "'";//定义字符串
										break;//跳出switch语句
									case "sex"://如果参数值为sex
										$other = "sex='" . $_GET['key'] . "'";//定义字符串
										break;//跳出switch语句
								}
								$v_sqlstr = "select * from tb_account where " . $other;//定义查询语句
							}
							$result = $pdo->prepare($v_sqlstr);//准备查询
							$result->execute();//执行查询
							while ($v_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
								?>
                                <tr>
                                    <td height="18" align="center" valign="middle"><?php echo $v_rst[0]; ?></td>
                                    <td height="18" align="center" valign="middle"><?php echo $v_rst[12]; ?></td>
                                    <td height="18" align="center" valign="middle"><?php echo $v_rst[1]; ?></td>
                                    <td height="18" align="center" valign="middle"><?php echo $v_rst[11]; ?></td>
                                    <form name="form1" method="post" action="freeze_chk.php">
                                        <td height="18" align="center" valign="middle">
											<?php
											if ($v_rst[13] == "1")//如果查询结果中第18个字段值为1
											{
												$fd = "冻结";
											} //为变量赋值
											else {
												$fd = "解冻";
											}//为变量赋值
											?>
                                            <input type="hidden" name="id" value="<?php echo $v_rst[0]; ?>">
                                            <input type="hidden" name="whether" value="<?php echo $v_rst[13]; ?>">
                                            <input type="submit" name="Submit2" class="submit"
                                                   value="<?php echo $fd; ?>">
                                            <a href="del_freeze_chk.php?id=<?php echo $v_rst[0]; ?>"
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