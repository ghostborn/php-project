<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/style.css" rel="stylesheet">
<?php
include("../conn/conn.php");
$state = isset($_POST['state']) ? $_POST['state'] : "";
$type = isset($_POST['type']) ? $_POST['type'] : "";
if (!isset($_POST['type'])) {
	$state = $_GET['state'];
	$type = $_GET['type'];
}
if ($state == "all") {
	$sql1 = mysqli_query($conn, "select count(*) as total from tb_info where type='$type' order by edate");
} else {
	$sql1 = mysqli_query($conn,
		"select count(*) as total from tb_info where type='$type' and checkstate=$state order by edate");
}
$minfo = mysqli_fetch_array($sql1);
$total = $minfo['total'];
$pagesize = 10;
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
		"select * from tb_info where type='$type' order by edate limit " . ($page - 1) * $pagesize . ",$pagesize");
} else {
	$sql = mysqli_query($conn,
		"select * from tb_info where type='$type' and checkstate=$state order by edate limit " . ($page - 1) * $pagesize . ",$pagesize");
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
                    <td width="90">信息标题</td>
                    <td width="190">信息内容</td>
                    <td width="50">联系人</td>
                    <td width="73">联系电话</td>
                    <td width="130">发布时间</td>
                    <td width="50">审核状态</td>
                    <td width="60">操作</td>
                </tr>
				<?php
				if ($info) {
					do {
						if ($info['checkstate'] == 1) {
							$state1 = "已审核";
						} else {
							$state1 = "未审核";
						}
						?>
                        <tr bgcolor="#FFFFFF">
                            <td align="center"><?php echo $info['title']; ?></td>
                            <td>&nbsp;<?php echo $info['content']; ?></td>
                            <td align="center"><?php echo $info['linkman']; ?></td>
                            <td align="center"><?php echo $info['tel']; ?></td>
                            <td align="center"><?php echo $info['edate']; ?></td>
                            <td align="center" class="style11"><?php echo $state1; ?></td>
                            <td align="center" bgcolor="#FFFFFF">
                                <a href="state_ok.php?id=<?php echo $info['id']; ?>&type=<?php echo $type; ?>&state=<?php echo $state; ?>">审核</a>/
                                <a href="miandel_ok.php?id=<?php echo $info['id']; ?>&type=<?php echo $type; ?>&state=<?php echo $state; ?>">删除</a>
                            </td>
                        </tr>
						<?php
					} while ($info = mysqli_fetch_array($sql));
					?>
                    <tr bgcolor="#FFFFDD">
                        <td height="22" colspan="7" align="right">共有<?php
							echo $total;
							?>
                            条&nbsp;每页显示<?php echo $pagesize; ?>条&nbsp;第<?php echo $page; ?>
                            页/共<?php echo $pagecount; ?>页
							<?php
							if ($page >= 2) {
								?>
                                <a href="find_mianfei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=1"
                                   title="首页"></a>
                                <a href="find_mianfei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $page - 1; ?>"
                                   title="上一页"></a>
								<?php
							}
							if ($pagecount <= 4) {
								for ($i = 1; $i <= $pagecount; $i++) {
									?>
                                    <a href="find_mianfei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
									<?php
								}
							} else {
								for ($i = 1; $i <= 4; $i++) {
									?>
                                    <a href="find_mianfei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
								<?php } ?>
                                <a href="find_mianfei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $page - 1; ?>"
                                   title="下一页"></a>
                                <a href="find_mianfei.php?type=<?php echo $type; ?>&state=<?php echo $state; ?>&page=<?php echo $pagecount; ?>"
                                   title="尾页"></a>
							<?php } ?>
                            &nbsp;
                        </td>
                    </tr>
					<?php
				} else {
					?>
                    <tr align="center" bgcolor="#FFFFFF">
                        <td colspan="7">对不起，您检索的信息不存在！</td>
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
