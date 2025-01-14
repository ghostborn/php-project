<?php
session_start();
include "Conn/conn.php";
include "check_login.php";
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="CSS/style.css" rel="stylesheet">
    <title>我的文章</title>
    <style>
        .style1 {
            color: #FF0000
        }
    </style>
</head>
<script src=" JS/menu.JS"></script>
<script src=" JS/UBBCode.JS"></script>
<script language="javascript">
    function check() {
        if (myform.txt_title.value == "") {
            alert("博客主题名称不允许为空！");
            myform.txt_title.focus();
            return false;
        }
        if (myform.file.value == "") {
            alert("文章内容不允许为空！");
            myform.file.focus();
            return false;
        }
    }
</script>
<body>
<div class=menuskin id=popmenu
     onmouseover="clearhidemenu();highlightmenu(event,'on')"
     onmouseout="highlightmenu(event,'off');dynamichide(event)"
     style="Z-index:100;position:absolute;">
</div>
<TABLE width="920" cellPadding=0 cellSpacing=0 align="center" background="images/F_head.jpg">
    <TBODY>
    <TR>
        <TD style="VERTICAL-ALIGN: bottom; HEIGHT: 6px" colSpan=3>
            <TABLE align="center" cellSpacing=0 cellPadding=0>
                <TBODY>
                <TR>
                    <TD height="123" colspan="6"></TD>
                </TR>
                <TR>
                    <TD height="26" align="center" valign="middle">
                        <TABLE width="650" cellSpacing=0 cellPadding=0 align="center">
                            <TBODY>
                            <TR align="center">
                                <TD style="WIDTH: 110px; COLOR: red;">欢迎您:&nbsp;<?php echo $_SESSION['username']; ?>
                                    &nbsp;&nbsp;
                                </TD>
                                <TD style="WIDTH: 90px; COLOR: red;"><SPAN
                                            style="FONT-SIZE: 9pt; COLOR: #cc0033"> </SPAN><a
                                            href="index.php">博客首页</a></TD>
                                <TD style="WIDTH: 90px; COLOR: red;"><a onmouseover=showmenu(event,productmenu)
                                                                        onmouseout=delayhidemenu() class='navlink'
                                                                        style="CURSOR:hand">文章管理</a></TD>
                                <TD style="WIDTH: 90px; COLOR: red;"><a onmouseover=showmenu(event,Honourmenu)
                                                                        onmouseout=delayhidemenu() class='navlink'
                                                                        style="CURSOR:hand">图片管理</a></TD>
                                <TD style="WIDTH: 100px; COLOR: red;"><a onmouseover=showmenu(event,myfriend)
                                                                         onmouseout=delayhidemenu() class='navlink'
                                                                         style="CURSOR:hand">朋友圈管理</a></TD>
								<?php
								if ($_SESSION['fig'] == 1) {
									?>
                                    <TD style="WIDTH: 90px; COLOR: red;"><a onmouseover=showmenu(event,myuser)
                                                                            onmouseout=delayhidemenu() class='navlink'
                                                                            style="CURSOR:hand">管理员管理</a></TD>
									<?php
								}
								?>
                                <TD style="WIDTH: 90px; COLOR: red;"><a href="safe.php">退出登录</a></TD>
                            </TR>
                            </TBODY>
                        </TABLE>
                    </TD>
                </TR>
                </TBODY>
            </TABLE>
        </TD>
    </TR>
    <TR>
        <TD colSpan=3 valign="baseline" style="BACKGROUND-IMAGE: url( images/bg.jpg);">
            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="500" align="center" valign="top">

                        <table width="600" height="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="130" align="center" valign="top">
									<?php
									if (!isset($_GET['page'])) {
										$page = 1;
									} else {
										$page = $_GET['page'];
									}
									?><br>
                                    <table width="680" border="0" align="center" cellpadding="3" cellspacing="1"
                                           bgcolor="#9CC739">
                                        <tr align="left">
                                            <td width="390" height="25" valign="top" bgcolor="#EFF7DE"><span
                                                        class="tableBorder_LTR"> 查看我的文章 </span></td>
                                        </tr>
										<?php
										$page_size = 10;     //每页显示20条记录
										$query = "select count(*) as total from tb_article where author = '" . $_SESSION['username'] . "' order by id desc";
										$result = mysqli_query($link, $query);       //查询总的记录条数
										$data = mysqli_fetch_array($result); //将查询结果返回到数组
										$message_count = $data['total'];//获取查询总记录数
										$page_count = ceil($message_count / $page_size);      //根据记录总数除以每页显示的记录数求出所分的页数
										$offset = ($page - 1) * $page_size;            //计算下一页从第几条数据开始循环
										$sql = mysqli_query($link,
											"select id,title from tb_article where author = '" . $_SESSION['username'] . "' order by id desc limit $offset, $page_size");
										$info = mysqli_fetch_array($sql);

										?>
                                        <tr>
                                            <td height="31" align="center" valign="top" bgcolor="#FFFFFF">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <table width="100%" border="0" cellspacing="0"
                                                                   cellpadding="0" valign="top">
																<?php
																if (!$info){
																	?>
                                                                    <tr>
                                                                        <td align="center"><font color=#ff0000>您还未添加任何文章!</font>
                                                                        </td>
                                                                    </tr>
																	<?php
																}else{
																$i = $offset + 1;//文章序号
																do {
																	?>
                                                                    <tr>
                                                                        <td height="35" style="padding-left:30px"><a
                                                                                    style="font-size:14px; color:#0066FF"
                                                                                    href="showmy.php?file_id=<?php echo $info['id']; ?>"><?php echo $i . "、" . $info['title']; ?></a>
                                                                        </td>
                                                                    </tr>
																	<?php
																	$i = $i + 1;
																} while ($info = mysqli_fetch_array($sql));
																?>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="680" height="30" border="0" align="center" cellpadding="0"
                                           cellspacing="0">
                                        <tr bgcolor="#EFF7DE">
                                            <td width="33%">&nbsp;&nbsp;页次：<?php echo $page; ?>
                                                /<?php echo $page_count; ?>页&nbsp;记录：<?php echo $message_count; ?> 条&nbsp;
                                            </td>
                                            <td width="67%" align="right" class="hongse01">
												<?php
												if ($page != 1) {
													echo "<a href=myfiles.php?page=1>首页</a>&nbsp;";
													echo "<a href=myfiles.php?page=" . ($page - 1) . ">上一页</a>&nbsp;";
												}
												if ($page < $page_count) {
													echo "<a href=myfiles.php?page=" . ($page + 1) . ">下一页</a>&nbsp;";
													echo "<a href=myfiles.php?page=" . $page_count . ">尾页</a>";
												}
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
            </table>
        </TD>
    </TR>
    </TBODY>
</TABLE>
</body>
</html>
