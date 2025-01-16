<?php
include "conn/conn.php";//包含数据库连接文件
$s_sqlstr = "select * from tb_register where toName='" . $_SESSION['name'] . "' order by issueDate Desc";//定义查询语句
$result = $pdo->prepare($s_sqlstr);//准备查询
$result->execute();//执行查询
?>
<table width="558" height="110" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="567" height="46" align="center" valign="bottom" style="font-size:24px;">点 歌 信 息 查 看</td>
    </tr>
    <tr>
        <td>
            <table width="559" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" height="318">
                        <table width="404" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="402" height="312" valign="top">
                                    <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center" width="400" valign="top">
												<?php
												if ($s_rst = $result->fetch(PDO::FETCH_NUM)) {//将查询结果返回到数组中并判断结果是否为真
													do {//循环输出查询结果
														?>
                                                        <table width="400" border="0" cellspacing="0" cellpadding="0">
                                                        <tr valign="top">
                                                            <td height="15" colspan="4">&nbsp;</td>
                                                        </tr>
														<?php
														$s_sqlstr1 = "select * from tb_audio where id=" . $s_rst[1];//定义查询语句
														$result1 = $pdo->prepare($s_sqlstr1);//准备查询
														$result1->execute();//执行查询
														if ($s_rst1 = $result1->fetch(PDO::FETCH_NUM)) {//将查询结果返回数组并判断是否为真
															?>
                                                            <tr valign="top">
                                                                <td align="right" width="130" height="30">歌曲名称：</td>
                                                                <td width="165" height="30"><a
                                                                            href="operation.php?action=dotlisten&id=<?php echo $s_rst[0]; ?>&name=<?php echo $s_rst1[16]; ?>"><?php echo $s_rst1[1]; ?></a>
                                                                </td>
                                                                <td align="right" width="75" height="30">点歌人：</td>
                                                                <td width="103" height="30">
																	<?php echo $s_rst[2]; ?>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <td align="right" width="110">祝语：</td>
                                                                <td height="55" colspan="3">
                                                                    <textarea name="textarea" cols="40"
                                                                              rows="3"><?php echo $s_rst[4]; ?></textarea>
                                                                </td>
                                                            </tr>
                                                            </table>
															<?php
														}
													} while ($s_rst = $result->fetch(PDO::FETCH_NUM));
												} else {
													echo "暂无点歌信息！";
												}
												?></td>
                                        </tr>
                                        <tr>
                                            <td height="30">
                                                <div align="center">
                                                    <input name="Submit2" type="button" value="  返  回  "
                                                           onClick="javascript:window.open('','_self');window.close()">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>