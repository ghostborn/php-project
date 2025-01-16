<?php
session_start();//启动Session
header("Content-type:text/html;charset=utf-8"); //设置文件编码格式
if (isset($_SESSION['name'])) {//如果Session变量name的值被设置
	echo "<script>alert('您已经登录！');history.back();</script>";//弹出对话框
}
?>
<title>用户登录</title>
<script src="js/chk.js" language="javascript"></script>
<link rel="stylesheet" href="css/style.css"/>
<center>
	<?php
	include "top.php";            //banner
	?>
    <table width="265" border="0" cellspacing="0" cellpadding="0" style="margin-top: 40px; margin-bottom: 40px;">
        <form name="loginform" id="loginform" action="login_chk.php" method="post">
            <tr>
                <td height="30" colspan="2" align="center" valign="top" background="images/login.jpg">&nbsp;</td>
            </tr>
            <tr>
                <td height="20" colspan="2" align="center" valign="middle" class="l_td">&nbsp;</td>
            </tr>
            <tr>
                <td width="93" height="35" align="right" valign="middle" class="l_td"><strong>用户名：</strong></td>
                <td width="180" height="35" align="left" valign="middle" class="l_td">
                    <input type="text" id="name" name="name" size="15"
                           onmouseover="this.style.backgroundColor='#deebef'"
                           onmouseout="this.style.backgroundColor=''"/>
                </td>
            </tr>
            <tr>
                <td height="35" align="right" valign="middle" class="l_td">
                    <strong>密 &nbsp;码：</strong>
                </td>
                <td height="35" align="left" valign="middle" class="l_td">
                    <input type="password" id="password"
                           name="password" size="15"
                           onmouseover="this.style.backgroundColor='#deebef'"
                           onmouseout="this.style.backgroundColor=''"/>
                </td>
            </tr>
            <tr>
                <td height="40" align="left" valign="middle" class="l_td">
                    <input type="submit" name="login" id="login" value="" onclick="return chk_log();"/>
                </td>
                <td height="40" align="left" valign="middle" class="l_td">
                    <a href="operation.php?action=found" id="dw"
                       class="b" target="_blank">[忘记密码]
                    </a>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="2" align="center" valign="middle" class="l_td">&nbsp;</td>
            </tr>
        </form>
    </table>
	<?php
	include "bottom.php";            //联系我们
	?>
</center>