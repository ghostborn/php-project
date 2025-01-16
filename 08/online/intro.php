<?php
header("Content-type: text/html; charset=utf-8"); //设置文件编码格式
session_start();//启动Session
include "conn/conn.php";//包含数据库连接文件
?>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        function chk_listen() {
            const name = "<?php echo $_SESSION['name'] ?? "";?>";//为变量赋值
            if (name == "") {//如果变量name的值为空
                alert('只有会员才能播放歌曲，请登录！');//弹出对话框
                return false;//返回false
            } else {
                return true;//返回true
            }
        }

        function chk_download() {
            const name = "<?php echo $_SESSION['name'] ?? "";?>";//为变量赋值
            const grades = "<?php echo $_SESSION['grades'] ?? "";?>";//为变量赋值
            if (name == "" || grades != "高级会员") {//如果变量name的值为空或者变量grades的值不是"高级会员"
                alert('只有高级会员登录后才能下载');//弹出对话框
                return false;//返回false
            } else {
                return true;//返回true
            }
        }
    </script>
    <body style="background-color: #f2f2f2">

	<?php
	$sql = "select * from tb_audio where id=" . $_GET['id'];//定义查询语句
	$result = $pdo->prepare($sql);//准备查询
	$result->execute();//执行查询
	if ($rst = $result->fetch(PDO::FETCH_NUM)){//将查询结果返回到数组并判断是否为真
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="w_1200"
           style="margin-top: 20px;margin-bottom: 20px; padding-bottom:36px;">
        <tr>
            <td width="34">&nbsp;</td>
            <td colspan="3">
                <span style="font-size: 20px;color: #2bb673; border-bottom: 4px solid #2bb673; line-height: 54px; margin: 0 0 6px 0px; padding-bottom: 10px">歌曲详情</span>
            </td>
        </tr>
        <tr>
            <td width="34"></td>
            <td colspan="2" height="1" bgcolor="#e5e5e5"></td>
        </tr>
        <tr>
            <td>
            </td>
            <td align="left" valign="top" style="padding-top:30px;">
                <table width="95%" border="0">
                    <tr>
                        <td width="30%" height="300" align="left" valign="middle">
                            <img name="news" src="<?php echo "upfiles/audio/" . $rst[2]; ?>"
                                 width="280" height="362" alt=""
                                 border="0"
                                 style=" border-color:#CCCCCC; margin-top:15px; margin-left:0px; margin-bottom:15px; margin-right:0px;"/>
                        </td>
                        <td width="70%" align="left" valign="top">
                            <table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                                <tr>
                                    <td height="60"
                                        style="font-size:22px; font-weight:bolder;"><?php echo $rst[1]; ?></td>
                                </tr>
                                <tr>
                                    <td width="280" height="50" align="left" style="font-size:18px;">
                                        歌手：<?php echo $rst[3]; ?></td>
                                </tr>
                                <tr>
                                    <td height="50" align="left" style="font-size:18px;">
                                        作词：<?php echo $rst[4]; ?></td>
                                </tr>
                                <tr>
                                    <td height="50" align="left" style="font-size:18px;">
                                        作曲：<?php echo $rst[5]; ?></td>
                                </tr>
                                <tr>
                                    <td height="50" align="left" style="font-size:18px;">
                                        歌曲类型：<?php echo $rst[10]; ?></td>
                                </tr>
                                <tr>
                                    <td height="50" align="left" style="font-size:18px;">
                                        语言：<?php echo $rst[12]; ?></td>
                                </tr>
                                <tr>
                                    <td height="50" align="left" style="font-size:18px;">
                                        发行时间：<?php echo $rst[18]; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <a href="operation.php?action=listen&id=<?php echo $rst[16]; ?>" target="_blank"
                               onClick="return chk_listen()"><img src="images/playsong.png"></a>
                            <a href="download.php?id=<?php echo $rst[16]; ?>&action=audio"
                               onClick="return chk_download()"><img src="images/downloadsong.png"></a>
                        </td>
                    </tr>
                    <tr>
                        <td height="44" colspan="2" style="font-size:18px;">&nbsp;&nbsp;歌曲简介：</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size:14px; line-height:30px;">
                            &nbsp;&nbsp;<?php echo $rst[14]; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
	<?php
}
?>