<?php
include_once("top.php");
include_once("bbs_top.php");//调用社区论坛的头文件

?>
    <div class="main-box">
		<?php
		$sql = mysqli_query($conn, "select * from tb_type_big order by createtime desc");
		$info = mysqli_fetch_array($sql);
		if ($info == false) {
			?>
            <div class="no-bbs">
                暂无论坛版块！
            </div>
			<?php
		} else {
			do {
				?>
                <div class="bbs-table">
                    <div class="bbs-table-title">
                        <span><?php echo unhtml($info["title"]); ?></span>
                    </div>
                    <table cellspacing="1" bgcolor="#6EBEC7">
						<?php
						$sql1 = mysqli_query($conn,
							"select * from tb_type_small where bigtypeid= '" . $info["id"] . "'");
						$info1 = mysqli_fetch_array($sql1);
						if ($info1 == false) {
							?>
                            <tr>
                                <td height="20" colspan="4" bgcolor="#FFFFFF">
                                    <div align="center" style="font-weight: bold; color: #DC4A01">该版块暂时无讨论区！
                                    </div>
                                </td>
                            </tr>
							<?php
						} else {
							?>
                            <tr bgcolor="#FFFFFF">
                                <td height="20" bgcolor="F0F5F9">&nbsp;</td>
                                <td width="520" height="20" bgcolor="F0F5F9">
                                    <div align="left" style="font-weight: bold; color: #DC4A01">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo unhtml($info["title"]); ?></div>
                                </td>
                                <td bgcolor="F0F5F9">
                                    <div align="center" style="font-weight: bold; color: #DC4A01">发帖数</div>
                                </td>
                                <td bgcolor="F0F5F9">
                                    <div align="center" style="font-weight: bold; color: #DC4A01">热门帖数</div>
                                </td>
                            </tr>
							<?php
							do {
								?>
                                <tr>
                                    <td width="62" height="60" bgcolor="F0F5F9">
                                        <div align="center"><img src="images/lt_15_3.jpg" width="40" height="36"/></div>
                                    </td>
                                    <td height="60" bgcolor="F0F5F9">
                                        <table width="474" height="60" border="0" align="center" cellpadding="0"
                                               cellspacing="0">
                                            <tr>
                                                <td width="474" height="30">&nbsp;<strong><a
                                                                href="bbs_list.php?id=<?php echo $info1["id"]; ?>"
                                                                class="a1"><?php echo unhtml($info1["title"]); ?></a></strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="30"><font
                                                            color="#666666">创建时间：<?php echo $info1["createtime"]; ?></font>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="81" height="60" bgcolor="F0F5F9">
                                        <div align="center"><?php
											$sqlt = mysqli_query($conn,
												"select count(*) as totalt from tb_bbs where typeid='" . $info1["id"] . "'");
											$infot = mysqli_fetch_array($sqlt);
											echo $infot["totalt"];
											?></div>
                                    </td>
                                    <td width="82" height="60" bgcolor="F0F5F9">
                                        <div align="center"><?php
											$sqlt = mysqli_query($conn,
												"select count(*) as totalt from tb_bbs where typeid='" . $info1["id"] . "' and readtimes>10");
											$infot = mysqli_fetch_array($sqlt);
											echo $infot["totalt"];
											?></div>
                                    </td>
                                </tr>
								<?php
							} while ($info1 = mysqli_fetch_array($sql1));
						}
						?>
                    </table>
                </div>
				<?php
			} while ($info = mysqli_fetch_array($sql));
		}
		?>
    </div>
<?php
include_once("bottom.php");
?>