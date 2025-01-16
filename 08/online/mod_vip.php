<?php
include "conn/conn.php";//包含数据库连接文件
$m_sqlstr = "select * from tb_account where id = " . $_SESSION['id'];//定义查询语句
$result = $pdo->prepare($m_sqlstr);//准备查询
$result->execute();//执行查询
if ($m_rst = $result->fetch(PDO::FETCH_NUM)) {//将查询结果返回到数组并判断是否为真
	?>
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                    <form id="reg" name="reg" method="post" enctype="multipart/form-data" action="mod_vip_chk.php">
                        <tr>
                            <td width="50" rowspan="18" align="center" valign="top">&nbsp;</td>
                            <td height="20" colspan="2" align="center" valign="top">&nbsp;</td>
                            <td width="50" rowspan="18" align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle" scope="col">用户名：</td>
                            <td align="left" valign="middle" scope="col">
                                <input type="text" name="name" id="name"
                                       class="usual"
                                       value="<?php echo $m_rst[1]; ?>"
                                       readonly="readonly"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">密码：</td>
                            <td align="left" valign="middle">
                                <input type="password" name="password" id="password"
                                       class="usual"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                                <span class="STYLE1"> *</span>(最少3位)
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">确认密码：</td>
                            <td align="left" valign="middle">
                                <input type="password" name="t_password" id="t_password"
                                       class="usual"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                                <span class="STYLE1"> *</span>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">性别：</td>
                            <td align="left" valign="middle">
								<?php if ($m_rst[5] == "男") { ?>
                                    <input name="sex" id="sex" type="radio" value="男" checked/>男
                                    <input name="sex" id="sex" type="radio" value="女"/>女
								<?php } else { ?>
                                    <input name="sex" id="sex" type="radio" value="男"/>男
                                    <input name="sex" id="sex" type="radio" value="女" checked/>女
								<?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">上传头像：</td>
                            <td align="left" valign="middle">
                                <input type="file" name="head" id="head"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">年龄：</td>
                            <td align="left" valign="middle">
                                <input type="text" name="age" id="age" class="usual"
                                       value="<?php echo $m_rst[6]; ?>"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">职业：</td>
                            <td align="left" valign="middle">
                                <input type="text" name="job" id="job" class="usual"
                                       value="<?php echo $m_rst[7]; ?>"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">E-mail：</td>
                            <td align="left" valign="middle">
                                <input type="text" name="email" id="email" class="usual"
                                       value="<?php echo $m_rst[8]; ?>"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">联系地址：</td>
                            <td align="left" valign="middle">
                                <input type="text" name="address" id="address"
                                       class="usual" value="<?php echo $m_rst[9]; ?>"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="100" height="40" align="right" valign="middle">QQ：</td>
                            <td align="left" valign="middle">
                                <input type="text" name="qq" id="qq" class="usual"
                                       value="<?php echo $m_rst[10]; ?>"
                                       onmouseover="this.style.backgroundColor='#deebef'"
                                       onmouseout="this.style.backgroundColor=''"/>
                            </td>
                        </tr>
                        <tr>
                            <td height="30" colspan="2" align="center" valign="middle">
                                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                <input type="hidden" name="oldhead" value="<?php echo $m_rst[14]; ?>"/>
                                <input name="regi" type="submit" id="regi" value="修改"
                                       onclick="return mod_chk();"/>(<span class="STYLE1">*</span>号为必填项)
                                <input name="reset" type="reset" id="reset" value="重置"/>
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
    </table>
	<?php
}
?>
