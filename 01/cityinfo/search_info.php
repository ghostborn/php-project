<link href="css/style.css" rel="stylesheet">
<?php
include("conn/conn.php");
?>
<table width="670" height="587" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="670" height="587" valign="top" bgcolor="#FFFFFF">
            <table width="670" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="670" height="37">&nbsp;
                        <img src="Images/landian.gif" width="9" height="9"><strong>付费专区</strong>
                    </td>
                </tr>
                <tr>
                    <td height="96" align="center" valign="top">
						<?php
						date_default_timezone_set("PRC");
						$date1 = date("Y-m-d");
						$sgsql = mysqli_query($conn,
							"select * from tb_leaguerinfo  where type='寻人/物启示' and showday>='$date1' and checkstate=1 ");
						$sginfo = mysqli_fetch_array($sgsql);
						if ($sginfo) {
							do {
								?>
                                <table width="647" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFFF4">
                                    <tr>
                                        <td height="26">
                                            <span class="style1">『寻人/物启示』</span>
                                            <span class="style8">&nbsp;<?php echo $sginfo['title']; ?>&nbsp;</span>
                                            <span class="style6">&nbsp;<?php echo $sginfo['sdate']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="26">&nbsp;&nbsp;
                                            <span class="style5"><?php echo $sginfo['content']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="26">&nbsp;
                                            <span class="style8">联系人：<?php echo $sginfo['linkman']; ?>&nbsp;&nbsp;&nbsp;联系电话：<?php echo $sginfo['tel']; ?></span>
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
                                    <td align="center">暂无寻人/物启示信息资源！</td>
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
                    <td height="37">&nbsp;
                        <img src="Images/landian.gif" width="9" height="9"><strong>免费专区</strong>
                    </td>
                </tr>
                <tr>
                    <td height="140" align="center" valign="top">
						<?php
						$sql = mysqli_query($conn,
							"SELECT COUNT(*) AS total FROM tb_info WHERE type='寻人/物启示' AND checkstate=1");
						$info = mysqli_fetch_array($sql);
						$total = $info['total'];
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
						$gsql = mysqli_query($conn,
							"select * from tb_info where type='寻人/物启示' and checkstate=1 order by edate desc limit " . ($page - 1) * $pagesize . ",$pagesize");
						$ginfo = mysqli_fetch_array($gsql);
						if ($ginfo) {
							do {
								?>
                                <table width="647" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFFF4">
                                    <tr>
                                        <td height="26">
                                            <span class="style1">『寻人/物启示』</span>
                                            <span class="style8">&nbsp;<?php echo $ginfo['title']; ?>&nbsp;</span>
                                            <span class="style6">&nbsp;<?php echo $ginfo['edate']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="26">&nbsp;&nbsp;
                                            <span class="style5"><?php echo $ginfo['content']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="26">&nbsp;
                                            <span class="style8">联系人：<?php echo $ginfo['linkman']; ?>&nbsp;&nbsp;&nbsp;联系电话：<?php echo $ginfo['tel']; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="3" background="Images/line1.gif"></td>
                                    </tr>
                                </table>
								<?php
							} while ($ginfo = mysqli_fetch_array($gsql));
							?>
                            <table width="650" height="27" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="650" height="27" colspan="3" align="right">共有<?php
										echo $total;
										?>
                                        条&nbsp;每页显示<?php echo $pagesize; ?>条&nbsp;第<?php echo $page; ?>
                                        页/共<?php echo $pagecount; ?>页
										<?php
										if ($page >= 2){
										?>
                                        <a href="search.php?page=1" title="首页"></a>
                                        <a href="search.php?page=<?php echo $page - 1; ?>" title="前一页">
											<?php
											}
											if ($pagecount <= 4) {
												for ($i = 1; $i <= $pagecount; $i++) {
													?>
                                                    <a href="search.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
													<?php
												}
											} else {
												for ($i = 1; $i <= 4; $i++) {
													?>
                                                    <a href="search.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
												<?php } ?>
                                                <a href="search.php?page=<?php echo $page - 1; ?>" title="后一页"></a>
                                                <a
                                                        href="search.php?page=<?php echo $pagecount; ?>"
                                                        title="尾页"></a>
											<?php } ?>
                                    </td>
                                </tr>
                            </table>
							<?php
						} else {
							?>
                            <table width="647" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">暂无寻人/物启示信息资源！</td>
                                </tr>
                            </table>
							<?php
						}
						?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
