<?php
include "conn/conn.php";//包含数据库连接文件
include "inc/chec.php";//包含判断用户权限文件
?>
<table width="558" height="110" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="567" height="26" align="center" valign="middle"><font style="font-size:13px; ">会 员 等 级 评 定 参 数
                更 新</font></td>
    </tr>
    <tr>
        <td>
            <table width="559" height="94" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="92">
                        <table width="404" height="90" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="402" valign="top">
                                    <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <form name="list" method="post" action="v_grade_chk.php">
                                            <tr>
                                                <td height="15" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="150" height="35" align="right" valign="middle">项 目 名 称
                                                    ：
                                                </td>
                                                <td width="250" height="35" align="left" valign="middle">
                                                    <select name="name">
														<?php
														$g_sqlstr = "SELECT * FROM tb_grade";//定义查询语句
														$result = $pdo->prepare($g_sqlstr);//准备查询
														$result->execute();//执行查询
														while ($g_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果

															?>
                                                            <option value="<?php echo $g_rst[0]; ?>"
                                                                    selected="selected"><?php echo $g_rst[1]; ?></option>
															<?php
														}
														?>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td height="35" align="right" valign="middle">参 数 值 ：</td>
                                                <td height="35" align="left" valign="middle"><input name="price"
                                                                                                    type="text"
                                                                                                    size="20"></td>
                                            </tr>
                                            <tr>
                                                <td height="30" colspan="2" align="center" valign="middle">
                                                    <input name="Submit" type="submit" value="更  新">
                                                    <input name="Submit2" type="button" value="返  回"
                                                           onClick="javascript:top.window.close()"></td>
                                            </tr>
                                        </form>
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