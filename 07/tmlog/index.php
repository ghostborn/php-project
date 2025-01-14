<?php
session_start();
include "Conn/conn.php";
include "function.php";//包含函数文件
date_default_timezone_set("PRC");
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>博客Sky</title>
    <link href="CSS/style.css" rel="stylesheet"/>
</head>
<?php
$str = array("大", "更", "创", "天", "科", "客", "博", "技", "立", "新");//定义数组
$word = count($str);//获取数组长度
$img = "";//初始化变量
$pic = "";//初始化变量
for ($i = 0; $i < 4; $i++) {
	$num = rand(0, $word - 1);      //$word=$word*2-1
	$img = $img . "<img src=' images/checkcode/" . $num . ".gif' width='16' height='16'>";    //显示随机图片
	$pic = $pic . $str[$num];    //将图片转换成数组中的文字
}
?>
<script src="JS/check.js" language="javascript">
</script>
<body onselectstart="return false">
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr align="right" valign="top">
        <td height="149" colspan="2" background="images/head.jpg">
            <table width="100%" height="149" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="51" align="right">
                        <br>
                        <table width="262" border="0" cellspacing="0" cellpadding="0">
                            <tr align="left">
                                <td width="26" height="20"><a href="index.php"></a></td>
                                <td width="71" class="word_white"><a href="index.php"><span
                                                style="FONT-SIZE: 9pt; COLOR: #000000; TEXT-DECORATION: none">首  页</span></a>
                                </td>
                                <td width="87"><a href="file.php"><span
                                                style="FONT-SIZE: 9pt; COLOR: #000000; TEXT-DECORATION: none">我的博客</span></a>
                                </td>
                                <td width="55"><a
                                            href="<?php echo(!isset($_SESSION['username']) ? 'Regpro.php' : 'safe.php'); ?>"><span
                                                style="FONT-SIZE: 9pt; COLOR: #000000; TEXT-DECORATION: none"><?php echo(!isset($_SESSION['username']) ? "博客注册" : "安全退出"); ?></span></a>
                                </td>
                                <td width="23">&nbsp;</td>
                            </tr>
                        </table>
                        <br></td>
                </tr>
                <tr>
                    <td height="73" align="right"><p>&nbsp;</p></td>
                </tr>
                <tr>
                    <form name="form" method="post" action="checkuser.php">
                        <td height="20" valign="baseline">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="32%" height="20" align="center" valign="baseline">&nbsp;</td>
                                    <td width="67%" align="left" valign="baseline" style="text-indent:10px;">
										<?php
										if (!isset($_SESSION['username'])) {
											?>
                                            用户名:
                                            <input name=txt_user size="10">
                                            密码:
                                            <input name=txt_pwd type=password style="FONT-SIZE: 9pt; WIDTH: 65px"
                                                   size="6">
                                            验证码:
                                            <input name="txt_yan" style="FONT-SIZE: 9pt; WIDTH: 65px" size="8">
                                            <input type="hidden" name="txt_hyan" id="txt_hyan"
                                                   value="<?php echo $pic; ?>">
											<?php echo $img; ?> &nbsp;
                                            <input style="FONT-SIZE: 9pt" type=submit value=登录 name=sub_dl
                                                   onClick="return f_check(form)">
                                            &nbsp;
											<?php
										} else {
											?>
                                            <font color="red"><?php echo $_SESSION['username']; ?></font>&nbsp;&nbsp;BCCD博客网站欢迎您的光临！！！当前时间：
                                            <font color="red"><?php echo date("Y-m-d l"); ?>
                                            </font>
											<?php
										}
										?>
                                    </td>
                                    <td width="1%" align="center" valign="baseline">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </form>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="236" height="501" style="background:url(images/left.jpg) no-repeat">
            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="155" align="center" valign="top">
						<?php include "cale.php"; ?>
                    </td>
                </tr>
                <tr>
                    <td height="125" align="center" valign="top"><br>

                        <table width="200" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="201" border="0" cellspacing="0" cellpadding="0" valign="top"
                                           style="margin-top:5px;">
										<?php
										$sql = mysqli_query($link,
											"SELECT id,title FROM tb_article ORDER BY now DESC LIMIT 4");
										$i = 1;
										while ($info = mysqli_fetch_array($sql)) {
											?>
                                            <tr>
                                                <td width="201" height="23" align="left" valign="top">
                                                    &nbsp;&nbsp;&nbsp;<a
                                                            href="article.php?file_id=<?php echo $info['id']; ?>"
                                                            target="_blank"><?php echo $i . "、" . msubstr($info['title'],
																0, 30);
														if (strlen($info['title']) > 30) {
															echo "...";
														} ?></a>
                                                </td>
                                            </tr>
											<?php
											$i = $i + 1;
										}
										?>
                                        <tr>
                                            <td height="10" align="right"><a href="file_more.php"><img
                                                            src=" images/more.gif" width="27" height="9" border="0">&nbsp;&nbsp;&nbsp;</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="201" align="center" valign="top"><br>
                        <table width="145" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="201" border="0" cellspacing="0" cellpadding="0" valign="top"
                                           style="margin-top:5px;">
										<?php
										$sql = mysqli_query($link,
											"SELECT id,tpmc,file FROM tb_tpsc ORDER BY scsj DESC LIMIT 1");
										$info = mysqli_fetch_array($sql);
										?>
                                        <tr>
                                            <td width="9" rowspan="2" align="center">&nbsp;</td>
                                            <td width="147" align="center"><a
                                                        href="image.php?recid=<?php echo $info['id']; ?>"
                                                        target="_blank"><img
                                                            src="f_image.php?pic_id=<?php echo $info['id']; ?>"
                                                            width="170" height="140" border="0"></a></td>
                                            <td width="10" rowspan="2" align="center">&nbsp;</td>
                                        </tr>
                                        <tr height="26">
                                            <td align="center">图片名称：<?php echo $info['tpmc']; ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" height="10" align="right"><a href="pic_more.php"><img
                                                            src=" images/more.gif" width="27" height="9" border="0">&nbsp;&nbsp;&nbsp;</a>
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
        <td width="684" height="501" align="center" background="images/right.jpg">
            <table width="100%" height="98%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="372" align="center">
                        <table style="WIDTH: 300px" cellspacing=0 cellpadding=0>
                            <tbody>
                            <tr>
                                <td style="HEIGHT: 280px" rowspan=2>
									<?php
									$p_sql = "SELECT * FROM tb_public ORDER BY id DESC";
									$p_rst = mysqli_query($link, $p_sql);

									?>
                                    <marquee onMouseOver=this.stop()
                                             onMouseOut=this.start()
                                             scrollamount=2 scrolldelay=7 direction=up>

										<?php
										while ($p_row = mysqli_fetch_row($p_rst)) {
											?>
                                            <a href="#" style="height:30px; line-height:30px; font-size:14px"
                                               onclick="wopen=open('show_pub.php?id=<?php echo $p_row[0]; ?>','','height=200,width=500,scollbars=no')">--<?php echo $p_row[1]; ?>
                                                --
                                            </a><br>
											<?php
										}
										?>
                                    </marquee>
                                </td>
                            </tr>
                            <tr></tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="66">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>

