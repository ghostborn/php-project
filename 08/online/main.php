<?php
include "conn/conn.php";//包含数据库连接文件
$l_sqlstr = "SELECT * FROM tb_video ORDER BY id DESC LIMIT 0,4";//定义查询语句
$l_sqlstr1 = "SELECT * FROM tb_video ORDER BY id DESC LIMIT 0,15";//定义查询语句
$l_sqlstr2 = "SELECT * FROM tb_audio ORDER BY id DESC LIMIT 0,4";//定义查询语句

?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>无标题文档</title>
</head>

<body>
<!--最新影视-->
<table width="100%" height="70" border="0" style="margin-left:0;">
    <tr>
        <td align="left" valign="bottom" style="font-size:22px;">电影</td>
        <td width="10%" align="right" valign="bottom" style="padding-right:1%;">
            <a href="list.php?action=video" style=" font-size:14px;">更多></a>
        </td>
    </tr>
</table>
<?php
$l_sqlstr4 = "SELECT * FROM tb_video WHERE downTime = (SELECT MAX(downTime) FROM tb_video)";//定义查询语句
$result4 = $pdo->prepare($l_sqlstr4);//准备查询
$result4->execute();//执行查询
$l_rst4 = $result4->fetch(PDO::FETCH_NUM)//将查询结果返回到数组
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-left:0;">
    <tr>
        <td width="440">
            <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                <tr>
                    <td><a href="operation.php?action=see&id=<?php echo $l_rst4[16]; ?>" target="_blank"
                           onClick="return chk_see()"><img src="<?php echo "upfiles/video/" . $l_rst4[2]; ?>"
                                                           width="100%" height="420"/></a></td>
                </tr>
                <tr>
                    <td height="40" valign="bottom" style="padding-left:20px; font-size:20px; color: #333333"><a
                                href="operation.php?action=see&id=<?php echo $l_rst4[16]; ?>" target="_blank"
                                onClick="return chk_see()"><?php echo $l_rst4[1]; ?></a></td>
                </tr>
                <tr>
                    <td height="40" valign="middle"
                        style="padding-left:20px; font-size:14px; color: #7a7a7a"><?php echo $l_rst4[14]; ?></td>
                </tr>
            </table>
        </td>
        <td width="54%" align="center">
            <table width="100%" border="0">
				<?php
				$result = $pdo->prepare($l_sqlstr);//准备查询
				$result->execute();//执行查询
				$number = 0;//初始化变量
				while ($l_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
					if (($number % 2) == 0) {//如果变量的值是偶数就输出行标签<tr>
						?>
                        <tr>
						<?php
					}
					?>
                    <td width="49%" align="center">
                        <!--显示影视资料 -->
                        <table width="97%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF"
                               style="margin:0px 0px 8px 0px;">
                            <tr>
                                <td align="center">
                                    <a href="operation.php?action=see&id=<?php echo $l_rst[16]; ?>"
                                       target="_blank" onClick="return chk_see()">
                                        <img name="news" src="<?php echo "upfiles/video/" . $l_rst[2]; ?>" width="100%"
                                             height="172" alt="" border="0"/>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td height="32" valign="bottom"
                                    style="padding-left:10px; font-size:18px; color: #333333">
                                    <a href="operation.php?action=see&id=<?php echo $l_rst[16]; ?>" target="_blank"
                                       onClick="return chk_see()"><?php echo $l_rst[1]; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td height="32" valign="middle"
                                    style="padding-left:10px; font-size:14px; color: #7a7a7a"><?php echo $l_rst[14]; ?></td>
                            </tr>
                        </table>
                    </td>
					<?php
					if (($number % 2) != 0) {//如果变量的值不是偶数就输出行结束标签</tr>
						?>
                        </tr>
						<?php
					}
					$number++;//变量自加1
				}
				?>
            </table>
        </td>
    </tr>
</table>

<!--音乐-->
<table width="100%" height="70" border="0" style="margin-left:0%; margin-top:20px;">
    <tr>
        <td align="left" valign="bottom" style="font-size:22px;">歌曲</td>
        <td width="10%" align="right" valign="bottom" style="padding-right:1%;">
            <a href="list.php?action=audio" style=" font-size:14px;">更多></a>
        </td>
    </tr>
</table>
<?php
$l_sqlstr6 = "SELECT * FROM tb_audio WHERE downTime = (SELECT MAX(downTime) FROM tb_audio)";//定义查询语句
$result6 = $pdo->prepare($l_sqlstr6);//准备查询
$result6->execute();//执行查询
$l_rst6 = $result6->fetch(PDO::FETCH_NUM)//将查询结果返回到数组
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-left:0%; margin-bottom:32px;">
    <tr>
        <td width="440">
            <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                <tr>
                    <td><a href="operation.php?action=listen&id=<?php echo $l_rst6[16]; ?>" target="_blank"
                           onClick="return chk_listen()"><img src="<?php echo "upfiles/audio/" . $l_rst6[2]; ?>"
                                                              width="100%" height="416"/></a></td>
                </tr>
                <tr>
                    <td height="40" valign="bottom" style="padding-left:20px; font-size:22px;color: #333333;"><a
                                href="operation.php?action=listen&id=<?php echo $l_rst6[16]; ?>" target="_blank"
                                onClick="return chk_listen()"><?php echo $l_rst6[1]; ?></a></td>
                </tr>
                <tr>
                    <td height="40" valign="middle"
                        style="padding-left:20px; font-size:14px  color: #7a7a7a;"><?php echo $l_rst6[14]; ?></td>
                </tr>
            </table>
        </td>
        <td width="54%" align="center" valign="top">
            <table width="100%" border="0">
				<?php
				$result2 = $pdo->prepare($l_sqlstr2);//准备查询
				$result2->execute();//执行查询
				$number = 0;//初始化变量
				while ($l_rst2 = $result2->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
					if (($number % 2) == 0) {//如果变量的值是偶数就输出行标签<tr>
						?>
                        <tr>
						<?php
					}
					?>
                    <td width="50%" align="center">
                        <!--显示歌曲资料 -->
                        <table width="97%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF"
                               style="margin:3px;">
                            <tr>
                                <td align="center">
                                    <a href="operation.php?action=listen&id=<?php echo $l_rst2[16]; ?>"
                                       target="_blank" onClick="return chk_listen()">
                                        <img name="news" src="<?php echo "upfiles/audio/" . $l_rst2[2]; ?>" width="100%"
                                             height="172" alt="" border="0"/>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td height="30" valign="bottom" style="padding-left:10px; font-size:18px;">
                                    <a href="operation.php?action=listen&id=<?php echo $l_rst2[16]; ?>"
                                       target="_blank" onClick="return chk_listen()"><?php echo $l_rst2[1]; ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td height="30" valign="middle"
                                    style="padding-left:10px; font-size:14px; color:#818181"><?php echo $l_rst2[14]; ?></td>
                            </tr>
                        </table>
                    </td>
					<?php
					if (($number % 2) != 0) {//如果变量的值不是偶数就输出行结束标签</tr>
						?>
                        </tr>
						<?php
					}
					$number++;//变量自加1
				}
				?>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
