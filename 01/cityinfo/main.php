<link rel="stylesheet" href="css/style.css">
<?php
include("conn/conn.php");
?>
<table width="670" height="587" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="670" height="587" valign="top" bgcolor="#FFFFFF">
            <table width="670" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="670" height="37">
                        <img src="Images/landian.gif" alt="" width="9" height="9">
                        <strong>付费专区</strong>
                    </td>
                </tr>
                <tr>
                    <td height="96" align="center" valign="top">
						<?php
						date_default_timezone_set('PRC');
						$date1 = date("Y-m-d"); //获取当前日期
						$sgsql = mysqli_query($conn,
							"select * from tb_leaguerinfo where type='公寓信息' and showday >= '$date1' and checkstate=1"); //查询付费的公寓信息
						$sginfo = mysqli_fetch_array($sgsql); //将查询结果集返回到数组
						if ($sginfo) {
							do { //循环输出付费的公寓信息
								?>
                                <table width="647" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFFF4">
                                    <tr>
                                        <td height="26">
                                            <span class="style1">『公寓信息』</span>
                                            <span class="style8"><?php echo $sginfo['title']; ?></span>
                                            <span class="style6"><?php echo $sginfo['sdate']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="26"><span class="style5"><?php echo $sginfo['content']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="26">
                                    <span class="style8">
                                        联系人: <?php echo $sginfo['linkman']; ?>
                                        联系电话: <?php echo $sginfo['tel']; ?>
                                    </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="3" background="Images/line1.gif"></td>
                                    </tr>
                                </table>
								<?php
							} while ($sginfo = mysqli_fetch_array($sgsql));
						} else {
							?>
                            <table width="647" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">暂无公寓信息资源！</td>
                                </tr>
                            </table>
							<?php
						}
						?>
                    </td>
                </tr>

                <tr>
                    <td align="center" valign="top">
                        <table width="667" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="87" background="Images/pcard2.png">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="37">
                        &nbsp;<img src="Images/landian.gif" width="9" height="9"><strong>免费专区</strong>
                    </td>
                </tr>
                <tr>
                    <td height="140" align="center" valign="top">
						<?php
						//查询免费的公寓信息
						$sql = mysqli_query($conn,
							"SELECT COUNT(*) AS total FROM tb_info WHERE type='公寓信息' AND checkstate=1");
						$info = mysqli_fetch_array($sql); //将查询结果集返回到数组
						$total = $info['total']; //获取查询记录总数
						$pagesize = 4; //每页显示记录数
						if ($total <= $pagesize) {
							$pagecount = 1; //定义总页数
						}
						if (($total % $pagesize) != 0) {
							$pagecount = intval($total / $pagesize) + 1; //计算总页数
						} else {
							$pagecount = $total / $pagesize; //计算总页数
						}
						if (!isset($_GET['page'])) {
							$page = 1; //定义当前页
						} else {
							$page = intval($_GET['page']); //获取当前页
						}
						?>
                    </td>
                </tr>


            </table>
        </td>
    </tr>
</table>
