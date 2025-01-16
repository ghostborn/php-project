<?php
session_start();//启动Session
include "inc/chec.php";//包含判断用户权限文件
include "conn/conn.php";//包含数据库连接文件
?>
<link href="css/style.css" rel="stylesheet"/>
<script src="js/admin_js.js" language="javascript"></script>
<script type="text/javascript">
    function MM_popupMsg(msg) { //v1.0
        if (confirm(msg))
            return true;
        else
            return false;
    }
</script>
<table width="828" cellpadding="0" cellspacing="0">
    <tr>
        <td height="12" background="images/side.jpg">&nbsp;</td>
    </tr>
    <tr>
        <td height="96" colspan="2" scope="col" background="images/banner.jpg">&nbsp;</td>
    </tr>
    <tr>
        <td height="12" background="images/side.jpg">&nbsp;</td>
    </tr>
</table>

<table width="828" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="201" height="500" align="center" valign="top" bgcolor="#f0f0f0">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f0f0f0">
                <tr>
                    <td height="33" background="images/menu.jpg">&nbsp;</td>
                </tr>
                <tr>
                    <td>
						<?php
						include "left.php";//包含文件
						?>
                    </td>
                </tr>
            </table>
        </td>
        <td align="center" valign="top" bgcolor="#f0f0f0">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f0f0f0">
                <tr>
                    <td height="34" align="right" valign="middle" background="images/line.jpg"><a href="logout.php"
                                                                                                  onclick="return MM_popupMsg('是否要退出登录');">退出登录</a>&nbsp;
                    </td>
                </tr>
                <tr>
                    <td height="15" bgcolor="#f0f0f0">&nbsp;</td>
                </tr>
                <tr>
                    <td height="427" align="center" valign="top"
                        style="background-image:url(images/bg.jpg); background-repeat:no-repeat; background-position:center;">
                        <div style="height:35px;">&nbsp;</div>
						<?php
						/*  根据不同的参数，显示不同的功能界面  */
						switch (isset($_GET['action']) ? $_GET['action'] : "") {//判断参数action的值
							case "audioList"://如果参数值为audioList
								include "a_list.php";//包含a_list.php文件
								break;//跳出switch语句
							case "videoList"://如果参数值为videoList
								include "v_list.php";//包含v_list.php文件
								break;//跳出switch语句
							case "audio"://如果参数值为audio
								include "audio.php";//包含audio.php文件
								break;//跳出switch语句
							case "video"://如果参数值为video
								include "video.php";//包含video.php文件
								break;//跳出switch语句
							case "grade"://如果参数值为grade
								include "grade.php";//包含grade.php文件
								break;//跳出switch语句
							case "member"://如果参数值为member
								include "member.php";//包含member.php文件
								break;//跳出switch语句
							case "log"://如果参数值为log
								include "log.php";//包含log.php文件
								break;//跳出switch语句
							case "manager"://如果参数值为manager
								include "manager.php";//包含manager.php文件
								break;//跳出switch语句
							default://默认值
								include "a_list.php";//包含a_list.php文件
								break;//跳出switch语句
						}
						?>            </td>
                </tr>
                <tr>
                    <td height="15" bgcolor="#f0f0f0">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>