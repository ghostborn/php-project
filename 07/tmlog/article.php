<?php
session_start();
include "Conn/conn.php";
date_default_timezone_set("PRC");
$file_id = $_GET['file_id'];
$bool = false;
$str = array("大", "更", "创", "天", "科", "客", "博", "技", "立", "新");
$word = count($str);
$img = "";
$pic = "";
for ($i = 0; $i < 4; $i++) {
	$num = rand(0, $word - 1);      //$word=$word*2-1
	$img = $img . "<img src=' images/checkcode/" . $num . ".gif' width='16' height='16'>";    //显示随机图片
	$pic = $pic . $str[$num];    //将图片转换成数组中的文字
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="CSS/style.css" rel="stylesheet">
    <title>浏览博客文章及评论</title>
    <script src="JS/check.js" language="javascript">
    </script>
    <script language="javascript">
        function r_check() {
            if (document.myform.txt_content.value == "") {
                alert("评论内容不能为空!");
                myform.txt_content.focus();
                return false;
            }
        }

        function d_chk(urlstr) {
            if (confirm("确定要删除选中的项目吗？一旦删除将不能恢复！")) {
                return true;
            } else
                return false;
        }

        function fri_chk() {
            if (confirm("确定要删除选中的项目吗？一旦删除将不能恢复！")) {
                return true;
            } else
                return false;
        }
    </script>
</head>
<body style="MARGIN-TOP: 0px; VERTICAL-ALIGN: top; PADDING-TOP: 0px; TEXT-ALIGN: center">
<TABLE width="920" align="center" cellPadding=0 cellSpacing=0>
    <TBODY>
    <TR>
        <TD colSpan=3 background="images/F_head.jpg">
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
                    <td height="66" align="right"><p>&nbsp;</p></td>
                </tr>
                <tr>
                    <form name="form" method="post" action="checkuser.php">
                        <td height="20" valign="baseline">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="20" align="center" valign="baseline" style=" text-indent:50px;">
										<?php
										if (!isset($_SESSION['username'])) {
											?>
                                            用户名:
                                            <input name=txt_user size="10">
                                            密码:
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
										?></td>
                                    <td width="1%" align="center" valign="baseline">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </form>
                </tr>
            </table>

        </TD>
    </TR>
    <TR>
        <TD colSpan=3 valign="baseline"
            style="BACKGROUND-IMAGE: url( images/bg.jpg); VERTICAL-ALIGN: middle; HEIGHT: 450px; TEXT-ALIGN: center">
            <br>
            <br>
            <table align="center" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="130" align="center" valign="middle">
                        <table width="680" border="0" align="center" cellpadding="3" cellspacing="1"
                               bordercolor="#9CC739" bgcolor="#FFFFFF">
                            <tr align="left">
                                <td height="25" valign="top" bgcolor="#EFF7DE"><span
                                            class="tableBorder_LTR"> 博客文章</span></td>
                            </tr>
                            <tr>
                                <td align="center"> <?php
									$sql = mysqli_query($link, "select * from tb_article where id = " . $file_id);
									$result = mysqli_fetch_array($sql);
									?>
                                    <table width="666" border="0" cellpadding="5" cellspacing="1" bordercolor="#D6E7A5"
                                           bgcolor="#FFFFFF" class="i_table">
                                        <tr bgcolor="#FFFFFF" height="30">
                                            <td width="14%" align="center">博客ID号</td>
                                            <td width="15%"><?php echo $result['id']; ?></td>
                                            <td width="11%" align="center">作
                                                者
                                            </td>
                                            <td width="18%"><?php echo $result['author']; ?></td>
                                            <td width="12%" align="center">发表时间</td>
                                            <td width="20%"><?php echo $result['now']; ?></td>
                                        </tr>
                                        <tr bgcolor="#FFFFFF" height="30">
                                            <td align="center">博客主题</td>
                                            <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['title']; ?></td>
                                        </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td align="center">文章内容</td>
                                            <td colspan="4" style="line-height:1.5">
                                                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['content']; ?></td>
                                            <td><?php
												if ((isset($_SESSION['fig']) && $_SESSION['fig'] == 1) or (isset($_SESSION['username']) && $_SESSION['username'] == $result['author'])) {
													$bool = true;
													?>
                                                    <a href="del_file.php?file_id=<?php echo $result['id']; ?>"><img
                                                                src="images/A_delete.gif" width="52" height="16"
                                                                alt="删除博客文章" onClick="return fri_chk();"></a>
													<?php
												}
												?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
						<?php
						if (!isset($_GET['page'])) {
							$page = 1;
						} else {
							$page = $_GET['page'];
						}
						?><br>
                        <table width="680" border="0" align="center" cellpadding="3" cellspacing="1"
                               bordercolor="#9CC739" bgcolor="#FFFFFF">
                            <tr align="left">
                                <td width="390" height="25" valign="top" bgcolor="#EFF7DE"><span
                                            class="tableBorder_LTR"> 查看相关评论</span></td>
                            </tr>
							<?php
							$page_size = 2;     //每页显示4条记录
							$query = "select count(*) as total from tb_filecomment where fileid='$file_id' order by id desc";
							$result = mysqli_query($link, $query);       //查询总的记录条数
							$data = mysqli_fetch_array($result);
							$message_count = $data['total'];//获取查询总记录数
							$page_count = ceil($message_count / $page_size);      //根据记录总数除以每页显示的记录数求出所分的页数
							$offset = ($page - 1) * $page_size;            //计算下一页从第几条数据开始循环
							$sql = mysqli_query($link,
								"select * from tb_filecomment where fileid='$file_id' order by id desc limit $offset, $page_size");
							$result = mysqli_fetch_array($sql);
							if ($result == false){
								echo "<tr><td align='center'><font color=#ff0000>对不起，没有相关评论!</font></td></tr>";
							}
							else{
							do {
								?>
                                <tr>
                                    <td align="center" valign="top">
                                        <table width="666" border="0" cellpadding="5" cellspacing="1"
                                               bordercolor="#D6E7A5" bgcolor="#FFFFFF" class="i_table">
                                            <tr bgcolor="#FFFFFF" height="30">
                                                <td width="14%" align="center">评论ID号</td>
                                                <td width="15%"><?php echo $result['id']; ?></td>
                                                <td width="11%" align="center">评论人</td>
                                                <td width="18%"><?php echo $result['username']; ?></td>
                                                <td width="12%" align="center">评论时间</td>
                                                <td width="20%"><?php echo $result['datetime']; ?></td>
                                            </tr>
                                            <tr bgcolor="#FFFFFF">
                                                <td align="center">评论内容</td>
                                                <td colspan="4" style="line-height:1.5">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['content']; ?></td>
                                                <td>
													<?php
													if ($bool) {
														?>
                                                        <a href="del_comment.php?comment_id=<?php echo $result['id'] ?>"><img
                                                                    src="images/A_delete.gif" width="52" height="16"
                                                                    alt="删除博客文章评论"
                                                                    onClick="return d_chk();"></a>
														<?php
													}
													?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
								<?php
							} while ($result = mysqli_fetch_array($sql));
							?>
                        </table>
                        <table width="680" height="26" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr bgcolor="#EFF7DE">
                                <td width="52%">&nbsp;&nbsp;页次：<?php echo $page; ?>/<?php echo $page_count; ?>页
                                    记录：<?php echo $message_count; ?> 条&nbsp;
                                </td>
                                <td align="right" class="hongse01">
									<?php
									if ($page != 1) {
										echo "<a href=article.php?page=1&file_id=" . $file_id . ">首页</a>&nbsp;";
										echo "<a href=article.php?page=" . ($page - 1) . "&file_id=" . $file_id . ">上一页</a>&nbsp;";
									}
									if ($page < $page_count) {
										echo "<a href=article.php?page=" . ($page + 1) . "&file_id=" . $file_id . ">下一页</a>&nbsp;";
										echo "<a href=article.php?page=" . $page_count . "&file_id=" . $file_id . ">尾页</a>";
									}
									}
									?> </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <!--  发表评论  -->
                        <form name="myform" method="post" action="check_comment.php">
                            <table width="680" border="0" align="center" cellpadding="3" cellspacing="1"
                                   bordercolor="#9CC739" bgcolor="#FFFFFF">
                                <tr align="left">
                                    <td width="390" height="25" valign="top" bgcolor="#EFF7DE"><span class="right_head"><SPAN
                                                    style="FONT-SIZE: 9pt; COLOR: #cc0033"></SPAN></span><span
                                                class="tableBorder_LTR"> 发表评论</span></td>
                                </tr>
                                <td height="112" align="center" valign="top">
                                    <input name="htxt_fileid" type="hidden" value="<?php echo $_GET['file_id']; ?>">
                                    <table width="600" border="0" cellpadding="1" cellspacing="0" bordercolor="#D6E7A5"
                                           bgcolor="#FFFFFF">
                                        <tr>
                                            <td align="center">我要评论</td>
                                            <td width="510"><textarea name="txt_content" cols="70" rows="8"
                                                                      id="txt_content"></textarea></td>
                                        </tr>
                                        <tr align="center">
                                            <td colspan="2"><input type="submit" name="submit" value="提交"
                                                                   onClick="return r_check();">
                                                &nbsp;
                                                <input type="reset" name="submit2" value="重置"></td>
                                        </tr>
                                    </table>
                                </td>
                            </table>
                        </form>
                        <br>
                        <!-------------->
                    </td>
                </tr>
            </table>
        </TD>
    </TR>
    </TBODY>
</TABLE>
</body>
</html>
