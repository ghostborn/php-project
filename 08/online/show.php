<?php
session_start();//启动Session
header("Content-type:text/html;charset=utf-8"); //设置文件编码格式
include "conn/conn.php";//包含数据库连接文件
?>
<!doctype html>
<script src="js/chk.js" language="javascript"></script>
<script type="text/javascript">
    function chk_see() {
        const name = "<?php echo $_SESSION['name'] ?? "";?>";//为变量赋值
        if (name == "") {//如果变量name的值为空
            alert('只有会员才能观看影片，请登录！');//弹出对话框
            return false;//返回false
        } else {
            return true;//返回true
        }
    }

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

    function chk_dot() {
        const name = "<?php echo $_SESSION['name'] ?? "";?>";//为变量赋值
        if (name == "") {//如果变量name的值为空
            alert('只有会员才能点歌，请登录！');//弹出对话框
            return false;//返回false
        } else {
            return true;//返回true
        }
    }
</script>
<link rel="stylesheet" href="css/style.css"/>
<body>
<?php
include "top.php";            //banner
?>
<!---->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="w_1200"
       style="margin-top: 12px; margin-bottom: 12px">
    <tr>
        <td height="42" align="center" valign="middle" bgcolor="" style=" font-size:16px; color:#333333;">查询结果</td>
    </tr>
</table>
<div style="" class="w_1200">
	<?php
	if (isset($_POST['action']) && $_POST['action'] == "l_found") {//如果POST方法传递的action参数的值为l_found
		$_SESSION['action'] = $_POST['action'];//为Session变量赋值
		$_SESSION['k_word'] = $_POST['k_word'];//为Session变量赋值
		$_SESSION['m_type'] = $_POST['m_type'];//为Session变量赋值
	}
	if (isset($_SESSION['action'])) {//如果Session变量action的值被设置
		if ($_SESSION['m_type'] == "video") {//如果Session变量m_type的值为video
			$l_sqlstr = "select * from tb_video where name like '%" . $_SESSION['k_word'] . "%'";//定义查询语句
			$result = $pdo->prepare($l_sqlstr);//准备查询
			$result->execute();//执行查询
			$total = $result->rowCount();//获取查询记录数
			$pagesize = 3;//每页显示3条数据
			$pages = ceil($total / $pagesize);//获取总页数
			$page = (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;//为当前页变量赋值
			$l_sqlstr = "select id,name,picture,actor,director,style,remark,address from tb_video where name like '%" . $_SESSION['k_word'] . "%' limit " . ($page - 1) * $pagesize . "," . $pagesize;//定义查询语句
			$result = $pdo->prepare($l_sqlstr);//准备查询
			$result->execute();//执行查询
			//$number = 0;//初始化变量
			while ($l_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
				//if(($number % 3) == 0){//如果变量的值是3的倍数就输出行标签<tr>

				//}
				?>
                <!--显示影视资料 -->
                <table width="32%" border="0" cellspacing="0" cellpadding="0" style="float:left; border: 1px solid #e5e5e5; margin-right: 1%">
                    <tr>
                        <td width="52%" align="left" valign="middle">
                            <a href="operation.php?action=see&id=<?php echo $l_rst[7]; ?>" target="_blank"
                                    onClick="return chk_see()">
                                <img name="news" src="<?php echo "upfiles/video/" . $l_rst[2]; ?>" width="100%" height="260" alt="" border="0" style=" border-color:#CCCCCC; margin-top:0px; margin-left:0px; margin-bottom:0px; margin-right:0px;"/>
                            </a>
                        </td>
                        <td align="center" valign="middle">
                            <table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" height="35" colspan="2" style="font-size:20px;">&nbsp;&nbsp;
                                        <a href="operation.php?action=see&id=<?php echo $l_rst[7]; ?>"
                                                target="_blank" onClick="return chk_see()"><?php echo $l_rst[1]; ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50" height="35" align="right" valign="middle">导演：</td>
                                    <td><?php echo $l_rst[4]; ?></td>
                                </tr>
                                <tr>
                                    <td height="35" align="right" valign="middle">主演：</td>
                                    <td><?php echo $l_rst[3]; ?></td>
                                </tr>
                                <tr>
                                    <td height="35" align="right" valign="middle">类型：</td>
                                    <td><?php echo $l_rst[5]; ?></td>
                                </tr>
                                <tr>
                                    <td height="35" colspan="2" align="left" valign="middle" style="padding-left:10%;">
                                        <a href="operation.php?action=see&id=<?php echo $l_rst[7]; ?>" target="_blank"
                                           onClick="return chk_see()">
                                            <img src="images/online_icon.png" border="0" alt="在线观看"/></a>
                                        <a href="download.php?id=<?php echo $l_rst[7] ?>&action=video"
                                           onClick="return chk_download()">
                                            <img src="images/down.png" border=0 alt="下载"/></a>&nbsp;
                                        <a href="operation.php?action=v_intro&id=<?php echo $l_rst[0]; ?>"
                                           target="_blank">
                                            <img src="images/show_icon.png" alt="介绍" border="0"/></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
				<?php
				//if(($number %3) == 2){//如果变量的值除以3的余数等于2就输出行结束标签</tr>

				//}
				//$number++;//变量自加1
			}
			?>
			<?php
		} else {
			?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="w_1200 list_music">
                <tr bgcolor="#ededed">
                    <td width="14%" height="54" align="left" valign="middle" style="font-size:18px;">歌曲分类</td>
                    <td width="20%" align="center" valign="middle" style="font-size:18px;">歌曲名称</td>
                    <td width="20%" align="center" valign="middle" style="font-size:18px;">主唱</td>
                    <td width="10%" align="center" valign="middle" style="font-size:18px;">歌曲简介</td>
                    <td width="12%" align="center" valign="middle" style="font-size:18px;">在线试听</td>
                    <td width="12%" align="center" valign="middle" style="font-size:18px;">下载</td>
                    <td width="12%" align="center" valign="middle" style="font-size:18px;">点歌</td>
                </tr>
				<?php
				$l_sqlstr = "select * from tb_audio where name like '%" . $_SESSION['k_word'] . "%'";//定义查询语句
				$result = $pdo->prepare($l_sqlstr);//准备查询
				$result->execute();//执行查询
				$total = $result->rowCount();//获取查询记录数
				$pagesize = 3;//每页显示3条数据
				$pages = ceil($total / $pagesize);//获取总页数
				$page = (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;//为当前页变量赋值
				$l_sqlstr = "select id,style,name,actor,remark,address from tb_audio where name like '%" . $_SESSION['k_word'] . "%' limit " . ($page - 1) * $pagesize . "," . $pagesize;//定义查询语句
				$result = $pdo->prepare($l_sqlstr);//准备查询
				$result->execute();//执行查询
				while ($l_rst = $result->fetch(PDO::FETCH_NUM)) {//循环输出查询结果
					?>
                    <tr class="list_tr" onMouseOver="this.style.backgroundColor='#f5f8fb'"
                        onMouseOut="this.style.backgroundColor=''" onchange="k_change();">
                        <td height="48" align="left" valign="middle" style="font-size:14px;">【<?php echo $l_rst[1]; ?>
                            】
                        </td>
                        <td align="center" valign="middle" style="font-size:14px;">
                            <a style="color: #2bb673;" href="operation.php?action=listen&id=<?php echo $l_rst[5]; ?>" target="_blank"
                               onClick="return chk_listen()"><?php echo $l_rst[2]; ?></a>
                        </td>
                        <td align="center" valign="middle" style="font-size:14px;"><?php echo $l_rst[3]; ?></td>
                        <td align="center" valign="middle">
                            <a href="operation.php?action=intro&id=<?php echo $l_rst[0]; ?>" target="_blank">
                                <img src="images/music_01.png" alt="介绍" border="0"/></a></td>
                        <td align="center" valign="middle">
                            <a href="operation.php?action=listen&id=<?php echo $l_rst[5]; ?>" target="_blank"
                               onClick="return chk_listen()">
                                <img src="images/music_02.png" border="0"/></a>
                        </td>
                        <td align="center" valign="middle">
                            <a href="download.php?id=<?php echo $l_rst[5] ?>&action=audio"
                               onClick="return chk_download()">
                                <img src="images/music_03.png" border="0"/></a>
                        </td>
                        <td align="center" valign="middle">
                            <a href='operation.php?action=give&id=<?php echo $l_rst[0]; ?>' target="_blank"
                               onClick="return chk_dot()">
                                <img src=images/music_04.png border="0" alt="点播"/></a></td>
                    </tr>
					<?php
				}
				?>
            </table>
			<?php
		}
	}
	?>
</div>

<table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" style="font-size:14px; font-weight:bolder;">
			<?php
			$url = $_SERVER['QUERY_STRING'];//获取URL查询的字符串
			parse_str($url, $arr);//将查询字符串解析到数组$arr中
			unset($arr['page']);//释放数组中page元素的值
			$url = http_build_query($arr);//构造URL字符串
			echo "第" . $page . "页/共" . $pages . "页&nbsp;&nbsp;&nbsp;";//输出
			if ($page == 1) {//如果当前页为第一页
				echo "首页&nbsp;上一页&nbsp;&nbsp;&nbsp;";//输出
			} else {
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $url . "&page=1'>首页</a>&nbsp;";//输出
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $url . "&page=" . ($page - 1) . "'>上一页</a>&nbsp;&nbsp;&nbsp;";    //输出
			}
			if ($page == $pages) {//如果当前页为最后一页
				echo "下一页&nbsp;尾页";//输出
			} else {
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $url . "&page=" . ($page + 1) . "'>下一页</a>&nbsp;";//输出
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?" . $url . "&page=" . $pages . "'>尾页</a>";    //输出
			}
			?>
        </td>
    </tr>
</table>
<?php
include "bottom.php";            //联系我们
?>

</body>