<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet">
<?php
include("../conn/conn.php");
$flag = isset($_POST['commend']) ? $_POST['commend'] : "";
if (!isset($_POST['commend'])) {
	$flag = $_GET['flag'];
}
if ($flag == "all") {
	$sql1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_advertising ORDER BY flag DESC");
} else {
	$sql1 = mysqli_query($conn, "select count(*) as total from tb_advertising where flag='$flag' order by flag desc");
}
$minfo = mysqli_fetch_array($sql1);
$total = $minfo['total'];
$pagesize = 4;
if ($total <= $pagesize) {
	$pagecount = 1;
}
if (($total % $pagesize) != 0) {
	$pagecount = intval($total / $pagesize) + 1;
} else {
	$pagecount = $total / $pagesize;
}
if (!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = intval($_GET['page']);
}
if ($flag == "all") {
	$sql = mysqli_query($conn,
		"select * from tb_advertising order by flag desc limit " . ($page - 1) * $pagesize . ",$pagesize");
} else {
	$sql = mysqli_query($conn,
		"select * from tb_advertising where flag='$flag' order by flag desc limit " . ($page - 1) * $pagesize . ",$pagesize");
}
$info = mysqli_fetch_array($sql);
?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="position">您现在的位置：易查供求信息网&nbsp;&gt;&nbsp;后台管理系统</td>
    </tr>
    <tr>
        <td height="20" background="images/default_t.jpg">&nbsp;</td>
    </tr>
    <tr>
        <td height="488" align="center" valign="top" background="images/default_m.jpg">
            <table width="650" border="1" cellpadding="0" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFCC33">
                <tr align="center" bgcolor="#FFCC33">
                    <td width="201">广告标题</td>
                    <td width="161">广告内容</td>
                    <td width="116">发布时间</td>
                    <td width="56">是否推荐</td>
                    <td width="56" height="22">操作</td>
                </tr>
				<?php
				if ($info) {
					do {
						if ($info['flag'] == "1") {
							$flag1 = "已推荐";
						} else {
							$flag1 = "未推荐";
						}
						?>
                        <tr bgcolor="#FFFFFF">
                            <td>&nbsp;<?php echo $info['title']; ?></td>
                            <td>&nbsp;<?php echo $info['content']; ?></td>
                            <td align="center"><?php echo $info['fdate']; ?></td>
                            <td align="center" bgcolor="#FFFFFF" class="style11"><?php echo $flag1; ?></td>
                            <td align="center" bgcolor="#FFFFFF"><a
                                        href="gg_ok.php?id=<?php echo $info['id']; ?>&flag=<?php echo $flag; ?>">推荐</a>/<a
                                        href="del_ok.php?id=<?php echo $info['id']; ?>&flag=<?php echo $flag; ?>">删除</a>
                            </td>
                        </tr>
						<?php
					} while ($info = mysqli_fetch_array($sql));
					?>
                    <tr bgcolor="#FFFFDD">
                        <td height="22" colspan="8" align="right">共有<?php
							echo $total;
							?>
                            条&nbsp;每页显示<?php echo $pagesize; ?>条&nbsp;第<?php echo $page; ?>
                            页/共<?php echo $pagecount; ?>页
							<?php
							if ($page >= 2) {
								?>
                                <a href="find_gg.php?flag=<?php echo $flag; ?>&page=1" title="首页"></a> <a
                                        href="find_gg.php?flag=<?php echo $flag; ?>&page=<?php echo $page - 1; ?>"
                                        title="上一页"></a>
								<?php
							}
							if ($pagecount <= 4) {
								for ($i = 1; $i <= $pagecount; $i++) {
									?>
                                    <a href="find_gg.php?flag=<?php echo $flag; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
									<?php
								}
							} else {
								for ($i = 1; $i <= 4; $i++) {
									?>
                                    <a href="find_gg.php?flag=<?php echo $flag; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
								<?php } ?>
                                <a href="find_gg.php?flag=<?php echo $flag; ?>&page=<?php echo $page - 1; ?>"
                                   title="下一页"></a> <a
                                        href="find_gg.php?flag=<?php echo $flag; ?>&page=<?php echo $pagecount; ?>"
                                        title="尾页"></a>
							<?php } ?>
                            &nbsp;
                        </td>
                    </tr>
					<?php
				} else {
					?>
                    <tr align="center" bgcolor="#FFFFFF">
                        <td colspan="8">对不起，您检索的信息不存在！</td>
                    </tr>
					<?php
				}
				?>
            </table>
        </td>
    </tr>
    <tr>
        <td height="27" background="images/default_e.jpg">&nbsp;</td>
    </tr>
</table>
