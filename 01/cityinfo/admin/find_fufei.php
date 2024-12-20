<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet">
<?php
include("../conn/conn.php");
$state = isset($_POST['payfor']) ? $_POST['payfor'] : "";
$type = isset($_POST['select']) ? $_POST['select'] : "";
if (!isset($_POST['select'])) {
	$state = $_GET['state'];
	$type = $_GET['type'];
}
if ($state == "all") {
	$sql1 = mysqli_query($conn, "select count(*) as total from tb_leaguerinfo  where type='$type' order by id");
} else {
	$sql1 = mysqli_query($conn,
		"select count(*) as total from tb_leaguerinfo  where type='$type' and checkstate=$state order by id");
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
if ($state == "all") {
	$sql = mysqli_query($conn,
		"select * from tb_leaguerinfo  where type='$type' order by id limit " . ($page - 1) * $pagesize . ",$pagesize");
} else {
	$sql = mysqli_query($conn,
		"select * from tb_leaguerinfo  where type='$type' and checkstate=$state order by id limit " . ($page - 1) * $pagesize . ",$pagesize");
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
            &nbsp;&nbsp;当前信息类别：&nbsp;『<span class="style11">&nbsp;<?php echo $type; ?>&nbsp;</span>』<br>
            <table width="650" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFCC33">
                <tr align="center" bgcolor="#FFCC33">
                    <td width="120">信息标题</td>
                    <td width="50">信息内容</td>
                    <td width="50">联系人</td>
                    <td width="86">联系电话</td>
                    <td width="66">发布日期</td>
                    <td width="66">截止日期</td>
                    <td width="50">审核状态</td>
                    <td>操作</td>
                </tr>
				<?php
				if ($info) {
					do {
						if ($info['checkstate'] == 1) {
							$state1 = "已付费";
						} else {
							$state1 = "未付费";
						}
						?>
                        <tr bgcolor="#FFFFFF">
                            <td align="center"><?php echo $info['title']; ?></td>
                            <td>&nbsp;<?php echo $info['content']; ?></td>
                            <td align="center"><?php echo $info['linkman']; ?></td>
                            <td align="center"><?php echo $info['tel']; ?></td>
                            <td align="center"><?php echo $info['sdate']; ?></td>
                            <td align="center"><?php echo $info['showday']; ?></td>
                            <td align="center" class="style11"><?php echo $state1; ?></td>
                            <td align="center" bgcolor="#FFFFFF"><a
                                        href="statefu_ok.php?id=<?php echo $info['id']; ?>&type=<?php echo $type; ?>&state=<?php echo $state; ?>">审核</a>/<a
                                        href="fudel_ok.php?id=<?php echo $info['id']; ?>&type=<?php echo $type; ?>&state=<?php echo $state; ?>">删除</a>
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
                                <a href="find_fufei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=1"
                                   title="首页"></a> <a
                                        href="find_fufei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $page - 1; ?>"
                                        title="上一页"></a>
								<?php
							}
							if ($pagecount <= 4) {
								for ($i = 1; $i <= $pagecount; $i++) {
									?>
                                    <a href="find_fufei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
									<?php
								}
							} else {
								for ($i = 1; $i <= 4; $i++) {
									?>
                                    <a href="find_fufei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
								<?php } ?>
                                <a href="find_fufei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $page - 1; ?>"
                                   title="下一页"></a> <a
                                        href="find_fufei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $pagecount; ?>"
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
